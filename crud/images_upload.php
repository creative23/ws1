<?php
include_once 'dbconfig.php';
session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='http://mi-linux.wlv.ac.uk/~1523649/crud/login.php';</script>";	
}



?>

<html>
<head lang="en">
<meta charset="utf-8">
<title>Upload an Image</title>

<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>

<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html");   
});
</script>
</head>

<body>

<div id="header">
</div>
<div class="row">
    <div class="col-sm-12">
		<center>
		
	<h1>Upload an Image</h1>  
		
		</center>	
    </div>
  </div>

<div class="container">
	
	<div class="row">
 
	<div class="col-md-8">
 

 
	<form id="form" action="upload_web.php" method="post" enctype="multipart/form-data">
	
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
		</div>
		
			 
		 <div class="form-group">
			<label for="name">Comments</label>
			<input type="text" class="form-control" id="comments" name="comments" placeholder="Enter comments" required />
		</div>
		
		<div class="form-group">
			<label for="email">Area</label>
			<input type="text" class="form-control" id="area" name="area" placeholder="Enter area" required />
		</div>
		 
		<div class="form-group">
			<label for="email">User</label>
			<input type="text" class="form-control" id="user" name="user" value=<?php echo $_SESSION["mail"]; ?> placeholder="Enter user" required />
		</div>	
		
		<div class="form-group">
						<label class="radio-inline">
						  <input type="radio" name="status_" checked  value="Red"  > <p><font color="Red">Red</font></p>
						</label>
						<label class="radio-inline">
						  <input type="radio" name="status_" value="Amber" ><p><font color="orange">Amber</font></p>
						</label>
						<label class="radio-inline">
						  <input type="radio" name="status_" value="Green" ><p><font color="green">Green</font></p>
						</label>
		</div>	
			
		<input id="uploadImage" type="file" accept="image/*" name="image" />
			<div id="preview"><img src="filed.png" /></div><br>
		
		<center>
				<input class="btn btn-success" type="submit" value="Upload">
		</center>
	</form>
 
	<div id="err"></div>
	<hr>

	</div>
	</div>
</div>

<br>
<br>
<br>

<center>
	<div class="col-sm-3 col-md-12 ">	
		<?php include 'footer.php';?>		
	</div>
</center>

</div></body></html>



<script>
$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
   url: "upload_web.php",
   type: "POST",
   data:  new FormData(this),
   contentType:false,
         cache:false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {
    if(data=='invalid')
    {
     // invalid file format.
     $("#err").html("Invalid File !").fadeIn();
    }
    else
    {
     // view uploaded file.
     $("#preview").html(data).fadeIn();
     $("#form")[0].reset(); 
    }
      },
     error: function(e) 
      {
    $("#err").html(e).fadeIn();
      }          
    });
 }));
});

</script>

