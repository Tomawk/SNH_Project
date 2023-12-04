<?php
require('../inc/db.php');
// If form submitted, insert values into the database.
session_start();

    function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
    }

        // removes backslashes
    $error = NULL;

    if (empty($_POST["email"])) { /* Email */
    $emailErr = "Inserisci una email";
    $error = 1;
    } else {
    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato email non valido."; 
      $error= 1;
    }

    $query_email = "SELECT * FROM users WHERE email ='".$email."'";
    $result_email = mysqli_query($con,$query_email); 
    $result_emailCount= mysqli_num_rows($result_email);

    if ($result_emailCount  > 0){
        $emailErr = "Questa email &egrave; gi&agrave; associata ad un altro account.";
        $error = 1;
    }
  }

    if(isset($emailErr)){
        $_SESSION['emailErr']= $emailErr;
    }


    if (empty($_POST["nome"])) { /* Nome */
        $nomeErr = "Devi inserire un nome.";
        $error = 1;
        }
        else{

          $nome = test_input($_POST["nome"]);

          if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
            $nomeErr = "Il nome deve contenere solo lettere o spazi bianchi"; 
            $error = 1;
          }
          elseif (strlen($nome) < 3) {
          $nomeErr = "Inserisci un nome valido."; 
          $error = 1;
          }
        }

     if(isset($nomeErr)){
        $_SESSION['nomeErr']= $nomeErr;
    }

    if (empty($_POST["surname"])) {  /* Cognome */
        $surnameErr = "Devi inserire un cognome.";
        $error = 1;
        }
        else{

          $surname = test_input($_POST["surname"]);  

          if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
            $surnameErr = "Il cognome deve contenere solo lettere o spazi bianchi"; 
            $error = 1;
          }
          elseif (strlen($surname) < 3) {
          $surnameErr = "Inserisci un cognome valido."; 
          $error = 1;
          }
        }

    if(isset($surnameErr)){
        $_SESSION['surnameErr']= $surnameErr;
    }


    if (empty($_POST["uname"])) { /* Username */
        $usernameErr = "Devi inserire un username";
        }
        else{
          $username = test_input($_POST['uname']);
          $query_user = "SELECT * FROM users WHERE username ='".$username."'";
          $result_user = mysqli_query($con,$query_user); 
          $result_userCount=mysqli_num_rows($result_user);
          if($result_userCount > 0){
            $usernameErr=  "Username gi&agrave; presente, inseriscine uno nuovo";
            $error = 1;
          }
    }


    if(isset($usernameErr)){
        $_SESSION['usernameErr']= $usernameErr;
    }


    if (empty($_POST["psw"])) { /* Password */
        $pswErr = "Devi inserire una password.";
    }
        else{
            $psw = $_POST['psw'];
            if (strlen($psw) <= '7') {
            $pswErr = "La tua password deve contenere almeno 8 caratteri.";
            $error = 1;
            }
            elseif (!preg_match("#[0-9]+#",$psw)) {
                $pswErr = "La tua password deve contenere almeno un numero";
                $error = 1;
            }
            elseif(!preg_match("#[A-Z]+#",$psw)) {
                $pswErr = "La tua password deve contenere almeno un carattere maiuscolo";
                $error = 1;
            }
            elseif(!preg_match("#[a-z]+#",$psw)) {
                $pswErr = "La tua password deve contenere almeno un carattere minuscolo";
                $error = 1;
            }
          
        }

    if(isset($pswErr)){
        $_SESSION['pswErr']= $pswErr;
    }

    if (empty($_POST["psw-repeat"])) { /* Ripeti Password */
        $psw_repeatErr = "Devi reinserire la password.";
        $error = 1;
        }
        else{
            $psw_repeat = test_input($_POST['psw-repeat']);
            if($psw != $psw_repeat){
                $psw_repeatErr = "Le due password non coincidono.";
                $error = 1;
            } 
        }

    if(isset($psw_repeatErr)){
        $_SESSION['psw_repeatErr']= $psw_repeatErr;
    }

    if (empty($_POST["citta"])) { /* Citta */
        $cittaErr = "Devi inserire una citt&agrave;";
        $error = 1;
        }
        else{
          $citta = test_input($_POST['citta']);
          if (!preg_match("/^[a-zA-Z ]*$/",$citta)) {
            $cittaErr = "La citt&agrave; deve contenere solo lettere o spazi bianchi"; 
            $error = 1;
          }
        }

    if(isset($cittaErr)){
        $_SESSION['cittaErr']= $cittaErr;
    }

    if (empty($_POST["indirizzo"])) { /* Indirizzo */
        $indirizzoErr = "Devi inserire un indirizzo";
        $error = 1;
        }
        else{
          $indirizzo = test_input($_POST['indirizzo']);
    }

    if(isset($indirizzoErr)){
        $_SESSION['indirizzoErr']= $indirizzoErr;
    }


    if (empty($_POST["cap"])) { /* CAP */
        $capErr = "Devi inserire un CAP";
        $error= 1;
        }
        else{
          $cap = test_input($_POST['cap']);
          if (!preg_match("/^\d{5}$/",$cap)) {
            $capErr = "CAP non valido.";
            $error = 1;
          }
        }

    if(isset($capErr)){
        $_SESSION['capErr']= $capErr;
    }

	$trn_date = date("Y-m-d");

    if($error == NULL){

    $query = "INSERT into `users` (email, nome, cognome, username, password, citta, indirizzo, cap, trn_date)
    VALUES ('$email', '$nome', '$surname', '$username', '".md5($psw)."', '$citta', '$indirizzo', '$cap', '$trn_date')";

    $result = mysqli_query($con,$query);


    $_SESSION['username'] = $username;

    header("location: ../index.php");
        
    } else header('location: ../index.php')

?>