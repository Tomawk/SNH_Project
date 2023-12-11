<?php
require("../inc/db.php");

function generate_tokens(): array
{
    $selector = bin2hex(random_bytes(16));
    $validator = bin2hex(random_bytes(32));

    return [$selector, $validator, $selector . ':' . $validator];
}

function parse_token(string $token): ?array
{
    $parts = explode(':', $token);

    if ($parts && count($parts) == 2) {
        return [$parts[0], $parts[1]];
    }
    return null;
}

function insert_user_token(int $user_id, string $selector, string $hashed_validator, string $expiry,$con): bool
{
    $sql = 'INSERT INTO user_tokens(user_id, selector, hashed_validator, expiry)
            VALUES(?,?,?,?)';

    $statement = $con->prepare($sql);
    $statement->bind_param("isss",$user_id,$selector,$hashed_validator,$expiry);
    return $statement->execute();
}

function find_user_token_by_selector(string $selector,$con)
{

    $sql = 'SELECT id, selector, hashed_validator, user_id, expiry
                FROM user_tokens
                WHERE selector = ? AND
                    expiry >= now()
                LIMIT 1';

    $statement = $con->prepare($sql);
    //$statement->bindValue(':selector', $selector);
    $statement->bind_param("s",$selector);

    $statement->execute();

    return $statement->fetch();
}

function delete_user_token(string $user_id,$con): bool
{
    $sql = 'DELETE FROM "user_tokens" WHERE user_id = (select id from users as us where us.username = ? )';
    $sql = 'DELETE FROM `user_tokens` WHERE user_id = (select id from users as us where us.username = ?)';
    $statement = $con->prepare($sql);
    $statement->bind_param("s", $user_id);

    return $statement->execute();
}
/*
function find_user_by_token(string $token,$con)
{
    $tokens = parse_token($token);

    if (!$tokens) {
        return null;
    }

    $sql = 'SELECT users.id, username
            FROM users
            INNER JOIN user_tokens ON user_id = users.id
            WHERE selector = :selector AND
                expiry > now()
            LIMIT 1';

    $statement = $con->prepare($sql);
    $statement->bindValue(':selector', $tokens[0]);
    $statement->execute();

    return $statement->fetch();
}
*/
//<--------------------------------
function is_user_logged_in($con): bool
{

    // check the remember_me in cookie
    $token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_STRING);

    if ($token && token_is_valid($token,$con)) {

        $user = find_user_by_token($token,$con);

        if ($user) {
            return log_user_in($user);
        }
    }
    return false;
}

/**
 * log a user in
 * @param array $user
 * @return bool
 */
function log_user_in(array $user): bool
{
    // prevent session fixation attack
    if (session_regenerate_id()) {
        // set username & id in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        return true;
    }

    return false;
}


function logout($con): void
{
    if (is_user_logged_in($con)) {

        // delete the user token
        delete_user_token($_SESSION['user_id']);

        // delete session
        unset($_SESSION['username'], $_SESSION['user_id`']);

        // remove the remember_me cookie
        if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_user', null, -1);
        }

        // remove all session data
        session_destroy();

        // redirect to the login page
        redirect_to('login.php');
    }
}

function remember_me(int $username,$con)
//function remember_me(int $day = 30)
{
    $day = 30;
    [$selector, $validator, $token] = generate_tokens();

    // remove all existing token associated with the user id
    //delete_user_token($user_id);

    // set expiration date
    $expired_seconds = time() + 60 * 60 * 24 * $day;

    // insert a token to the database
    $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
    $expiry = date('Y-m-d H:i:s', $expired_seconds);

    if (insert_user_token($username, $selector, $hash_validator, $expiry,$con)) {
        setcookie('remember_me', $token, $expired_seconds,"/","localhost");
    }
}

function getuserId($user,$con):int{
    $prepared = $con -> prepare("SELECT id from users where username = ?");;
    $prepared->bind_param("s",$user);
    $prepared->execute();
    $result=$prepared->get_result()->fetch_array(MYSQLI_NUM)[0];
  return $result;
}

?>