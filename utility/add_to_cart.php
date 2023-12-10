<?php
    session_start();
    require('../inc/db.php');


    $ISBN = $_POST["ISBN"];;
    $username = $_POST["username"];

    if($username != $_SESSION["username"]){
        //qui un qualcuno ha modificato i dati del form cercando di modificare dati che non appertengono a lui
        echo 0;
        exit();
    }

    $query = "SELECT * FROM ordini where stato_ordine is null";
    $result=mysqli_query($con,$query);
    $resultCount=mysqli_num_rows($result);
    
    
    if($resultCount == 0){
        //carrello vuoto
        $timestamp = time(); 
        $currentDate = gmdate('Y-m-d', $timestamp);
        $query =  "INSERT INTO `ordini` (`id`, `data`, `totale`, `stato_ordine`) 
                VALUES (NULL, '".$currentDate."', '0', NULL)";
        $result=mysqli_query($con,$query);

       
        //get the id
        $query = "SELECT id from `ordini` order by id DESC limit 1";
        $result=mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];

        //insert the item
        $query = "INSERT INTO `ContenutoOrdini` (`ISBN`, `username`, `id`, `numero_item`) 
            VALUES ( ?, ?, ?, 1)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssi",$ISBN,$username,$id);
        $stmt->execute();

        echo 1;
    }
    else{
        //il carrello contiene già qualcosa
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];

        //controllo se li libro è gia presente
        $query = $query = "SELECT numero_item FROM ContenutoOrdini WHERE ISBN = ? and id = ? ";
        $stmt = $con->prepare($query);
        $stmt->bind_param("si",$ISBN,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $resultCount=mysqli_num_rows($result);


        if($resultCount == 0){
            //il libro non è presente
            $query = "INSERT INTO `ContenutoOrdini` (`ISBN`, `username`, `id`, `numero_item`) 
                VALUES ( ?, ?, ?, 1)";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssi",$ISBN,$username,$id);
            $stmt->execute();

        }
        else{
            $row = mysqli_fetch_assoc($result);
            //il libro è già presente
            
            $query = "UPDATE `ContenutoOrdini` SET `numero_item` = '".(floatval($row['numero_item'])+1)."' 
                WHERE `ContenutoOrdini`.`ISBN` = ? 
                AND   `ContenutoOrdini`.`username` = ?  
                AND   `ContenutoOrdini`.`id` = ? ;";

            $stmt = $con->prepare($query);
            $stmt->bind_param("ssi",$ISBN,$username,$id);
            $stmt->execute();

        }
        echo 1;
    }
?>