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
	$TeamLeader = $_POST['TeamLeader']; 
	$Area = $_POST['Area']; 
	$Issue = $_POST['Issue'];
	$Date_Required = $_POST['Date_Required']; 
	$Comment = $_POST['Comment']; 
	$Champion = $_POST['Champion'];
	$Qty = $_POST['Qty'];	
	$Status = $_POST['Status'];

	//creating a statement to insert to database 
	$stmt = $mysqli->prepare("INSERT INTO Team (TeamLeader, Area, Issue, Date_Required, Comment, Champion, Qty, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	
	//binding the parameter to statement 
	$stmt->bind_param("ssssssss", $TeamLeader, $Area, $Issue, $Date_Required, $Comment, $Champion, $Qty, $Status);
	
	//if data inserts successfully
	if($stmt->execute()){
		//making success response 
		$response['error'] = false; 
		$response['message'] = 'Record saved successfully';
		//echo 'Record Inserted Successfully';			
	}else{
		//if not making failure response 
		$response['error'] = true; 
		$response['message'] = 'Please try later';
		
	}
	
}else{
	echo json_encode($response);
	$response['error'] = true; 
	$response['message'] = "Invalid request"; 
	echo 'Something went wrong';
	
	
}

//displaying the data in json format 
echo json_encode($response);
