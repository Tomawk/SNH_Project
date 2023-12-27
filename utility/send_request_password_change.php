<?php
    session_start();
    require('../inc/db.php');
    require('../forMail/mail.php');

    // Check connection
    if ($con->connect_error) {
        echo 0;
        die("Connection failed: " . $con->connect_error);
       return;
    }
    
    if(!isset($_POST['email']) || !isset($_POST['username'])){
        //"username or email not present";
        echo 0;
        return;
    }else{

        $sql = "SELECT * FROM users Where email = ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$_POST['email']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //send an email with che password

            

            if($row['username'] != $_POST['username']){
                //username wrong
                echo 0;
                return;
            }

            $rand = bin2hex(random_bytes('16'));
            $time = time();

            
            //insert link into the db
            $sql = "UPDATE `users` SET `link` = ?, `timestamp` = ? WHERE `users`.`id` = ? ";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssi",$rand,$time,$row['id']);
            $stmt->execute();

            $link = "http://localhost/BookStore/SNH_Project/dynamic_change_password.php?link=".$rand;
            
            
            //send the email
            sendMail($link,$row['email'],"Your link to change the password is: ","Password recovery");

            echo 1;
            //echo "password sent";
        }else{
            echo 0;
        }
}

?>