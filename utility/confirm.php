<?php
	session_start();
	require('../inc/db.php');

	function generateRandomNumber($con){ // Funzione per generare un id unico per idPizza
    $randomString = uniqid(rand());
    //Devo verificare che il codice non sia gia presente (affinche sia unico)
    $domanda = "SELECT * FROM ordini_log WHERE pizza='".$randomString."'";
    $risultato=mysqli_query($con,$domanda);
    $resultCount=mysqli_num_rows($risultato); // Conta i record

    $domanda2 = "SELECT * FROM pizzacustom_def WHERE idpizza='".$randomString."'";
    $risultato2=mysqli_query($con,$domanda2);
    $resultCount2=mysqli_num_rows($risultato2);

    $daily_date = date("Y-m-d"); // Data corrente

    if($resultCount>0 || $resultCount2>0){
        //Esiste già quell'id, richiama ricorsivamente la funzione
        return generateRandomNumber($con);
    }else{
        //Il codice è stato generato (è unico) e viene inserito
        mysqli_query($con,"INSERT INTO ordini_log (utente, pizza, data) VALUES ('".$_SESSION["username"]."','".$randomString."','".$daily_date."')");
        return $randomString;
    }
}
	$idpizza=generateRandomNumber($con); // Genero un nuovo idPizza e inserisco un record nella tabella ordini

	

	// Adesso inserisco nella tabella pizzacustom con l'id precedentemente creato
	mysqli_query($con,"INSERT INTO pizzacustom_log (idpizza, impasto, salsa, formaggio) VALUES ('".$idpizza."','".$_SESSION["impasto"]."','".$_SESSION["tomato"]."','".$_SESSION["cheese"]."')");
	unset($_SESSION['impasto']);
	unset($_SESSION['tomato']);
	unset($_SESSION['cheese']);

	/* Inserisco nella tabella ingredienti */
	if (isset($_SESSION["capperi"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Capperi"."','"."0.50"."')");
		unset($_SESSION['capperi']); //unset delle variabili session
	}
	if (isset($_SESSION["pomodorini"])){ 
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Pomodorini"."','"."0.50"."')");
		unset($_SESSION['pomodorini']);
	}
	if (isset($_SESSION["peperoni"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Peperoni"."','"."1.00"."')");
		unset($_SESSION['peperoni']);
	}
	if (isset($_SESSION["funghi"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Funghi"."','"."1.00"."')");
		unset($_SESSION['funghi']);
	}
	if (isset($_SESSION["rucola"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Rucola"."','"."0.50"."')");
		unset($_SESSION['rucola']);
	}
	if (isset($_SESSION["salamino"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Salamino"."','"."1.00"."')");
		unset($_SESSION['salamino']);
	}
	if (isset($_SESSION["patatine"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Patatine"."','"."1.00"."')");
		unset($_SESSION['patatine']);
	}
	if (isset($_SESSION["cipolla"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Cipolla"."','"."0.50"."')");
		unset($_SESSION['cipolla']);
	}
	if (isset($_SESSION["bacon"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Bacon"."','"."1.50"."')");
		unset($_SESSION['bacon']);
	}
	if (isset($_SESSION["acciughe"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Acciughe"."','"."1.50"."')");
		unset($_SESSION['acciughe']);
	}
	if (isset($_SESSION["pcotto"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Prosciutto Cotto"."','"."1.50"."')");
		unset($_SESSION['pcotto']);
	}
	if (isset($_SESSION["olive"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Olive"."','"."0.50"."')");
		unset($_SESSION['olive']);
	}
	if (isset($_SESSION["wurstel"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Wurstel"."','"."1.50"."')");
		unset($_SESSION['wurstel']);
	}
	if (isset($_SESSION["origano"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Origano"."','"."0.50"."')");
		unset($_SESSION['origano']);
	}
	if (isset($_SESSION["basilico"])){
		mysqli_query($con,"INSERT INTO ingredienti_log (pizza, ingrediente, costo) VALUES ('".$idpizza."','"."Basilico"."','"."0.50"."')");
		unset($_SESSION['basilico']);
	}

	/* BEVANDE */

	if (isset($_SESSION["acquanat"])){
		$totale = 0.50 * $_SESSION["q_acquanat"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Acqua Naturale"."','".$_SESSION["q_acquanat"]."','".$totale."')");
		unset($_SESSION['acquanat']);
		unset($_SESSION['q_acquanat']);
	}

	if (isset($_SESSION["acquafri"])){
		$totale = 0.50 * $_SESSION["q_acquafri"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Acqua Frizzante"."','".$_SESSION["q_acquafri"]."','".$totale."')");
		unset($_SESSION['acquafri']);
		unset($_SESSION['q_acquafri']);
	}

	if (isset($_SESSION["cola"])){
		$totale = 2.00 * $_SESSION["q_cola"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Coca Cola"."','".$_SESSION["q_cola"]."','".$totale."')");
		unset($_SESSION['cola']);
		unset($_SESSION['q_cola']);
	}

	if (isset($_SESSION["sprite"])){
		$totale = 2.00 * $_SESSION["q_sprite"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Sprite"."','".$_SESSION["q_sprite"]."','".$totale."')");
		unset($_SESSION['sprite']);
		unset($_SESSION['q_sprite']);
	}

	if (isset($_SESSION["estatepes"])){
		$totale = 1.50 * $_SESSION["q_estatepes"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Estathe Pesca"."','".$_SESSION["q_estatepes"]."','".$totale."')");
		unset($_SESSION['estatepes']);
		unset($_SESSION['q_estatepes']);
	}

	if (isset($_SESSION["estatelim"])){
		$totale = 1.50 * $_SESSION["q_estatelim"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Estathe Limone"."','".$_SESSION["q_estatelim"]."','".$totale."')");
		unset($_SESSION['estatelim']);
		unset($_SESSION['q_estatelim']);
	}

	if (isset($_SESSION["fanta"])){
		$totale = 2.00 * $_SESSION["q_fanta"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Fanta"."','".$_SESSION["q_fanta"]."','".$totale."')");
		unset($_SESSION['fanta']);
		unset($_SESSION['q_fanta']);
	}

	if (isset($_SESSION["7up"])){
		$totale = 2.00 * $_SESSION["q_7up"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."7Up"."','".$_SESSION["q_7up"]."','".$totale."')");
		unset($_SESSION['7up']);
		unset($_SESSION['q_7up']);
	}

	if (isset($_SESSION["heineken"])){
		$totale = 2.50 * $_SESSION["q_heineken"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Birra Heineken"."','".$_SESSION["q_heineken"]."','".$totale."')");
		unset($_SESSION['heineken']);
		unset($_SESSION['q_heineken']);
	}

	if (isset($_SESSION["corona"])){
		$totale = 2.50 * $_SESSION["q_corona"];
		mysqli_query($con,"INSERT INTO bevande_log(pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Birra Corona"."','".$_SESSION["q_corona"]."','".$totale."')");
		unset($_SESSION['corona']);
		unset($_SESSION['q_corona']);
	}

	if (isset($_SESSION["peroni"])){
		$totale = 2.50 * $_SESSION["q_peroni"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Birra Peroni"."','".$_SESSION["q_peroni"]."','".$totale."')");
		unset($_SESSION['peroni']);
		unset($_SESSION['q_peroni']);
	}

	if (isset($_SESSION["moretti"])){
		$totale = 2.50 * $_SESSION["q_moretti"];
		mysqli_query($con,"INSERT INTO bevande_log (pizza, bevanda, quantita, totale) VALUES ('".$idpizza."','"."Birra Moretti"."','".$_SESSION["q_moretti"]."','".$totale."')");
		unset($_SESSION['moretti']);
		unset($_SESSION['q_moretti']);
	}
	
	/* Aggiusto il totale (prezzo) della pizza inserita */

	/* Sommo il totale degli ingredienti e inserisco il valore nella variabile $sum */

	$query_somma1 = "SELECT SUM(costo) AS costo_sum FROM ingredienti_log WHERE pizza='".$idpizza."'";
	$result_somma1 = mysqli_query($con,$query_somma1); 
	$row = mysqli_fetch_assoc($result_somma1); 
	$sum = $row['costo_sum'];

	/* Sommo il totale delle bibite e le inserisco in $sum */

	$query_somma2 = "SELECT SUM(totale) AS costo_sum FROM bevande_log WHERE pizza='".$idpizza."'";
	$result_somma2 = mysqli_query($con,$query_somma2); 
	$row2 = mysqli_fetch_assoc($result_somma2); 

	$sum += $row2['costo_sum'];

	/* Gestisco il prezzo dell'impasto, salsa, formaggio */

	$query_custom= "SELECT * FROM pizzacustom_log WHERE idpizza='".$idpizza."'";
	$result_custom = mysqli_query($con,$query_custom); 
	$row3 = mysqli_fetch_assoc($result_custom); 

	if($row3['impasto'] == "Classico"){
		$sum += 3;
	}

	if($row3['impasto'] == "Integrale"){
		$sum += 4;
	}

	if($row3['impasto'] == "Senza Glutine"){
		$sum += 3;
	}

	if($row3['impasto'] == "Curcuma"){
		$sum += 3.5;
	}

	if($row3['impasto'] == "Grano Saraceno"){
		$sum += 3.5;
	}

	if($row3['salsa'] == "Pomodoro"){
		$sum += 1;
	}

	if($row3['formaggio'] == "Mozzarella"){
		$sum += 2;
	}

	if($row3['formaggio'] == "Bufala"){
		$sum += 3;
	}

	if($row3['formaggio'] == "Mozzarella (- grassi)"){
		$sum += 2.5;
	}

	/* Aggiorno */

	mysqli_query($con,"UPDATE ordini_log SET totale='".$sum."' WHERE pizza='".$idpizza."'");




	header("location: ../carrello.php"); //reindirizzo al carrello


?>