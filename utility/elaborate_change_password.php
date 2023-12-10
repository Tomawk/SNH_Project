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

    if(!isset($_POST["username"]) || !isset($_POST["old_password"])  || !isset($_POST["new_password"]) ){
        echo "some field are missing";
    }

    $username = $_POST["username"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    $sql = "SELECT * FROM users where username = ? and password = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss",$username,hash('md5', $old_password));
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //user present
        $sql = "UPDATE `users` SET `password` = ? WHERE `users`.`id` = ?";
        $stmt = $con->prepare($sql);
        $row = $result->fetch_assoc();
        $stmt->bind_param("si",hash('md5',$new_password), $row["id"]);
        $stmt->execute();

        echo"<div class='message-container' style='background: green'>";
        echo"<h1>Operation result</h1>";
        echo "<p>Password correttamente cambiata</p>";
        echo "<p>torna alla main page</p>";
    }else{
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Esito operazione</h1>";
        echo "<p>Username non esistente o password errata, riprova</p>";
    }
    ?>
 </div>
</body>
</html>
