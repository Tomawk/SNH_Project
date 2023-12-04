<?php
    session_start();
    require('../inc/db.php');

    function generateRandomNumber($con){ // genero un codice ordine unico
     $randomString = uniqid(rand());
    //Devo verificare che il codice non sia gia presente (affinche sia unico)
      $domanda = "SELECT * FROM ordini_def WHERE codordine='".$randomString."'";
      $risultato=mysqli_query($con,$domanda);
      $resultCount=mysqli_num_rows($risultato); // Conta i record
      $daily_date = date("Y-m-d"); // Data corrente

     if($resultCount>0){
            //Esiste già quell'id, richiama ricorsivamente la funzione
         return generateRandomNumber($con);
     }else{
         //Il codice è stato generato (è unico) e viene inserito
            mysqli_query($con,"INSERT INTO ordini_def (codordine, utente, totale_ordine, data_pagamento) VALUES ('".$randomString."','".$_SESSION["username"]."','".$_SESSION["totale"].
                "','".$daily_date."')");
            return $randomString;
        }
    }


    $idordine = generateRandomNumber($con);
    unset($_SESSION["totale"]); /* Unset del totale */

    $query = "SELECT * FROM ordini_log WHERE utente='".$_SESSION['username']."'";
    $result=mysqli_query($con,$query);
    $resultCount=mysqli_num_rows($result);

    $rows_ordini = array();
        while($row = mysqli_fetch_assoc($result)){
        $rows_ordini[] = $row;
    }


    for($i = 0; $i<$resultCount; $i++){

        /* INSERIMENTO DALLA TABELLA LOG INGREDIENTI A QUELLA DEFINITIVA */
        $query2 = "SELECT * FROM ingredienti_log WHERE pizza='".$rows_ordini[$i]['pizza']."'";
        $result2=mysqli_query($con,$query2);
        $resultCount2=mysqli_num_rows($result2); // Totale righe tabella log ingredienti
        $rows_ingredienti = array();
        while($row2 = mysqli_fetch_assoc($result2)){
        $rows_ingredienti[] = $row2;
        }

        $counter_ingredients = 0; /* Contatore row tabella log ingredienti */

        while($counter_ingredients < $resultCount2){

            mysqli_query($con,"INSERT INTO ingredienti_def (pizza, ingrediente, costo) VALUES ('".$rows_ordini[$i]['pizza']."','".$rows_ingredienti[$counter_ingredients]['ingrediente']."','".$rows_ingredienti[$counter_ingredients]['costo']."')");

            $counter_ingredients++;
        }

         /* SVUOTO LOG INGREDIENTI */
         mysqli_query($con,"DELETE FROM ingredienti_log WHERE pizza='".$rows_ordini[$i]['pizza']."'");

        /* INSERIMENTO DALLA TABELLA LOG PIZZACUSTOM A QUELLA DEFINITIVA */
        $query3 = "SELECT * FROM pizzacustom_log WHERE idpizza='".$rows_ordini[$i]['pizza']."'";
        $result3=mysqli_query($con,$query3);
        $row3 = mysqli_fetch_assoc($result3);
        mysqli_query($con,"INSERT INTO pizzacustom_def (codordine, idpizza, impasto, salsa, formaggio, costo) VALUES ('".$idordine."','".$rows_ordini[$i]['pizza']."','".$row3['impasto']."','".$row3['salsa']."','".$row3['formaggio']."','".$rows_ordini[$i]['totale']."')");

        /* SVUOTO LOG INGREDIENTI */
         mysqli_query($con,"DELETE FROM pizzacustom_log WHERE idpizza='".$rows_ordini[$i]['pizza']."'");

        /* INSERIMENTO DALLA TABELLA LOG DELLE BEVANDE A QUELLA DEFINITIVA */

        $query4 = "SELECT * FROM bevande_log WHERE pizza='".$rows_ordini[$i]['pizza']."'";
        $result4=mysqli_query($con,$query4);
        $resultCount4=mysqli_num_rows($result4);
        $rows_bibite = array();
        while($row4 = mysqli_fetch_assoc($result4)){
        $rows_bibite[] = $row4;
        }

        $counter_drinks = 0; /* Contatore row tabella log bevande */

         while($counter_drinks < $resultCount4){

            mysqli_query($con,"INSERT INTO bevande_def (pizza, bevanda, quantita, totale) VALUES ('".$rows_ordini[$i]['pizza']."','".$rows_bibite[$counter_drinks]['bevanda']."','".
                $rows_bibite[$counter_drinks]['quantita']."','".$rows_bibite[$counter_drinks]['totale']."')");

            $counter_drinks++;
        }

        /* SVUOTO LOG BEVANDE */
         mysqli_query($con,"DELETE FROM bevande_log WHERE pizza='".$rows_ordini[$i]['pizza']."'");

    }

    /* SVUOTO LOG ORDINI */

    mysqli_query($con,"DELETE FROM ordini_log WHERE utente='".$_SESSION['username']."'");


    /* Reindirizzamento a success.php */

    header('location: ../successo.php ')

    ?>