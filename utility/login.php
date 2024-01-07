<?php
require('../inc/db.php');
require('sessionManager.php');
require('rememberme.php');
require("insert_function.php");
require("log.php");
if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

session_start();



function redirect(){
    if(isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']); // SAFE (?)
    }
    else
    {
        header("location: ../index.php");
    }
}



// If form submitted, insert values into the database.
if (isset($_POST['username']) && isset($_POST['password'])){

      $username = stripslashes($_POST['username']);
      //escapes special characters in a string
      $username = mysqli_real_escape_string($con,$username);
      $password = stripslashes($_POST['password']);
      $password = mysqli_real_escape_string($con,$password);

      // Check if target IP is blocked or not

      // IP dell'utente
      $ip = get_client_ip();

      // Controllo del numero di tentativi di login falliti per blocco ip
      $maxFailedAttempts = 20;

      // Check if IP is already blocked

      $stmt_check_blocked_ip = $con->prepare("SELECT* FROM ip_addresses_checks WHERE ip= ?");
      $stmt_check_blocked_ip->bind_param("s",$ip);
      $stmt_check_blocked_ip->execute();
      $resultCheckBlockedIP = $stmt_check_blocked_ip->get_result();
      $resultCheckBlockedIPCount = mysqli_num_rows($resultCheckBlockedIP);

      $numFailedAttempts = 0;

      if($resultCheckBlockedIP == 1) {
          $row_ip = mysqli_fetch_assoc($resultCheckBlockedIP);
          $numFailedAttempts = $row_ip['failed_attempts'];
      }

      if($numFailedAttempts >= $maxFailedAttempts){ //ip is blocked
          $_SESSION['error'] = "IP has been locked, retry later";
          $log_msg = "LOGIN ATTEMPT ON IP LOCKED";
          log_message($log_msg);
          redirect();
      } else{ //non blocked ip

          //Checking is user existing in the database or not

          $stmt = $con->prepare("SELECT* FROM users WHERE username= ?");
          $stmt->bind_param("s",$username);
          $stmt->execute();
          $result = $stmt->get_result(); //only one row
          $resultCount=mysqli_num_rows($result);

          if($resultCount == 1){
              //get salt
              $row = mysqli_fetch_assoc($result);
              $salt = $row['salt'];

              // get bruteforce counter
              $bruteforce_counter = $row['bruteforce_counter'];

              if($bruteforce_counter > 5){ //condition on bruteforce counter for account locking
                  $_SESSION['error'] = "Account has been locked, retry later";
                  $log_msg = "LOGIN ATTEMPT ON LOCKED ACCOUNT: username: ".$username;
                  log_message($log_msg);
                  redirect();
              } else { //account not locked

                  $prepared = $con->prepare("SELECT* FROM users WHERE username= ? and password = ? ");

                  $hashed_psw = hash('sha256',$password);
                  $final_psw = hash('sha256', $salt . $hashed_psw); //hashed psw with hash

                  $prepared->bind_param("ss",$username,$final_psw);
                  $prepared->execute();
                  $rows=mysqli_num_rows($prepared->get_result());

                  if($rows==1){ //username exists and password correct

                      $_SESSION['username'] = $username;

                      //reset bruteforce counter & ip locking counter

                      $bruteforce_counter = 0;
                      $expire_stamp = null;

                      //reset bruteforce counter

                      $stmt_reset_bruteforce = $con->prepare("UPDATE users SET bruteforce_counter = ?, bruteforce_exp = ? WHERE username = ?");

                      $stmt_reset_bruteforce->bind_param("iis",$bruteforce_counter,$expire_stamp,$username);
                      $stmt_reset_bruteforce->execute();

                      //reset ip failed login attemps by clearing row for that ip if exists

                      if($resultCheckBlockedIPCount > 0){
                          $stmt_reset_ip_login_attempts = $con->prepare("DELETE FROM ip_addresses_checks WHERE ip = ?");
                          $stmt_reset_ip_login_attempts->bind_param("s",$ip);
                          $stmt_reset_ip_login_attempts->execute();
                      }

                      // LOG SUCCESSFUL LOGIN
                      $log_msg = "SUCCESSFUL LOGIN: username: ".$username;
                      log_message($log_msg);

                      //se l'utente aveva aggiunto cose al carrello quando non era loggato, devo inserirli nel db
                      if(isset($_SESSION['not_logged_in']) and sizeof($_SESSION['not_logged_in']) > 0){
                          //inserico elementi nel db
                          for($i = 0; $i < sizeof($_SESSION['not_logged_in']); $i++){
                              //questo per inviare il dato al db
                              insert_book($_SESSION['not_logged_in'][$i],$username,$con);
                          }
                      }
                      unset($_SESSION['not_logged_in']);
                      //to prevent session fixation attack
                      $rememberme_selected = isset($_POST["rememberme"]) ? true : false;
                      $_SESSION["state"] = "outside";
                      $_SESSION["csrf_token"] = bin2hex(random_bytes(128));
                      $sql = "UPDATE users set csrf_token = ? where username = ? ";
                      $stmt = $con->prepare($sql);
                      $stmt->bind_param("ss",$_SESSION["csrf_token"],$_SESSION["username"]);
                      $stmt->execute();

                      $state = $_SESSION["state"];
                      if(regenerateSession($username,$rememberme_selected,"",$state)){
                          if($_SESSION["rememberme"]==true)
                              remember_me(getuserId($_SESSION["username"],$con),$con);
                          //remember_me();
                          unset($_SESSION["rememberme"]);
                      }

                  }else { //username exist but password wrong

                      //increment bruteforce counter and set new timestamp expiration

                      $bruteforce_counter += 1;
                      $expire_stamp = date('Y-m-d H:i:s', strtotime("+60 min")); //60 min expiration time
                      $expire_stamp = strtotime($expire_stamp);

                      //update bruteforce counter

                      $stmt_update_bruteforce = $con->prepare("UPDATE users SET bruteforce_counter = ?, bruteforce_exp = ? WHERE username = ?");

                      $stmt_update_bruteforce->bind_param("iis",$bruteforce_counter,$expire_stamp,$username);
                      $stmt_update_bruteforce->execute();

                      if($resultCheckBlockedIPCount >0 ){ //non-first failed attempt
                          $numFailedAttempts += 1;
                          $stmt_update_ip_failed_attempts= $con->prepare("UPDATE ip_addresses_checks SET failed_attempts = ?, timestamp_exp = ? WHERE ip = ?");
                          $stmt_update_ip_failed_attempts->bind_param("iis",$numFailedAttempts,$expire_stamp,$ip);
                          $stmt_update_ip_failed_attempts->execute();
                      }else { //first failed attempt
                          $numFailedAttempts = 1;
                          $stmt_insert_ip_failed_attempts= $con->prepare("INSERT INTO ip_addresses_checks (ip, timestamp_exp, failed_attempts) VALUES (?, ?, ?)");
                          $stmt_insert_ip_failed_attempts->bind_param("sii",$ip,$expire_stamp,$numFailedAttempts);
                          $stmt_insert_ip_failed_attempts->execute();
                      }

                      $_SESSION['error'] = "Username or Password wrong. Retry.";
                      $log_msg = "FAILED LOGIN ATTEMPT: username: " . $username;
                      log_message($log_msg);
                  }
              }
          }else{
              //NON EXISTENT USERNAME
              $_SESSION['error'] = "Username or Password wrong. Retry."; //ERRORS SHOULD NOT GIVE HINTS TO THE ATTACKERS
              $log_msg = "FAILED LOGIN ATTEMPT ON NON-EXISTENT USER: username: ".$username;
              log_message($log_msg);
              redirect();
          }

      }


}else{
      $_SESSION['error'] = "Email or password are missing";
      //$log_msg = "FAILED LOGIN ATTEMPT: Username: ".$username;
      //log_message($log_msg);
}
redirect();





?>