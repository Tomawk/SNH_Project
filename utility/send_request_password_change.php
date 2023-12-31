<?php
    session_start();
    require('../inc/db.php');
    require('../forMail/mail.php');
    require('hashing_psw.php');
    require('log.php');
if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

    // Check connection
    if ($con->connect_error) {
        echo 0;
        die("Connection failed: " . $con->connect_error);
    }
    
    if(!isset($_POST['email']) || !isset($_POST['username'])){
        //"username or email not present";
        echo 0;
    }else {

        $email = $_POST['email'];
        $username = $_POST['username'];

        // CLEAR + SANITIZE

        $email = trim($email); //Remove whitespaces
        $email = stripcslashes($email);
        $email = htmlspecialchars($email); //Convert special characters to HTML entities
        $email = mysqli_real_escape_string($con, $email); //SQL Injection prevention


        $username = trim($username); //Remove whitespaces
        $username = stripcslashes($username);
        $username = htmlspecialchars($username); //Convert special characters to HTML entities
        $username = mysqli_real_escape_string($con, $username); //SQL Injection prevention

        // VALIDATION

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 0;
        } else if (strlen($username) < 2 || strlen($username) > 10 || !preg_match('/^[a-zA-Z0-9!?£$èòàù_.,]+$/', $username)) {
            echo 0;
        } else {

            $sql = "SELECT * FROM users Where email = ? ";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                //send an email with che password


                if (strcasecmp($row['username'], $username) != 0 ) {
                    //username wrong
                    $log_msg = "EMAIL PASSWORD RECOVERY FAILED USERNAME NON VALID: email: ". $email . " username: " .$username ;
                    log_message($log_msg);
                    echo 0;
                    return;
                }

                $rand = bin2hex(random_bytes('16'));
                $time = time();

                // Hashing and salting rand

                $salt = create_salt();
                $hashed_link = hash('sha256',$rand);
                $final_link= hash('sha256', $salt . $hashed_link); //hashed psw with hash


                //insert link into the db
                $sql = "UPDATE `users` SET `link` = ?, `link_salt` = ?, `timestamp` = ? WHERE `users`.`id` = ? ";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("sssi", $final_link, $salt, $time, $row['id']);
                $stmt->execute();

                $link = "https://localhost/SNH_Project/dynamic_change_password.php?userid=". $row['id'] ."&link=" . $rand;

                //send the email
                sendMail($link, $row['email'], "Your link (will expire in 5 minutes) to change the password is: ", "Password recovery");

                $log_msg = "EMAIL PASSWORD RECOVERY CORRECTLY SENT: email: ".$email." username: ".$username;
                log_message($log_msg);

                echo 1;
                //echo "password sent";
            } else {

                $log_msg = "EMAIL PASSWORD RECOVERY FAILED INVALID EMAIL: email: ". $email;
                log_message($log_msg);
                echo 0;
            }
        }

    }

?>
