<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(strpos($url, 'dashboard') !== false){
    require '../vendor/autoload.php';
} else {
    require './vendor/autoload.php';
};

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail extends Database
{
    private $mail;
    private array $row;

    public function __construct()
    { 
        parent::__construct();
        $this->row = $this->select('smtp_host, smtp_username, smtp_password, smtp_port', 'main');
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->isHTML(true);
        $this->mail->Host       =  "{$this->row[0]['smtp_host']}";
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = "{$this->row[0]['smtp_username']}";
        $this->mail->Password   =  "{$this->row[0]['smtp_password']}";
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       =  "{$this->row[0]['smtp_port']}";               
    }

    public function registerMail($sender,$name,$email)
    {
    try
    {
        $this->mail->setFrom($sender, $name);
        $this->mail->addAddress($email);
        $this->mail->Subject = 'Thank you for registering, ' . filter_var($_REQUEST['firstname'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH);
        $this->row = $this->select('confirmation_code', 'users', ['email' => filter_var(strtolower($_REQUEST['email']),FILTER_SANITIZE_EMAIL)]);      
        $message = file_get_contents('./views/mail/registeremail.php');   
        $message = str_Replace('%url%', $_SERVER['SERVER_NAME'], $message);
        $message = str_replace('%code%', $this->row[0]['confirmation_code'], $message);
        $this->mail->msgHTML($message);
        $this->mail->send();
    } catch (Exception $e)
    {
        echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}