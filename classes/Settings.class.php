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
                    $this->firstName = filter_var($_REQUEST['firstname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                case !empty($_REQUEST['lastName']):
                    $this->lastName = filter_var($_REQUEST['firstname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                case !empty($_REQUEST['email']):
                    $this->email = filter_var(strtolower($_POST['email']),FILTER_SANITIZE_EMAIL);
                case !empty($_REQUEST['password']):
                    $this->password = $_REQUEST['password'];
                case !empty($_REQUEST['confirm']):
                    $this->confirm = $_REQUEST['confirm'];
            }

            // Email now updates but services wont. Will fix this later on.
            $this->statement = $this->connection->prepare("UPDATE users SET firstname = case when '$this->firstName' <> '' then '$this->firstName' else firstname end, lastname = case when '$this->lastName' <> '' then '$this->lastName' else lastname end, email = case when '$this->email' <> '' then '$this->email' else email end WHERE email = :email");
            $this->statement->execute([':email' => $_SESSION['client']['email']]);
            if(isset($this->email)){
                $_SESSION['client']['email'] = $this->email;
            }
            header("Refresh: 0");
        }
    }
}