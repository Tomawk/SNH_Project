<?php
session_start();
require('inc/db.php');
require('utility/sessionManager.php');

checkSession($con);
if(!isset($_SESSION['username'])){
    $_SESSION["error"]= "Username or Password wrong. Retry.";
    header('location: index.php');
} 
?>
<!DOCTYPE HTML>
<html lang="it">
	<head>
	<title> Summary </title>
	<link href="CSS/summary.css" rel="stylesheet" type="text/css">
    <script src="JS/modal.js" ></script>
    <script src="JS/summary.js" ></script>
	<link href="CSS/stilemain.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>
	<link rel="icon" href="immagini/icon.png" sizes="32x32">
	</head>
<body>
<?php 
	include 'html/topnav.php';
	include "html/modal_user.php";
?>
<div class='container'>
  <div class='window'>
    <div class='order-info'>
      <div class='order-info-content' >
        <h2>Order Summary</h2>
                <div class='line'></div>
 
       
<?php
        if(isset($_POST["order id"]))
            header("location: ..".$_POST["order id"]);
        exit();
        $query = "SELECT b.*, o.stato_ordine, o.id,c.numero_item FROM `ContenutoOrdini` as c join `ordini` as o on c.id = o.id join books b on b.ISBN = c.ISBN 
				where c.username = ? and o.stato_ordine is null;";
   		//$result=mysqli_query($con,$query);
		$statement = $con->prepare($query);
		$statement->bind_param("s",$_SESSION["username"]);
		$statement->execute();
		$result =  $statement->get_result();
    	$resultCount=mysqli_num_rows($result);

    	if($resultCount == 0) { /* Se il carrello è vuoto */
    		echo '<h2 id="h2_empty"> Ops! System error!  &egrave; vuoto.. </h2>
    			  <img src="immagini/emptycart.png" alt="carrello vuoto" id="empty_cart">
				  <a href="bookshelf.php" id="a_empty"> Contact an administrator! </a>';
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

			echo '';
        }
   $_SESSION["totale"] = $totale_finale;

	if ($resultCount > 0){
		echo '';
    }
?>
</div>

        <div class='total'>
<div class='line'></div>
          <span style='float:left;'>
            <div class='thin dense'>VAT 19%</div>
            <div class='thin dense'>Delivery</div>
            TOTAL
          </span>
          <span style='float:right; text-align:right;'>
            <div class='thin dense'>$68.75</div>
            <div class='thin dense'>$4.95</div>
            $435.55
          </span>
        </div>
</div>
        <div class='credit-info'>
          <div class='credit-info-content'>
            <h2>Your credit card:</h2>
                <div class='line'></div>
            Card Number
            <input class='input-field'></input>
            Card Holder
            <input class='input-field'></input>
            <h2>Your address:</h2>
                <div class='line'></div>
            Address
            <input class='input-field'></input>

            <table class='half-input-table'>
                <button class='back-btn'>Back</button>
                <button class='pay-btn'>Buy Now!</button>
            </table>

          </div>

        </div>
      </div>
</div>
<?php
    include "html/footer.php";
?>