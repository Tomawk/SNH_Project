<?php
    session_start();
    require('../inc/db.php');

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
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    if(!isset($_POST['username'])){
        echo "usaname not present";
    }else{
        $sql = "SELECT * FROM users Where username = ? ";
        $stmt = $con->prepare($sql);
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
            $stmt = $con->prepare($sql);
            $stmt->bind_param("si",hash('md5', $password),$row["id"]);
            $stmt->execute();
            //send the email
            $to      = $row['email'];
            $subject = 'Password recovery';
            $message = $password;
            $headers = 'From: INSERIRE QUI LA PROPRIA EMAIL'       . "\r\n" .
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