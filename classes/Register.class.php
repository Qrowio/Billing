<?php

class Register extends Database {    
    private $firstname;
    private $surname;
    private $email;
    private $password;
    private $confirm;
    private $created;
    private $sql;
    private $row;
    private $hashed;
    private $ip;

    function __construct() {
        if(isset($_POST['submit'])){
            parent::__construct();
            $this->firstname = filter_var($_REQUEST['firstname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $this->surname = filter_var($_REQUEST['surname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $this->email = filter_var(strtolower($_REQUEST['email']),FILTER_SANITIZE_EMAIL);
            $this->password = strip_tags($_REQUEST['password']);
            $this->confirm = strip_tags($_REQUEST['confirm']);
            $this->created = new DateTime();
            $this->created = $this->created->format('Y-m-d H:i:s');
            $this->ip = $_SERVER['REMOTE_ADDR'];
            if(empty($this->firstname) || empty($this->surname) || empty($this->email) || empty($this->password) || empty($this->confirm)){
                // Insert Error Later
                echo "Please submit the entire form";
            } else if ($this->password != $this->confirm){
                // Insert Error Later
                echo "Your password is incorrect.";
            } else {
                try {
                    $this->sql = $this->connection->prepare("SELECT email FROM users WHERE email = :email");
                    $this->sql->execute([':email' => $this->email]); 
                    $this->row = $this->sql->fetch(PDO::FETCH_ASSOC);
                    if(isset($this->row['email'])){
                        // Insert Error Later
                        echo "User already exists";
                    } else {
                        $this->hashed = password_hash($this->password, PASSWORD_DEFAULT);
                        $this->sql = $this->connection->prepare("INSERT INTO USERS (firstname, lastname, email, password, createdAt, ip_address) VALUES (:firstname, :lastname,:email, :password, :createdAt, :ip_address)");
                        $this->sql->execute([
                            ':firstname' => $this->firstname,
                            ':lastname' => $this->surname,
                            ':email' => $this->email,
                            ':password' => $this->hashed,
                            ':createdAt' => $this->created,
                            ':ip_address' => $this->ip
                        ]);
                        $mailer = new Mail;
                        $mailer->registerMail('qrow@qrow.dev','noreply',"{$_POST['email']}",'Hi');
                        header('location: login.php');
                    }
                } catch(PDOException $err){
                    echo $err;
                }
            }
        }
    }
}

?>