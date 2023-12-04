<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="it">
	<head>
	<title>Error 404</title>
	<link href="CSS/stile404.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/error_icon.png" sizes="32x32"> 
	</head>
<body>
	<div id="center_div">
		<div id="image">
		<img src="immagini/sad_face.png" alt="sad_face">
		</div>
		<h1> 404 </h1>
		<h3> Pagina non trovata </h3>
		<p id="p1"> La pagina a cui stai cercando di accedere non esiste o si &egrave; verificato un errore.</p>
		<p id="p2"> Accedi alla <a href="index.php"> Home </a> oppure riprova successivamente.</p>
	</div>
</body>
</html>