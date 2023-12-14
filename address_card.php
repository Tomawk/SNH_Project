<?php
  $id_ordine = $_POST['checkout'];
  session_start();
  require('inc/db.php');
  require('utility/sessionManager.php');
  checkSession($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Address and Credit Card Info</title>
  <link href="CSS/address_card.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="container">
    <h1>Enter Address and Credit Card Info</h1>
    <label for="order id">Order id: </label><?php echo $id_ordine ?>
    <br>
    <br>
    <form action="#">
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
          <input type="date" id="expiration" name="expiration" placeholder="MM/YY" required >
        </div>
        <div>
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" placeholder="000" required oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" maxlength="3">
        </div>
      </div>

      <div id="button">
        <input type="button" value="Back" onclick="location.href = 'carrello.php';">
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
</body>

</body>
</html>


