<?php
 session_start();

  if(!isset($_SESSION["username"])){
  header('location: accesso.php');
  }
?>
<!DOCTYPE html>
<html lang="it">
	<head>
    <title> Creazione Pizza </title>
	<link href="./CSS/stilecreation.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="immagini/icon.png" sizes="32x32">
	</head>
<body onload="ApriModal()">
<!-- The Modal -->
<div id="myModal" class="modal"> <!-- Modal -->
  <div id="modal-content"> <!-- Contenuto Modal -->
  	<h1>Benvenuto!</h1>
    <p>Crea e ordina la tua pizza dei sogni.
    E' molto facile, parti dall'impasto e inserisci gli ingredienti che pi&ugrave; preferisci senza limitazioni! 
    Ogni ingrediente avr&agrave; un costo aggiuntivo. La creazione &egrave; individuale. Al termine di essa sar&agrave; possibile concatenare ulteriori ordini in
    un'unica spedizione.
    <br><br>Cosa stai aspettando?
    </p>
    <button id="starter" onclick="ChiudiModal()"> Inizia Adesso </button>
  </div>
</div>
<nav class="topnav">
 <table>
  <tr>
    <td><a href="./index.php">Home</a></td>
  <td><a href="./index.php#hr1">Promozioni</a></td>
    <td><a onclick="scrollup()">Ordina Online</a></td>
    <td><a href="./index.php#hr2">Prenotazione</a></td>
    <td><a href="./index.php#contatti">Contatti</a></td>

<?php /* Verifica se l'utente è loggato e nel caso mostra il bottone con il nome */
echo '<td><a onclick="openmodal2()"><strong>'.' '. $_SESSION["username"] . '</strong></a></td>';
?>
  <td><a href="carrello.php">Il Mio Carrello</a></td>
  </tr>
</table>
</nav>
<div id="intestazione">
	<h1> FASTPIZZA </h1>
</div>
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

<form id="form1" action="test.php" method="post" name="form1">
<section id="selezioneImpasti">
<h2>&#8226; Scegli il tuo impasto</h2>
<img src="./Creation/impasto_classico.png" alt="impasto classico" id="I1">
<label class="container">Classico
  <input type="radio" checked="checked" name="impasto" value="Classico"> 
  <span class="checkmark"></span>
</label>
<img src="./Creation/impasto_integrale.png" alt="impasto integrale" id="I2">
<label class="container">Integrale
  <input type="radio" name="impasto" value="Integrale">
  <span class="checkmark"></span>
</label>
<img src="./Creation/impasto_classico.png" alt="impasto senza glutine" id="I3">
<label class="container">Senza Glutine
  <input type="radio" name="impasto" value="Senza Glutine">
  <span class="checkmark"></span>
</label>
<img src="./Creation/impasto_curcuma.png" alt="impasto curcuma" id="I4">
<label class="container">Curcuma
  <input type="radio" name="impasto" value="Curcuma">
  <span class="checkmark"></span>
</label>
<img src="./Creation/impasto_grano.png" alt="impasto grano saraceno" id="I5">
<label class="container">Grano Saraceno
  <input type="radio" name="impasto" value="Grano Saraceno">
  <span class="checkmark"></span>
</label>

</section>

<section id="selezioneTomato">
<h2>&#8226; Scegli la salsa per la base:</h2>

<img src="./Creation/impasto_classico.png" alt="no tomato" id="T1">
<label class="container">Nessuno
  <input type="radio" checked="checked" name="tomato" value="Nessuno">
  <span class="checkmark"></span>
</label>
<img src="./Creation/pomodoro.jpg" alt="no tomato" id="T2">
<label class="container">Pomodoro
  <input type="radio" name="tomato" value="Pomodoro">
  <span class="checkmark"></span>
</label>
</section>

<section id="selezioneCheese">
<h2>&#8226; E' il momento di aggiungere il formaggio:</h2>

<img src="./Creation/red_cross.png" alt="nessuno" id="C1">
<label class="container">Nessuno
  <input type="radio" checked="checked" name="cheese" value="Nessuno">
  <span class="checkmark"></span>
</label>
<img src="./Creation/mozzarellai.jpg" alt="mozzarella" id="C2">
<label class="container">Mozzarella
  <input type="radio" name="cheese" value="Mozzarella">
  <span class="checkmark"></span>
</label>
<img src="./Creation/mozzarellai.jpg" alt="mozzarella" id="C3">
<label class="container">Bufala
  <input type="radio" name="cheese" value="Bufala">
  <span class="checkmark"></span>
</label>
<img src="./Creation/mozzarellai.jpg" alt="mozzarella" id="C4">
<label class="container">Mozzarella (- grassi)
  <input type="radio" name="cheese" value="Mozzarella (- grassi)">
  <span class="checkmark"></span>
</label>

</section>

<section id="selezioneIngredients">
<h2>&#8226; Adesso dai sfogo alla tua fantasia inserendo gli ingredienti che preferisci:</h2>

<div>
  <img src="./Creation/capperii.png" alt="capperi" id="A1">
<label class="container">Capperi
  <input type="checkbox" name="capperi" value="capperi" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/pomodorinii.jpg" alt="pomodorini" id="A2">
<label class="container">Pomodorini
  <input type="checkbox" name="pomodorini" value="pomodorini" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/peperonii.jpg" alt="peperoni" id="A3">
<label class="container">Peperoni
  <input type="checkbox" name="peperoni" value="peperoni" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/funghii.jpg" alt="funghi" id="A4">
<label class="container">Funghi
  <input type="checkbox" name="funghi" value="funghi" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/rucolai.png" alt="rucola" id="A5">
<label class="container">Rucola
  <input type="checkbox" name="rucola" value="rucola" class="ingredients">
  <span class="checkmark"></span>
</label>
</div>
<div>

<img src="./Creation/salaminoi.png" alt="salamino" id="A6">
<label class="container">Salamino
  <input type="checkbox" name="salamino" value="salamino" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/patatinei.jpg" alt="patatine" id="A7">
<label class="container">Patatine
  <input type="checkbox" name="patatine" value="patatine" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/cipollai.png" alt="cipolla" id="A8">
<label class="container">Cipolla
  <input type="checkbox" name="cipolla" value="cipolla" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/baconi.jpg" alt="bacon" id="A9">
<label class="container">Bacon
  <input type="checkbox" name="bacon" value="bacon" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/sardinei.png" alt="acciughe" id="A10">
<label class="container">Acciughe
  <input type="checkbox" name="acciughe" value="acciughe" class="ingredients">
  <span class="checkmark"></span>
</label>
</div>
<div>
<img src="./Creation/pcottoi.jpg" alt="pcotto" id="A11">
<label class="container">Prosc. Cotto
  <input type="checkbox" name="pcotto" value="pcotto" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/olivei.png" alt="olive" id="A12">
<label class="container">Olive
  <input type="checkbox" name="olive" value="olive" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/wursteli.jpg" alt="wurstel" id="A13">
<label class="container">Wurstel
  <input type="checkbox" name="wurstel" value="wurstel" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/origanoi.png" alt="origano" id="A14">
<label class="container">Origano
  <input type="checkbox" name="origano" value="origano" class="ingredients">
  <span class="checkmark"></span>
</label>

<img src="./Creation/basilicoi.png" alt="basilico" id="A15">
<label class="container">Basilico
  <input type="checkbox" name="basilico" value="basilico" class="ingredients">
  <span class="checkmark"></span>
</label>
</div>

<section id="add_on">
  <h2>&#8226; Seleziona la/e bevande:</h2>
    <div> 

      <img src="./Creation/acquanati.jpg" alt="acqua" id="B1">
      <label class="container">Acqua Nat. (1L)
        <input type="checkbox" name="acquanat" value="AcquaNat" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_1">Quantit&agrave;
      <input type="number" name="q_acquanat" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/acquafrii.png" alt="acqua" id="B2">
      <label class="container">Acqua Friz.(1L)
        <input type="checkbox" name="acquafri" value="AcquaFri" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_2">Quantit&agrave;
      <input type="number" name="q_acquafri" min="1" max="6" value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/cocacolai.jpg" alt="cocacola" id="B3">
      <label class="container">CocaCola (33Cl)
        <input type="checkbox" name="cola" value="CocaCola" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_3">Quantit&agrave;
      <input type="number" name="q_cola" min="1" max="6" value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/spritei.png" alt="sprite" id="B4">
      <label class="container">Sprite (33Cl)
        <input type="checkbox" name="sprite" value="sprite" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_4">Quantit&agrave;
      <input type="number" name="q_sprite" min="1" max="6" value="1" onkeydown="return false" required>
      </label>

    </div>

    <div>

      <img src="./Creation/estatepesi.png" alt="estathe" id="B5">
      <label class="container">Estath&egrave; P. (33Cl)
        <input type="checkbox" name="estatepes" value="estatepes" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_1">Quantit&agrave;
      <input type="number" name="q_estatepes" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/estatelimi.jpg" alt="estathe" id="B6">
      <label class="container">Estath&egrave; L. (33Cl)
        <input type="checkbox" name="estatelim" value="estatelim" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_2">Quantit&agrave;
      <input type="number" name="q_estatelim" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/fantai.jpg" alt="fanta" id="B7">
      <label class="container">Fanta (33Cl)
        <input type="checkbox" name="fanta" value="fanta" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_3">Quantit&agrave;
      <input type="number" name="q_fanta" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/7upi.jpg" alt="7up" id="B8">
      <label class="container">7Up (33Cl)
        <input type="checkbox" name="7up" value="7up" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_4">Quantit&agrave;
      <input type="number" name="q_7up" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>


    </div>

        <div>

      <img src="./Creation/heineken.jpeg" alt="heineken" id="B9">
      <label class="container">Heineken (33Cl)
        <input type="checkbox" name="heineken" value="heineken" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_1">Quantit&agrave;
      <input type="number" name="q_heineken" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/coronai.jpg" alt="corona" id="B10">
      <label class="container">Corona (33Cl)
        <input type="checkbox" name="corona" value="corona" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_2">Quantit&agrave;
      <input type="number" name="q_corona" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/peronii.jpg" alt="peroni" id="B11">
      <label class="container">Peroni (33Cl)
        <input type="checkbox" name="peroni" value="peroni" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_3">Quantit&agrave;
      <input type="number" name="q_peroni" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>

      <img src="./Creation/morettii.png" alt="moretti" id="B12">
      <label class="container">Moretti (33Cl)
        <input type="checkbox" name="moretti" value="moretti" class="drinks">
        <span class="checkmark"></span>
      </label>
      <label class="numbercontainer quantity_4">Quantit&agrave;
      <input type="number" name="q_moretti" min="1" max="6"  value="1" onkeydown="return false" required>
      </label>


    </div>

</section>

</section>
<aside id="order"> <input type="submit" value="Procedi" onclick="submitForms()"> </aside>
</form>
<aside id="preview">
	<p id="result"> Prezzo: 3&euro; </p>
	<img src="./Creation/impasto_classico.png" alt="preview" id="iclassico">
	<img src="./Creation/impasto_integrale.png" alt="preview" id="iintegrale">
	<img src="./Creation/impasto_curcuma.png" alt="preview" id="icurcuma">
	<img src="./Creation/impasto_grano.png" alt="preview" id="igrano">
	<img src="./Creation/sugo_pomodoro.png" alt="preview" id="tpomodoro">
	<img src="./Creation/mozzarella.png" alt="preview" id="cmozzarella">
	<img src="./Creation/capperi.png" alt="preview" id="icapperi">
	<img src="./Creation/funghi.png" alt="preview" id="ifunghi">
	<img src="./Creation/peperoni.png" alt="preview" id="ipeperoni">
	<img src="./Creation/pomodorini.png" alt="preview" id="ipomodorini">
  <img src="./Creation/rucola.png" alt="preview" id="irucola">
  <img src="./Creation/salamino.png" alt="preview" id="isalamino">
  <img src="./Creation/patatine.png" alt="preview" id="ipatatine">
  <img src="./Creation/cipolla.png" alt="preview" id="icipolla">
  <img src="./Creation/wurstel.png" alt="preview" id="iwurstel">
  <img src="./Creation/olive.png" alt="preview" id="iolive">
  <img src="./Creation/basilico.png" alt="preview" id="ibasilico">
  <img src="./Creation/origano.png" alt="preview" id="iorigano">
  <img src="./Creation/pcotto.png" alt="preview" id="ipcotto">
  <img src="./Creation/acciughe.png" alt="preview" id="iacciughe">
  <img src="./Creation/bacon.png" alt="preview" id="ibacon">
</aside>
<!-- MODAL UTENTE -->

<div id="id03" class="modal">
  
  <div class="modal-content animate">
    <div class="imgcontainer">
      <span onclick="closemodal2()" class="close" title="Close Modal">&times;</span> <!-- Span chiusura modal -->
      <img src="immagini/user.png" alt="Avatar" class="avatar">
    </div>

    <div class="container-modal">
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

<!--                                 -->

<script src="./JS/creation.js"></script>
</body>
</html>