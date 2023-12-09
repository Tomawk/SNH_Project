<?php 

	session_start();
    require('../inc/db.php');

	$id = $_POST['id'];
	$ISBN = $_POST['ISBN'];
	
	$query = "SELECT * FROM ContenutoOrdini WHERE id = '".$id."' and ISBN = '".$ISBN."'";
	$result = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);

	if($row['numero_item'] == 1){
		//controllo quanti elementi contiene il carrello
		$query = "SELECT * FROM ContenutoOrdini WHERE id = '".$id."'";
		$result=mysqli_query($con,$query);
    	$elimina_corrello=mysqli_num_rows($result); 


		//elemino elemento
		$query = "DELETE FROM ContenutoOrdini WHERE id = '".$id."' and ISBN = '".$ISBN."';";
		$result=mysqli_query($con,$query);

		if($elimina_corrello == 1){
			//resta solo un elemento nel carrello allora elimino il carrello
			//Elimino carrello
			$query = "DELETE FROM ordini WHERE id = '".$id."';";
			$result=mysqli_query($con,$query);
		}
	
	}
	else{
		//faccio update
		$query = "UPDATE `ContenutoOrdini` SET `numero_item` = '".(floatval($row['numero_item'])-1)."' 
                WHERE `ContenutoOrdini`.`ISBN` = '".$ISBN."'
                AND   `ContenutoOrdini`.`username` = '".$row['username']."' 
                AND   `ContenutoOrdini`.`id` = '".$id."';";

        $result=mysqli_query($con,$query);
	}

	header('location: ../carrello.php');

?> 