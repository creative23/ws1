<?php
include_once 'dbconfig.php';
ob_start();
error_reporting(0);

session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}

// connection
//$db_conx = mysqli_connect("localhost", "root", "", "tg");
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error("Our database server is down at the moment. :(");
    exit();
} 
//initialize variables
$months ='';

$RFTs = '';
$Reworks = '';
$Scraps = '';
$dates  = '';

//Get lists from db
//VIEW QUERY
$sql = mysqli_query($mysqli, "SELECT * FROM actionview");
while($row = mysqli_fetch_array($sql)){
	$Red	= $row['Red'];
	$Amber	= $row['Amber'];
	$Green	= $row['Green'];	
	$date	= $row['Date_'];
//	$date	=  date('D, M, Y', strtotime($row['Date_']));
	
	
	$dates = $dates.'"'.$date.'",';	
	$Reds = $Reds.$Red.',';
	$Ambers = $Ambers.$Amber.',';
	$Greens = $Greens.$Green.',';

}

//$dates = trim($dates, ",");
$Reds = trim($Reds, ",");
$Ambers = trim($Ambers, ",");
$Greens = trim($Greens, ",");

?>
<!DOCTYPE html>

<head>
  
  <html lang="en">
  <title>Action Metrics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
  
  <script
  
	
		
  src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
	
</script>

  
</head>


<style>
body {
  padding-top: 0px;
}

.with-margin {
  margin-bottom: 5px;
}

.spacer5 {
  height: 5px;
}


}

</style>

<style media="all">
#mytable td, #mytable th {
    border: 3px solid #333;
    padding: 3px;
	font-size:14px;
}

#mytable  tr:nth-child(even){background-color: #f2f2f2;}

#mytable tr:hover {background-color: yellow;}

#mytable th {
    padding-top: 6px;
    padding-bottom: 6px;
    text-align: left;
    background-color: #333;
    color: white;
	font-size:16px;
}

#mytable {   
    width: 0px;
    height:0px;
    overflow: auto;	
}
</style>

<script> 
$(function(){
  $("#header").load("header.php");
  
});
</script>




<body>

<!-- 
<h1>date <?php echo $dates; ?> </h1>
<h1>Reds <?php echo $Reds; ?> </h1>
<h1>Ambers <?php echo $Ambers; ?> </h1>
<h1>Greens <?php echo $Greens; ?> </h1>
 -->

<div id="header"></div>

<div class="container">

  <div class="row">
    <div class="col-sm-12">
		<center>	
			<h1>Actions Metrics</h1>
		</center>	
    </div>
  </div>
  
  	  <div class="row">
			
			<div class="col-sm-6 col-md-6 ">

				<div class="panel panel-default">
					
					<div class="panel-heading">
							 Line Chart Example
					</div>
				
					<div id="Pie">
						<div style="height:400px; width:400px; margin-top:3px; ">
								<center>	
									<canvas id="Chart1" ></canvas>
								</center>	
						</div>
					</div>
				
				</div>
			</div>			
			
			
				
			
				
			<div class="col-sm-6 col-md-6 ">

				<div class="panel panel-default">
					
					<div class="panel-heading">
							 Line Chart Example
					</div>
				
					<div id="Pie">
						<div >
								<center>	
									<canvas id="Chart2" ></canvas>
								</center>	
						</div>
					</div>
				
				</div>
			</div>
	  </div>
  
		
	  <div class="row">
    
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          <div class="content">Status Table</div>
				<br>
					<table  align="center" id="mytable2" class="table table-bordered" >
							<tr>							
							</tr>
								<th>Date</th>
								<th>Red</th>	  
								<th>Amber</th>	  
								<th>Green</th>	  
								<th>Total</th>	  
							</tr>							
							<?php							
							$sql_query="SELECT * FROM actionview";							
							$result_set = $mysqli->query($sql_query);													
							if(mysqli_num_rows($result_set)>0)
							{
								while($row=mysqli_fetch_array($result_set))
								{
								?>
									<tr>
										<td><?php echo $row[0]; ?></td>
										<td><?php echo $row[1]; ?></td>
										<td><?php echo $row[2]; ?></td>
										<td><?php echo $row[3]; ?></td>  										
										<td><?php echo $row[4]; ?></td>
									</tr>
								<?php
								}
							}
							else
							{
								?>
								<tr>
									<td colspan="5">No Data Found !</td>
								</tr>
								<?php
							}
							?>
						</table>
					
        </div>
      </div>     
    </div>
    
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          <div class="content">Area Table</div>
				<br>
						<table align="center" id="mytable2" class="table table-bordered" >
							<tr>							
							</tr>
								<th>Area</th>
								<th>Total</th>	  
							</tr>							
							<?php							
							$sql_query="SELECT * FROM areaview";							
							$result_set = $mysqli->query($sql_query);													
							if(mysqli_num_rows($result_set)>0)
							{
								while($row=mysqli_fetch_array($result_set))
								{
								?>
									<tr>
										<td><?php echo $row[0]; ?></td>
										<td><?php echo $row[1]; ?></td>           
									</tr>
								<?php
								}
							}
							else
							{
								?>
								<tr>
									<td colspan="5">No Data Found !</td>
								</tr>
								<?php
							}
							?>
						</table>
        </div>
      </div>      
    </div>
    
    <div class="col-sm-3"  >
      <div class="row" >
        <div class="col-sm-12">
          <div class="content">Champion Table</div>
				<br>
						<table align="center" id="mytable2" class="table table-bordered">
							<tr>							
							</tr>
								<th>Champion</th>
								<th>Total</th>	  
							</tr>							
							<?php							
							$sql_query="SELECT * FROM champview2";							
							$result_set = $mysqli->query($sql_query);													
							if(mysqli_num_rows($result_set)>0)
							{
								while($row=mysqli_fetch_array($result_set))
								{
								?>
									<tr>
										<td><?php echo $row[0]; ?></td>
										<td><?php echo $row[1]; ?></td>           
									</tr>
								<?php
								}
							}
							else
							{
								?>
								<tr>
									<td colspan="5">No Data Found !</td>
								</tr>
								<?php
							}
							?>
						</table>
        </div>
      </div>  
    </div>
    
        <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          <div class="content">Issue Table</div>
				<br>
						<table align="center" id="mytable2" class="table table-bordered" >
							<tr>							
							</tr>
								<th>Issue</th>
								<th>Total</th>	  
							</tr>							
							<?php							
							$sql_query=" SELECT * FROM `issueview` ";							
							$result_set = $mysqli->query($sql_query);													
							if(mysqli_num_rows($result_set)>0)
							{
								while($row=mysqli_fetch_array($result_set))
								{
								?>
									<tr>
										<td><?php echo $row[0]; ?></td>
										<td><?php echo $row[1]; ?></td>           
									</tr>
								<?php
								}
							}
							else
							{
								?>
								<tr>
									<td colspan="5">No Data Found !</td>
								</tr>
								<?php
							}
							?>
						</table>
        </div>
      </div>  
    </div>	
			
  
    
  </div>
  
</div>

<script>


function chart1 (){
 // chart DOM Element
      var ctx = document.getElementById("Chart1");

	  var data = {
        datasets: [{
          data: [<?php echo $Red; ?>, <?php echo $Amber; ?>,  <?php echo $Green; ?>],
          backgroundColor: ["#ff0000","#FF9A00","#a3ff00" ]
        }],
        labels: ["Red","Amber", "Green"]
      };
  
      var xChart = new Chart(ctx, {
					  
		 // The type of chart we want to create
       
        type: 'pie',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		
		options: {
			
			labels: {
				fontColor: 'rgb(255, 99, 132)'
			},
			title: {
				display: true,
				text: 'Red vs Amber vs Green'
			}
			
		
        }
		
	  });
}

 
		 
</script>


<script>
function chart2 (){

   // chart DOM Element
      var ctx = document.getElementById("Chart2");
      var data = {
        datasets: [
		
		{
          data: [<?php echo $Reds; ?>],
		  backgroundColor: "#ff0000",
		  //backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "#ff0000",
		  borderWidth: 5,
          label: 'Reds' // for legend
        },
		
		{
          data: [<?php echo $Ambers; ?>],
		  backgroundColor: "#FF9A00",
		  //backgroundColor: 'transparent',		  
		  borderColor: "#FF9A00",
		  borderWidth: 5,
          label: 'Ambers' // for legend
        },
		
		{
          data: [<?php echo $Greens; ?>],
		   backgroundColor: "#a3ff00",
		  //backgroundColor: 'transparent',
		  borderColor: "#a3ff00",
		  borderWidth: 5,
		  // Changes this dataset to become a line
          //type: 'line',
          label: 'Greens' // for legend
        }
		
		],
        labels: [
          <?php echo $dates; ?>
        ]
      };
	  

      var xChart = new Chart(ctx, {
		 // The type of chart we want to create
        type: 'bar',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		options: {
			
			title: {
            display: true,
            text: 'RFT vs Scrap vs Rework by Date'
        },
			
			 legend: {
				display: true,
				position: 'left',
				labels: {
					fontColor: 'black'
					//fontColor: 'rgb(255, 99, 132)'
				}
			  },
			  tooltips: {
				  mode: 'y'
			  },
		    scales: {
				yAxes: [{
				  ticks: {
					beginAtZero: true
				  }
				}],
				xAxes: [{
				  ticks: {
					autoskip: true,
					maxTicksLimit:12
				  }
				}]
			  }
			}
		  });
		  
}		  		  
		 



</Script>

</body>

<script>
window.onload = start(); 
</script>

<script>
function start(){
chart1();
chart2();
chart3();
//chart4();
}
</script>

<script>
window.onload = start(); 
</script>



<center>
	<div class="col-sm-3 col-md-12 ">
		<?php include 'footer.php';?>
	</div>
</center>


<script>
$('button').on('click', function () {
$('h1').text('Updating...'); 
//start();
location.reload();
   
});


</script>

