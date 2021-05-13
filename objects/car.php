<?php

  class Car{
    private $conn;
    private $table_name = "Car";
    private $vehicle_type = '`Vehicle Type`';
    
    public $CarID;
    public $cost;
    public $color;
    public $make;
    public $model;
    public $year;
    
    public function __construct($db)
    {
      $this->conn = $db;
    }
    
    public function findCar()
    {
      $query = "Select * FROM ".$this->table_name." WHERE Color='".$this->color."' AND VID in (Select VID FROM ".$this->vehicle_type." WHERE Model = '".$this->model."' AND Year = ".$this->year." AND Make = '".$this->make."')";
      $stmt = $this->conn->prepare($query);
    
      $stmt->execute();
      if($stmt->rowCount()>0)
      { 
        $result = $stmt->fetch();
        $this->CarID = $result['CarID'];
        return true;
      }
      return false;
    }
    
 
    
  }
?>