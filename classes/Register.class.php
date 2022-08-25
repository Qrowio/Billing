<?php

class Register extends Database {    
    private string $firstname;
    private string $surname;
    private string $email;
    private string $password;
    private string $confirm;
    private string $hashed;
    private PDOStatement $sql;
    private array $row;

    public function __construct()
    {
        parent::__construct();
        if(isset($_POST['submit']))
        {
            $this->firstname = filter_var($_REQUEST['firstname'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH);
            $this->surname = filter_var($_REQUEST['surname'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH);
            $this->email = filter_var(strtolower($_REQUEST['email']),FILTER_SANITIZE_EMAIL);
            $this->password = strip_tags(htmlspecialchars($_REQUEST['password']));
            $this->confirm = strip_tags(htmlspecialchars($_REQUEST['confirm']));
            $this->hashed = password_hash($this->password, PASSWORD_DEFAULT);

            if(empty($this->firstname) || empty($this->surname) || empty($this->email) || empty($this->password) || empty($this->confirm) || $this->password != $this->confirm)
            {
                echo "A part of the form is not complete or incorrect.";
            } else {
                try {
                    $this->row = $this->select('email', 'users', ['email' => $this->email]);
                    if($this->row[0]['email'] == $this->email)
                    {
                        echo "User already exists";
                    } else
                    {
                        $this->sql = $this->connection->prepare("INSERT INTO USERS (firstname, lastname, email, password, createdAt, ip_address, confirmation_code) VALUES (:firstname, :lastname,:email, :password, :createdAt, :ip_address, :confirm_code)");
                        $this->sql->execute([
                            ':firstname' => $this->firstname,
                            ':lastname' => $this->surname,
                            ':email' => $this->email,
                            ':password' => $this->hashed,
                            ':createdAt' => date('Y-m-d H:i:s'),
                            ':ip_address' => filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP),
                            ':confirm_code' => bin2hex(random_Bytes(20))
                        ]);
                        $mailer = new Mail;
                        $mailer->registerMail('qrow@qrow.dev','noreply',"{$_POST['email']}");
                        header('location: login.php');
                    }
                } catch(PDOException $err)
                {
                    echo $err;
                }
            }
        }
    }
}

?>