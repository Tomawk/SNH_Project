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
    require('hashing_psw.php');
    if(!isset($_SESSION['username'])){
      echo "you have to log in first!";
      return;
    }

    if(!isset($_POST["old_password"])  || !isset($_POST["new_password"])  ||!isset($_SESSION['username']) ){
        echo "some field are missing";
        return;
    }

    $username = $_SESSION['username'];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

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
        }else{
            echo"<div class='message-container' style='background: #de6666'>";
            echo"<h1>Operation result</h1>";
            echo "<p>Username not exist or incorrect password, retry.</p>";
        }

    }else{
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Operation result</h1>";
        echo "<p>Username not exist or incorrect password, retry.</p>";
    }




    ?>
 </div>
</body>
</html>
