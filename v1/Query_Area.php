<?php 
include_once 'dbconfig.php';

 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $mysqli->prepare("SELECT Area FROM Shop_Area ORDER BY Area ;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($Area);
 
 $fields = array(); 
 
 //loop through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['Area'] = $Area; 
 array_push($fields, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($fields);