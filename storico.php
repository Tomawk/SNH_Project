<?php
session_start();
require('inc/db.php');

if(!isset($_SESSION['username'])){
	header('location: 404.php');
}

?>
<!DOCTYPE HTML>
<html lang="it">
	<head>
	<title>Storico Utente</title>
	<link href="CSS/stilestorico.css" rel="stylesheet" type="text/css">
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

    	<?php /* Verifica se l'utente è loggato e nel caso mostra il bottone con il nome */
		echo '<td><a onclick="openmodal2()"><strong>'.' '. $_SESSION["username"] . '</strong></a></td>';
		?>

  		<td><a href="carrello.php">Il Mio Carrello</a></td>
 	 </tr>
	</table>
	</nav>
	<div id="center_div">
		<h1> Storico Ordini </h1>
		<hr>
		<?php
		$query = "SELECT * FROM ordini_def WHERE utente='".$_SESSION['username']."'";
   		$result=mysqli_query($con,$query);
    	$resultCount=mysqli_num_rows($result);

    	if($resultCount == 0) { /* Se il carrello è vuoto */
    		echo '<h2 id="h2_empty"> Ops! Non hai ancora effettuato ordini.. </h2>
    			  <img src="immagini/storico_empty.jpg" alt="nessun ordine" id="empty_history">
    			  <a href="creation.php" id="a_empty"> Inizia a ordinare adesso! </a>';

    	}

    	$rows_ordini = array();
		while($row = mysqli_fetch_assoc($result)){
        $rows_ordini[] = $row;
   		}

   		for($i= 0; $i<$resultCount; $i++){

   			$query2 = "SELECT * FROM pizzacustom_def WHERE codordine='".$rows_ordini[$i]['codordine']."'";
   			$result2= mysqli_query($con,$query2);
    		$resultCount2=mysqli_num_rows($result2);

   			echo '
   			<section>
			<div class="image">
				<img src="immagini/pizza_delivery.png" alt="pizza_delivery">
			</div>
			<h3> Ordine - '.$rows_ordini[$i]['codordine'].' </h3>
			<p class="quantity"> x'.$resultCount2.' - Pizza Personalizzata </p>
			<p class="data"> Data Pagamento: <strong>'.$rows_ordini[$i]['data_pagamento'].'</strong> </p>
			<p class="total"> Totale <br> &nbsp;&nbsp;<strong>'.$rows_ordini[$i]['totale_ordine'].'&euro; </strong></p>
			</section>
			<hr>
			';
   		}
   		?>
		
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