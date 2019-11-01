<?php
date_default_timezone_set('Etc/UTC');

require 'class.phpmailer.php';
require 'class.smtp.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "mx1.hostinger.com.br";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "naoresponda@viciadosemsushi.com.br";
//Password to use for SMTP authentication
$mail->Password = "viciadosedemais";
//Set who the message is to be sent from
$mail->setFrom('naoresponda@viciadosemsushi.com.br', 'VICIADOS EM SUSHI');
//Set an alternative reply-to address
$mail->addReplyTo('contato@viciadosemsushi.com.br ', 'VICIADOS EM SUSHI CONTATO');
//Set who the message is to be sent to
$mail->addAddress($clienteEmail, $clienteNome);
//Set the subject line
$mail->Subject = $subjectMensagem;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($msgHTMLMAIL);
//Replace the plain text body with one created manually
$mail->AltBody = 'Para ver essa mensagem, utilize um leitor de email compativel com HTML!';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}
