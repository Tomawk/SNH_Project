

<?php
    session_start();
    require('inc/db.php');
    include 'html/topnav.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password</title>
	<link href="CSS/stilemain.css" rel="stylesheet" type="text/css">
  <link href="CSS/stilePasswordChange.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>
<body>
  
  <div class="change-password-form">
    <h2>Account recovery</h2>
    <form>
      <div class="form-group">
        <label for="email">email</label>
        <input type="text" id="email" name="email" required>
      </div>
    
      <div class="form-group">
        <input type="submit" value="Change Password" onclick="handleRecoverPassword()">
      </div>
      <div class="form-group">
        <p id="result"></p>
      </div>
    </form>
  </div>

  <script>
    function handleRecoverPassword(){
      event.preventDefault();
      var data = new FormData();
        data.append('email', document.getElementById("email").value);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/elaborateAccountRecovery.php", true);
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
              if(parseInt(xhr.responseText) == 1){
                jQuery('#result').html("Email sent");
                jQuery("#result").css("color", "green");
              }else{
                jQuery('#result').html("Recovery problem");
                jQuery("#result").css("color", "red");
              }
            }
        };
        xhr.send(data);
    }
  </script>
</body>
</html>


