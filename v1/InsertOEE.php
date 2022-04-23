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
	$Shift_Length = $_POST['Shift_Length']; 
	$Breaks = $_POST['Breaks']; 
	$Down_Time = $_POST['Down_Time'];
	$Cycle_Time = $_POST['Cycle_Time']; 
	$Scrap_Count = $_POST['Scrap_Count'];
	$Good_Parts = $_POST['Good_Parts'];
	$Total_Count = $_POST['Total_Count']; 
	$Availability = $_POST['Availability']; 
	$Performance = $_POST['Performance'];
	$Quality = $_POST['Quality'];
	$OEE_Value = $_POST['OEE_Value']; 


	
	//creating a statement to insert to database 
	$stmt = $mysqli->prepare("INSERT INTO OEE (`Shift_Length`, `Breaks`, `Down_Time`, `Cycle_Time`, `Scrap_Count`, `Good_Parts`, `Total_Count`, `Availability`, `Performance`, `Quality`, `OEE_Value`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	
	//binding the parameter to statement 
	$stmt->bind_param("sssssssssss", $Shift_Length, $Breaks, $Down_Time, $Cycle_Time, $Scrap_Count, $Good_Parts , $Total_Count, $Availability, $Performance, $Quality, $OEE_Value);
	
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
	echo json_encode($response);
	$response['error'] = true; 
	$response['message'] = "Invalid request"; 
	
	
	
}

//displaying the data in json format 
echo json_encode($response);
