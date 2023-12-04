<?php 

	session_start();
    require('../inc/db.php');

	$query = "SELECT * FROM ordini_log WHERE utente ='".$_SESSION['username']."'";
	$result=mysqli_query($con,$query);
    $resultCount=mysqli_num_rows($result);

    $rows_ordini = array();

	while($row = mysqli_fetch_assoc($result)){
    $rows_ordini[] = $row;
   	}



   	for($i = 0; $i<$resultCount; $i++){
		if(isset($_POST[$rows_ordini[$i]['pizza']])) {
			mysqli_query($con,"DELETE FROM ordini_log WHERE pizza='".$rows_ordini[$i]['pizza']."'");
			mysqli_query($con,"DELETE FROM ingredienti_log WHERE pizza='".$rows_ordini[$i]['pizza']."'");
			mysqli_query($con,"DELETE FROM bevande_log WHERE pizza='".$rows_ordini[$i]['pizza']."'");
			mysqli_query($con,"DELETE FROM pizzacustom_log WHERE idpizza='".$rows_ordini[$i]['pizza']."'");

		}

	}

	header('location: ../carrello.php')


?> 