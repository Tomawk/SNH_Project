<?php
    session_start();
    require('../inc/db.php');
    require('../forMail/mail.php');
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
                    echo 0;
                    return;
                }

                $rand = bin2hex(random_bytes('16'));
                $time = time();


                //insert link into the db
                $sql = "UPDATE `users` SET `link` = ?, `timestamp` = ? WHERE `users`.`id` = ? ";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssi", $rand, $time, $row['id']);
                $stmt->execute();

                $link = "https://localhost/SNH_Project/dynamic_change_password.php?link=" . $rand;


                //send the email
                sendMail($link, $row['email'], "Your link to change the password is: ", "Password recovery");

                echo 1;
                //echo "password sent";
            } else {
                echo 0;
            }
        }

    }

?>
