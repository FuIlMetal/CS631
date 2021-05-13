<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include_once './config/database.php';
  include_once './objects/customer.php';
  include_once './objects/car.php';
  include_once './objects/service.php';
  
  $database = new Database;
  $db = $database->getConnection();
  $apt_table = "Service Appointment";
  
  $customer = new Customer($db);
  $car = new Car($db);
  $service = new Service($db);
  
  $_POST = json_decode(file_get_contents('php://input'), true);
  $customer->fname = $_POST["fname"];
  $customer->lname = $_POST["lname"];
  $customer->email = $_POST["email"];
 
  //make car object and take in model, make, year, color
  
  $car->color = $_POST["color"];
  $car->make = $_POST["make"];
  $car->model = $_POST["model"];
  $car->year = $_POST["year"];
  
  $service->SDropOff = $_POST["dropOff"];
  
  if(!$customer->checkIfExist())
  {
    $customer->registerCustomer();
  }

  $CID = $customer->CID;
  
  $car->findCar();
  $CarID = $car->CarID;
  
  //figure out pickup date
  $query = "SELECT timestampdiff(year, current_date, dateOfPurchase) AS TimeDiff from Purchase WHERE CID = '".$CID."' AND CarID = '".$CarID."'";
  echo $query;
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $time = $result['TimeDiff'];
  
  //figure out PID
  if($time > 3)
    $time = 3;
    
  $query = "SELECT PID from `Service Package` WHERE TimeSincePurchased = ".$time;
  echo $query."\n";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $PID = $result['PID'];
  
  //figure out pickupp date
  
  
  $query = "INSERT INTO `".$apt_table."` SET ScheduledDropOff='".$service->SDropOff."', AppMadeDate= current_date, CID='".$CID."', CarID='".$CarID."', PID = ".$PID;
  echo $query;
  $stmt = $db->prepare($query);
  $result = $stmt->execute();
  $AID = $db->lastInsertId();
  
  if(result)
  {
      $user_arr = array(
        "status" => "Successful Appointment",
        "AID" => $AID
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