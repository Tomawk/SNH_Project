<?php
    session_start();
    require('inc/db.php');
if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

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
    <script src="JS/mainscript.js"></script>
    
</head>
<body>
  <?php

    include 'html/topnav.php';
    include 'html/aside.php';

    include "html/modal_user.php";
    $id = $_GET['userid'];
    $link = $_GET['link'];

    if(!isset($link) && !isset($id)) return;

        // retrieve salt

    $stmt_salt = $con->prepare("SELECT * from users WHERE id = ?");
    $stmt_salt->bind_param("i",$id);
    $stmt_salt->execute();
    $result_salt = $stmt_salt->get_result();

    if(mysqli_num_rows($result_salt) == 0){
      echo "Some error occurred";
      return;
    }

    $row_salt = mysqli_fetch_assoc($result_salt);

    $salt = $row_salt['link_salt'];

    $hashed_link = hash('sha256',$link);
    $final_link= hash('sha256', $salt . $hashed_link); //hashed psw with hash

    $query = "SELECT * FROM users WHERE link = ? AND id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si",$final_link,$id);
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
    <form onsubmit="return validateDynamicChangePSW()" action="utility/elaborate_dynamic_change_password.php" method="post" id="my_form" name="dynamic_psw_form">
      <div class="form-group">
        <label for="oldPassword">New Password</label>
        <input type="password" id="new_password" name="new_password" oninput="controlla_sicurezza_password()" required>
        <p class="error_register" id="error_password"> Invalid new password. Password should at least contain 8 chars, an uppercase char, a lowercase char and a number.</p>
      </div>
      <div class="form-group">
        <label for="newPassword">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password"  required>
        <p class="error_register" id="error_confirm_password"> Passwords do not match. </p>
        <p id="password_strength"></p>
      </div>
      <input  id="link" name="link" value =<?php echo "'".$final_link."' " ?> hidden>
      <div class="form-group">
        <input type="submit" value="Change password" id="submit_button">
        <p id="password_strength_validation"></p>
      </div>
    </form>
  </div>
</body>
</html>


