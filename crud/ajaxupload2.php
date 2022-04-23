<?php
//include database configuration file
//include_once 'db.php';

$db = new mysqli('localhost', 'root', '', 'tg');

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory

if(!empty($_POST['name']) || !empty($_POST['status_']) || $_FILES['image'])
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

// can upload same image using rand function
$final_image = rand(1000,1000000).$img;

$filename = getFileName() . '.'. $ext; 

// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 

if(move_uploaded_file($tmp,$path))
//if (move_uploaded_file($_FILES['image']['tmp_name'],$path);	
{
echo "<img src='$path' />";

	//$name = $_POST['name'];
	//$email = $_POST['email'];
	
	
	$name = $_POST['name'];
	$comments = $_POST['comments'];
	$area = $_POST['area'];
	$user = $_POST['user'];
	$status_ = $_POST['status_'];


//$insertValuesSQL .= "(NULL,'".$path."', NOW(), '$path', '$name' , '$email', '$comments', '$area', '$user')";

//insert form data in the database
$insert = $db->query("INSERT INTO `images_web` (`id`, `file_name`, `uploaded_on`, `url`, `name`,`status_`, `Comments`, `Area`, `User` ) VALUES (NULL,'".$filename."', NOW(), '$path', '$name' , '$status_', '$comments', '$area', '$user')");

//echo $insert?'ok':'err';
}
} 
else 
{
echo 'invalid';
}
}

function getFileName(){
		$db = new mysqli('localhost', 'root', '', 'tg');
		$sql = "SELECT max(Id) as id FROM images_web";
		$result = mysqli_fetch_array(mysqli_query($db,$sql));
		
		mysqli_close($db);
		if($result['id']==null)
			return 1; 
		else 
			return ++$result['id']; 
	}

?>