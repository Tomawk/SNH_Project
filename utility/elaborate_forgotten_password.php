<?php
    session_start();
    require('../inc/db.php');
    require('../forMail/mail.php');

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
        echo 0;
        die("Connection failed: " . $con->connect_error);
       return;
    }
    if(!isset($_POST['username']) or !isset($_POST['email'])){
        //"usaname or email not present";
        echo 0;
        return;
    }else{
        
        $sql = "SELECT * FROM users Where username = ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //send an email with che password

            if($row['email'] != $_POST['email']){
                echo 0;
                return;
            }

            //create new password
            $password = randomPassword();
            
            $sql = "UPDATE users SET password = ? WHERE id = ? ";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("si",hash('md5', $password),$row["id"]);
            $stmt->execute();

            //send the email
            sendMail($password,$row['email'],"Your new password is: ",'Password changing');

            echo 1;
            //echo "password sent";
        }else{
            echo 0;
        }
}

?>
