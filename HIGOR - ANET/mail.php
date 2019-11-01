<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */

require 'class.phpmailer.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
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
   // echo "Message sent!";
}
