<?php

  class Service{
    private $conn;
    private $billt_table = "BillT";
    private $billp_table = "BillP";
    private $apt_table = "Service Appointment";
    private $parts = array();
    private $tests = array();
    
    public $BID;
    public $AID;
    public $CID;
    public $CarID;
    public $PID;
    public $AppMadeDate;
    public $SDropOff;
    public $ADropOff;
    public $Pickup;
    
    public function __construct($db)
    {
      $this->conn = $db;
    }
    
    public function createAppointment()
    {
      $query = "INSERT INTO `".$apt_table."` SET ScheduledDropOff='".$this->SDropOff."', AppMadeDate= current_date, CID='".$this->CID."', CarID='".$this->CarID."'";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $this->AID = $this->conn->lastInsertId();
      return true;
    }
    
  }
?>