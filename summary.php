<?php
session_start();
require('inc/db.php');
require('utility/sessionManager.php');

checkSession($con);
if(!isset($_SESSION['username'])){
    $_SESSION["error"]= "Username or Password wrong. Retry.";
    header('location: index.php');
} 
if($_SESSION["state"]!="summary")
{
  header("location: ".$_SESSION["state"].".php") ;
  exit();
}
if(!isset($_POST["address"])||!isset($_POST["city"])|| 
          !isset($_POST["country"]) || !isset($_POST["cardnumber"])||
          !isset($_POST["expiration"])||!isset($_POST["cvv"]))
          {
            $_SESSION["state"]="address_card";
            header("location: address_card.php");
            exit();
          }
?>
<!DOCTYPE HTML>
<html lang="it">
	<head>
	<title> Summary </title>
    <script src="JS/modal.js" ></script>
    <script src="JS/summary.js" ></script>
	<link href="CSS/stilemain.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>
	<link rel="icon" href="immagini/icon.png" sizes="32x32">
	<link href="CSS/summary.css" rel="stylesheet" type="text/css">
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
         
       
<?php
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
		
      echo "<h2>"."Order Summary for #".$_SESSION["id_ordine"]."</h2>
                <div class='line'></div>";

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

	for ($i = 0; $i < $resultCount ; $i++){
		echo "<div class='line'></div>
        <table class='order-table'>
          <tbody>
            <tr>
              <td><img src='".$rows_ordini[$i]['image_url']."' class='image'></img>".
                  "</td>
              <td>
                <br> <span class='thin'>".$rows_ordini[$i]['title']."</span>
                <br>".$rows_ordini[$i]['author']."<br> <span class='thin small'>".
                $rows_ordini[$i]['numero_item']." items</span>
              </td>

            </tr>
            <tr>
              <td>
                <div class='price'>$".$rows_ordini[$i]['price']."</div>".
              "</td>
            </tr>
          </tbody>
        </table>"
    ;
    }
?>
</div>

        <div class='total'>
<div class='line'></div>
          <span style='float:left;'>
            <div class='thin dense'>Delivery</div>
            TOTAL
          </span>
          <span style='float:right; text-align:right;'>
            <div class='thin dense'>$0.00</div>
            <?php
            echo $totale_finale;
            ?>
          </span>
        </div>
</div>
        <div class='credit-info'>
          <div class='credit-info-content'>
            <h2>Your credit card:</h2>
                <div class='line'></div>
            Card Number
            <p class='input-field'><?php echo $_POST["cardnumber"];?></p>
            <h2>Your address:</h2>
                <div class='line'></div>
            Address
            <p class='input-field'><?php echo $_POST["address"].",".$_POST["city"];?></p>

            <table class='half-input-table'>
                <button class='back-btn' onclick="location.href='carrello.php'">Cancel</button>
                <button class='pay-btn' onclick="location.href='utility/pay.php'">Buy Now!</button>
            </table>

          </div>

        </div>
      </div>
</div>
<?php
    include "html/footer.php";
?>