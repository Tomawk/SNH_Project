<?php
	session_start();
	require('inc/db.php');

	if(!isset($_SESSION['username'])){
	header('location: 404.php');
	}

    $stmt1 = mysqli_prepare($con,"SELECT * FROM users WHERE username = ?");
    $stmt1->bind_param("s", $_SESSION['username']);
    $stmt1->execute();
    $result= $stmt1->get_result(); //only one row
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
<html lang="eng">
	<head>
	<title>User information</title>
	<link href="CSS/info_style.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="immagini/key_icon.png" sizes="32x32">

    <!-- Font Awesome Import -->
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>
    <!-- Modal js include -->
    <script src="JS/modal.js" ></script>

	</head>
<body>
<?php include 'html/topnav.php';?>
	<div id="center_div">
		<div id="image">
			<img src="immagini/user.png" alt="avatar">
		</div>
		<p id= "username"><strong><?php echo $_SESSION['username']?></strong></p>
		<p id="storico"><strong>User from: </strong><?php echo $date ?></p>
		<p id= "name"><strong>Name: </strong><?php echo $nome ?></p>
		<p id= "cognome"><strong>Surname: </strong><?php echo $cognome ?></p>
		<p id= "email"><strong>Email: </strong><?php echo $email ?></p>
		<p id= "indirizzo"><strong>Address: </strong><?php echo $indirizzo ?></p>
		<p id= "citta"><strong>City: </strong><?php echo $citta ?></p>
		<p id= "cap"><strong>Postal Code: </strong><?php echo $cap ?></p>
		<p><a id="change_pwd" href="password_change.php">Change password</a></p>
<?php
include "html/modal_user.php";
?>
</body>
</html>