<?php

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'alejandrond91@gmail.com';
$mail->Password = 'marujito'; 
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'alejandrond91@gmail.com';
$mail->FromName = 'Alejandro';
$mail->addAddress('alejandrond91@gmail.com');     // Add a recipient

$mail->Subject = 'prueba';
$mail->Body    = 'Hi Alejandro, This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'El mensaje no ha podido ser enviado.';
    echo 'Error: ' . $mail->ErrorInfo;
} else {
    echo 'El mensaje ha sido enviado con éxito.';
}
?>

