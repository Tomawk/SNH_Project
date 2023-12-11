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

    $statement = $con->prepare($sql);
    $statement->bind_param('s', $selector);
    $statement->execute();
    //$statement->bind_result($id,$selector,$hashed_validator,$user_id,$expiry);
    //$result=$statement->fetch();
    $result=$statement->get_result()->fetch_array(MYSQLI_NUM)[0];
    return $result;
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

    $statement = $con->prepare($sql);
    $statement->bind_param('s', $tokens[0]);
    $statement->execute();
    //$result = $statement->get_result();
    //if(mysqli_num_row($result) != 1)
        //return null;
    //else
    $statement->bind_result($username);
    $statement->fetch();
    return ($username);
}

function regenerateSession($username,$remember_selected,$reload = false)
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

    return true;
    // Don't want this one to expire
    //unset($_SESSION['OBSOLETE']);
    //unset($_SESSION['EXPIRES']);
}

function checkSession($con)
{
        if(isset($_SESSION["username"]) )
            return true;
        if(!isset($_COOKIE["remember_me"]))
            return false;
        $token = $_COOKIE["remember_me"];
        //header("location:"+$token);
        if(!token_is_valid($token,$con))
            return false;
        $user=find_user_by_token($token,$con);
        if($user != null){
            $_SESSION["username"] = $user;
            return true;
        }
        else    
            return false;
}
?>