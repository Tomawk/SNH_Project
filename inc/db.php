<?php

/* connessione al db */
$address = "localhost";
$user = "root";
$database = "bookworm";
$con = mysqli_connect($address,$user,"",$database);

// Verifica connessione

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>