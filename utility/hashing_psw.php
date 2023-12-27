<?php


// FUNCTIONS TO HASH PASSWORDS //
function hash_psw($clear_psw){
    $psw_hash = hash('sha256', $clear_psw);
    return $psw_hash;
}

function create_salt() // a good salt is long as the hash length
{
    $text = date('U');
    $salt = hash('sha256', $text);
    return $salt;
}


?>