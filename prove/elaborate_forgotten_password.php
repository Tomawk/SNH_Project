<?php
    // Connect to your database (replace these values with your actual database credentials)
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "fastpizza";

    $conn = new mysqli($host, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(!isset($_POST['username'])){
        echo "usaname not present";
    }else{
        $sql = "SELECT * FROM users Where username = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //send an email with che password

            //create new password
            $password = randomPassword();
            
            //echo "the password is this -> ".$password."\n";
            //save the new password into the db
            $sql = "UPDATE users SET password = ? WHERE id = ? ";
            $stmt = $conn->prepare($sql);
            echo "1";
            $stmt->bind_param("si",hash('sha256', $password),$row["id"]);
            echo "3";
            $stmt->execute();
            echo "4";
            
            //send the email
            $to      = $row['email'];
            $subject = 'Password recovery';
            $message = $password;
            $headers = 'From: a.nigro8@studenti.unipi.it'       . "\r\n" .
                    'Reply-To: ciao.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            echo mail($to, $subject, $message, $headers);

            echo " | mail sent";
            //echo "password sent";
        }else{
            echo "no user with that username";
        }
}

?>