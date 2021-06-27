<?php

namespace Model;

use Core\model;

class Mail extends model
{
    private $From;
    private $Subject;
    private $Header;
    private $mail;

    function __construct()
    {
        parent::__construct();
        $witcher = new \witcher();
        $witcher->requirePlugin("PHPMailerAutoload.php");
        return $this->mail = new \PHPMailer;
    }

    public function SetTo($email, $name = "")
    {
        return $this->mail->addAddress($email, $name);
    }

    public function SetFrom($email, $firstlast = "")
    {
        return $this->mail->setFrom($email, $firstlast);
    }

    public function SetMessage($msg)
    {
        return $this->mail->msgHTML($msg);
    }

    public function SetSubject($subject)
    {
        return $this->mail->Subject = $subject;
    }

    public function SetHeaders()
    {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $this->From . "\r\n";
        return $this->Header = $headers;
    }

    public function Send($to,$msg,$sub)
    {
        $this->mail = new \PHPMailer;
        $this->mail->SetTo($to, "test");
        $this->mail->SetFrom($this->From);
        $this->mail->SetMessage($msg);
        $this->mail->SetSubject($sub);
        if (!$this->mail->send()) {
            return "Mailer Error: " . $this->mail->ErrorInfo;
        } else {
            return true;
        }
    }
}