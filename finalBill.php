<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include_once './config/database.php';
  include_once './objects/service.php';
  
  $database = new Database;
  $db = $database->getConnection();
  
  $service = new Service($db);
  
  $_POST = json_decode(file_get_contents('php://input'), true);
 
  $service->AID = $_POST["AID"];

  $result = $service->createBill();
  
  print_r(json_encode($result, JSON_PRETTY_PRINT));

  
?>