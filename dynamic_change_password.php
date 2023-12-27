<?php
    session_start();
    require('inc/db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password</title>

  <link href="CSS/stilePasswordChange.css" rel="stylesheet" type="text/css">
  <link href="CSS/topnav.css" rel="stylesheet" type="text/css">
  <link href="CSS/rightnav.css" rel="stylesheet" type="text/css">
  <link href="CSS/modals.css" rel="stylesheet" type="text/css">

    <!-- Modal js include -->
    <script src="JS/modal.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="JS/dynamic_change_password.js"></script>
    
</head>
<body>
  <?php

    include 'html/topnav.php';
    include 'html/aside.php';

    include "html/modal_user.php";
    $link = $_GET['link'];

    if(!isset($link)) return;

    $query = "SELECT * FROM users WHERE link = ? ";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s",$link);
    $stmt->execute();
    $result = $stmt->get_result();

    if(mysqli_num_rows($result) == 0){
      echo "Some error occurred";
      return;
    }

    $row = mysqli_fetch_assoc($result);

    //check of the timestamp
    if((intval($row['timestamp']))+5*60 < time()){
        echo "Link not valid anymore";
        return;
    }

  ?>
  <div class="change-password-form">
    <h2>Change password</h2>
    <form action="utility/elaborate_dynamic_change_password.php" method="post" id="my_form">
      <div class="form-group">
        <label for="oldPassword">New Password</label>
        <input type="password" id="new_password" name="new_password" oninput="controlla_sicurezza_password()" required>
      </div>
      <div class="form-group">
        <label for="newPassword">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password"  required>
        <p id="password_strength"></p>
      </div>
      <input  id="link" name="link" value =<?php echo "'".$link."' " ?> hidden>
      <div class="form-group">
        <input type="submit" value="Change password" id="submit_button">
        <p id="password_strength_validation"></p>
      </div>
    </form>
  </div>
</body>
</html>


