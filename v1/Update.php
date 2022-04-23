<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

include 'DatabaseConfig.php';

 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

	$Id = $_POST['Id'];
	$TeamLeader = $_POST['TeamLeader']; 
	$Area = $_POST['Area']; 
	$Issue = $_POST['Issue'];
	$Date_Required = $_POST['Date_Required']; 
	$Comment = $_POST['Comment']; 		
	$Champion = $_POST['Champion'];
	$Status = $_POST['Status'];

$Sql_Query = "UPDATE Team SET TeamLeader= '$TeamLeader', Area = '$Area', Issue = '$Issue', Date_Required= '$Date_Required', Comment = '$Comment', Champion = '$Champion', Status = '$Status' WHERE id = $Id";

 if(mysqli_query($con,$Sql_Query))
{
 echo 'Record Updated Successfully';
}
else
{
 echo 'Something went wrong';
 }
 }
 mysqli_close($con);
?>