<?php
/*
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
*/
  include_once './config/database.php';
  include_once './objects/customer.php';
  include_once './objects/car.php';
  
  $database = new Database;
  $db = $database->getConnection();
  
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
  
  $SalePrice = $_POST["salePrice"];
  
  if(!$customer->checkIfExist())
  {
    $customer->registerCustomer();
  }

  $CID = $customer->CID;
  //create sale now with CID and VID
  
  if($car->findCar())
  {
    $query = "Insert into Purchase Set DateOfPurchase = current_date, CID = ".$CID.", CarID = ".$car->CarID.", SalePrice = ".$SalePrice;
    $stmt = $db->prepare($query);
    $result = $stmt->execute();
    $TID = $db->lastInsertId();
    if(result)
    {
      $user_arr = array(
        "status" => "Successful Sale"
        );
    }
    else
    {
      $user_arr = array(
        "status" => "Unsuccessful Sale"
        );
    }
  }
  else
  {
    $user_arr = array(
        "status" => "Car does not exist"
        );
  }
   
  print_r(json_encode($user_arr, JSON_PRETTY_PRINT));

  
?>