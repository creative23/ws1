<?php
//include database configuration file
include_once 'db.php';

//$db = new mysqli('localhost', 'root', '', 'tg');

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory

if(!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image'])
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

// can upload same image using rand function
$final_image = rand(1000,1000000).$img;

// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 

if(move_uploaded_file($tmp,$path)) 
{
echo "<img src='$path' />";
	$name = $_POST['name'];
	$email = $_POST['email'];
	
	$status_ = $_POST['status_'];
	$name = $_POST['name'];
	$comments = $_POST['comments'];
	$area = $_POST['area'];
	$user = $_POST['user'];
	


$insertValuesSQL .= "(NULL,'".$fileName."', NOW(), '$targetFilePath', '$name' , '$status_', '$comments', '$area', '$user')";

//insert form data in the database
$insert = $db->query("INSERT INTO `images_web` (`id`, `file_name`, `uploaded_on`, `url`, `name`,`Status_`, `Comments`, `Area`, `User` ) VALUES $insertValuesSQL ");

//echo $insert?'ok':'err';
}
} 
else 
{
echo 'invalid';
}
}
?>