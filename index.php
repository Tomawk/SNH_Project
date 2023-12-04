<?php
session_start();
require('inc/db.php');
?>
<!DOCTYPE html>
<html lang="it">
	<head>
  <title> Fastpizza Home </title>
	<link href="CSS/stilemain.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/icon.png" sizes="32x32">
	</head>
<body>
<nav class="topnav">
 <table>
  <tr>
    <td><a onclick="scrollup()">Home</a></td>
    <td><a href="#hr1">Promozioni</a></td>
    <td><a href="creation.php">Ordina Online</a></td>
    <td><a href="#hr2">Prenotazione</a></td>
    <td><a href="#contatti">Contatti</a></td>
	
	<?php /* Verifica se l'utente è loggato e nel caso mostra il bottone con il nome */
	if(!isset($_SESSION["username"])){

echo '
    <td> <a onclick="openmodal()">Login</a></td>
    <td> <a onclick="openmodal1()">Registrati</a></td>';
	
}else{
echo '<td><a onclick="openmodal2()"><strong>'.' '. $_SESSION["username"] . '</strong></a></td>';
}
?>
	<td><a href="carrello.php">Il Mio Carrello</a></td>
  </tr>
</table>
</nav>
<aside class="rightnav"> 
  <table>
   <tr>
   	<td id="facebook"></td>
   </tr>
   <tr>
   	<td id="instagram"></td>
   </tr>
   <tr>
   	<td id="google"></td>
   </tr>
  </table>
</aside>
<aside class="tutorial">
  <div> <img src="./immagini/alert_icon.png" alt="alert"> </div>
  <p> <a href="documentazione.html"> Tutorial ! </a> </p>
</aside>
<div class="mainpic">
		<h1 id="title">FAST PIZZA</h1>
		<h3 id="subtitle">La pizza come vuoi tu</h3>
</div>
<div class="firstdiv">
	<div class="production">
	 <h2 id="title1">Componi ora la tua pizza!</h2>
	 <img src="immagini/greyline.png" alt="greyline" id="linea">
	 <h4 id="subtitle1">Inizia a comporre adesso,tutto &eacute; personalizzabile!<br>
	 Parti scegliendo l'impasto che pi&ugrave; preferisci </h4>
	 <h4 id="subtitle2">e dai sfogo alla tua creativit&aacute;</h4>
	 <a href="creation.php">INIZIA ORA ></a>
    </div>
    <div class="rightimage">
	</div>
</div>
<div id="separator1">
	<hr id="hr1">
	<p>Le nostre novit&aacute;!</p>
</div>
<section class="promotions" id="promote">
	<table>
	 <tr>
	 	<td> <h2> Introduzione del Tutorial! </h2> <br> Sei nuovo e non conosci Fastpizza? Ti consigliamo di dare un'occhiata al tutorial appena aggiunto!</td>
	 	<td id="image1"> </td>
	 </tr>
	 <tr>
	 	<td id="image2"> </td>
	 	<td> <h2> Nuovo Ingrediente! </h2> <br> Da oggi &egrave; possibile inserire all'interno della vostra pizza preferita l'ingrediente "Acciughe", consigliato con salsa di pomodoro e capperi!</td>
	 </tr>
	 <tr>
	 	<td> <h2> Storico Ordini! </h2> <br> Da oggi ogni utente potr&agrave; tener traccia dello storico ordini direttamente dal proprio men&ugrave; utente!</td>
	 	<td id="image3"></td>
	 </tr>
	</table>
</section>
<div id="separator2">
	<hr id="hr2">
	<p>Prenota adesso!</p>
</div>
<div class="reservation">
  <form id="myForm" name="myForm" onsubmit="return validateForm()" method="post">
  Data: 
  <input type="text" id="theDate" name="theDate" required>
  &nbsp;
  Nome:
  <input type="text" id="firstname" name="firstname" required>
  &nbsp;
  Orario:
  <select id="theTime" name="theTime">
  <option>12:00</option>
  <option>12:30</option>
  <option>13:00</option>
  <option>13:30</option>
  <option>14:00</option>
  <option>14:30</option>
  <option>18:30</option>
  <option>19:00</option>
  <option>19:30</option>
  <option>20:00</option>
  <option>20:30</option>
  <option>21:00</option>
  <option>21:30</option>
  <option>22:00</option>
  <option>22:30</option>
  </select>
  &nbsp;
  N&ordm;Persone:
  <input type="number" name="numb" min="1" max="6" onkeydown="return false" required>
  <input type="submit" name="save" value="Submit">
</form>
</div>
 <?php /* Validation */


    $date_now = date("Y-m-d");

    if (empty($_POST["theDate"])) { /* Email */

    $dateErr = "Inserisci una data";
    } else 
      {
      $date = $_POST["theDate"];
      if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)){
        $dateErr = "Formato non valido, deve essere del tipo yyyy-mm-dd";
      }
      elseif($date_now > $date){
        $dateErr = "Non puoi inserire una data gi&agrave; passata";
      }
    }

  if(isset($_POST['save'])){

      if (empty($_POST["firstname"])) {
        $nameErr = "Devi inserire un nome.";
      }
        else{
          if(strlen($_POST['firstname']) < 3) {
          $nameErr = "Inserisci un nome valido.";
          }
           else $name = $_POST['firstname'];
        }

       if (empty($_POST["numb"])) {
        $numbErr = "Devi inserire un numero di persone.";
       }
        else{
          if($_POST['numb'] < 1 || $_POST['numb'] > 6 ) {
          $numbErr = "Inserisci un numero di persone valido (compreso tra 1 e 6).";
          }
           else $numb = $_POST['numb'];
        }

       if(!isset($name)){
         echo '<p class="err_reservation" id="nameErr">'.$nameErr.'</p>';
         unset($nameErr);
       }
       if(!isset($numb)){
         echo '<p class="err_reservation" id="numbErr">'.$numbErr.'</p>';
       }

       if(isset($dateErr)){
          echo '<p class="err_reservation" id="dateErr">'.$dateErr.'</p>';
       }

       if(isset($name) && isset($numb) && !isset($dateErr)){
        $query_reserv = "SELECT * FROM prenotazioni WHERE data='".$date."'AND orario='".$_POST['theTime']."'";
        $result_reserv = mysqli_query($con,$query_reserv);
        $result_reservCount= mysqli_num_rows($result_reserv);
        $query_reserv1 = "SELECT * FROM prenotazioni WHERE data='".$date."'AND orario='".$_POST['theTime']."'AND nome='".$name."'";
        $result_reserv1 = mysqli_query($con,$query_reserv1);
        $result_reservCount1= mysqli_num_rows($result_reserv1);
        if($result_reservCount > 6){
          echo 
          '
          <div id="alertbox" style="display: block;">
            Ci dispiace ma non ci sono tavoli liberi per il giorno '.$date.' con orario '.$_POST['theTime'].'
          </div>
          ';
        }
         else if($result_reservCount1 > 0){
          echo 
          '
          <div id="alertbox" style="display: block;">
            Ci dispiace ma &egrave; gi&agrave; presente una prenotazione in data '.$date.' con orario '.$_POST['theTime'].' a suo nome.
          </div>
          ';
        } else{
         echo '
            <div id="alertbox" style="display: block; background-color: #6c95ec;">
                Prenotazione effettuata con successo!
            </div>
            ';
         mysqli_query($con,"INSERT INTO prenotazioni (nome, data, orario, numpersone) VALUES ('".$name."','".$date."','".$_POST["theTime"]."','".$numb."')");
        }
       }

  }

?>
<div id="alertbox">
</div>
<!-- MODAL PER IL LOGIN --> 
<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post" name="login" action="./utility/login.php">
    <div class="imgcontainer">
      <span onclick="closemodal()" class="close" title="Close Modal">&times;</span> <!-- Span chiusura modal -->
      <img src="immagini/avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Inserisci Username" name="username" class="inputmodal" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Inserisci Password" name="password" class="inputmodal" required>
      <br><br>
      <button type="submit" class="modalbutton">Login</button>

      <?php
      if(isset($_SESSION["error"])){

      echo '<p id="errore_login">'.' '.$_SESSION['error'].'<p>';
      unset($_SESSION['error']);

      }

      ?>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="closemodal()" class="cancelbtn">Cancel</button>
      <span class="psw"><a href="#">Password</a> dimenticata?</span>
    </div>
  </form>
</div>

<!-- FINE MODAL LOGIN-->

<!-- MODAL PULSANTE UTENTE -->

<div id="id03" class="modal">
  
  <div class="modal-content animate">
    <div class="imgcontainer">
      <span onclick="closemodal2()" class="close" title="Close Modal">&times;</span> <!-- Span chiusura modal -->
      <img src="immagini/user.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
		 <p> <strong><?php echo $_SESSION["username"]; ?></strong> </p>
<br>
<br>
      <button type="button" onclick="location.href = 'info.php';" class="modalbutton">Le mie informazioni</button>
      <button type="button" onclick="location.href = 'storico.php';" class="modalbutton">Storico Ordini</button>
      <button type="button" onclick="location.href = './utility/logout.php';" class="modalbutton">Logout</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
    </div>
  </div>
</div>

<!-- FINE MODAL UTENTE -->

<!-- MODAL REGISTRAZIONE -->

<div id="id02" class="modal1"> <!-- Modal1 -->
  <span onclick="closemodal1()" class="close1" title="Close Modal">&times;</span>
  <form class="modal-content1 animate" method="post" name="register" onsubmit="return validateFormRegister()" action="./utility/register.php">
    <div class="container1">
      <h1>Registrati</h1>
      <p>Perfavore inserisci i dati nei seguenti riquadri per creare un account.</p>
      <hr id="hrmodal1">
      <label><b>Email</b></label>
      <input type="text" placeholder="Inserisci Email" name="email" id="modal1_email" required>
      <p class="error_register" id="error_email"> Email non supportata, inserisci una email valida. </p>

      <label><b>Nome</b></label>
      <input type="text" placeholder="Inserisci Nome" name="nome" id="modal1_nome" required>
      <p class="error_register" id="error_nome"> Nome non supportato, inserisci un nome valido. </p>

      <label><b>Cognome</b></label>
      <input type="text" placeholder="Inserisci Cognome" name="surname" id="modal1_surname" required>
      <p class="error_register" id="error_surname"> Cognome non supportato, inserisci un cognome valido. </p>

      <label><b>Username</b></label>
      <input type="text" placeholder="Inserisci Username" name="uname" class="modal1_input" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Inserisci Password" name="psw" id="modal1_password" required>
      <p class="error_register" id="error_password"> Password non valida. Deve contenere almeno 8 caratteri, una lettera maiuscola, una lettera minuscola e un numero.</p>

      <label><b>Ripeti Password</b></label>
      <input type="password" placeholder="Ripeti Password" name="psw-repeat" id="modal1_repeat" required>
      <p class="error_register" id="error_repeat"> Le due password con coincidono. </p>

      <label><b>Citt&agrave;</b></label>
      <input type="text" placeholder="Inserisci Citt&agrave;" name="citta" class="modal1_input" required>

      <label><b>Indirizzo</b></label>
      <input type="text" placeholder="Inserisci Indirizzo" name="indirizzo" class="modal1_input" required>

      <label><b>CAP</b></label>
      <input type="text" placeholder="Inserisci CAP" name="cap" id="modal1_cap" required>
      <p class="error_register" id="error_cap"> CAP non valido. Ricorda: Il CAP &egrave; formato da 5 cifre numeriche </p>

      <p>Creando un account accetti i nostri <a href="#" style="color:dodgerblue">Termini e Condizioni</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="closemodal1()" class="cancelbutn" id="modal1button_cancel">Cancel</button>
        <button type="submit" class="signupbtn" id="modal1button_signup">Sign Up</button>
      </div>
      <?php

        if(isset($_SESSION['emailErr'])){
        echo '<p class="err_register" id="emailErr">'.$_SESSION['emailErr'].'</p>';
        unset($_SESSION['emailErr']);
        }

        if(isset($_SESSION['nomeErr'])){
        echo '<p class="err_register" id="nomeErr">'.$_SESSION['nomeErr'].'</p>';
        unset($_SESSION['nomeErr']);
        }

        if(isset($_SESSION['surnameErr'])){
        echo '<p class="err_register" id="surnameErr">'.$_SESSION['surnameErr'].'</p>';
        unset($_SESSION['surnameErr']);
        }

        if(isset($_SESSION['usernameErr'])){
        echo '<p class="err_register" id="usernameErr">'.$_SESSION['usernameErr'].'</p>';
        unset($_SESSION['usernameErr']);
        }

        if(isset($_SESSION['pswErr'])){
        echo '<p class="err_register" id="pswErr">'.$_SESSION['pswErr'].'</p>';
        unset($_SESSION['pswErr']);
        }

        if(isset($_SESSION['psw_repeatErr'])){
        echo '<p class="err_register" id="psw_repeatErr">'.$_SESSION['psw_repeatErr'].'</p>';
        unset($_SESSION['psw_repeatErr']);
        }

        if(isset($_SESSION['cittaErr'])){
        echo '<p class="err_register" id="cittaErr">'.$_SESSION['cittaErr'].'</p>';
        unset($_SESSION['cittaErr']);
        }

        if(isset($_SESSION['indirizzoErr'])){
        echo '<p class="err_register" id="indirizzoErr">'.$_SESSION['indirizzoErr'].'</p>';
        unset($_SESSION['indirizzoErr']);
        }

        if(isset($_SESSION['capErr'])){
        echo '<p class="err_register" id="capErr">'.$_SESSION['capErr'].'</p>';
        unset($_SESSION['capErr']);
        }

      ?>
    </div>
  </form>

</div>
<!-- Fine Modal Registrazione -->
<footer class="contacts" id="contatti">
	<h2> Vieni a trovarci! </h2>
	<p id="leftp"> Via Filippo Turati, 12 <br>
	56125 Pisa PI <br> <br>
	Tutti i giorni: <br>
	dalle 12:30 alle 15:30 <br>
	dalle 18:30 alle 00:30 <br> <br>
	Email: <a href="mailto:indirizzo@email.com">fastpizza@inc.corporation.it</a></p>
	<p id="copyright"> While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy. Copyright 2017-2018 by FastPizza Inc. All Rights Reserved. </p>
	<div id="map" onclick="location.href = 'https://www.google.com/maps/place/Via+Filippo+Turati,+12,+56125+Pisa+PI/@43.7126809,10.3991586,17z/data=!3m1!4b1!4m5!3m4!1s0x12d59199440ab5c9:0x7950e3edf0d20800!8m2!3d43.7126809!4d10.4013473';"> </div>
	<img src="immagini/arrow-up.png" alt="freccia" onclick="scrollup()" style="cursor: pointer;">
</footer>
<script src="JS/mainscript.js"> </script>
</body>
</html>
