<?php

  class Service{
    private $conn;
    private $bill_table = "Bill";
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
      $result = $stmt->execute();
      if(result)
        return true;
      else
        return false;
    }
    
  }
?>