<?php
/*
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
*/
  include_once './config/database.php';
 
  $database = new Database;
  $db = $database->getConnection();
  
  $_POST = json_decode(file_get_contents('php://input'), true);
  
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];

  $query = "Select VT.Make, VT.Model, VT.Year, P.DateOfPurchase, Count(*) as Count, sum(P.SalePrice-C.Cost) as Profit From Purchase as P, Car as C, `Vehicle Type` as VT 
		Where P.DateOfPurchase >= '".$startDate."' AND P.DateOfPurchase <= '".$endDate."' and P.CarID = C.CarID and C.VID = VT.VID Group by VT.Model, VT.Make, VT.Year, P.DateOfPurchase;";
 
  $stmt = $db->prepare($query);
  $result = $stmt->execute();
  if(result)
  {
    $user_arr[]= array(
    "status" => "Successful Select"
    );
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $user_arr[]=$row;
    }
  }
  else
  {
    $user_arr = array(
    "status" => "Unsuccessful Select"
    );
  }

  print_r(json_encode($user_arr, JSON_PRETTY_PRINT));

?>