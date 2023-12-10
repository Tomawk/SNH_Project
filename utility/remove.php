<?php 

	session_start();
    require('../inc/db.php');


	$id = $_POST['id'];
	$ISBN = $_POST['ISBN'];

	if(isset($_SESSION['not_logged_in']) and !isset($_SESSION['username'])){
		//utente non loggato -> rimuovi elemento
		if (($key = array_search($ISBN, $_SESSION['not_logged_in'])) !== false) {
			unset($_SESSION['not_logged_in'][$key]);
		}
		header('location: ../carrello.php');
		exit();
	}

	if(!isset($_SESSION['username'])){
		header('location: ../carrello.php');
		exit();
	}

	$query = $query = "SELECT * FROM ContenutoOrdini WHERE ISBN = ? and id = ? ";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si",$ISBN,$id);
    $stmt->execute();
    $result = $stmt->get_result();
	$row = mysqli_fetch_assoc($result);

	if($_SESSION['username'] != $row['username']){
		//qui un qualcuno ha modificato i dati del form cercando di modificare dati che non appertengono a lui
		echo "Per favore, rispova. Qualcosa è andato storto";
		exit();
	}

	if($row['numero_item'] == 1){
		//controllo quanti elementi contiene il carrello

		$query = $query = "SELECT * FROM ContenutoOrdini WHERE id = ? ";
    	$stmt = $con->prepare($query);
    	$stmt->bind_param("i",$id);
    	$stmt->execute();
    	$result = $stmt->get_result();
		$elimina_corrello=mysqli_num_rows($result); 

		//elemino elemento
		$query = $query = "DELETE FROM ContenutoOrdini WHERE ISBN = ? and id = ? ";
    	$stmt = $con->prepare($query);
   		$stmt->bind_param("si",$ISBN,$id);
    	$stmt->execute();


		if($elimina_corrello == 1){
			//resta solo un elemento nel carrello allora elimino il carrello
			//Elimino carrello

			$query = "DELETE FROM ordini WHERE id = ? ";
    		$stmt = $con->prepare($query);
   			$stmt->bind_param("i",$id);
    		$stmt->execute();
		}

	}
	else{
		//faccio update
		$query = "UPDATE `ContenutoOrdini` SET `numero_item` = '".(floatval($row['numero_item'])-1)."'  
                WHERE `ContenutoOrdini`.`ISBN` = ? 
                AND   `ContenutoOrdini`.`username` = ? 
                AND   `ContenutoOrdini`.`id` = ? ";

        $stmt = $con->prepare($query);
        $stmt->bind_param("ssi",$ISBN,$_SESSION['username'],$id);
		
        $stmt->execute(); 

	}

	header('location: ../carrello.php');
?> 