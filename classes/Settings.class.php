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
                    $this->firstName = $_REQUEST['firstName'];
                case !empty($_REQUEST['lastName']):
                    $this->lastName = $_REQUEST['lastName'];
                case !empty($_REQUEST['email']):
                    $this->email = $_REQUEST['email'];
                case !empty($_REQUEST['password']):
                    $this->password = $_REQUEST['password'];
                case !empty($_REQUEST['confirm']):
                    $this->confirm = $_REQUEST['confirm'];
            }

            // email = case when '$this->email' <> '' then '$this->email' else email end
            // Will need to do a check for this. Will need to check if it does not exist in database already.
            // Will also need to change some of the actual backend code for the website as we're using session for email. We could force logout after email reset to be honest.
            // Or we change how the entire system gets the information instead of $_SESSION['email'] we grab the ID and do a query.
            $this->statement = $this->connection->prepare("UPDATE users SET firstname = case when '$this->firstName' <> '' then '$this->firstName' else firstname end, lastname = case when '$this->lastName' <> '' then '$this->lastName' else lastname end WHERE email = :email");
            $this->statement->execute([':email' => $_SESSION['client']['email']]); 
            header("Refresh: 0");
        }
    }
}