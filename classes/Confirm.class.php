<?php

class Confirm extends Database {
    private $statement;
    function __construct(){
        if(isset($_REQUEST['code'])){
            parent::__construct();
            $this->statement = $this->connection->prepare("SELECT * FROM users WHERE confirmation_code = :code");
            $this->statement->execute([':code' => $_REQUEST['code']]);
            $this->row = $this->statement->fetch();
            if($this->row['confirmed'] == 1){
                header("location: login.php");
            } else {
                if($_REQUEST['code'] == $this->row['confirmation_code']){
                    $this->statement = $this->connection->prepare("UPDATE users SET confirmed = 1 WHERE confirmation_code = :code");
                    $this->statement->execute([':code' => $_REQUEST['code']]);
                    header("refresh:5;url=login.php");
                } else {
                    header("location: login.php");
                }
            }
        } else {
            header("location: login.php");
        }
    }
}