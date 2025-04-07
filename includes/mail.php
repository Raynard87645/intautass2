<?php
require_once '../config/mail.php';

function sendMail($subject, $body, $content, $to, $to_name, $from = $_ENV['MAIL_FROM_ADDRESS'], $from_name = $_ENV["MAIL_FROM_NAME"]) {
    global $mail;
    try {
        //code...
        // Recipients
        $mail->setFrom($from, $from_name);
        $mail->addAddress($to, $to_name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $content;

        $mail->send();

        echo "Email send successfully.\n";
    } catch (\Throwable $th) {
        //throw $th;
        echo "Error: Unable to send email.\n";
    }
    
}