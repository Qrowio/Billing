<?php
declare(strict_types=1);

class CPanel extends Database {
    private CurlHandle $curl;
    private array $header;
    private string $link;
    private string $result;
    private array $decode;
    private string $domain;

    public function __construct()
    {
        parent::__construct();
        $this->row = $this->select('domain', 'services', ['id' => htmlspecialchars($_GET['id'])]);
        $this->domain = $this->row[0]['domain'];
        $this->row = $this->select("*", 'modules', ['module_name' => 'cpanel']);

        if($this->row[0])
        {
            $this->curl = curl_init();
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST,0);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,1);
            $this->header[0] = "Authorization: WHM ". $this->row[0]['module_username'] . ":" . preg_replace("'(\r|\n)'","",$this->row[0]['api_key']);
            curl_setopt($this->curl,CURLOPT_HTTPHEADER,$this->header);
        }
    }

    public function requestInfo()
    {
        $this->link = $this->row[0]['module_link'] . "accountsummary?domain={$this->domain}";
        curl_setopt($this->curl, CURLOPT_URL, $this->link);
        $this->result = curl_exec($this->curl);
        if($this->result == ""){
            header("location: services.php");
        } else
        {
            $this->decode = json_decode($this->result, true);
        }
        return $this->decode;
    }

    public function bandwidth()
    {
        $this->link = $this->row[0]['module_link'] . "showbw?search={$this->domain}&searchtype=domain";
        curl_setopt($this->curl, CURLOPT_URL, $this->link);
        $this->result = curl_exec($this->curl);
        $this->decode = json_decode($this->result, true);
        return $this->decode;
    }
}

?>