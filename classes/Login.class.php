<?php
declare(strict_types=1);

class Login extends Database {
    private string $email;
    private string $password;
    private array $row;

    public function __construct()
    {
        if(isset($_POST['submit']))
        {
            parent::__construct();
            $this->email = filter_var(strtolower($_POST['email']),FILTER_SANITIZE_EMAIL);
            $this->password = strip_tags(htmlspecialchars($_POST['password']));
            if(empty($this->email) || empty($this->password))
            {
                echo "Please fill the form";
            } else
            {
                try
                {
                    $this->row = $this->select('*', 'users', ['email' => $this->email]);
                    if($this->row[0]['email'] == $this->email)
                    {
                        if(password_verify($this->password, $this->row[0]['password']))
                        {
                            if($this->row[0]['confirmed'] == 1 && $this->row[0]['is_banned'] == 0)
                            {
                                $_SESSION['client']['email'] = $this->row[0]['email'];
                                $_SESSION['client']['id'] = $this->row[0]['id'];
                                if($this->row[0]['is_admin'] == 1)
                                {
                                    $_SESSION['client']['admin'] = 1;
                                }
                                header('location: ../dashboard/index.html');
                            } else
                            {
                                echo "Your account is not activated or is banned";
                            }
                        }
                    } else
                    {
                        echo "Wrong information";
                    }
                } catch(PDOException $err)
                {
                    echo $err;
                }
            }
        }
    }
}