<?php
include_once 'dbconfig.php';

session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}

?>

<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Raise an Action</title>
<!-- bootstrap-3.3.7 -->
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- JQUERY -->
<script type="text/javascript" language="javascript" src="jquery/jquery.js"></script>

<style>
* {
    box-sizing: border-box;
}

input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}
</style>
</head>

<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html");   
});
</script>

<body>

<div id="header">
</div>

<div id="server_response"><b>Server here.</b></div>


 <div class="row">
    <div class="col-sm-12">
		<center>
		
	<h1>Upload an Image</h1>  
		
		</center>	
    </div>
  </div>
  
  <div class="container">
  
  <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
    
	<div class="row">
     <div class="col-25">
        <label for="area">Area</label>
      </div>
      <div class="col-75">
        <select id="area" name="area">
          <option value="f55">F55</option>
          <option value="bentley">Bentley</option>
          <option value="ltc">LTC</option>
        </select>
      </div>
	 
    </div>
    
	<div class="row">
      <div class="col-25">
        <label for="issue">issue</label>
      </div>
      <div class="col-75">
        <select id="issue" name="issue">
          <option value="line stop">Line Stop</option>
          <option value="out of parts">Out of Parts</option>
   
        </select>
      </div>
    </div>
	
    <div class="row">
      <div class="col-25">
        <label for="champion">Champion</label>
      </div>
      <div class="col-75">
        <select id="champion" name="user">
          <option value="liam">Liam</option>
          <option value="lee">Lee</option>

        </select>
      </div>
    </div>
	
  
	<div class="row">
		  <div class="col-25">
			<label for="subject">Comments</label>
		  </div>
		  <div class="col-75">
			<textarea id="comments" name="comments" placeholder="Write something.." style="height:200px"></textarea>
		  </div>
		
   </div>
	
	
	
		<div class="row">	
		
			<div class="col-25">
					<label for="subject">Status</label>
			</div>
			
			<div class="col-75">	
					<label class="radio-inline">
					  <input type="radio" name="optradio" checked  value="Red"  > <p><font color="Red">Red</font></p>
					</label>
					<label class="radio-inline">
					  <input type="radio" name="optradio" value="Amber" ><p><font color="orange">Amber</font></p>
					</label>
					<label class="radio-inline">
					  <input type="radio" name="optradio" value="Green" ><p><font color="green">Green</font></p>
					</label>
					
				<p></p>
			</div>
		</div>		
	
	  <input type="file" name="files[]" multiple >	
	
  </form>
  
  <div class="row">
      <input type="submit"  id="submit_button">
  </div>
  
 
  
</div>



<center>
	<div class="col-sm-3 col-md-12 ">	
		<?php include 'footer.php';?>		
	</div>
</center>

</body>
</html>


<script>
$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "ajaxupload.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
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


