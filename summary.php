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

  
        <table class='order-table'>
          <tbody>
            <tr>
              <td><img src='https://dl.dropboxusercontent.com/s/qbj9tsbvthqq72c/Vintage-20L-Backpack-by-Fj%C3%A4llr%C3%A4ven.jpg' class='full-width'></img>
              </td>
              <td>
                <br> <span class='thin'>Fjällräven</span>
                <br>Vintage Backpack<br> <span class='thin small'> Color: Olive, Size: 20L</span>
              </td>
            </tr>
            <tr>
              <td>
                <div class='price'>$235.95</div>
              </td>
            </tr>
          </tbody>
        </table>
        <div class='line'></div>
        <table class='order-table'>
          <tbody>
            <tr>
              <td><img src='https://dl.dropboxusercontent.com/s/nbr4koso8dpoggs/6136C1p5FjL._SL1500_.jpg' class='full-width'></img>
              </td>
              <td>
                <br> <span class='thin'>Monobento</span>
                <br>Double Lunchbox<br> <span class='thin small'> Color: Pink, Size: Medium</span>
              </td>

            </tr>
            <tr>
              <td>
                <div class='price'>$25.95</div>
              </td>
            </tr>
          </tbody>
        </table>
        
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