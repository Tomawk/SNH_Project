<?php

function token_is_valid(string $token,$con): bool { 
    [$selector, $validator] = parse_token2($token);
    $tokens = find_user_token_by_selector($selector,$con);
    if (!$tokens) 
        return false;
    return password_verify($validator, $tokens);
    }
function parse_token2(string $token): ?array
{
    $parts = explode(':', $token);

    if ($parts && count($parts) == 2) {
        return [$parts[0], $parts[1]];
    }
    return null;
}

function find_user_token_by_selector(string $selector,$con)
{

    //$sql = 'SELECT id, selector, hashed_validator, user_id, expiry
    $sql = 'SELECT hashed_validator
                FROM user_tokens
                WHERE selector = ? AND
                    expiry >= now()
                LIMIT 1';

    $selector = stripslashes($selector);
    $selector = mysqli_real_escape_string($con,$selector);

    $statement = $con->prepare($sql);
    $statement->bind_param('s', $selector);
    $statement->execute();
    //$statement->bind_result($id,$selector,$hashed_validator,$user_id,$expiry);
    //$result=$statement->fetch();
    $temp=$statement->get_result()->fetch_array(MYSQLI_NUM);
    if($temp != null)
        return $temp[0];
    return null;
}

function find_user_by_token(string $token,$con)
{
     $parts = explode(':', $token);

    if ($parts && count($parts) == 2) {
        $tokens =  [$parts[0], $parts[1]];
    }else
        return null;

    if (!$tokens) {
        return null;
    }

    $sql = 'SELECT username
            FROM users
            INNER JOIN user_tokens ON user_tokens.user_id = users.id
            WHERE selector = ? AND
                expiry > now()
            LIMIT 1';

    $tok = stripslashes($token[0]);
        $selector = mysqli_real_escape_string($con,$tok);
        $statement = $con->prepare($sql);
        $statement->bind_param('s', $tok);
        $statement->execute();
        //$result = $statement->get_result();
        //if(mysqli_num_row($result) != 1)
            //return null;
        //else
        $statement->bind_result($username);
        $statement->fetch();
        return ($username);
    }

    function regenerateSession($username,$remember_selected,$reload = false,$state)
    {
        /*
        // This token is used by forms to prevent cross site forgery attempts
        #if(!isset($_SESSION['nonce']) || $reload)
            #$_SESSION['nonce'] = md5(microtime(true));

        #check if the IPaddress is the same 
        if(!isset($_SESSION['IPaddress']) || $reload)
            //$_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
            $ipaddress = $_SERVER["REMOTE_ADDR"];

        #check if the user agent is the same
        if(!isset($_SESSION['userAgent']) || $reload)
            //$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
            $useragent = $_SERVER["HTTP_USER_AGENT"];

        // Set current session to expire in 1 minute
        $_SESSION['OBSOLETE'] = true;
        $_SESSION['EXPIRES'] = time() + 60;
        */

        // Create new session without destroying the old one
        session_regenerate_id(false);

        // Grab current session ID and close both sessions to allow other scripts to use them
        $newSession = session_id();
        session_write_close();

        // Set session ID to the new one, and start it back up again
        session_id($newSession);
        session_start();

        $_SESSION["username"]=$username;
        $_SESSION["rememberme"]=$remember_selected;
        $_SESSION["state"]=$state;

        return true;
        // Don't want this one to expire
        //unset($_SESSION['OBSOLETE']);
        //unset($_SESSION['EXPIRES']);
    }

    function checkExpiration(){
        $last_act = $_SESSION["timestamp"];
        $now = time();
        #if($now < $last_act + 60*60  )
        if($now < $last_act + 5  ){
            $_SESSION["timestamp"];
            return true;
        }
        else{
            /*
            unset($_SESSION["rememberme"]);
            unset($_SESSION["state"]);
            unset($_SESSION["username"]);
            unset($_SESSION["timestamp"]);
            */
        }
        return false;
}

function checkSession($con)
{
        if(!isset($_SERVER['HTTPS'])){
            $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            header("location:".$url);
        }
        if(isset($_SESSION["username"]) ){
                if(!checkExpiration())
                    if(!isset($_COOKIE["rememberme"]))
                        {
                        unset($_SESSION["rememberme"]);
                        unset($_SESSION["state"]);
                        unset($_SESSION["username"]);
                        unset($_SESSION["timestamp"]);
                        return false;
                        }
        }
        if(!isset($_COOKIE["rememberme"]))
            return false;
        $token = $_COOKIE["rememberme"];
        //header("location:"+$token);
        if(!token_is_valid($token,$con))
            return false;

        $user=find_user_by_token($token,$con);
        $state = $_SESSION["state"];
        if($user != null){
            $_SESSION["username"] = $user;
            $_SESSION["state"] = $state;
            $_SESSION["timestamp"] = isset($_COOKIE["rememberme"])?time()+60*60*24:time();
            return true;
        }
        else    
            return false;
}
?>