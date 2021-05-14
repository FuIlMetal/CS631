<?php
/*
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
*/
  include_once './config/database.php';
  
  $database = new Database;
  $db = $database->getConnection();
  $apt_table = "Service Appointment";
  
  
  $_POST = json_decode(file_get_contents('php://input'), true);
  
  $AID = $_POST["AID"];
  $dropOff = $_POST["dropOff"];
  
  //convert date to datetime
  $query = "SELECT convert('".$dropOff."', datetime) AS newTime";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $time = $result['newTime'];
  
  //update actual drop off
  $query = "UPDATE `Service Appointment` SET ActualDropOff = '".$time."' WHERE AID = ".$AID;
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  
  //update pickup date
  $query = "SELECT timediff(PickupDate, ScheduledDropoff) AS TimeDiff from `Service Appointment` WHERE AID = ".$AID;
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $ptime = $result['TimeDiff'];
  

  $query = "SELECT addtime('".$time."', '".$ptime."') AS newTime";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  $newTime = $result['newTime'];
  
  
  $query = "UPDATE `Service Appointment` SET PickupDate = '".$newTime."' WHERE AID = ".$AID;
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  
  if(result)
  {
      $user_arr = array(
        "status" => "Successful Update",
        "AID" => $AID,
        "Pickup" => $newTime
        );
  }
  else
  {
      $user_arr = array(
        "status" => "Unsuccessful Update"
        );
  }
 
  print_r(json_encode($user_arr, JSON_PRETTY_PRINT));

  
?>