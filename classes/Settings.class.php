<?php

class Settings extends Database {
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $confirm;
    private $statement;

    function __construct() {
        if(isset($_POST['save'])){
            parent::__construct();

            switch($_REQUEST){
                case !empty($_REQUEST['firstName']):
                    $this->firstName = filter_var($_REQUEST['firstName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                case !empty($_REQUEST['lastName']):
                    $this->lastName = filter_var($_REQUEST['lastName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                case !empty($_REQUEST['password']):
                    $this->password = strip_tags($_REQUEST['password']);
                case !empty($_REQUEST['confirm']):
                    $this->confirm = strip_tags($_REQUEST['confirm']);
            }

            if(!empty($_REQUEST['email'])){
                $this->email = filter_var(strtolower($_POST['email']),FILTER_SANITIZE_EMAIL);
                $this->statement = $this->connection->prepare("SELECT email FROM users WHERE email = :email");
                $this->statement->execute([':email' => $this->email]);
                $this->row = $this->statement->fetch(PDO::FETCH_ASSOC);
                if(isset($this->row['email'])){
                    // Add better arrow later
                    echo "Email taken";
                } else {
                    $this->statement = $this->connection->prepare("UPDATE users SET firstname = case when '$this->firstName' <> '' then '$this->firstName' else firstname end, lastname = case when '$this->lastName' <> '' then '$this->lastName' else lastname end, email = case when '$this->email' <> '' then '$this->email' else email end WHERE email = :email");
                    $this->statement->execute([':email' => $_SESSION['client']['email']]);
                    if(isset($this->email)){
                        $_SESSION['client']['email'] = $this->email;
                    }
                    header("Refresh: 0");
                }
            } else {
                $this->statement = $this->connection->prepare("UPDATE users SET firstname = case when '$this->firstName' <> '' then '$this->firstName' else firstname end, lastname = case when '$this->lastName' <> '' then '$this->lastName' else lastname end WHERE email = :email");
                $this->statement->execute([':email' => $_SESSION['client']['email']]);
                header("Refresh: 0");
            }
        }
    }
}