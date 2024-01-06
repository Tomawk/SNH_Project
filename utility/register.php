<?php
require('../inc/db.php');
require("hashing_psw.php");

// If form submitted, insert values into the database.
session_start();
if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

//*+++++++++++++++++++++++++++++
//*+++++++++++++++++++++++++++++
//*+++++++++++++++++++++++++++++
//aggiungere contatore per evitare brute force attack
//*+++++++++++++++++++++++++++++
//*+++++++++++++++++++++++++++++
//*+++++++++++++++++++++++++++++


    //REDIRECT FUNCTION
    function redirect(){
        if(isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']); // SAFE (?)
        }
        else
        {
            header("location: ../index.php");
        }
    }

    //SANITIZE AND CLEAN INPUT DATA
    function test_input($data,$con) {
     $data = trim($data); //Remove whitespaces
     $data = stripcslashes($data);
     $data = htmlspecialchars($data); //Convert special characters to HTML entities
     $data = mysqli_real_escape_string($con,$data); //SQL Injection prevention
     return $data;
    }

    // SERVER SIDE VALIDATION

    $error = NULL;

    //EMAIL VALIDATION

    if (empty($_POST["email"])) { /* Email empty */
        $emailErr = "Insert an email";
        $error = 1;
    } else {
        $email = test_input($_POST["email"],$con);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $error= 1;
        }

        $stmt = $con->prepare("SELECT* FROM users WHERE email= ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result_email = $stmt->get_result();
        $result_emailCount=mysqli_num_rows($result_email);

        if ($result_emailCount  > 0){
            $emailErr = "Username or email is already in use."; //The error messages should not give any hints to users
            $error = 1;
        }
  }

    if(isset($emailErr)){
        $_SESSION['emailErr']= $emailErr;
    }

    //NAME VALIDATION
    if (empty($_POST["name"])) { /* Name empty */
        $nameErr = "Insert a name.";
        $error = 1;
        }
        else{

          $name = test_input($_POST["name"],$con);

          if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Name can contain only alphabetic chars";
            $error = 1;
          }
          elseif (strlen($name) < 2) {
              $nameErr = "Name is too short";
              $error = 1;
          }
          elseif (strlen($name) > 10) {
              $nameErr = "Name is too Long";
              $error = 1;
          }
        }

     if(isset($nameErr)){
        $_SESSION['nameErr']= $nameErr;
    }

     //SURNAME
    if (empty($_POST["surname"])) {  /* Surname empty */
        $surnameErr = "Insert the surname.";
        $error = 1;
        }
        else{

          $surname = test_input($_POST["surname"],$con);

          if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
            $surnameErr = "Surname can contain only alphabetic chars";
            $error = 1;
          }
          elseif (strlen($surname) < 2) {
              $nameErr = "Surname is too short";
              $error = 1;
          }
          elseif (strlen($surname) > 10) {
              $nameErr = "Surname is too Long";
              $error = 1;
          }
        }

    if(isset($surnameErr)){
        $_SESSION['surnameErr']= $surnameErr;
    }

    //USERNAME VALIDATION

    if (empty($_POST["uname"])) { /* Username empty */
        $usernameErr = "Insert an username";
        }
        else{
          $username = test_input($_POST['uname'],$con);

          if(strlen($username) < 2){
              $usernameErr = "Username is too short";
              $error=1;
          } elseif (strlen($username) > 10){
              $usernameErr = "Username is too long";
              $error=1;
          } elseif (!preg_match('/^[a-zA-Z0-9!?£$èòàù_.,]+$/', $username)) { // only a selection of special characters allowed
              $usernameErr = "Username is not supported, retry.";
              $error=1;
          } else {
              $stmt_user = $con->prepare("SELECT* FROM users WHERE username= ?");
              $stmt_user->bind_param("s",$username);
              $stmt_user->execute();
              $result_user = $stmt_user->get_result();
              $result_userCount=mysqli_num_rows($result_user);

              if($result_userCount > 0){
                  $usernameErr=  "Username or email is already in use."; //The error messages should not give any hints to users
                  $error = 1;
              }
          }
    }


    if(isset($usernameErr)){
        $_SESSION['usernameErr']= $usernameErr;
    }

    //PASSWORD VALIDATION

    if (empty($_POST["psw"])) { /* Password empty*/
        $pswErr = "Insert a password";
    }
        else{
            $psw_clear = $_POST['psw'];
            if (strlen($psw_clear) <= 7 || strlen($psw_clear) > 255) {
            $pswErr = "Password is too long or too short";
            $error = 1;
            }
            elseif (!preg_match("#[0-9]+#",$psw_clear)) {
                $pswErr = "Password should contain at least a number";
                $error = 1;
            }
            elseif(!preg_match("#[A-Z]+#",$psw_clear)) {
                $pswErr = "Password should contain at least one uppercase char";
                $error = 1;
            }
            elseif(!preg_match("#[a-z]+#",$psw_clear)) {
                $pswErr = "Password should contain at least one lowercase char";
                $error = 1;
            }
          
        }

    if(isset($pswErr)){
        $_SESSION['pswErr']= $pswErr;
    }

    //PASSWORD REPEAT VALIDATION
    if (empty($_POST["psw-repeat"])) { /* Password repeat empty */
        $psw_repeatErr = "Repeat your password.";
        $error = 1;
        }
        else{
            $psw_repeat = test_input($_POST['psw-repeat'],$con);
            if($psw_clear != $psw_repeat){
                $psw_repeatErr = "Password mismatch.";
                $error = 1;
            } 
        }

    if(isset($psw_repeatErr)){
        $_SESSION['psw_repeatErr']= $psw_repeatErr;
    }

    //CITY VALIDATION
    if (empty($_POST["city"])) { /* Citta */
        $cityErr = "Insert a city";
        $error = 1;
        }
        else{
          $city = test_input($_POST['city'],$con);
          if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
            $cityErr = "City can contain only alphabetic chars";
            $error = 1;
          }
        }

    if(isset($cityErr)){
        $_SESSION['cittaErr']= $cityErr;
    }

    //ADDRESS VALIDATION
//************************* MANCA CONTROLLO SULL'USO DI SPECIAL CHAR E SIMILI *********************
    if (empty($_POST["address"])) { /* Address empty */
        $addressErr = "Insert an address";
        $error = 1;
        }
        else{
          $address = test_input($_POST['address'],$con);
    }

    if(isset($addressErr)){
        $_SESSION['addressErr']= $addressErr;
    }


    if (empty($_POST["cap"])) { /* CAP */
        $capErr = "Insert the postal code";
        $error= 1;
        }
        else{
          $cap = test_input($_POST['cap'],$con);
          if (!preg_match("/^\d{5}$/",$cap)) {
            $capErr = "Invalid postal code";
            $error = 1;
          }
        }

    if(isset($capErr)){
        $_SESSION['capErr']= $capErr;
    }

	$trn_date = date("Y-m-d");

    if($error == NULL){

        $hashed_psw = hash_psw($psw_clear);
        $salt = create_salt();

        $psw = hash('sha256', $salt . $hashed_psw); //hashed psw with hash

        $stmt_final = $con->prepare("INSERT into users (email, nome, cognome, username, password, salt, citta, indirizzo, cap, trn_date)
        VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt_final->bind_param("ssssssssss",$email, $name, $surname, $username, $psw, $salt, $city, $address, $cap, $trn_date);
        $stmt_final->execute();

        $result = $stmt_final->get_result();

        $_SESSION['username'] = $username;

        redirect();

    } else {
        $_SESSION["signup_error"] = "error";
        redirect();
    }

?>