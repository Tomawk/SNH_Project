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
    require("log.php");
    if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

    if(!isset($_SESSION['username'])){
      echo "you have to log in first!";
      return;
    }

    if(!isset($_POST["old_password"])  || !isset($_POST["new_password"])
        || !isset($_SESSION['username']) || !isset($_POST['new_password_repeat'])){
        echo "some field are missing";
        return;
    }

    $username = $_SESSION['username'];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $new_password_repeat = $_POST['new_password_repeat'];

    //sanitize + clean inputs

    $old_password = trim($old_password); //Remove whitespaces
    $old_password = stripcslashes($old_password);
    $old_password = htmlspecialchars($old_password); //Convert special characters to HTML entities
    $old_password = mysqli_real_escape_string($con,$old_password); //SQL Injection prevention

    $new_password = trim($new_password); //Remove whitespaces
    $new_password = stripcslashes($new_password);
    $new_password = htmlspecialchars($new_password); //Convert special characters to HTML entities
    $new_password = mysqli_real_escape_string($con,$new_password); //SQL Injection prevention

    $new_password_repeat = trim($new_password_repeat); //Remove whitespaces
    $new_password_repeat = stripcslashes($new_password_repeat);
    $new_password_repeat = htmlspecialchars($new_password_repeat); //Convert special characters to HTML entities
    $new_password_repeat = mysqli_real_escape_string($con,$new_password_repeat); //SQL Injection prevention

    // Validation server-side of $new_password

    if (strlen($new_password) <= 7 || strlen($new_password) > 255) {
        echo "New Password is too long or too short";
        return;
    }
    elseif (!preg_match("#[0-9]+#",$new_password)) {
        echo "New Password should contain at least a number";
        return;
    }
    elseif(!preg_match("#[A-Z]+#",$new_password)) {
        echo "New Password should contain at least one uppercase char";
        return;
    }
    elseif(!preg_match("#[a-z]+#",$new_password)) {
        echo "New Password should contain at least one lowercase char";
        return;
    }

    if($new_password_repeat != $new_password){
        echo "The new inserted password don't match";
        return;
    }

    $sql_username = "SELECT * FROM users where username = ?";
    $stmt_username = $con->prepare($sql_username);
    $stmt_username->bind_param("s",$username);
    $stmt_username->execute();
    $result_username = $stmt_username->get_result();
    $result_usernameCount=mysqli_num_rows($result_username);

    if($result_usernameCount == 1){
        //user present

        //retrieve salt

        $row = mysqli_fetch_assoc($result_username);
        $salt = $row['salt'];

        $old_hashed_psw = hash('sha256',$old_password);
        $old_final_psw = hash('sha256', $salt . $old_hashed_psw); //hashed psw with hash

        $sql = "SELECT * FROM users where username = ? and password = ? ";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss",$username,$old_final_psw);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            //old password matches

            // create new salt
            $new_salt = create_salt();

            // hash the new pasw
            $hashed_psw = hash_psw($new_password);
            $psw_final = hash('sha256', $new_salt . $hashed_psw); //hashed psw with hash

            $sql = "UPDATE `users` SET `password` = ?,`salt` = ?  WHERE `users`.`id` = ?";
            $stmt = $con->prepare($sql);
            $row = $result->fetch_assoc();
            $stmt->bind_param("ssi",$psw_final,$new_salt, $row["id"]);
            $stmt->execute();

            echo"<div class='message-container' style='background: green'>";
            echo"<h1>Operation result</h1>";
            echo "<p>Password correctly changed</p>";
            echo "<a href='../index.php'>Go back to the main page</a>";
            // LOG SUCCESSFUL CHANGE PSW
            $log_msg = "PASSWORD CHANGE CORRECTLY: username: ".$username;
            log_message($log_msg);

            //Sent notification via email
            sendMail(" ",$row['email'],"Your password has been correctly changed","Password change");

        }else{
            echo"<div class='message-container' style='background: #de6666'>";
            echo"<h1>Operation result</h1>";
            echo "<p>Username not exist or incorrect password, retry.</p>";
            // LOG CHANGE PSW FAILED
            $log_msg = "PASSWORD CHANGE FAILED: username: ".$username;
            log_message($log_msg);
        }

    }else{
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Operation result</h1>";
        echo "<p>Username not exist or incorrect password, retry.</p>";
        // LOG CHANGE PSW FAILED
        $log_msg = "PASSWORD CHANGE FOR NON-EXISTENT USERNAME: username: ".$username;
        log_message($log_msg);
    }




    ?>
 </div>
</body>
</html>
