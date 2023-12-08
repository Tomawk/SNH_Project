<?php
session_start();
require('inc/db.php');
require('utility/sessionManager.php');
?>
<!DOCTYPE html>
<html lang="it">
	<head>
  <title> Bookworm Home </title>
	<link href="CSS/stilemain.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/icon.png" sizes="32x32">
    <!-- Font Awesome Import -->
    <script src="JS/mainscript.js"> </script>
    <script src="JS/modal.js" ></script>
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>
	</head>
<body 
  <?php 
    if(isset($_SESSION["error"])){
      echo 'onload ="openmodal()"';
    }
	if(isset($_SESSION["signup_error"])){
      echo 'onload ="openmodal1()"';
	}
    ?>
>
<?php include 'html/topnav.php';?>
<div class="mainpic">
		<h1 id="title">BOOK WORM</h1>
		<h3 id="subtitle">Your favourite bookshop</h3>
</div>
<div class="firstdiv">
	<div class="production">
	 <h2 id="title1">Search in our bookshelf for your favourite book!</h2>
	 <img src="immagini/greyline.png" alt="greyline" id="linea">
	 <h4 id="subtitle1"> We pride ourselves on offering a diverse range of titles, from international bestsellers to emerging gems, ensuring a satisfying literary experience for every reader. With fast shipping and curated selections</h4>
	 <a href="creation.php">Explore now! > </a>
    </div>
    <div class="rightimage">
	</div>
</div>
<div id="separator1">
	<hr id="hr1">
	<p>News and more!</p>
</div>
<section class="promotions" id="promote">
	<table>
	 <tr>
	 	<td> <h2> Book Discount! </h2> <br> We are offering a 20% discount on a captivating selection of books. Dive into savings and stories today!</td>
	 	<td id="image1"> </td>
	 </tr>
	 <tr>
	 	<td id="image2"> </td>
	 	<td> <h2> Free Shipping! </h2> <br> 'Tis the season of giving! Enjoy the holiday spirit with free shipping on our site – because every book deserves to find its way home for Christmas.</td>
	 </tr>
	 <tr>
	 	<td> <h2> Order History! </h2> <br> Starting today, every user can track their order history directly from their user menu!</td>
	 	<td id="image3"></td>
	 </tr>
	</table>
</section>

<div id="alertbox">
</div>
<?php include 'html/modal.php' ?>
<?php include 'html/footer.php' ?>
</body>
</html>
