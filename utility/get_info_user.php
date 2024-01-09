<?php 

	session_start();
    require('../inc/db.php');
    if(!isset($_SERVER['HTTPS'])){
        header("HTTPS 404 nosecure");
        exit();
    }

    if(isset($_SESSION['username'])){
        
        $username= $_POST['username'];

        if($_SESSION['username'] !=  $username){
            header("index.php");
            exit();
        }

        $query = "SELECT * FROM users WHERE username = ? ";
    	$stmt = $con->prepare($query);
    	$stmt->bind_param("s",$_SESSION['username']);
    	$stmt->execute();
    	$row = $stmt->get_result();
        $result = mysqli_fetch_assoc($row);

        $array = $result['username']."|".$result['nome']."|".$result['cognome']."|".$result['email'];
        echo $array;
    }

	if(isset($_POST['link'])){
        
    }

?>