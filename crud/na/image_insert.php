<?php
include_once 'dbConfig_2.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    
       
    // File upload configuration
    $targetDir = "uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
	
	$files = $_POST['files'];
	$status_ = $_POST['status_'];
	$name = $_POST['name'];
	$comments = $_POST['comments'];
	$area = $_POST['area'];
	$user = $_POST['user'];
	
	


	//$status_ = 'Amber';
	//$name = 'name';
	//$comments = 'c';
	//$area = 'area';
	//$user = 'user';
	
    if(!empty(array_filter($_FILES[$files][$name]))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES[$files][$name][$key]);
            $targetFilePath = $targetDir . $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES[$files]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL .= "(NULL,'".$fileName."', NOW(), '$targetFilePath', '$name' , '$status_', '$comments', '$area', '$user')";
                }else{
                    $errorUpload .= $_FILES[$files][$name][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES[$files][$name][$key].', ';
            }
        }
        
        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');
            // Insert image file name into database
            $insert = $db->query("INSERT INTO `images_web` (`id`, `file_name`, `uploaded_on`, `url`, `name`,`Status_`, `Comments`, `Area`, `User` ) VALUES  $insertValuesSQL ");
            if($insert){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
				echo $insertValuesSQL;
            }
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
    
    // Display status message
    echo $statusMsg;
	echo $insertValuesSQL;
}
?>