<?php 
include_once 'dbconfig.php';
 

 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $mysqli->prepare("SELECT Team_Leader FROM TeamLeader ORDER BY Team_Leader ;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($TeamLeader);
 
 $fields = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['TeamLeader'] = $TeamLeader; 
 array_push($fields, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($fields);