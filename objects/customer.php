<?php

  class Customer{
    private $conn;
    private $table_name = "Customer";
    
    public $CID;
    public $fname;
    public $lname;
    public $email;
    
    public function __construct($db)
    {
      $this->conn = $db;
    }
    
    public function checkIfExist()
    {
      $query = "Select * FROM ".$this->table_name." WHERE Email='".$this->email."'";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      if($stmt->rowCount()>0)
      { 
        $result = $stmt->fetch();
        $this->CID = $result['CID'];
        return true;
      }
      return false;
    }
    
    
    public function registerCustomer()
    {
      $query = "INSERT INTO ".$this->table_name." SET Email='".$this->email."', Fname='".$this->fname."', Lname='".$this->lname."'";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $this->CID = $this->conn->lastInsertId();
      return true;
    
    }
    
  }
?>