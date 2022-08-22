<?php

class Database
{
    protected PDO $connection;
    const ip = 'localhost';
    const name = 'billing';
    const username = 'root';
    const password = '';
    private $row;
    private PDOStatement $sql;
    private $id;
    private $email;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=".self::ip.";",self::username,self::password);
            $this->connection->exec('CREATE DATABASE IF NOT EXISTS ' . self::name);
            $this->connection->exec("use ". self::name);
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
                confirmation_code VARCHAR(100),
                ip_address VARCHAR(50),
                is_banned INT(11) DEFAULT 0,
                is_admin INT(11) DEFAULT 0
            )");
            
            $this->connection->exec("CREATE TABLE IF NOT EXISTS main(
                brand_name VARCHAR(255) NOT NULL DEFAULT 'Ethereal',
                brand_logo TEXT NULL,
                smtp_host TEXT NOT NULL,
                smtp_username TEXT NOT NULL,
                smtp_password TEXT NOT NULL,
                smtp_port TEXT NOT NULL
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

        } catch(PDOException $err)
        {
            echo $err;
        }
    }

    public function select(string $column, string $table, array $where = []) : array
    {
        try 
        {
            if(empty($column) || empty($table))
            {
                return array();
            } else
            {   
                if(!empty($where))
                {
                    $string;
                    foreach($where as $key => $val)
                    {
                        $string = $key . ' = :' . $key;
                    }
    
                    $this->statement = $this->connection->prepare("SELECT $column FROM $table WHERE $string");
    
                    foreach($where as $key => $val)
                    {
                        $this->statement->bindValue(":" . $key, $val);
                    }
                }

                if(empty($where))
                {
                    $this->statement = $this->connection->prepare("SELECT $column FROM $table");
                }
                $this->statement->execute();
                return $this->statement->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $error) {
            echo $error;
        }
    }
}