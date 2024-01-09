<?php
require("rememberme.php");
require("../inc/db.php");
if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

session_start();
if(isset($_SESSION["username"])){
        delete_user_token($_SESSION['username'],$con);
        unset($_SESSION['username']);
}
if (isset($_COOKIE['rememberme'])) {
            unset($_COOKIE['rememberme']);
            setcookie('rememberme', '', 1,'/');
        }
session_unset();
session_destroy();

if(isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
    header("location: ../index.php");
}
exit();
?>