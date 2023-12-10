<?php
require("rememberme.php");
session_start();
if(is_user_logged_in()){
        delete_user_token($_SESSION['user_id']);
        unset($_SESSION['username'], $_SESSION['user_id`']);
}
if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_user', null, -1);
        }
session_destroy();
header("Location: ../index.php");
exit();
?>