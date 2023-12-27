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
    <script src="JS/password_chage.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
</head>
<body>
  <?php

    include 'html/topnav.php';
    include 'html/aside.php';

    include "html/modal_user.php";

    if(!isset($_SESSION['username'])){
      echo "login first";
      return;
    }
  ?>
  <div class="change-password-form">
    <h2>Change password</h2>
    <form action="utility/elaborate_change_password.php" method="post" id="my_form">
      <div class="form-group">
        <label for="oldPassword">Old Password</label>
        <input type="password" id="old_password" name="old_password" required>
      </div>
      <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" id="new_password" name="new_password" oninput="controlla_sicurezza_password()" required>
        <p id="password_strength"></p>
      </div>
      
      <div class="form-group">
        <input type="submit" value="Change password" id="submit_button">
        <p id="password_strength_validation"></p>
      </div>
    </form>
  </div>
</body>
</html>


