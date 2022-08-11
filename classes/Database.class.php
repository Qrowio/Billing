<?php

class Database {
    protected $connection;
    private $ip = 'localhost';
    private $name = 'billing';
    private $username = 'root';
    private $password = '';
    private $row;
    private $sql;
    private $id;
    private $email;

    function __construct() {
        try {
            $this->connection = new PDO("mysql:host={$this->ip};",$this->username,$this->password);
            $this->connection->exec("CREATE DATABASE IF NOT EXISTS $this->name");
            $this->connection->exec("use $this->name");
            $this->connection->exec("CREATE TABLE IF NOT EXISTS users(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255) NULL,
                lastname VARCHAR(255) NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(60) NOT NULL,
                createdAt VARCHAR(50) NOT NULL,
                services INT(11) DEFAULT 0,
                tickets INT(11) DEFAULT 0,
                invoices INT(11) DEFAULT 0,
                confirmed INT(11) DEFAULT 0,
                confirmation_code VARCHAR(50),
                ip_address VARCHAR(50),
                is_banned INT(11) DEFAULT 0
                is_admin INT(11) DEFAULT 0
            )");

            $this->connection->exec("CREATE TABLE IF NOT EXISTS packages(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                package_name VARCHAR(255) NOT NULL,
                package_price FLOAT NOT NULL,
                package_description TEXT,
                package_image TEXT
            )");

            $this->connection->exec("CREATE TABLE IF NOT EXISTS services(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                package_name VARCHAR(255) NOT NULL,
                createdAt VARCHAR(50) NOT NULL,
                expireAt VARCHAR(50) NULL,
                domain TEXT NOT NULL,
                user VARCHAR(255) NOT NULL,
                cpanel_username VARCHAR(255) NOT NULL,
                cpanel_password VARCHAR(255) NOT NULL,
                status VARCHAR(50) NOT NULL
            )");

            $this->connection->exec("CREATE TABLE IF NOT EXISTS modules(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                module_name VARCHAR(50) NOT NULL,
                module_link TEXT NOT NULL,
                module_username TEXT NOT NULL,
                api_key TEXT NOT NULL
            )");
        } catch(PDOException $err) {
            echo $err;
        }
    }

    function pullServices() {
        $this->sql = $this->connection->prepare("SELECT * FROM services WHERE user = :user");
        $this->email = $_SESSION['client']['email'];
        $this->sql->execute([':user' => $this->email]);
        return $this->sql;
    }

    function userInfo() {
        $this->sql = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $this->sql->execute([':email' => $this->email]);
        $this->row = $this->sql->fetch();
        return $this->row;
    }
    
    function serviceExpiry() {
        $this->sql = $this->connection->prepare("SELECT * FROM services WHERE user = :user");
        $this->email = $_SESSION['client']['email'];
        $this->sql->execute([':user' => $this->email]);
        $this->row = $this->sql->fetchAll();
        foreach($this->row as $row){
            $today = date("Y-m-d");
            $expire = $row['expireAt'];
            $expireid = $row['id'];
            if($expire <= $today && $row['status'] != 'Terminated'){
                $this->sql = $this->connection->prepare("UPDATE services SET status = 'Terminated' WHERE id = :id");
                $this->sql->execute([':id' => $expireid]);
                header("Refresh:0");
            } else if ($expire >= $today) {
                $this->sql = $this->connection->prepare("UPDATE services SET status = 'Active' WHERE id = :id");
                $this->sql->execute([':id' => $expireid]);
            }
        }
    }

    function servicePage() {
        $this->id = $_REQUEST['id'];
        $this->sql = $this->connection->prepare("SELECT user FROM services WHERE id = $this->id");
        $this->sql->execute();
        $this->row = $this->sql->fetch();
        if($this->row['user'] == $_SESSION['client']['email']){
            $this->sql = $this->connection->prepare("SELECT * FROM services WHERE id = $this->id");
            $this->sql->execute();
            return $this->sql;
        } else {
            header('location: services.php');
        }
    }
}