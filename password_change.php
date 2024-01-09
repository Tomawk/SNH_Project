<?php
    session_start();
    require('inc/db.php');
    require("utility/sessionManager.php");
    checkSession($con);
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
    <script src="JS/mainscript.js"> </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

    <!-- Font Awesome Import -->
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>

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
    <form onsubmit="return validateFormChangePsw()"  action="utility/elaborate_change_password.php" method="post" id="my_form" name="change_psw">
      <div class="form-group">
        <label for="oldPassword">Old Password</label>
        <input type="password" id="old_password" name="old_password" required>
      </div>
      
      <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" id="new_password" name="new_password" oninput="controlla_sicurezza_password()" required>
        <p class="error_register" id="error_password"> Invalid new password. Password should at least contain 8 chars, an uppercase char, a lowercase char and a number.</p>
        <p id="password_strength"></p>
      </div>
      <div class="form-group">
        <label for="newPasswordRepeat">Repeat New Password</label>
        <input type="password" id="new_password_repeat" name="new_password_repeat" required>
        <p class="error_register" id="error_rep_password">Passwords don't match.</p>
      </div>
      <div class="form-group">
        <input type="submit" value="Change password" id="submit_button">
        <p id="password_strength_validation"></p>
      </div>
    </form>
  </div>
</body>
</html>


