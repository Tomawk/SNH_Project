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

    if($_SERVER['SERVER_PORT'] !== 443 &&
        (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')) {
         header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); //with this you force https
        echo "niente";
    }else  echo "ciao"
?>