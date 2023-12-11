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
header("Location: ../index.php");
exit();
?>