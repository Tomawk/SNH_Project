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

    if(!isset($_POST["new_password"])  || !isset($_POST["confirm_password"])  || !isset($_POST["link"])){
        echo "some field are missing";
    }

    $link = $_POST['link'];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    $sql = "SELECT * FROM users where link = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s",$link);
    $stmt->execute();
    $result = $stmt->get_result();

    if (($result->num_rows > 0) and ($new_password == $confirm_password)) {
        //user present and password correct

        // creating a new salt and hashing the password
        $hashed_psw = hash_psw($new_password);
        $salt = create_salt();
        $psw_final = hash('sha256', $salt . $hashed_psw); //hashed psw with hash

        $sql = "UPDATE `users` SET `password` = ?, `salt` = ? WHERE `users`.`id` = ?";
        $stmt = $con->prepare($sql);
        $row = $result->fetch_assoc();

        $stmt->bind_param("ssi",$psw_final,$salt,$row["id"]);
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
    ?>
 </div>
</body>
</html>
