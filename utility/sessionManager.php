<?php
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

/*
function checkSession()
{
    try{
        if(isset($_SESSION['OBSOLETE']) && ($_SESSION['EXPIRES'] < time()))
            //throw new Exception('Attempt to use expired session.');
            return false;

        #if(!is_numeric($_SESSION['user_id']))
            #throw new Exception('No session started.');

        if(isset($_SESSION['IPaddress']) && $_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'])
            throw new Exception('IP Address mixmatch (possible session hijacking attempt).');

        if(isset($_SESSION['userAgent']) && $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
            throw new Exception('Useragent mixmatch (possible session hijacking attempt).');

        #if(!$this->loadUser($_SESSION['user_id']))
            #throw new Exception('Attempted to log in user that does not exist with ID: ' . $_SESSION['user_id']);

        if(!isset($_SESSION['OBSOLETE']) && mt_rand(1, 100) == 1)
        {
            $this->regenerateSession();
        }

        return true;

    }catch(Exception $e){
        return false;
    }
}
*/
?>