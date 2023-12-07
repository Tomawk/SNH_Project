<?php
    // Connect to your database (replace these values with your actual database credentials)
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "fastpizza";

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(!isset($_POST["username"]) || !isset($_POST["old_password"])  || !isset($_POST["new_password"]) ){
        echo "some field are missing";
    }

    $username = $_POST["username"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    $sql = "SELECT * FROM users where username = ? and password = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$username,hash('sha256', $old_password));
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //user present
        $sql = "UPDATE `users` SET `password` = ? WHERE `users`.`id` = ?";
        $stmt = $conn->prepare($sql);
        $row = $result->fetch_assoc();
        $stmt->bind_param("si",hash('sha256',$new_password), $row["id"]);
        $stmt->execute();
        echo "done";
    }else{
        //TODO: handle
        //user not present
        echo "error";
    }