<?php

  class Database{
  
    private $host = "sql2.njit.edu";
    private $db_name = "aa2296";
    private $username = "aa2296";
    private $password = 'phpMyAdmin$444';
    public $conn;
    
    public function getConnection()
    {
      $this->conn = null;
      
      try{
        $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
        $this->conn->exec("set names utf8");
      }
      catch(PDOEcception $e){
        echo "Connection error: ".$e->getMessage();
      }
      return $this->conn;
    
    }
  }
?>