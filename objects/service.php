 <?php

  class Service{
    private $conn;
    private $PID;
    private $bill;
    
    public $AID;
    
    public function __construct($db)
    {
      $this->conn = $db;
    }
    
    public function createBill()
    {
    
      //Get Name
      $query = "Select c.Fname, c.Lname FROM Customer c, `Service Appointment` s Where c.CID = s.CID AND s.AID = ".$this->AID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->firstName = $result['Fname'];
      $this->lastName = $result['Lname'];
      $this->bill = array("FirstName" => $this->firstName);
      $this->bill["LastName"]= $this->lastName;
      
      //Get PID
      $query = "Select PID FROM `Service Appointment` Where AID = ".$this->AID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->PID= $result['PID'];
     
      //Get PParts and BillP
      $query = "Select Distinct p.PartName as Name, p.CostOfPart as Cost FROM Part p, PPart pp Where pp.PartID = p.PartID AND pp.PID =".$this->PID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      
      $this->pparts = array();
      
      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $this->pparts[] = $result;
      }
      
      $query = "Select Distinct p.PartName as Name, p.CostOfPart as Cost FROM Part p, BillP b Where b.PartID = p.PartID AND b.AID =".$this->AID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      
      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $this->pparts[] = $result;
      }
      $this->bill["Parts"] = $this->pparts;
      
      
      //Get PTask and BillT
      $query = "Select Distinct t.TestName as Name, t.LabourCost as Cost FROM Test t, PTask p Where p.TestID = t.TestID AND p.PID =".$this->PID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      
      $this->tasks = array();
      
      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $this->tasks[] = $result;
      }
   
      $query = "Select Distinct t.TestName as Name, t.LabourCost as Cost FROM Test t, BillT p Where p.TestID = t.TestID AND p.AID =".$this->AID;
     
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      
      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $this->tasks[] = $result;
      }
     
      $this->bill["Tasks"] = $this->tasks;
      
      //get total cost of parts
      $query = "Select sum(p.CostOfPart) as Cost FROM Part p, PPart pp Where pp.PartID = p.PartID AND pp.PID = ".$this->PID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->partsC= $result['Cost'];
      
      $query = "Select sum(p.CostOfPart) as Cost FROM Part p, BillP pp Where pp.PartID = p.PartID AND pp.AID = ".$this->AID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->partsC = $result['Cost'] + $this->partsC;
      
      $this->bill["PartsCost"] = $this->partsC;
      
      //get total cost of tests
      $query = "Select sum(t.LabourCost) as Cost FROM Test t, PTask pp Where pp.TestID = t.TestID AND pp.PID = ".$this->PID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->TestC = $result['Cost'];
      
      $query = "Select sum(t.LabourCost) as Cost FROM Test t, BillT pp Where pp.TestID = t.TestID AND pp.AID = ".$this->AID;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->TestC = $result['Cost'] + $this->TestC;
      
      $this->bill["TestCost"] = $this->TestC;
      
      $this->bill["TotalCost"] = $this->TestC + $this->partsC;
      
      return $this->bill;
    }
    
  }
?>