<?php
 	$daily_date = date("Y-m-d"); // Data corrente
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title> Ordine effettuato con successo </title>
		<link href="./CSS/stilesuccesso.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="immagini/success_icon.png" sizes="32x32">
	</head>
<body>
	<div id="center_div">
		<div class="imgdiv">
      		<img src="immagini/check.png" alt="check" class="check">
    	</div>
    	<div id="intestation">
    		<h1> Grazie! </h1>
    		<p> Il tuo ordine del giorno <?php echo $daily_date ?> &egrave; stato confermato con successo. </p>
    		<a href="index.php"> &#8592; TORNA ALLA HOME </a>
		</div>
	</div>
</body>
</html>