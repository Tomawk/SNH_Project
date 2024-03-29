<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Message Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }
    .message-container {
      text-align: center;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

    <?php
    session_start();
    require('../inc/db.php');
    require('../forMail/mail.php');
    require('hashing_psw.php');
    require('log.php');
    if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

    if(!isset($_POST["new_password"])  || !isset($_POST["confirm_password"])  || !isset($_POST["link"])){
        echo "some field are missing";
        exit();
    }

    $link = $_POST['link'];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $old_password = $_POST["old_password"];

    // CLEAR + SANITIZE
    $new_password = trim($new_password); //Remove whitespaces
    $new_password = stripcslashes($new_password);
    $new_password = htmlspecialchars($new_password); //Convert special characters to HTML entities
    $new_password = mysqli_real_escape_string($con,$new_password); //SQL Injection prevention

    $confirm_password = trim($confirm_password); //Remove whitespaces
    $confirm_password = stripcslashes($confirm_password);
    $confirm_password = htmlspecialchars($confirm_password); //Convert special characters to HTML entities
    $confirm_password = mysqli_real_escape_string($con,$confirm_password); //SQL Injection prevention

    $old_password = trim($old_password); //Remove whitespaces
    $old_password = stripcslashes($old_password);
    $old_password = htmlspecialchars($old_password); //Convert special characters to HTML entities
    $old_password = mysqli_real_escape_string($con,$old_password); //SQL Injection prevention


    // VALIDATION

    if (strlen($new_password) < 7 || strlen($new_password) > 255) {
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Operation Failed</h1>";
        echo "<p>Password should be at least 8 digit long</p>";
    }
    elseif (!preg_match("#[0-9]+#",$new_password)) {
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Operation Failed</h1>";
        echo "<p>Password should contain at least a number</p>";
    }
    elseif(!preg_match("#[A-Z]+#",$new_password)) {
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Operation Failed</h1>";
        echo "<p>Password should contain at least one uppercase char</p>";
    }
    elseif(!preg_match("#[a-z]+#",$new_password)) {
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Operation Failed</h1>";
        echo "<p>Password should contain at least one lowercase char</p>";
    } else {

        $sql = "SELECT * FROM users where link = ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$link);
        $stmt->execute();
        $result = $stmt->get_result();

        if (($result->num_rows > 0) and ($new_password == $confirm_password)) {
            //user present and password correct
            $old_password;
            $row = mysqli_fetch_assoc($result);

            $salt = $row['salt'];
            $old_hashed_psw = hash('sha256',$old_password);
            $old_final_psw = hash('sha256', $salt . $old_hashed_psw); //hashed psw with hash

            $sql = "SELECT * FROM users where username = ? and password = ? ";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("ss",$row['username'],$old_final_psw);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                // creating a new salt and hashing the password
                $hashed_psw = hash_psw($new_password);
                $salt = create_salt();
                $psw_final = hash('sha256', $salt . $hashed_psw); //hashed psw with hash

                $sql = "UPDATE `users` SET `password` = ?, `salt` = ? WHERE `users`.`id` = ?";
                $stmt = $con->prepare($sql);
                $row = $result->fetch_assoc();

                $stmt->bind_param("ssi",$psw_final,$salt,$row["id"]);
                $stmt->execute();

                $log_msg = "SUCCESSFUL PASSWORD CHANGE (FROM RECOVERY): username_id: ".$row['id'];
                log_message($log_msg);

                echo"<div class='message-container' style='background: green'>";
                echo"<h1>Operation result</h1>";
                echo "<p>Password correctly changed</p>";
                echo "<a href='../index.php'>Go back to the main page</a>";

                //Sent notification via email
                sendMail(" ",$row['email'],"Your password has been correctly changed","Password change");
            }
            else{
                $log_msg = "FAILED PASSWORD CHANGE (FROM RECOVERY): old password not correct";
                log_message($log_msg);

                echo"<div class='message-container' style='background: #de6666'>";
                echo"<h1>Operation result</h1>";
                echo "<p>Username not exist or incorrect password, retry.</p>";
            }
        }else{

            $log_msg = "FAILED PASSWORD CHANGE (FROM RECOVERY): user not found";
            log_message($log_msg);

            echo"<div class='message-container' style='background: #de6666'>";
            echo"<h1>Operation result</h1>";
            echo "<p>Username not exist or incorrect password, retry.</p>";

        }

    }

    ?>
 </div>
</body>
</html>
