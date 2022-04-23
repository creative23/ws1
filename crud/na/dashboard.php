<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shopfloor Metrics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></scriptjavascript:void(0);>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	
	body, html {	
    height: 100%;
    
	}
	
	.container {
  position: relative;
  margin: 3% auto;
  width: 50%;
}



.container .content {
  position: absolute;
  bottom: 0;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 1); /* Black background with 0.5 opacity */
  color: #f1f1f1;
  width: 100%;
  padding: 5px;
}
  
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}

    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #000000;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
	  	 
    }
	
	.column {
    float: left;
    width: 25%;
    padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
    content: "";
    clear: both;
    display: table;
}


	
  </style>
  
</head>

<script> 
$(function(){
  $("#header").load("header.html"); 
  $("#footer").load("footer.html");   
});
</script>

<body>



<div id="header">
</div>

<div class="container"> 
		  <div class="content">  
				<center>	
					<h1>Data Collection on a Mobile Device</h1>   
				</center>
		  </div>	  
</div>

<div class="row">
    <div class="col-sm-12">
		<center>	
			<h1>Data Collection on a Mobile Device</h1>
		</center>	
    </div>
  </div>

<center>
	<div class="container-fluid">
	  <div class="row content">
	   
		<br>
		
		<div class="col-sm-12">
		  <div class="well">
			<h4>Dashboard</h4>
			<p>You are logged in as:...........</p>
		  </div>
		  
		  <div class="row">
			<div class="col-sm-3">
			  <div class="well">
				<h4>Users</h4>
				<p>1 Million</p> 
			  </div>
			</div>
			<div class="col-sm-3">
			  <div class="well">
				<h4>Pages</h4>
				<p>100 Million</p> 
			  </div>
			</div>
			<div class="col-sm-3">
			  <div class="well">
				<h4>Sessions</h4>
				<p>10 Million</p> 
			  </div>
			</div>
			<div class="col-sm-3">
			  <div class="well">
				<h4>Bounce</h4>
				<p>30%</p> 
			  </div>
			</div>
		  </div>
		  
		  <div class="row">
			<div class="col-sm-4">
			  <div class="well">
			   <h4>Performance</h4>
				<p>RFT: 60</p> 
				<p>Scrap: 20</p> 
				<p>Rework: 25</p> 
			  </div>
			</div>
			<div class="col-sm-4">
			  <div class="well">
			   <h4>Logistics</h4>
				<p>Text</p> 
				<p>Text</p> 
				<p>Text</p> 
			  </div>
			</div>
			<div class="col-sm-4">
			  <div class="well">
			   <h4>Actions</h4>
				<p>Open</p> 
				<p>Closed</p> 
				<p></p> 
			  </div>
			</div>
		  </div>
		  
		  <div class="row">
			<div class="col-sm-8">
			  <div class="well">
				<p>Text</p> 
			  </div>
			</div>
			<div class="col-sm-4">
			  <div class="well">
				<p>RFT:  10</p> 
			  </div>
			</div>
		  </div>
		  
		  
		</div>
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
