<?php
require('../inc/db.php');

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

  
   $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";

   $result = mysqli_query($con,$query) or die(mysql_error());
   
   $rows = mysqli_num_rows($result);
 
 
 
   if($rows==1){
   $_SESSION['username'] = $username;



header("location: ../carrello.php");
         }else{
      $_SESSION['error'] = "Username o Password errati. Riprova.";
      header("location: ../accesso1.php");
  }
}

 ?>