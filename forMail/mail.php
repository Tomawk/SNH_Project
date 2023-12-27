<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendMail($object_to_send,$recipient,$body,$head){
    
    $mail = new PHPMailer();

    // Settings
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host       = "smtp-relay.brevo.com";    // SMTP server example
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
    $mail->Username   = "a.nigro8@studenti.unipi.it";            // SMTP account username example
    $mail->Password   = "5Q7HqnTtU0CZbcdx";            // SMTP account password example
    
  
    // Content
    $mail->setFrom('a.nigro8@studenti.unipi.it','BookStore');   
   
    $mail->addAddress($recipient);
    
    $mail->Subject = $head;
    $mail->Body    = $body.$object_to_send;
    $mail->send();
}

?>

