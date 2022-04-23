<?php
include_once 'dbconfig.php';



//checking the successful connection
if($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//making an array to store the response
$response = array(); 

//if there is a post request move ahead 
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	//getting the name from request 
	$part = $_POST['part']; 
	$failure = $_POST['failure']; 
	$status = $_POST['status'];
	$mysqldate = $_POST['mysqldate']; 
	$mysqltime = $_POST['mysqltime'];
	$month_ = $_POST['month_'];
	$wk_ = $_POST['wk_']; 
	

	//creating a statement to insert to database 
	$stmt = $mysqli->prepare("INSERT INTO faults2 (part, failure, status, Date_, Time_, Month_, Wk_) VALUES (?, ?, ?, ?, ?, ?, ?)");
	
	//binding the parameter to statement 
	$stmt->bind_param("sssssss", $part, $failure, $status, $mysqldate, $mysqltime, $month_ , $wk_);
	
	//if data inserts successfully
	if($stmt->execute()){
		//making success response 
		$response['error'] = false; 
		$response['message'] = 'Record saved successfully'; 
	}else{
		//if not making failure response 
		$response['error'] = true; 
		$response['message'] = 'Please try later';
	}
	
}else{
	//echo json_encode($response);
	$response['error'] = true; 
	$response['message'] = "Invalid request"; 
	
	
	
}

//displaying the data in json format 
echo json_encode($response);
