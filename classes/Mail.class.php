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
class Mail extends Database{
    private $mail;
    private $statement;

    public function __construct(){ 
        parent::__construct();
        $this->statement = $this->connection->prepare("SELECT smtp_host,smtp_username,smtp_password,smtp_port FROM main");
        $this->statement->execute();
        $this->row = $this->statement->fetch();
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();
        $this->mail->Host       =  "{$this->row['smtp_host']}";
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = "{$this->row['smtp_username']}";
        $this->mail->Password   =  "{$this->row['smtp_password']}";
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       =  "{$this->row['smtp_port']}";               
    }

    public function registerMail($sender,$name,$email,$code) {
    try {
        $this->mail->setFrom($sender, $name);
        $this->mail->addAddress($email);

        $this->mail->isHTML(true);
        $this->mail->Subject = 'Thank you for registering, ' . $_POST['firstname'];
        
        ob_start();
        require_once ('./mail/registeremail.php');
        $message = ob_get_clean();
        $this->mail->msgHTML($message);
        $this->mail->AltBody = 'This is a test with emails.';

        $this->mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}