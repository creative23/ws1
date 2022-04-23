<?php 

	require_once 'dbDetails.php';
	//require_once 'dbConfig.php';
	
	
	
	$upload_path = 'uploads/';
	
	//Getting the server ip 
	$server_ip = gethostbyname(gethostname());
		
	//creating the upload url 
	//$upload_url = 'http://192.168.1.11:80/AndroidUploadImage/'.$upload_path; 
	$upload_url = 'http://192.168.1.11:80/ws/crud/'.$upload_path; 
	//OR
	//Local Path
	//$upload_url = $upload_path; 
	
	
	
	//WlvLinuxURL Path
	//$upload_url = 'http://mi-linux.wlv.ac.uk/~1523649/crud/'.$upload_path;
	
	//Accessible (example)
	//http://mi-linux.wlv.ac.uk/~1523649/crud/uploads/28.jpg
	
	
	

	$response = array(); 
	
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
	
		if(isset($_POST['name']) and isset($_FILES['image']['name'])){
			
			
			$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
			
			
			$name = $_POST['name'];
			
			
			$fileinfo = pathinfo($_FILES['image']['name']);
			
			
			$extension = $fileinfo['extension'];
			
			
			$file_url = $upload_url . getFileName() . '.' . $extension;
			
			
			$file_path = $upload_path . getFileName() . '.'. $extension; 
			
			
			$filename = getFileName() . '.'. $extension;  
			
			
			try{
				
				move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
				
				$sql = "INSERT INTO `images_web` (`id`, `file_name`, `uploaded_on`,  `url`, `name`) VALUES (NULL, '$filename', NOW(),'$file_url', '$name' );";
				
			
				if(mysqli_query($con,$sql)){
					
					 
					$response['error'] = false; 
					$response['url'] = $file_url; 
					$response['name'] = $name;
				}
	
			}catch(Exception $e){
				$response['error']=true;
				$response['message']=$e->getMessage();
			}		
			
			echo json_encode($response);
			
			 
			mysqli_close($con);
		}else{
			$response['error']=true;
			$response['message']='Please choose a file';
		}
	}
	
	function getFileName(){
		$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
		$sql = "SELECT max(Id) as id FROM images_web";
		$result = mysqli_fetch_array(mysqli_query($con,$sql));
		
		mysqli_close($con);
		if($result['id']==null)
			return 1; 
		else 
			return ++$result['id']; 
	}