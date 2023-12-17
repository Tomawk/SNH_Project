<?php
require("rememberme.php");
require("../inc/db.php");
session_start();
if(isset($_SESSION["username"])){
        delete_user_token($_SESSION['username'],$con);
        unset($_SESSION['username']);
}
if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_me', '', 1,'/');
        }
session_unset();
session_destroy();
if(isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']); // SAFE (?)
}
else
{
    header("location: ../index.php");
}
exit();
?>