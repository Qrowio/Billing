<?php
declare(strict_types=1);

class Settings extends Database
{
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $confirm;
    private array $row;
    protected PDOStatement $statement;

    public function __construct()
    {
        parent::__construct();
        if(isset($_POST['save']))
        {
            switch($_POST)
            {
                case isset($_POST['firstname']):
                    $this->firstname = filter_var($_POST['firstname'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH);
                case isset($_POST['lastname']):
                    $this->lastname = filter_var($_POST['lastname'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH);
                case isset($_POST['password']):
                    $this->password = strip_tags(htmlspecialchars($_POST['password']));
                case isset($_POST['confirm']):
                    $this->confirm = strip_tags(htmlspecialchars($_POST['confirm']));
            }

            if(!empty($_POST['email']))
            {
                $this->email = filter_var(strtolower($_POST['email']),FILTER_SANITIZE_EMAIL);
                $this->row = $this->select('email', 'users', ['email' => $this->email]);
                if(isset($this->row[0]['email']))
                {
                    echo "Email taken";
                } else
                {
                    $this->statement = $this->connection->prepare("UPDATE users SET firstname = case when '$this->firstname' <> '' then '$this->firstname' else firstname end, lastname = case when '$this->lastname' <> '' then '$this->lastname' else lastname end, email = case when '$this->email' <> '' then '$this->email' else email end WHERE email = :email");
                    $this->statement->execute([':email' => $_SESSION['client']['email']]);
                    if(isset($this->email))
                    {
                        $_SESSION['client']['email'] = $this->email;
                    }
                    header("Refresh: 0");
                }
            } else
            {
                $this->statement = $this->connection->prepare("UPDATE users SET firstname = case when '$this->firstname' <> '' then '$this->firstname' else firstname end, lastname = case when '$this->lastname' <> '' then '$this->lastname' else lastname end WHERE email = :email");
                $this->statement->execute([':email' => $_SESSION['client']['email']]);
                header("Refresh: 0");
            }
        }
    }
}