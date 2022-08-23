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
            $this->row = $this->select('*', 'users', ['confirmation_code' => strip_tags($_REQUEST['code'])]);
            if($this->row[0]['confirmed'] == 1)
            {
                header("location: login.php");
            } else {
                if($_REQUEST['code'] == $this->row[0]['confirmation_code'])
                {
                    $this->statement = $this->connection->prepare("UPDATE users SET confirmed = 1 WHERE confirmation_code = :code");
                    $this->statement->execute([':code' => strip_tags($_REQUEST['code'])]);
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