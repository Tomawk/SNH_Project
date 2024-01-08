

<?php
    session_start();
    require('inc/db.php');
    

    if(isset($_SESSION['username'])){
      header("location: index.php");
    }

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

    <link href="CSS/modals.css" rel="stylesheet" type="text/css">
    <link href="CSS/topnav.css" rel="stylesheet" type="text/css">
    <link href="CSS/rightnav.css" rel="stylesheet" type="text/css">
    <link href="CSS/stilePasswordChange.css" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript" src="JS/request_recover_password.js"></script>

    <!-- Modal js include -->
    <script src="JS/modal.js" ></script>

    <!-- Validation register/login js include -->
    <script src="JS/mainscript.js"> </script>

    <!-- Font Awesome Import -->
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>

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
    <h2>Change Password</h2>
    <form>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <p class="error_form" id="error_username_input"> Username is too long or too short. </p>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" required>
        <p class="error_form" id="error_email_input"> Invalid email format </p>
      </div>
    
      <div class="form-group">
        <input type="submit" value="Send request" onclick="handleRecoverPassword()">
      </div>
      <div class="form-group">
        <p id="result"></p>
      </div>
    </form>
  </div>

</body>
</html>


