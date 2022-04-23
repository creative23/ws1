<?php 
 
 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'tg');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT ID, Date, TeamLeader, Area, Issue, Date_Required, Comment, Champion, Status FROM Team ORDER BY ID ;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($ID, $Date, $TeamLeader, $Area, $Issue, $Date_Required, $Comment, $Champion, $Status);
 
 $fields = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['ID'] = $ID; 
 $temp['Date'] = $Date; 
 $temp['TeamLeader'] = $TeamLeader; 
 $temp['Area'] = $Area; 
 $temp['Issue'] = $Issue; 
 $temp['Date_Required'] = $Date_Required; 
 $temp['Comment'] = $Comment; 
 $temp['Champion'] = $Champion; 
 $temp['Status'] = $Status; 
 array_push($fields, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($fields);