<?php
require('../inc/db.php');
require('sessionManager.php');
require('rememberme.php');
require("insert_function.php");

session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes

      $username = stripslashes($_REQUEST['username']);
      //escapes special characters in a string
      $username = mysqli_real_escape_string($con,$username);
      $password = stripslashes($_REQUEST['password']);
      $password = mysqli_real_escape_string($con,$password);
      //Checking is user existing in the database or not
      //$query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
      //$result = mysqli_query($con,$query) or die(mysql_error());
      //$rows = mysqli_num_rows($result);

      //solution with prepared statement:
      $prepared = $con->prepare("SELECT* FROM users WHERE username= ? and password = ? ");
      $hashed_password = md5($password);
      $prepared->bind_param("ss",$username,$hashed_password);
      $prepared->execute();
      $rows=mysqli_num_rows($prepared->get_result());
 
 
      if($rows==1){
            
            $_SESSION['username'] = $username;
            //se l'utente aveva aggiunto cose al carrello quando non era loggato, devo inserirli nel db
            if(isset($_SESSION['not_logged_in']) and sizeof($_SESSION['not_logged_in']) > 0){
                  //inserico elementi nel db
                  for($i = 0; $i < sizeof($_SESSION['not_logged_in']); $i++){
                        //questo per inviare il dato al db
                        insert_book($_SESSION['not_logged_in'][$i],$username,$con);
                  }
            }
            unset($_SESSION['not_logged_in']);
            //to prevent session fixation attack
            $rememberme_selected = isset($_POST["rememberme"]) ? true : false;
            $state = $_SESSION["state"];
            if(regenerateSession($username,$rememberme_selected,$state)){
                  if($_SESSION["rememberme"]==true)
                        remember_me(getuserId($_SESSION["username"],$con),$con);
                        //remember_me();
                  unset($_SESSION["rememberme"]);
            }
            
            

      }else
            $_SESSION['error'] = "Username or Password wrong. Retry.";
      
      //header("location: ../index.php");
}else{
      $_SESSION['error'] = "Generic error,contact admin.";
      //header("location: ../index.php");
}
header("location: ../index.php");

?>