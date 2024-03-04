<?php
namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mailer{

    function __construct(){
        $this->mail = new PHPMailer(false);
        $this->from = 'rizebotline@gmail.com';
    }

    function sendMail($title,$message,$mail_to){
        $this->mail->IsSMTP();
        $this->mail->Mailer = "smtp";
        $this->mail->SMTPDebug  = 0;  
        $this->mail->SMTPAuth   = TRUE;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port       = 587;
        $this->mail->Host       = "smtp.gmail.com";
        $this->mail->Username   = "rizebotline@gmail.com";
        $this->mail->Password   = "ozcfqcmrnjtpgtym";
        $this->mail->IsHTML(true);
        $this->mail->AddAddress($mail_to, $mail_to);
        $this->mail->SetFrom($this->from, $this->from);
        
        $this->mail->Subject = $title;
        $content = $message;
        $this->mail->MsgHTML($content); 
        if(!$this->mail->Send()) {
            return false;
        } else {
            return true;
        }
    }
}