<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'phpmailer/PHPMailerAutoload.php';
class Custom_functions {
  protected $CI;
  public function __construct() {
    // Assign the CodeIgniter super-object
    $this->CI =& get_instance();
  }

  function check_img($img) {
    //check image wether it is uploaded or link image
    if($img == '')
    return $img;
    if(substr($img,0,8)=='https://' || substr($img,0,7)=='http://') {
      return $img;
    }
    else {
      return ASSETS.$img;
    }
  }


  function mail_Send($to,$from,$subject,$attach,$body){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
      //Server settings
      //$mail->SMTPDebug = 3;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );
      $mail->Host = 'md-in-66.webhostbox.net';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'info@webassets.in';                 // SMTP username
      $mail->Password = 'WebAssets#7';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom($from, 'Webassets');
      for ($i=0;$i<sizeof($to);$i++){
        $mail->addAddress($to[$i]);     // Add a recipient
      }
      //Attachments
      if($attach != null){
        $mail->addAttachment($attach);         // Add attachments
      }
      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;

      $mail->Body = $body;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      return 'Message has been sent';
    }
    catch (Exception $e) {
      return 'Message could not be sent.';
    }
  }
  function randomString($length){
    $chars = "abcdefghijkmnpqrstuvwxyz23456789";
    srand((double)microtime()*1000000);
    $str = "";
    $i = 0;

    while($i <= $length){
      $num = rand() % 33;
      $tmp = substr($chars, $num, 1);
      $str = $str . $tmp;
      $i++;
    }
    return $str;
  }
}
