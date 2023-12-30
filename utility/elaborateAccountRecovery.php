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
        //"username or email not present";
        echo 0;
        return;
    }else{

        $email = $_POST['email'];

        // CLEAR + SANITIZE
        $email = trim($email); //Remove whitespaces
        $email = stripcslashes($email);
        $email = htmlspecialchars($email); //Convert special characters to HTML entities
        $email = mysqli_real_escape_string($con,$email); //SQL Injection prevention

        // VALIDATION

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            echo 0;
        } else {

            //VALIDATION SUCCEED

            $sql = "SELECT * FROM users Where email = ? ";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s",$_POST['email']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                //send an email with che password

                //send the email
                sendMail($row['username'],$row['email'],"Your username is: ","Account recovery");

                echo 1;
            }else{
                echo 0;
            }
        }
        

}

?>
