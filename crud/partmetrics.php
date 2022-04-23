<?php
include_once 'dbconfig.php';

session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}


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


//VIEW QUERY
$sql = mysqli_query($mysqli, " select `faults2`.`Date_` AS `Date_`,sum(if((`faults2`.`status` = 'rft'),`faults2`.`qty`,0)) AS `RFT`,sum(if((`faults2`.`status` = 'Rework'),`faults2`.`qty`,0)) AS `Rework`,sum(if((`faults2`.`status` = 'Scrap'),`faults2`.`qty`,0)) AS `Scrap`,sum(`faults2`.`qty`) AS `total` from `faults2` group by `faults2`.`Date_` ;
 ");
while($row = mysqli_fetch_array($sql)){
	$RFT	= $row['RFT'];
	$Rework	= $row['Rework'];
	$Scrap	= $row['Scrap'];	
	$date	= $row['Date_'];
//	$date	=  date('D, M, Y', strtotime($row['Date_']));
	
	
	$dates = $dates.'"'.$date.'",';	
	$RFTs = $RFTs.$RFT.',';
	$Reworks = $Reworks.$Rework.',';
	$Scraps = $Scraps.$Scrap.',';

}

//$dates = trim($dates, ",");
$RFTs = trim($RFTs, ",");
$Reworks = trim($Reworks, ",");
$Scraps = trim($Scraps, ",");




?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Part Metrics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
</script>

<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html"); 
});
</script>






<style media="all">

img{
    max-width:250px;
    max-height:250px;
}



</style>
<title>Part Status</title>
</head>

<html>

<body>



<div id="header"></div>

<!-- 
<h1>date <?php echo $dates; ?> </h1>
<h1>rft <?php echo $RFTs; ?> </h1>
<h1>rework <?php echo $Reworks; ?> </h1>
<h1>scrap <?php echo $Scraps; ?> </h1>
 -->


<div align="center" id="Title">
  <h1>Part Metrics</h1>  
</div>


<center>
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
	
</center>

<center>
<div class="col-sm-6 col-md-6 ">

	<div class="panel panel-default">
		
		<div class="panel-heading">
                 Line Chart Example
        </div>
	
		<div id="Bar">
			<div >
					<center>	
						<canvas id="Chart2" ></canvas>
					</center>	
			</div>
		</div>
	
	</div>
</div>
</center>





 
    
</body>

</html>

<script>


function chart2 (){

   // chart DOM Element
      var ctx = document.getElementById("Chart2");
      var data = {
        datasets: [
		
		{
          data: [<?php echo $RFTs; ?>],
		  backgroundColor: "#39a",
		  //backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "#39a",
		  borderWidth: 5,
          label: 'RFT' // for legend
        },
		
		{
          data: [<?php echo $Scraps; ?>],
		  backgroundColor: "#000000",
		  //backgroundColor: 'transparent',		  
		  borderColor: "#000000",
		  borderWidth: 5,
          label: 'Scrap' // for legend
        },
		
		{
          data: [<?php echo $Reworks; ?>],
		   backgroundColor: "#9BB6ff",
		  //backgroundColor: 'transparent',
		  borderColor: "#9BB6ff",
		  borderWidth: 5,
		  // Changes this dataset to become a line
          //type: 'line',
          label: 'Rework' // for legend
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
		  
  function adddata(){
  //myLineChart.data.datasets[0].data[7] = 60;
  //myLineChart.data.labels[7] = "Newly Added";
  Chart2.update();
}
	  
}		  		  
		 

function chart1 (){
 // chart DOM Element
      var ctx = document.getElementById("Chart1");
		
		
	  var data = {
        datasets: [{
          data: [<?php echo $RFT; ?>, <?php echo $Rework; ?>,  <?php echo $Scrap; ?>],
          backgroundColor: ["#39a","#9BB6ff","#000000" ]
        }],
        labels: ["RFT","Rework", "Scrap"]
      };
	  

	  
      var xChart = new Chart(ctx, {
		 
		responsive:true,
		maintainAspectRatio: false, 
		  
		
       
        type: 'pie',
		
        data: data,
		 		
			 
		
		options: {
			
			labels: {
				fontColor: 'rgb(255, 99, 132)'
			},
			
			title: {
				display: true,
				text: 'RFT vs Scrap vs Rework'
			}
			
			
        }
	
		
	  });
		  
}

 
		 
</script>





<br>
<br>
<br>
<br>

<center>
<h2> 24 Hour Performance Overview </h2>
</center>

<center>

<div class="col-sm-12 col-md-12 ">

	<div class="panel panel-default">
		
		<div class="panel-heading">
                 Line Chart Example
        </div>
		
			<div id="Tab24">
				<div id="content">
				<table align="center" id="images" class="table table-bordered" >
				<tr>
				
				</tr>
				<th>Status</th>
				<th>12AM</th>
				<th>1AM</th>	
				<th>2AM</th>
				<th>3AM</th>
				<th>4AM</th>
				<th>5AM</th>
				<th>6AM</th>
				<th>7AM</th>
				<th>8AM</th>
				<th>9AM</th>	
				<th>10AM</th>
				<th>11AM</th>
				<th>12PM</th>
				<th>1PM</th>
				<th>2PM</th>
				<th>3PM</th>
				<th>4PM</th>
				<th>5PM</th>
				<th>6PM</th>
				<th>7PM</th>
				<th>8PM</th>
				<th>9PM</th>
				<th>10PM</th>
				<th>11PM</th>

				
				</tr>
				<?php
				
				$sql_query="SELECT * FROM 24htpivot";
				
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
						<td><?php echo $row[5]; ?></td>
						<td><?php echo $row[6]; ?></td>
						<td><?php echo $row[7]; ?></td>
						<td><?php echo $row[8]; ?></td>
						<td><?php echo $row[9]; ?></td>
						<td><?php echo $row[10]; ?></td>
						<td><?php echo $row[11]; ?></td>
						<td><?php echo $row[12]; ?></td>
						<td><?php echo $row[13]; ?></td>
						<td><?php echo $row[14]; ?></td>
						<td><?php echo $row[15]; ?></td>
						<td><?php echo $row[16]; ?></td>
						<td><?php echo $row[17]; ?></td>
						<td><?php echo $row[18]; ?></td>
						<td><?php echo $row[19]; ?></td>
						<td><?php echo $row[20]; ?></td>
						<td><?php echo $row[21]; ?></td>
						<td><?php echo $row[22]; ?></td>
						<td><?php echo $row[23]; ?></td>
						<td><?php echo $row[24]; ?></td>
							   
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
				<tr>
					<td>Σ (Rework,RFT)</td>		

					<td>4</td>	
					<td>5</td>	
					<td>0</td>	
					<td>0</td>
					<td>0</td>	
					<td>0</td>	
					<td>0</td>	
					<td>0</td>
					<td>0</td>	
					<td>0</td>	
					<td>0</td>	
					<td>0</td>
					<td>0</td>	
					<td>0</td>	
					<td>0</td>	
					<td>0</td>
					<td>0</td>	
					<td>0</td>	
					<td>0</td>	
					<td>0</td>
					<td>0</td>	
					<td>0</td>	
					<td>0</td>	
					<td>0</td>		
				</tr>
				
				<tr>
					<td>Target</td>
					<td>5</td>	
					<td>4</td>	
					<td>3</td>	
					<td>2</td>
					<td>5</td>	
					<td>6</td>	
					<td>9</td>	
					<td>10</td>
					<td>11</td>	
					<td>5</td>	
					<td>4</td>	
					<td>2</td>
					<td>10</td>	
					<td>6</td>	
					<td>12</td>	
					<td>9</td>	
					<td>10</td>
					<td>11</td>	
					<td>5</td>	
					<td>4</td>	
					<td>2</td>
					<td>10</td>	
					<td>6</td>	
					<td>12</td>				
				</tr>
				
				<tr>
					<td>Difference</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 0</td>
					<td class="diff"> 0</td>	
					<td class="diff"> 4</td>
					
				</tr>
				
				</table>
				

				
				</div>
			</div>
			</div>
		</div>
	
	</div>
</div>			
			

</center>


<script>
function check(){
    var table = document.getElementById("images");
    var difference, addition;
    
    for(var i=1; i<table.rows.length; i++){
		
		//12AM / cell:1
		addition = (table.rows[2].cells[1].innerHTML*1) + (table.rows[3].cells[1].innerHTML*1);
		table.rows[5].cells[1].innerHTML = addition;
		
		difference = (table.rows[5].cells[1].innerHTML*1) - (table.rows[6].cells[1].innerHTML*1);
        table.rows[7].cells[1].innerHTML = difference;
		
		//1AM / cell:2
		addition = (table.rows[2].cells[2].innerHTML*1) + (table.rows[3].cells[2].innerHTML*1);
		table.rows[5].cells[2].innerHTML = addition;
		
		difference = (table.rows[5].cells[2].innerHTML*1) - (table.rows[6].cells[2].innerHTML*1);
        table.rows[7].cells[2].innerHTML = difference;
		
		//2AM / cell:3
		addition = (table.rows[2].cells[3].innerHTML*1) + (table.rows[3].cells[3].innerHTML*1);
		table.rows[5].cells[3].innerHTML = addition;
		
		difference = (table.rows[5].cells[3].innerHTML*1) - (table.rows[6].cells[3].innerHTML*1);
        table.rows[7].cells[3].innerHTML = difference;
		
		//3AM / cell:4
		addition = (table.rows[2].cells[4].innerHTML*1) + (table.rows[3].cells[4].innerHTML*1);
		table.rows[5].cells[4].innerHTML = addition;
		
		difference = (table.rows[5].cells[4].innerHTML*1) - (table.rows[6].cells[4].innerHTML*1);
        table.rows[7].cells[4].innerHTML = difference;
		
		//4AM / cell:5
		addition = (table.rows[2].cells[5].innerHTML*1) + (table.rows[3].cells[5].innerHTML*1);
		table.rows[5].cells[5].innerHTML = addition;
		
		difference = (table.rows[5].cells[5].innerHTML*1) - (table.rows[6].cells[5].innerHTML*1);
        table.rows[7].cells[5].innerHTML = difference;
		
		//5AM / cell:6
		addition = (table.rows[2].cells[6].innerHTML*1) + (table.rows[3].cells[6].innerHTML*1);
		table.rows[5].cells[6].innerHTML = addition;
		
		difference = (table.rows[5].cells[6].innerHTML*1) - (table.rows[6].cells[6].innerHTML*1);
        table.rows[7].cells[6].innerHTML = difference;
		
		
		//6AM / cell:7
		addition = (table.rows[2].cells[7].innerHTML*1) + (table.rows[3].cells[7].innerHTML*1);
		table.rows[5].cells[7].innerHTML = addition;	

		difference = (table.rows[5].cells[7].innerHTML*1) - (table.rows[6].cells[7].innerHTML*1);
        table.rows[7].cells[7].innerHTML = difference;	
		
		//7AM / cell:8
		addition = (table.rows[2].cells[8].innerHTML*1) + (table.rows[3].cells[8].innerHTML*1);
		table.rows[5].cells[8].innerHTML = addition;
		
		difference = (table.rows[5].cells[8].innerHTML*1) - (table.rows[6].cells[8].innerHTML*1);
        table.rows[7].cells[8].innerHTML = difference;
		
		//8AM / cell:9
		addition = (table.rows[2].cells[9].innerHTML*1) + (table.rows[3].cells[9].innerHTML*1);
		table.rows[5].cells[9].innerHTML = addition;
		
		difference = (table.rows[5].cells[9].innerHTML*1) - (table.rows[6].cells[9].innerHTML*1);
        table.rows[7].cells[9].innerHTML = difference;
		
		//9AM / cell:10
		addition = (table.rows[2].cells[10].innerHTML*1) + (table.rows[3].cells[10].innerHTML*1);
		table.rows[5].cells[10].innerHTML = addition;
				
		difference = (table.rows[5].cells[10].innerHTML*1) - (table.rows[6].cells[10].innerHTML*1);
        table.rows[7].cells[10].innerHTML = difference;
		
		//10AM / cell:11
		addition = (table.rows[2].cells[11].innerHTML*1) + (table.rows[3].cells[11].innerHTML*1);
		table.rows[5].cells[11].innerHTML = addition;
					
		difference = (table.rows[5].cells[11].innerHTML*1) - (table.rows[6].cells[11].innerHTML*1);
        table.rows[7].cells[11].innerHTML = difference;
					
		//11AM / cell:12
		addition = (table.rows[2].cells[12].innerHTML*1) + (table.rows[3].cells[12].innerHTML*1);
		table.rows[5].cells[12].innerHTML = addition;
		
		difference = (table.rows[5].cells[12].innerHTML*1) - (table.rows[6].cells[12].innerHTML*1);
        table.rows[7].cells[12].innerHTML = difference;
		
		
		
		
		//12PM / cell:13
		addition = (table.rows[2].cells[13].innerHTML*1) + (table.rows[3].cells[13].innerHTML*1);
		table.rows[5].cells[13].innerHTML = addition;
		
		difference = (table.rows[5].cells[13].innerHTML*1) - (table.rows[6].cells[13].innerHTML*1);
        table.rows[7].cells[13].innerHTML = difference;
		
		//1PM / cell:14
		addition = (table.rows[2].cells[14].innerHTML*1) + (table.rows[3].cells[14].innerHTML*1);
		table.rows[5].cells[14].innerHTML = addition;
		
		difference = (table.rows[5].cells[14].innerHTML*1) - (table.rows[6].cells[14].innerHTML*1);
        table.rows[7].cells[14].innerHTML = difference;
		
		//2PM / cell:15
		addition = (table.rows[2].cells[15].innerHTML*1) + (table.rows[3].cells[15].innerHTML*1);
		table.rows[5].cells[15].innerHTML = addition;
		
		difference = (table.rows[5].cells[15].innerHTML*1) - (table.rows[6].cells[15].innerHTML*1);
        table.rows[7].cells[15].innerHTML = difference;
		
		//3PM / cell:16
		addition = (table.rows[2].cells[16].innerHTML*1) + (table.rows[3].cells[16].innerHTML*1);
		table.rows[5].cells[16].innerHTML = addition;
		
		difference = (table.rows[5].cells[16].innerHTML*1) - (table.rows[6].cells[16].innerHTML*1);
        table.rows[7].cells[16].innerHTML = difference;
		
		//4PM / cell:17
		addition = (table.rows[2].cells[17].innerHTML*1) + (table.rows[3].cells[17].innerHTML*1);
		table.rows[5].cells[17].innerHTML = addition;
		
		difference = (table.rows[5].cells[17].innerHTML*1) - (table.rows[6].cells[17].innerHTML*1);
        table.rows[7].cells[17].innerHTML = difference;
							
		//5PM / cell:18
		addition = (table.rows[2].cells[18].innerHTML*1) + (table.rows[3].cells[18].innerHTML*1);
		table.rows[5].cells[18].innerHTML = addition;
		
		difference = (table.rows[5].cells[18].innerHTML*1) - (table.rows[6].cells[18].innerHTML*1);
        table.rows[7].cells[18].innerHTML = difference;
		
		
		
		
		
		//6PM / cell:19
		addition = (table.rows[2].cells[19].innerHTML*1) + (table.rows[3].cells[19].innerHTML*1);
		table.rows[5].cells[19].innerHTML = addition;
		
		difference = (table.rows[5].cells[19].innerHTML*1) - (table.rows[6].cells[19].innerHTML*1);
        table.rows[7].cells[19].innerHTML = difference;
		
		//7PM / cell:20
		addition = (table.rows[2].cells[20].innerHTML*1) + (table.rows[3].cells[20].innerHTML*1);
		table.rows[5].cells[20].innerHTML = addition;
		
		difference = (table.rows[5].cells[20].innerHTML*1) - (table.rows[6].cells[20].innerHTML*1);
        table.rows[7].cells[20].innerHTML = difference;
		
		//8PM / cell:21
		addition = (table.rows[2].cells[21].innerHTML*1) + (table.rows[3].cells[21].innerHTML*1);
		table.rows[5].cells[21].innerHTML = addition;
		
		difference = (table.rows[5].cells[21].innerHTML*1) - (table.rows[6].cells[21].innerHTML*1);
        table.rows[7].cells[21].innerHTML = difference;
		
		//9PM / cell:22
		addition = (table.rows[2].cells[22].innerHTML*1) + (table.rows[3].cells[22].innerHTML*1);
		table.rows[5].cells[22].innerHTML = addition;
		
		difference = (table.rows[5].cells[22].innerHTML*1) - (table.rows[6].cells[22].innerHTML*1);
        table.rows[7].cells[22].innerHTML = difference;
		
		//10PM / cell:23
		addition = (table.rows[2].cells[23].innerHTML*1) + (table.rows[3].cells[23].innerHTML*1);
		table.rows[5].cells[23].innerHTML = addition;
		
		difference = (table.rows[5].cells[23].innerHTML*1) - (table.rows[6].cells[23].innerHTML*1);
        table.rows[7].cells[23].innerHTML = difference;
		
		//11PM / cell:24
		addition = (table.rows[2].cells[24].innerHTML*1) + (table.rows[3].cells[24].innerHTML*1);
		table.rows[5].cells[24].innerHTML = addition;
		
		difference = (table.rows[5].cells[24].innerHTML*1) - (table.rows[6].cells[24].innerHTML*1);
        table.rows[7].cells[24].innerHTML = difference;	
		
        //table.rows[6].cells[18].innerHTML = difference == 0 ? '' : 'X';
    }
	
	check2();
	
}

window.onload = check;



</script>



<script>
function check2(){
	 $(document).ready(function(){
		$('#images td.diff').each(function(){
		   //var txt = $(this).text();
		  // if( parseInt(txt) == 0 ){
			if ($(this).text() < 0) {  
				$(this).css('background-color','#f00');
			}
		});
	});
}

</script>






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

<br>
<br>
<center>
	<div class="col-sm-3 col-md-12 ">
	
		<?php include 'footer.php';?>
		<button>Refresh</button>
	</div>
</center>


<script>
$('button').on('click', function () {
$('h1').text('Updating...'); 
//start();
location.reload();
   
});


</script>

