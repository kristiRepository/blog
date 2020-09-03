<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 
class Mail{


public static function sendEmail($email,$username,$vkey){



$mail = new PHPMailer(true);
 
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';  //mailtrap SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = '7e4f1427dfceca' ;   //username
    $mail->Password = '56fb8b5483df46';   //password
    $mail->Port = 465;                    //smtp port
 
    $mail->setFrom('Blog@web.net', 'Blog Administrator');
    $mail->addAddress($email,$username);
 
    $mail->isHTML(true);
 
    $mail->Subject = 'Confirm your email';
    $mail->Body    ="<p>One last step</p><a href='localhost:8000/?vkey={$vkey}'>Click here to activate your email</a>";
 
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
}

public static function sendPassword($email,$username,$vkey){

    



        $mail = new PHPMailer(true);
         
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';  //mailtrap SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = '7e4f1427dfceca' ;   //username
            $mail->Password = '56fb8b5483df46';   //password
            $mail->Port = 465;                    //smtp port
         
            $mail->setFrom('Blog@web.net', 'Blog Administrator');
            $mail->addAddress($email,$username);
         
            $mail->isHTML(true);
         
            $mail->Subject = 'Reset password';
            $mail->Body    ="<p>Please click the link to reset your password</p><a href='localhost:8000/reset-password/?vkey={$vkey}'>Click here</a>";
         
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        
} 

}