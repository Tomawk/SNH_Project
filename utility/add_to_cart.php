<?php
    session_start();
    require('../inc/db.php');
    require("insert_function.php");


    $ISBN = $_POST["ISBN"];
    $username = $_POST["username"];


    if(isset($_SESSION['not_logged_in']) and !isset($_SESSION["username"])){
        //l'utente non è loggato -> salvo le info del carrello in una variabile di sessione
        array_push($_SESSION['not_logged_in'],$ISBN);
        echo 1;
        exit();
    }

    if(!isset($_SESSION["username"])){
        echo 0;
        exit();
    }

    if($username != $_SESSION["username"]){
        //qui un qualcuno ha modificato i dati del form cercando di modificare dati che non appertengono a lui
        echo 0;
        exit();
    }

    insert_book($ISBN,$username,$con);
?>
