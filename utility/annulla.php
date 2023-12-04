<?php	

	/* UNSET DELLE VARIABILI SESSION SETTATE IN TEST.PHP */

	unset($_SESSION['impasto']);
	unset($_SESSION['tomato']);
	unset($_SESSION['cheese']);

	/* UNSET INGREDIENTI */

	if (isset($_SESSION["capperi"])){
		unset($_SESSION['capperi']); 
	}
	if (isset($_SESSION["pomodorini"])){ 
		unset($_SESSION['pomodorini']);
	}
	if (isset($_SESSION["peperoni"])){
		unset($_SESSION['peperoni']);
	}
	if (isset($_SESSION["funghi"])){
		unset($_SESSION['funghi']);
	}
	if (isset($_SESSION["rucola"])){
		unset($_SESSION['rucola']);
	}
	if (isset($_SESSION["salamino"])){
		unset($_SESSION['salamino']);
	}
	if (isset($_SESSION["patatine"])){
		unset($_SESSION['patatine']);
	}
	if (isset($_SESSION["cipolla"])){
		unset($_SESSION['cipolla']);
	}
	if (isset($_SESSION["bacon"])){
		unset($_SESSION['bacon']);
	}
	if (isset($_SESSION["acciughe"])){
		unset($_SESSION['acciughe']);
	}
	if (isset($_SESSION["pcotto"])){
		unset($_SESSION['pcotto']);
	}
	if (isset($_SESSION["olive"])){
		unset($_SESSION['olive']);
	}
	if (isset($_SESSION["wurstel"])){
		unset($_SESSION['wurstel']);
	}
	if (isset($_SESSION["origano"])){
		unset($_SESSION['origano']);
	}
	if (isset($_SESSION["basilico"])){
		unset($_SESSION['basilico']);
	}

	/* UNSET BEVANDE */

	if (isset($_SESSION["acquanat"])){
		unset($_SESSION['acquanat']);
		unset($_SESSION['q_acquanat']);
	}

	if (isset($_SESSION["acquafri"])){
		unset($_SESSION['acquafri']);
		unset($_SESSION['q_acquafri']);
	}

	if (isset($_SESSION["cola"])){
		unset($_SESSION['cola']);
		unset($_SESSION['q_cola']);
	}

	if (isset($_SESSION["sprite"])){
		unset($_SESSION['sprite']);
		unset($_SESSION['q_sprite']);
	}

	if (isset($_SESSION["estatepes"])){
		unset($_SESSION['estatepes']);
		unset($_SESSION['q_estatepes']);
	}

	if (isset($_SESSION["estatelim"])){
		unset($_SESSION['estatelim']);
		unset($_SESSION['q_estatelim']);
	}

	if (isset($_SESSION["fanta"])){
		unset($_SESSION['fanta']);
		unset($_SESSION['q_fanta']);
	}

	if (isset($_SESSION["7up"])){
		unset($_SESSION['7up']);
		unset($_SESSION['q_7up']);
	}

	if (isset($_SESSION["heineken"])){
		unset($_SESSION['heineken']);
		unset($_SESSION['q_heineken']);
	}

	if (isset($_SESSION["corona"])){
		unset($_SESSION['corona']);
		unset($_SESSION['q_corona']);
	}

	if (isset($_SESSION["peroni"])){
		unset($_SESSION['peroni']);
		unset($_SESSION['q_peroni']);
	}

	if (isset($_SESSION["moretti"])){
		unset($_SESSION['moretti']);
		unset($_SESSION['q_moretti']);
	}

  /* Reindizirramento a creation.php */

  header('location: ../creation.php');

?>