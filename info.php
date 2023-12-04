<?php
	session_start();
	require('inc/db.php');

	if(!isset($_SESSION['username'])){
	header('location: 404.php');
	}
	
	$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
   	$result=mysqli_query($con,$query);
   	$row = mysqli_fetch_assoc($result);
   	$nome = $row['nome'];
   	$cognome = $row['cognome'];
   	$email = $row['email'];
   	$indirizzo = $row['indirizzo'];
   	$citta = $row['citta'];
   	$cap = $row['cap'];
   	$date = $row['trn_date'];

?>
<!DOCTYPE html>
<html lang="it">
	<head>
	<title>Informazioni Utente</title>
	<link href="CSS/stileinfo.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/key_icon.png" sizes="32x32">
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

    	<?php /* Verifica se l'utente è loggato e nel caso mostra il bottone con il nome */
		echo '<td><a onclick="openmodal2()"><strong>'.'<i class="fas fa-user-tie"></i>'.' '. $_SESSION["username"] . '</strong></a></td>';
		?>

  		<td><a href="carrello.php">Il Mio Carrello</a></td>

 	 </tr>
	</table>
	</nav>
	<div id="center_div">
		<div id="image">
		<img src="immagini/user.png" alt="avatar">
		</div>
		<p id= "username"><strong><?php echo $_SESSION['username']?></strong></p>
		<p id="storico"><strong>Utente dal: </strong><?php echo $date ?></p>
		<p id= "name"><strong>Nome: </strong><?php echo $nome ?></p>
		<p id= "cognome"><strong>Cognome: </strong><?php echo $cognome ?></p>
		<p id= "email"><strong>Email: </strong><?php echo $email ?></p>
		<p id= "indirizzo"><strong>Indirizzo: </strong><?php echo $indirizzo ?></p>
		<p id= "citta"><strong>Citt&agrave;: </strong><?php echo $citta ?></p>
		<p id= "cap"><strong>Cap: </strong><?php echo $cap ?></p>
		<!--
		<form method="post">
		<input type="submit" name="change" id="change" value="Modifica Profilo">
		</form>
		-->
		<!-- MODAL UTENTE -->
	</div>

		<div id="id03" class="modal">
  
  		<div class="modal-content animate">
    		<div class="imgcontainer">
      		<span onclick="closemodal2()" class="close" title="Close Modal">&times;</span> <!-- Span chiusura modal -->
      		<img src="immagini/user.png" alt="Avatar" class="avatar">
    		</div>

    		<div class="container-modal">
      			<p><strong><?php echo $_SESSION["username"]; ?></strong></p>
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
<script> 
	var modal3= document.getElementById('id03')
	function openmodal2(){
		modal3.style.display = "block";
	}

	function closemodal2(){
		modal3.style.display = "none";
	}
</script>
</body>
</html>