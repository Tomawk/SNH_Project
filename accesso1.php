<?php
session_start();

if(isset($_SESSION['username'])){
  header('location: 404.php');
}

?>
<!DOCTYPE html>
<html lang="it">
  <head>
  <title> Accesso Carrello </title>
  <link href="CSS/stileaccesso.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="immagini/icon.png" sizes="32x32">
  </head>
<body>

<nav class="topnav">
  <table>
   <tr>
      <td><a href="./index.php">Home</a></td>
      <td><a href="./index.php#hr1">Promozioni</a></td>
      <td><a href="creation.php">Ordina Online</a></td>
      <td><a href="./index.php#hr2">Prenotazione</a></td>
      <td><a href="./index.php#contatti">Contatti</a></td>
   </tr>
  </table>
  </nav>

<div id="center_div">

  <div class="imgdiv">
      <img src="immagini/pizza_avatar.png" alt="Avatar" class="avatar">
    </div>
    <p id="intestation"> Per accedere a questa sezione devi essere loggato. <strong>Esegui il login. Oppure registrati nella <a href="index.php">Home</a></strong> </p>
    <form method="post" name="login" action="./utility/login_accesso1.php">
    <label><b>Username</b></label>
      <input type="text" placeholder="Inserisci Username" name="username" class="input" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Inserisci Password" name="password" class="input" required>

      <?php 
      if(isset($_SESSION["error"])){

      echo '<p id="errore_login">'.' '.$_SESSION['error'].'<p>';
      unset($_SESSION["error"]);
      }
      ?>
        
      <button type="submit"  class="button">Login</button>
    </form>
</div>

</body>
</html>