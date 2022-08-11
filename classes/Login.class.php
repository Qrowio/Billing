<?php

class Login extends Database {
    private $email;
    private $password;
    private $sql;
    private $row;

    function __construct() {
        if(isset($_POST['submit'])){
            parent::__construct();
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            if(empty($this->email) || empty($this->password)) {
                // Put better error later.
                echo "Please fill the form";
            } else {
                try {
                    $this->sql = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
                    $this->sql->execute([':email' => $this->email]);
                    $this->row = $this->sql->fetch(PDO::FETCH_ASSOC);
                    if($this->sql->rowCount() > 0){
                        if(password_verify($this->password, $this->row['password'])){
                            $_SESSION['client']['email'] = $this->row['email'];
                            $_SESSION['client']['id'] = $this->row['id'];
                            if($this->row['is_admin'] == 1){
                                $_SESSION['client']['admin'] = 1;
                            }
                            header('location: ../billing-system/dashboard/index.html');
                        }
                    } else {
                        // Put better error later.
                        echo "Wrong information";
                    }
                } catch(PDOException $err){
                    echo $err;
                }
            }
        }
    }
}