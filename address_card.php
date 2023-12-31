<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Address and Credit Card Info</title>
    <script src="JS/modal.js" ></script>

    <!-- Stylesheets -->
    <link href="CSS/topnav.css" rel="stylesheet" type="text/css">
    <link href="CSS/rightnav.css" rel="stylesheet" type="text/css">
    <link href="CSS/modals.css" rel="stylesheet" type="text/css">
    <link href="CSS/address_card.css" rel="stylesheet" type="text/css">

    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>
	<link rel="icon" href="immagini/icon.png" sizes="32x32">

    <script src="JS/address_card.js" ></script>

    <!-- Modal js include -->
    <script src="JS/modal.js" ></script>
</head>
<body>

<?php
  session_start();

  require('inc/db.php');
  require('utility/sessionManager.php');
  checkSession($con);
  include 'html/topnav.php';
  include 'html/aside.php';

  if(isset($_SESSION["username"])){
      include "html/modal_user.php";
  }

  if($_SESSION['state'] == 'outside' || !$_SESSION['id_ordine']){
    echo '<h2 id="h2_empty"> Ops! System error!  </h2>
      			  <img src="immagini/emptycart.png" alt="carrello vuoto" id="empty_cart">
	  			  <a href="carrello.php" id="a_empty"> Something went wrong restart from the checkout </a>
            </body>
            ';
    exit();
  }
  else if($_SESSION['state'] == 'carrello'){
    $_SESSION['state'] = 'address_card';
  }

  else if($_SESSION['state'] == 'summary'){
    //nothing
  }

  else if(!isset($_SESSION['state'])){
    header("location: index.php");
    exit();
  }
  else{
    $_SESSION['state'] = "outside";
    header("location: index.php");
    exit();
  }

?>

  <div class="new_container">
    <h1>Enter Address and Credit Card Info</h1>
    <label for="order id">Order id: </label><?php echo $_SESSION['id_ordine'] ?>
    <br>
    <br>
    <form action="summary.php" method="post" id="form_id">
       <label for="address">Address:</label>
      <input type="text" id="address" name="address" placeholder="via Diotisalvi" required>

      <label for="city">City:</label>
      <input type="text" id="city" name="city" placeholder="Pisa" required>

      <label for="country">Country:</label>
      <select id="country" name="country" required>
        <option value="">Select Country</option>

        <option value="ITA">Italia</option>
        <option value="UK">United Kingdom</option>
        <option value="CA">Canada</option>
        <option value="USA">Usa</option>

      </select>

      <label for="cardnumber">Card Number:</label>
      <input placeholder="Insert your credit card number" type="text" id="cardnumber" name="cardnumber" required oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" maxlength="16" >

      <div class="card-info">
        <div>
          <label for="expiration">Expiration Date:</label>
          <input type="date" id="expiration" name="expiration" placeholder="MM/YY" required min="<?php echo date("Y-m-d"); ?>">
        </div>
        <div>
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" placeholder="000" required oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" maxlength="3">
        </div>
      </div>

      <div id="button">
        <input type="button" value="Back" onclick="location.href = 'carrello.php';" id="back_button">
        <input type="submit" id="sub_btn" value="Submit" onclick="handleParameter()" >
      </div>
    </form>
  </div>
</body>

</html>
