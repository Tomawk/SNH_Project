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
	
</head>
<body>
  <div class="change-password-form">
    <h2>Change Password</h2>
    <form  action="utility/elaborate_change_password.php" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="oldPassword">Old Password</label>
        <input type="password" id="old_password" name="old_password" required>
      </div>
      <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" id="new_password" name="new_password" required>
      </div>
      
      <div class="form-group">
        <input type="submit" value="Change Password">
      </div>
    </form>
  </div>
</body>
</html>


