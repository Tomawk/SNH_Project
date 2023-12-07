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

    //$sql = "SELECT * FROM users";
    //$result = $conn->query($sql);

    $sql = "";
    $search_field = $_POST['Search_filed'];
    if($search_field == "none"){
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
    }
    else{
        $value = $_POST['Value'];
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $where_condition = "1";
        $stmt->bind_param("s",$where_condition);
        
    }
    
    

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output data from the query
        while ($row = $result->fetch_assoc()) {
            //echo "ID: " . $row["id"] . " - Name: " . $row["nome"] . " <br> ";
            echo "
                <div class='product'>
                    <img src='http://images.amazon.com/images/P/0195153448.01.THUMBZZZ.jpg' alt='Immagine scarpe'>
                    <h2>".$row["id"]."</h2>
                    <p>Descrizione breve del prodotto. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>".$row["nome"]."</p>
                    <p>".$row["email"]."</p>
                    <button type='button'>Aggiungi al Carrello</button>
                </div>
            ";
        }
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
?>