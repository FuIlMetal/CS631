<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include_once './config/database.php';
  include_once './objects/customer.php';
  include_once './objects/car.php';
  
  $database = new Database;
  $db = $database->getConnection();
  $apt_table = "Service Appointment";
  
  $customer = new Customer($db);
  $car = new Car($db);
  
  $_POST = json_decode(file_get_contents('php://input'), true);
  $customer->fname = $_POST["fname"];
  $customer->lname = $_POST["lname"];
  $customer->email = $_POST["email"];
 
  //make car object and take in model, make, year, color
  
  $car->color = $_POST["color"];
  $car->make = $_POST["make"];
  $car->model = $_POST["model"];
  $car->year = $_POST["year"];
  
  $dropOff = $_POST["dropOff"];
  
  if(!$customer->checkIfExist())
  {
    $customer->registerCustomer();
  }

  $CID = $customer->CID;
  
  $car->findCar();
  $CarID = $car->CarID;
  
  //figure out pickup date
  $query = "SELECT timestampdiff(year, current_date, dateOfPurchase) AS TimeDiff from Purchase WHERE CID = '".$CID."' AND CarID = '".$CarID."'";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $time = $result['TimeDiff'];
  
  //figure out PID
  if($time > 3)
    $time = 3;
    
  $query = "SELECT PID from `Service Package` WHERE TimeSincePurchased = ".$time;
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $PID = $result['PID'];
  
  //figure out pickupp date
  $query = "Select sum(t.Time) as sum From Test t, PTask p Where p.PID = ".$PID." AND p.TestID = t.TestID";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $time = $result['sum'];
  $query = "Select date_add('".$dropOff."', interval ".$time." hour) as pickup";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $pickup = $result['pickup'];
  
  $query = "INSERT INTO `".$apt_table."` SET ScheduledDropOff='".$dropOff."', AppMadeDate= current_date, CID='".$CID."', CarID='".$CarID."', PID = ".$PID.", PickupDate = '".$pickup."'";
  echo $query;
  $stmt = $db->prepare($query);
  $result = $stmt->execute();
  $AID = $db->lastInsertId();
  
  if(result)
  {
      $user_arr = array(
        "status" => "Successful Appointment",
        "AID" => $AID,
        "Pickup" => $pickup
        );
  }
  else
  {
      $user_arr = array(
        "status" => "Unsuccessful Appointment"
        );
  }
 
  print_r(json_encode($user_arr, JSON_PRETTY_PRINT));

  
?>