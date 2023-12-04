<?php
	session_start();
	require('inc/db.php');

	 if(!isset($_SESSION["username"])){
  	header('location: 404.php');
  	}

	$_SESSION['impasto'] = $_POST['impasto'];
	$_SESSION['tomato'] = $_POST['tomato'];
	$_SESSION['cheese'] = $_POST['cheese'];

	/* UNSET VARIABILI SESSION */

	if (isset($_SESSION["capperi"])){
		unset($_SESSION['capperi']); 
	}
	if (isset($_SESSION["pomodorini"])){ 
		unset($_SESSION['pomodorini']);
	}
	if (isset($_SESSION["peperoni"])){
		unset($_SESSION['peperoni']);
	}
	if (isset($_SESSION["funghi"])){
		unset($_SESSION['funghi']);
	}
	if (isset($_SESSION["rucola"])){
		unset($_SESSION['rucola']);
	}
	if (isset($_SESSION["salamino"])){
		unset($_SESSION['salamino']);
	}
	if (isset($_SESSION["patatine"])){
		unset($_SESSION['patatine']);
	}
	if (isset($_SESSION["cipolla"])){
		unset($_SESSION['cipolla']);
	}
	if (isset($_SESSION["bacon"])){
		unset($_SESSION['bacon']);
	}
	if (isset($_SESSION["acciughe"])){
		unset($_SESSION['acciughe']);
	}
	if (isset($_SESSION["pcotto"])){
		unset($_SESSION['pcotto']);
	}
	if (isset($_SESSION["olive"])){
		unset($_SESSION['olive']);
	}
	if (isset($_SESSION["wurstel"])){
		unset($_SESSION['wurstel']);
	}
	if (isset($_SESSION["origano"])){
		unset($_SESSION['origano']);
	}
	if (isset($_SESSION["basilico"])){
		unset($_SESSION['basilico']);
	}

	/* UNSET BEVANDE */

	if (isset($_SESSION["acquanat"])){
		unset($_SESSION['acquanat']);
		unset($_SESSION['q_acquanat']);
	}

	if (isset($_SESSION["acquafri"])){
		unset($_SESSION['acquafri']);
		unset($_SESSION['q_acquafri']);
	}

	if (isset($_SESSION["cola"])){
		unset($_SESSION['cola']);
		unset($_SESSION['q_cola']);
	}

	if (isset($_SESSION["sprite"])){
		unset($_SESSION['sprite']);
		unset($_SESSION['q_sprite']);
	}

	if (isset($_SESSION["estatepes"])){
		unset($_SESSION['estatepes']);
		unset($_SESSION['q_estatepes']);
	}

	if (isset($_SESSION["estatelim"])){
		unset($_SESSION['estatelim']);
		unset($_SESSION['q_estatelim']);
	}

	if (isset($_SESSION["fanta"])){
		unset($_SESSION['fanta']);
		unset($_SESSION['q_fanta']);
	}

	if (isset($_SESSION["7up"])){
		unset($_SESSION['7up']);
		unset($_SESSION['q_7up']);
	}

	if (isset($_SESSION["heineken"])){
		unset($_SESSION['heineken']);
		unset($_SESSION['q_heineken']);
	}

	if (isset($_SESSION["corona"])){
		unset($_SESSION['corona']);
		unset($_SESSION['q_corona']);
	}

	if (isset($_SESSION["peroni"])){
		unset($_SESSION['peroni']);
		unset($_SESSION['q_peroni']);
	}

	if (isset($_SESSION["moretti"])){
		unset($_SESSION['moretti']);
		unset($_SESSION['q_moretti']);
	}

	/* SET VARIABILI SESSION */

	if (isset($_POST["capperi"])){
		$_SESSION['capperi'] = $_POST['capperi'];
	}
	if (isset($_POST["pomodorini"])){
		$_SESSION['pomodorini'] = $_POST['pomodorini'];
	}
	if (isset($_POST["peperoni"])){
		$_SESSION['peperoni'] = $_POST['peperoni'];
	}
	if (isset($_POST["funghi"])){
		$_SESSION['funghi'] = $_POST['funghi'];
	}
	if (isset($_POST["rucola"])){
		$_SESSION['rucola'] = $_POST['rucola'];
	}
	if (isset($_POST["salamino"])){
		$_SESSION['salamino'] = $_POST['salamino'];
	}
	if (isset($_POST["patatine"])){
		$_SESSION['patatine'] = $_POST['patatine'];
	}
	if (isset($_POST["cipolla"])){
		$_SESSION['cipolla'] = $_POST['cipolla'];
	}
	if (isset($_POST["bacon"])){
		$_SESSION['bacon'] = $_POST['bacon'];
	}
	if (isset($_POST["acciughe"])){
		$_SESSION['acciughe'] = $_POST['acciughe'];
	}
	if (isset($_POST["pcotto"])){
		$_SESSION['pcotto'] = $_POST['pcotto'];
	}
	if (isset($_POST["olive"])){
		$_SESSION['olive'] = $_POST['olive'];
	}
	if (isset($_POST["wurstel"])){
		$_SESSION['wurstel'] = $_POST['wurstel'];
	}	
	if (isset($_POST["origano"])){
		$_SESSION['origano'] = $_POST['origano'];
	}
	if (isset($_POST["basilico"])){
		$_SESSION['basilico'] = $_POST['basilico'];
	}

	/* Inserimento nella table Bevande */

	if (isset($_POST["acquanat"])){
		$_SESSION['acquanat'] = $_POST['acquanat'];
		$_SESSION['q_acquanat']= $_POST['q_acquanat'];
	}

	if (isset($_POST["acquafri"])){
		$_SESSION['acquafri'] = $_POST['acquafri'];
		$_SESSION['q_acquafri']= $_POST['q_acquafri'];
	}

	if (isset($_POST["cola"])){
		$_SESSION['cola'] = $_POST['cola'];
		$_SESSION['q_cola']= $_POST['q_cola'];
	}

	if (isset($_POST["sprite"])){
		$_SESSION['sprite'] = $_POST['sprite'];
		$_SESSION['q_sprite']= $_POST['q_sprite'];
	}

	if (isset($_POST["estatepes"])){
		$_SESSION['estatepes'] = $_POST['estatepes'];
		$_SESSION['q_estatepes']= $_POST['q_estatepes'];
	}

	if (isset($_POST["estatelim"])){
		$_SESSION['estatelim'] = $_POST['estatelim'];
		$_SESSION['q_estatelim']= $_POST['q_estatelim'];
	}

	if (isset($_POST["fanta"])){
		$_SESSION['fanta'] = $_POST['fanta'];
		$_SESSION['q_fanta']= $_POST['q_fanta'];
	}

	if (isset($_POST["7up"])){
		$_SESSION['7up'] = $_POST['7up'];
		$_SESSION['q_7up']= $_POST['q_7up'];
	}

	if (isset($_POST["heineken"])){
		$_SESSION['heineken'] = $_POST['heineken'];
		$_SESSION['q_heineken']= $_POST['q_heineken'];
	}

	if (isset($_POST["corona"])){
		$_SESSION['corona'] = $_POST['corona'];
		$_SESSION['q_corona']= $_POST['q_corona'];
	}

	if (isset($_POST["peroni"])){
		$_SESSION['peroni'] = $_POST['peroni'];
		$_SESSION['q_peroni']= $_POST['q_peroni'];
	}

	if (isset($_POST["moretti"])){
		$_SESSION['moretti'] = $_POST['moretti'];
		$_SESSION['q_moretti']= $_POST['q_moretti'];
	}

?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title> Resoconto Ordine </title>
		<link href="./CSS/stiletest.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="immagini/icon.png" sizes="32x32">
	</head>
<body>
<div id="resoconto">
<hr>
<h1> RESOCONTO ORDINE </h1>
<hr>
<p><img src="immagini/pizza_icon.png" class="icon" alt="icon"><strong> Tipologia Impasto:</strong> 
	<?php 
	echo $_POST["impasto"]; 
	if($_POST['impasto'] == 'Classico' || $_POST['impasto'] == 'Senza Glutine' ){
	$totale = 3;
	echo ' (+3.00&euro;)';
	}
	if($_POST['impasto'] == 'Integrale'){
	$totale = 4;
	echo ' (+4.00&euro;)';
	}
	if($_POST['impasto'] == 'Curcuma' || $_POST['impasto'] == 'Grano Saraceno'){
	$totale = 3.5;
	echo ' (+3.50&euro;)';
	}
	?>
</p>
<p><img src="immagini/sauce_icon.png" class="icon" alt="icon"><strong> Tipologia Salsa:</strong> 
	<?php
	echo $_POST["tomato"]; 
	if($_POST['tomato'] == 'Pomodoro'){
	$totale += 1;
	echo ' (+1.00&euro;)';
	}
	?>
</p>
<p><img src="immagini/cheese_icon.png" class="icon" alt="icon"><strong> Tipologia Formaggio:</strong>
	<?php 
	echo $_POST["cheese"]; 
	if($_POST['cheese'] == 'Mozzarella'){
	$totale += 2;
	echo ' (+2.00&euro;)';
	}
	if($_POST['cheese'] == 'Bufala'){
	$totale += 3;
	echo ' (+3.00&euro;)';
	}
	if($_POST['cheese'] == 'Mozzarella (- grassi)'){
	$totale += 2.5;
	echo ' (+2.50&euro;)';
	}
	?>
</p>
<h2> Setting Ingredienti:</h2>
<?php if(isset($_POST['capperi'])) { $totale += 0.5; echo '<p><img src="immagini/capers_icon.png" class="icon" alt="icon"><strong> Capperi:</strong> +0.50&euro;</p>'; } ?>
<?php if(isset($_POST['pomodorini'])) { $totale += 0.5; echo '<p><img src="immagini/tomato_icon.png" class="icon" alt="icon"><strong> Pomodorini:</strong> +0.50&euro;</p>'; } ?>
<?php if(isset($_POST['peperoni'])) { $totale += 1; echo '<p><img src="immagini/pepper_icon.png" class="icon" alt="icon"><strong> Peperoni:</strong> +1.00&euro;</p>'; } ?>
<?php if(isset($_POST['funghi'])) { $totale += 1; echo '<p><img src="immagini/mushroom_icon.png" class="icon" alt="icon"><strong> Funghi:</strong> +1.00&euro;</p>'; } ?>
<?php if(isset($_POST['rucola'])) { $totale += 0.5; echo '<p><img src="immagini/salad_icon.png" class="icon" alt="icon"><strong> Rucola:</strong> +0.50&euro;</p>'; } ?>
<?php if(isset($_POST['salamino'])) { $totale += 1; echo '<p><img src="immagini/salami_icon.png" class="icon" alt="icon"><strong> Salamino:</strong> +1.00&euro;</p>'; } ?>
<?php if(isset($_POST['patatine'])) { $totale += 1; echo '<p> <img src="immagini/potatoes_icon.png" class="icon" alt="icon"> <strong> Patatine:</strong> +1.00&euro;</p>'; } ?>
<?php if(isset($_POST['cipolla'])) { $totale += 0.5; echo '<p><img src="immagini/onion_icon.png" class="icon" alt="icon"><strong> Cipolla:</strong> +0.50&euro;</p>'; } ?>
<?php if(isset($_POST['bacon'])) { $totale += 1.5; echo '<p><img src="immagini/bacon_icon.png" class="icon" alt="icon"><strong> Bacon:</strong> +1.50&euro;</p>'; } ?>
<?php if(isset($_POST['acciughe'])) { $totale += 1.5; echo '<p><img src="immagini/sardine_icon.png" class="icon" alt="icon"><strong> Acciughe:</strong> +1.50&euro;</p>'; } ?>
<?php if(isset($_POST['pcotto'])) { $totale += 1.5; echo '<p><img src="immagini/ham_icon.png" class="icon" alt="icon"><strong> Prosciutto Cotto:</strong> +1.50&euro;</p>'; }?>
<?php if(isset($_POST['olive'])) { $totale += 0.5; echo '<p><img src="immagini/olive_icon.png" class="icon" alt="icon"><strong> Olive:</strong> +0.50&euro;</p>'; } ?>
<?php if(isset($_POST['wurstel'])) { $totale += 1.5; echo '<p><img src="immagini/wurstel_icon.png" class="icon" alt="icon"><strong> Wurstel:</strong> +1.50&euro;</p>'; } ?>
<?php if(isset($_POST['origano'])) { $totale += 0.5; echo '<p><img src="immagini/origan_icon.png" class="icon" alt="icon"><strong> Origano:</strong> +0.50&euro;</p>'; } ?>
<?php if(isset($_POST['basilico'])) { $totale += 0.5; echo '<p><img src="immagini/basilic_icon.png" class="icon" alt="icon"><strong> Basilico:</strong> +0.50&euro;</p>'; } ?>
<h2> Bevande: </h2>

<?php if(isset($_POST['acquanat'])) { $totale += $_POST['q_acquanat']*0.5; echo '<p><img src="immagini/acqua_icon.png" class="icon" alt="icon"><strong> Acqua Frizzante:</strong>'.' '.$_POST['q_acquanat'].' x 0.5&euro; = +'.$_POST['q_acquanat']*0.5.'&euro;</p>'; } ?>

<?php if(isset($_POST['acquafri'])) { $totale += $_POST['q_acquafri']*0.5; echo '<p><img src="immagini/acqua_icon.png" class="icon" alt="icon"><strong> Acqua Frizzante:</strong>'.' '.$_POST['q_acquafri'].' x 0.5&euro; = +'.$_POST['q_acquafri']*0.5.'&euro;</p>'; } ?>

<?php if(isset($_POST['cola'])) { $totale += $_POST['q_cola']*2; echo '<p><img src="immagini/coke_icon.png" class="icon" alt="icon"><strong> CocaCola:</strong>'.' '.$_POST['q_cola'].' x 2.00&euro; = +'.$_POST['q_cola']*2.0.'&euro;</p>'; } ?>

<?php if(isset($_POST['sprite'])) { $totale += $_POST['q_sprite']*2; echo '<p><img src="immagini/sprite_icon.png" class="icon" alt="icon"><strong> Sprite:</strong>'.' '.$_POST['q_sprite'].' x 2.00&euro; = +'.$_POST['q_sprite']*2.0.'&euro;</p>'; } ?>

<?php if(isset($_POST['estatepes'])) { $totale += $_POST['q_estatepes']*1.5; echo '<p><img src="immagini/soda_icon.png" class="icon" alt="icon"><strong> Estat&egrave; Pesca:</strong>'.' '.$_POST['q_estatepes'].' x 1.50&euro; = +'.$_POST['q_estatepes']*1.5.'&euro;</p>'; } ?>

<?php if(isset($_POST['estatelim'])) { $totale += $_POST['q_estatelim']*1.5; echo '<p><img src="immagini/soda_icon.png" class="icon" alt="icon"><strong> Estat&egrave; Limone:</strong>'.' '.$_POST['q_estatelim'].' x 1.50&euro; = +'.$_POST['q_estatelim']*1.5.'&euro;</p>'; } ?>

<?php if(isset($_POST['fanta'])) { $totale += $_POST['q_fanta']*2 ; echo '<p><img src="immagini/fanta_icon.png" class="icon" alt="icon"><strong> Fanta:</strong>'.' '.$_POST['q_fanta'].' x 2.00&euro; = +'.$_POST['q_fanta']*2.0.'&euro;</p>'; } ?>

<?php if(isset($_POST['7up'])) { $totale += $_POST['q_7up']*2; echo '<p><img src="immagini/7up_icon.png" class="icon" alt="icon"><strong> 7Up:</strong>'.' '.$_POST['q_7up'].' x 2.00&euro; = +'.$_POST['q_7up']*2.0.'&euro;</p>'; } ?>

<?php if(isset($_POST['heineken'])) { $totale += $_POST['q_heikenen']*2.5; echo '<p><img src="immagini/heineken_icon.png" class="icon" alt="icon"><strong> Heineken:</strong>'.' '.$_POST['q_heineken'].' x 2.50&euro; = +'.$_POST['q_heineken']*2.5.'&euro;</p>'; } ?>

<?php if(isset($_POST['corona'])) { $totale += $_POST['q_corona']*2.5; echo '<p><img src="immagini/corona_icon.png" class="icon" alt="icon"><strong> Corona:</strong>'.' '.$_POST['q_corona'].' x 2.50&euro; = +'.$_POST['q_corona']*2.5.'&euro;</p>'; } ?>

<?php if(isset($_POST['peroni'])) { $totale += $_POST['q_peroni']*2.5; echo '<p><img src="immagini/peroni_icon.png" class="icon" alt="icon"><strong> Peroni:</strong>'.' '.$_POST['q_peroni'].' x 2.50&euro; = +'.$_POST['q_peroni']*2.5.'&euro;</p>'; } ?>

<?php if(isset($_POST['moretti'])) { $totale += $_POST['q_moretti']*2.5; echo '<p><img src="immagini/moretti_icon.png" class="icon" alt="icon"><strong> Moretti:</strong>'.' '.$_POST['q_moretti'].' x 2.50&euro; = +'.$_POST['q_moretti']*2.5.'&euro;</p>'; } ?>

</div>
<aside id="preview">
	<p> Preview: </p>
	<?php if ($_POST["impasto"] == 'Classico'){ echo '<img src="./Creation/impasto_classico.png" alt="preview" id="iclassico" style="display:block">';} ?>
	<?php if ($_POST["impasto"] == 'Integrale'){ echo '<img src="./Creation/impasto_integrale.png" alt="preview" id="iintegrale" style="display:block">';} ?>
	<?php if ($_POST["impasto"] == 'Curcuma'){ echo '<img src="./Creation/impasto_curcuma.png" alt="preview" id="icurcuma" style="display:block">';} ?>
	<?php if ($_POST["impasto"] == 'Senza Glutine'){ echo '<img src="./Creation/impasto_classico.png" alt="preview" style="display:block">';} ?>
	<?php if ($_POST["impasto"] == 'Grano Saraceno'){ echo '<img src="./Creation/impasto_grano.png" alt="preview" id="igrano" style="display:block">';} ?>
	<?php if ($_POST["tomato"] == 'Pomodoro'){ echo '<img src="./Creation/sugo_pomodoro.png" alt="preview" id="tpomodoro" style="display:block">';} ?>
	<?php if ($_POST["cheese"] == 'Mozzarella' || $_POST["cheese"] == 'Mozzarella (- grassi)' || $_POST["cheese"] == 'Bufala'){ 
		echo '<img src="./Creation/mozzarella.png" alt="preview" id="cmozzarella" style="display:block">';} ?>
	<?php if (isset($_POST["capperi"])){ echo '<img src="./Creation/capperi.png" alt="preview" id="icapperi" style="display:block">';} ?>
	<?php if (isset($_POST["funghi"])){ echo '<img src="./Creation/funghi.png" alt="preview" id="ifunghi" style="display:block">';} ?>
	<?php if (isset($_POST["peperoni"])){ echo '<img src="./Creation/peperoni.png" alt="preview" id="ipeperoni" style="display:block">';} ?>
	<?php if (isset($_POST["pomodorini"])){ echo '<img src="./Creation/pomodorini.png" alt="preview" id="ipomodorini" style="display:block">';} ?>
  	<?php if (isset($_POST["rucola"])){ echo '<img src="./Creation/rucola.png" alt="preview" id="irucola" style="display:block">';} ?>
  	<?php if (isset($_POST["salamino"])){ echo '<img src="./Creation/salamino.png" alt="preview" id="isalamino" style="display:block">';} ?>
 	<?php if (isset($_POST["patatine"])){ echo '<img src="./Creation/patatine.png" alt="preview" id="ipatatine" style="display:block">';} ?>
  	<?php if (isset($_POST["cipolla"])){ echo '<img src="./Creation/cipolla.png" alt="preview" id="icipolla" style="display:block">';} ?>
	<?php if (isset($_POST["wurstel"])){ echo '<img src="./Creation/wurstel.png" alt="preview" id="iwurstel" style="display:block">';} ?>
  	<?php if (isset($_POST["olive"])){ echo '<img src="./Creation/olive.png" alt="preview" id="iolive" style="display:block">';} ?>
 	<?php if (isset($_POST["basilico"])){ echo '<img src="./Creation/basilico.png" alt="preview" id="ibasilico" style="display:block">';} ?>
 	<?php if (isset($_POST["origano"])){ echo '<img src="./Creation/origano.png" alt="preview" id="iorigano" style="display:block">';} ?>
  	<?php if (isset($_POST["pcotto"])){ echo '<img src="./Creation/pcotto.png" alt="preview" id="ipcotto" style="display:block">';} ?>
 	<?php if (isset($_POST["acciughe"])){ echo '<img src="./Creation/acciughe.png" alt="preview" id="iacciughe" style="display:block">';} ?>
 	<?php if (isset($_POST["bacon"])){ echo '<img src="./Creation/bacon.png" alt="preview" id="ibacon" style="display:block">';} ?>
</aside>
<aside id= "total">
	<?php echo '<p> Totale: <strong>'.$totale.'&euro;</strong></p>'; ?>
</aside>
<aside id="details"> 
	<h3> Le tue informazioni </h3>
	<p><strong> Username: </strong><?php echo $_SESSION['username']; ?> <br>
	<strong>Email: </strong>
	<?php 
	$query = mysqli_query($con,"SELECT email FROM users WHERE username ='{$_SESSION['username']}'");
	$result = mysqli_fetch_assoc($query);
	echo $result["email"];
	?> <br>
	<strong>Nome: </strong>
	<?php 
	$query = mysqli_query($con,"SELECT nome FROM users WHERE username ='{$_SESSION['username']}'");
	$result = mysqli_fetch_assoc($query);
	echo $result["nome"];
	?> 
	&emsp;&emsp;<strong>Cognome: </strong>
	<?php 
	$query = mysqli_query($con,"SELECT cognome FROM users WHERE username ='{$_SESSION['username']}'");
	$result = mysqli_fetch_assoc($query);
	echo $result["cognome"];
	?> <br>
	<strong>Citta: </strong>
	<?php 
	$query = mysqli_query($con,"SELECT citta FROM users WHERE username ='{$_SESSION['username']}'");
	$result = mysqli_fetch_assoc($query);
	echo $result["citta"];
	?> <br>
	<strong>Indirizzo: </strong>
	<?php 
	$query = mysqli_query($con,"SELECT indirizzo FROM users WHERE username ='{$_SESSION['username']}'");
	$result = mysqli_fetch_assoc($query);
	echo $result["indirizzo"];
	?> 
	&emsp;&emsp;<strong>CAP: </strong>
	<?php 
	$query = mysqli_query($con,"SELECT cap FROM users WHERE username ='{$_SESSION['username']}'");
	$result = mysqli_fetch_assoc($query);
	echo $result["cap"];
	?> 
	</p>
</aside>
<div id="pulsanti">
	<form action="./utility/confirm.php">
	<input type="submit" id="add_order" value="Aggiungi al Carrello" name="aggiungi">
	</form>
	<form action="./utility/annulla.php">
	<input type="submit" id="cancel_order" value="Annulla" name="annulla">
	</form>
</div>
</body>
</html>
