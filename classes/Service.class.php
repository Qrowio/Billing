<?php
declare(strict_types = 1);

class Service extends Database
{
    
    public function __construct()
    {
        parent::__construct();
        $services = $this->select('*', 'services', ['user' => $_SESSION['client']['id']]);

        foreach($services as $service){
            if($service['expireAt'] <= date("Y-m-d") && $service['status'] != 'Terminated'){
                $this->sql = $this->connection->prepare("UPDATE services SET status = 'Terminated' WHERE id = :id");
                $this->sql->execute([':id' => $service['id']]);
                header("Refresh:0");
            } else if ($service['expireAt'] >= date("Y-m-d")) {
                $this->sql = $this->connection->prepare("UPDATE services SET status = 'Active' WHERE id = :id");
                $this->sql->execute([':id' => $service['id']]);
            }
        }
    }

    public function serviceInfo()
    {
        $this->user = $this->select('user', 'services', ['id' => strip_tags($_REQUEST['id'])]);
        if($this->user[0]['user'] == $_SESSION['client']['id']){
            return $this->select('*', 'services', ['id' => strip_tags($_REQUEST['id'])]);
        } else {
            header('location: services.php');
        }
    }
}