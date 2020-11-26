<?php

class Database{
    
 private $host = "fdb28.awardspace.net";
 private $db_name = "3552748_ggp";
 private $username = "3552748_ggp";
 private $password = "kepoajalu1851";
 public $conn;
 
	public function getConnection(){
 
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>