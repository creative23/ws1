<?php
include_once 'dbconfig.php';
session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='http://mi-linux.wlv.ac.uk/~1523649/crud/login.php';</script>";	
}



?>

<!DOCTYPE html>
<html>
<body>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Android</title>
<!-- bootstrap-3.3.7 -->
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- JQUERY -->
<script type="text/javascript" language="javascript" src="jquery/jquery.js"></script>

</head>

<style>


img{
    max-width:350px;
    max-height:550px;
}



#images td, #images th {
    border: 3px solid #333;
    padding: 8px;
}

#images tr:nth-child(even){background-color: #f2f2f2;}

#images tr:hover {background-color: #ddd;}

#images th {
    padding-top: 12px;
    padding-bottom: 12px;
    align: "center";
    background-color: #333;
    color: white;
	
}

</style>

<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html");   
});
</script>

<div id="header">
</div>



  <div class="row">
    <div class="col-sm-12">
		<center>	
	<h1>Data Collection on a Mobile Device</h1>   
		</center>	
    </div>
  </div>
  
<center>
<div id="body">
	<div id="content">
    <table align="center" id="images" >
    
 
  
  <tr>
    <th><h3>Register and Login Screen</h3></th>
    <th><h3>Raise a Shopfloor Action</h3></th>
    <th><h3>Log a part</h3></th>
  </tr>
  
  <tr>
    <td><img src="register_login.gif" alt="register_login"></td>
    <td><img src="action.gif" alt="action"></td>
	<td><img src="part.gif" alt="part"> </td>
  </tr>
  
  <tr>
	
    <th ><h3>OEE Calculator</h3></th>
    <th><h3>Chat</h3></th>
    <th><h3>Send an Email</h3></th>
	
  </tr>
  
  <tr>
    <td><img src="oee.gif" alt="oee"></td>
    <td><img src="chat.gif" alt="chat"></td>
	<td><img src="email.gif" alt="email"> </td>
  </tr>
  
  
  <tr>
    <th><h3>Upload an Image</h3></th>
  </tr>
  
  <tr>
    <td><img src="image.gif" alt="image"></td>
  </tr>
  
</table>
    </div>
</div>
</center>

<center>
	<div class="col-sm-3 col-md-12 ">
	
		<?php include 'footer.php';?>
		
	</div>
</center>

</body>
</html>
