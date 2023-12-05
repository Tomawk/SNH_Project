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

    // Perform a database query (replace this query with your actual query)
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data from the query
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Name: " . $row["nome"] . "<br>";
        }
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
?>