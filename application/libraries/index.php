<?php
	
//Load composer's autoloader
require 'phpmailer/PHPMailerAutoload.php';

function mail_Send($to,$subject,$attach,$body){
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 3;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'vishal@jbglass.in';                 // SMTP username
    $mail->Password = '9871732671';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('vishal@jbglass.in', 'Vishal Singhal');
	for ($i=0;$i<sizeof($to);$i++){
	$mail->addAddress($to[$i]);     // Add a recipient
   /*$mail->addAddress('erp@kiet.edu', 'Joe User');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');
	*/	
	}
    //Attachments
    $mail->addAttachment($attach);         // Add attachments
	
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
	
    $mail->Body    = '<style>table, th, td {
   border: 1px solid black;
}</style>'.$body.'';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
	return 'Message has been sent';
} catch (Exception $e) {
    return 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
}
}

?>