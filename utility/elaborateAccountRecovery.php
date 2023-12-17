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
    if(!isset($_POST['email'])){
        //"usaname or email not present";
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

            //send the email
            sendMailAccountRecovery($row['email'],$row['username']);

            echo 1;
            //echo "password sent";
        }else{
            echo 0;
        }
}

?>
