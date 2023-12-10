<?php
session_start();
require('inc/db.php');

if(!isset($_SESSION['username'])){
	//header('location: accesso1.php');
}

?>
<!DOCTYPE HTML>
<html lang="it">
	<head>
	<title> Carrello </title>
	<link href="CSS/stilecarrello.css" rel="stylesheet" type="text/css">
    <script src="JS/modal.js" ></script>
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>
	<link rel="icon" href="immagini/icon.png" sizes="32x32">
	</head>
<body>
<?php 
	include 'html/topnav.php';
	include "html/modal_user.php";
?>

	<div id="center_div">
		<h1> Libri nel tuo Carrello </h1>
		<hr>

		<?php 

		$totale_finale = 0; /* Contatore prezzo totale carrello */

		if(isset($_SESSION['not_logged_in'])){
			sort($_SESSION['not_logged_in']);
			
			$resultCount=sizeof($_SESSION['not_logged_in']);

			if($resultCount == 0){
				echo '<h2 id="h2_empty"> Ops! Il tuo Carrello &egrave; vuoto.. </h2>
    			  <img src="immagini/emptycart.png" alt="carrello vuoto" id="empty_cart">
    			  <a href="bookshelf.php" id="a_empty"> Inizia a ordinare adesso! </a>';
				exit();
			}

			$numero_item = 1;
			$multple_copy = 0;
			for($i = 0; $i<$resultCount; $i++){

				//questo if è utili per capire se di sono elementi dobbiati nella lista
				if($i+1 < $resultCount and $_SESSION['not_logged_in'][$i] == $_SESSION['not_logged_in'][$i+1]){
					$numero_item++;
					$multple_copy = 1;
					continue;
				}
				else{
					if($multple_copy == 1){
						$multple_copy = 0;
					}
				}

				//l'utente ha inserito libri nel carrello anche se non si è loggato
				$query = "SELECT * FROM books WHERE ISBN = ? ";
				$stmt = $con->prepare($query);
				$stmt->bind_param("s",$_SESSION['not_logged_in'][$i]);
				$stmt->execute();
				$result = $stmt->get_result();
				$rows_ordini = mysqli_fetch_assoc($result);
			
				$totale_finale += floatval($rows_ordini['price']); /* Incremento il totale */
	
				echo '
				<section>
	
					<div class="image"> 
						<img src='.$rows_ordini['image_url'].' alt="pizza">
					</div>
	
					<div class="testo">
	
						<p class="price"> '.$rows_ordini['price']. '&euro; </p>

						<form action="utility/remove.php" class="remove_form" method="post">
						
							<input type="text" name="ISBN" value="' .$_SESSION['not_logged_in'][$i].'" hidden>
							<input type="submit" value="Rimuovi" class="remove_btn">
						</form>
	
						<p class="description_p"> 
							<strong>titolo:</strong> '.$rows_ordini['title'].' 
							<strong>Publisher:</strong> '.$rows_ordini['publisher'].' 
							<strong>Auhtor:</strong> '.$rows_ordini['author'].'
							<br>
							<strong>Numero item :</strong> '.$numero_item.'
						</p>
	
						<p class="description_b"> 
							<strong>ISBN: </strong> '.$rows_ordini['ISBN'].' 
						</p>
	
					</div>
	
				</section>
	
	
				<br>
				<hr>
				';
				
				if($multple_copy == 0){
					$numero_item = 1;
				}
				
			}

		}
		else{
		
		
		$query = "SELECT b.*, o.stato_ordine, o.id,c.numero_item FROM `ContenutoOrdini` as c join `ordini` as o on c.id = o.id join books b on b.ISBN = c.ISBN 
				where c.username = '".$_SESSION['username']."'"."  and o.stato_ordine is null;";

   		$result=mysqli_query($con,$query);
    	$resultCount=mysqli_num_rows($result);

    	if($resultCount == 0) { /* Se il carrello è vuoto */
    		echo '<h2 id="h2_empty"> Ops! Il tuo Carrello &egrave; vuoto.. </h2>
    			  <img src="immagini/emptycart.png" alt="carrello vuoto" id="empty_cart">
				  <a href="bookshelf.php" id="a_empty"> Inizia a ordinare adesso! </a>';
				exit();

    	}
		

    	$rows_ordini = array();
		while($row = mysqli_fetch_assoc($result)){
        	$rows_ordini[] = $row;
   		}


		//se il mio carello non è vuoto e prelievo i libri contenuti
		$totale_finale = 0;
		for($i = 0; $i<$resultCount; $i++){

			
			$totale_finale += floatval($rows_ordini[$i]['price'])*floatval($rows_ordini[$i]['numero_item']); /* Incremento il totale */

			echo '
			<section>

				<div class="image"> 
					<img src='.$rows_ordini[$i]['image_url'].' alt="pizza">
				</div>

				<div class="testo">

					<h2> Ordine - #' .$rows_ordini[$i]['id'].' </h2>

					<p class="price"> '.$rows_ordini[$i]['price']. '&euro; </p>
					<form action="utility/remove.php" class="remove_form" method="post">
						<input type="submit" value="Rimuovi" class="remove_btn">
						<input type="text" name="id" value="' .$rows_ordini[$i]['id'].'" hidden>
						<input type="text" name="ISBN" value="' .$rows_ordini[$i]['ISBN'].'" hidden>
					</form>

					<p class="description_p"> 
						<strong>titolo:</strong> '.$rows_ordini[$i]['title'].' 
						<strong>Publisher:</strong> '.$rows_ordini[$i]['publisher'].' 
						<strong>Auhtor:</strong> '.$rows_ordini[$i]['author'].'
						<br>
						<strong>Numero item :</strong> '.floatval($rows_ordini[$i]['numero_item']).'
						
					</p>

					<p class="description_b"> 
						<strong>ISBN: </strong> '.$rows_ordini[$i]['ISBN'].' 
					</p>

				</div>

			</section>


			<br>
			<hr>
			';
		}
	}

	$_SESSION["totale"] = $totale_finale;

	if ($resultCount > 0){
		echo '
	<div id="total">

		<p> Subtotale Carrello &emsp; '.$totale_finale.'&euro; </p>
		<p style="color: red"> Spedizione Gratuita &emsp; 0.00&euro; </p>
		<h2> Totale &emsp; '.$totale_finale. '&euro; </h2>

	</div>
	<hr style="width: 100%">
	<footer> 
		<a href="bookshelf.php"> Continua ad ordinare </a>
		<form action="utility/pay.php" id="pay_form">
		<input type="submit" id="order_complete" value="Check Out" name="checkout">
		</form>
	</footer>';
	}
	?>
</div>

	<!-- MODAL UTENTE -->

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
      <button type="button" onclick="location.href = 'utility/logout.php';" class="modalbutton">Logout</button>
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

	function remove_item(i){
		<?php 
			if (($key = array_search(i, )) !== false) {
    			unset($array[$key]);
			}
 		?>
	}
</script>
</body>
</html>