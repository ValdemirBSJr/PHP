<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */

require 'class.phpmailer.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('contato@psiti.pe.hu', 'PSITI');
//Set an alternative reply-to address
$mail->addReplyTo('contato@psiti.pe.hu', 'PSITI');
//Set who the message is to be sent to
$mail->addAddress('badmoon25@gmail.com', 'Valdemir');
//Set the subject line
$mail->Subject = 'TESTE COM O PHP MAILER!!!';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

$mail->msgHTML("<h1>OLA VICIADOS!!!!</h1><p>TESTE DE ENVIO DE EMAIL.</p><a href='www.google.com.br'>GUGLI</a>");

//Replace the plain text body with one created manually
$mail->AltBody = 'Para ver essa mensagem, utilize um leitor de email compativel com HTML!';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
