<?php
    session_start();
    require('inc/db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<link href="CSS/stilemain.css" rel="stylesheet" type="text/css">
  <title>Change Password</title>
  <link href="CSS/stilePasswordChange.css" rel="stylesheet" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
</head>
<body>
  <?php include 'html/topnav.php';?>
  <div class="change-password-form">
    <h2>Cambio password</h2>
    <form action="utility/elaborate_change_password.php" method="post" id="my_form">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="oldPassword">Vecchia Password</label>
        <input type="password" id="old_password" name="old_password" required>
      </div>
      <div class="form-group">
        <label for="newPassword">Nuova Password</label>
        <input type="password" id="new_password" name="new_password" onkeypress="controlla_sicurezza_password()" required>
        <p id="password_strength"></p>
      </div>
      
      <div class="form-group">
        <input type="submit" value="Cambia Password" id="submit_button">
        <p id="password_strength_validation"></p>
      </div>
    </form>
  </div>
  <script>

    document.getElementById("submit_button").addEventListener("click", function(event){
        event.preventDefault();
        const password = document.getElementById('new_password').value;
        const result = zxcvbn(password);
        var guesses = result.guesses_log10;
        if(guesses < 10){
            var p = document.getElementById("password_strength_validation");
            p.textContent = "scrivi una password più forte";
            p.style.color = "red";
            p.style.fontSize = "0.8em";
            event.preventDefault();
            return;
        }
        document.getElementById("my_form").submit();
    });

    function controlla_sicurezza_password(){
        const password = document.getElementById('new_password').value;
        const result = zxcvbn(password);
        var guesses = result.guesses_log10;
        var p = document.getElementById("password_strength");
        if(guesses <5 ){
            p.textContent = "password debole";
            p.style.color = "red";
            p.style.fontSize = "0.8em";
        }
        else if (guesses < 10){
            p.textContent = "password non molto forte";
            p.style.color = "#e67014";
            p.style.fontSize = "0.8em";
        }
        else{
            p.textContent = "password forte";
            p.style.color = "green";
            p.style.fontSize = "0.8em";
        }
    }

  </script>
</body>
</html>


