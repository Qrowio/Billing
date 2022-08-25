<?php
declare(strict_types=1);

class Confirm extends Database
{
    private array $row;

    public function __construct()
    {
        parent::__construct();
        if(isset($_REQUEST['code']))
        {
            $code = htmlspecialchars($_REQUEST['code']);
            $this->row = $this->select('*', 'users', ['confirmation_code' => $code]);
            if($this->row[0]['confirmed'] == 1)
            {
                header("location: login.php");
            } else {
                if($code == $this->row[0]['confirmation_code'])
                {
                    $this->statement = $this->connection->prepare("UPDATE users SET confirmed = 1 WHERE confirmation_code = :code");
                    $this->statement->execute([':code' => $code]);
                    header("refresh:5;url=login.php");
                } else
                {
                    header("location: login.php");
                }
            }
        } else
        {
            header("location: login.php");
        }
    }
}