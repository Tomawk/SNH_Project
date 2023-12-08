<?php
    // Connect to your database (replace these values with your actual database credentials)
       
    session_start();
    require('../inc/db.php');

    if(!isset($_POST["username"]) || !isset($_POST["old_password"])  || !isset($_POST["new_password"]) ){
        echo "some field are missing";
    }

    $username = $_POST["username"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    $sql = "SELECT * FROM users where username = ? and password = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss",$username,hash('md5', $old_password));
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //user present
        $sql = "UPDATE `users` SET `password` = ? WHERE `users`.`id` = ?";
        $stmt = $con->prepare($sql);
        $row = $result->fetch_assoc();
        $stmt->bind_param("si",hash('md5',$new_password), $row["id"]);
        $stmt->execute();
        echo "Password correctly changed";
    }else{
        echo "Error: retry";
    }