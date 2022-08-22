<?php

class CPanel extends Database {
    private $curl;
    private $header;
    private $username;
    private $api;
    private $link;
    private $result;
    private $decode;
    private $domain;
    private $bandwidth;

    function __construct() {
        parent::__construct();
        $this->sql = $this->connection->prepare("SELECT domain FROM services WHERE id = :id");
        $this->sql->execute([':id' => $_REQUEST['id']]);
        $this->row = $this->sql->fetch();
        $this->domain = $this->row['domain'];
        
        $this->sql = $this->connection->prepare("SELECT * FROM modules WHERE module_name = :module_name");
        $this->sql->execute([':module_name' => 'cpanel']);
        $this->row = $this->sql->fetch();

        if($this->row){
            $this->api = $this->row['api_key'];
            $this->username = $this->row['module_username'];
            $this->curl = curl_init();
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST,0);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,1);
            $this->header[0] = "Authorization: WHM $this->username:" . preg_replace("'(\r|\n)'","",$this->api);
            curl_setopt($this->curl,CURLOPT_HTTPHEADER,$this->header);
            if ($this->result == false) {
                error_log("curl_exec threw error \"" . curl_error($this->curl) . "\" for $this->link");
            }   
        }
    }

    function requestInfo() {
        $this->link = $this->row['module_link'] . "accountsummary?domain={$this->domain}";
        curl_setopt($this->curl, CURLOPT_URL, $this->link);
        $this->result = curl_exec($this->curl);
        if($this->result == ""){
            header("location: services.php");
            // Put better error later.
        } else {
            $this->decode = json_decode($this->result, true);
        }
        return $this->decode;
    }

    function bandwidth() {
        $this->link = $this->row['module_link'] . "showbw?search={$this->domain}&searchtype=domain";
        curl_setopt($this->curl, CURLOPT_URL, $this->link);
        $this->result = curl_exec($this->curl);
        $this->bandwidth = json_decode($this->result, true);
        return $this->bandwidth;
    }
}

?>