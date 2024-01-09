

<?php
    session_start();
    require('inc/db.php');
    require('utility/sessionManager.php');
    checkSession($con);
if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }
    if(isset($_SESSION["username"]))
        header("location: index.php");
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <!-- Modal js include -->
    <script src="JS/modal.js" ></script>

    <!-- Validation register/login js include -->
    <script src="JS/mainscript.js"> </script>
    <script src="JS/usernameRecovery.js"> </script>
    
</head>
<body
    <?php
    if(isset($_SESSION["error"])){
        echo 'onload ="openmodal()"';
    }
    if(isset($_SESSION["signup_error"])){
        echo 'onload ="openmodal1()"';
    }
    ?>
>
<?php
    include 'html/topnav.php';
    include 'html/aside.php';

    if(isset($_SESSION["username"])){
        include "html/modal_user.php";
    }else{
        include 'html/modal_login.php';
        include 'html/modal_register.php';
    }
?>
  <div class="change-password-form">
    <h2>Account recovery</h2>
    <form>
      <div class="form-group">
        <label for="email">email</label>
        <input type="text" id="email" name="email" required>
        <p class="error_form" id="error_email_input"> Not supported email, insert a valid email. </p>
      </div>
    
      <div class="form-group">
        <input type="submit" value="Recover email" onclick="handleRecoverPassword()">
      </div>
      <div class="form-group">
        <p id="result"></p>
      </div>
    </form>
  </div>

</body>
</html>


