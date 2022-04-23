<?php
ob_start();
error_reporting(0);
// connection
$db_conx = mysqli_connect("localhost", "root", "", "tg");

if (mysqli_connect_errno()) {
    echo mysqli_connect_error(":(");
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
$sql = mysqli_query($db_conx, "SELECT * FROM SUM_STATUS");
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


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<title>  Part Status  </title>



</head>

<body>
<!-- //

<h1>date <?php echo $dates; ?> </h1>
<h1>rft <?php echo $RFTs; ?> </h1>
<h1>rework <?php echo $Reworks; ?> </h1>
<h1>scrap <?php echo $Scraps; ?> </h1>

// -->

<h1>Part Status</h1>

<button>Refresh</button>

<div class="col-sm-3 col-md-3 ">
<canvas id="Chart1" ></canvas>	
</div>



<div class="col-sm-6 col-md-6 ">
<canvas id="Chart2" ></canvas>
</div>

<div class="col-sm-12 col-md-6 ">
<canvas id="Chart3" ></canvas>
</div>

<div  id="SW">
<canvas id="Chart4" ></canvas>
</div>

</div>
    <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    
</body>
</html>

<script>

function chart1 (){

   // chart DOM Element
      var ctx = document.getElementById("Chart3");
      var data = {
        datasets: [
		
		{
          data: [<?php echo $RFTs; ?>],
		  backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "#39a",
		  borderWidth: 5,
          label: 'RFT' // for legend
        },
		
		{
          data: [<?php echo $Scraps; ?>],
		  backgroundColor: 'transparent',		  
		  borderColor: "#000000",
		  borderWidth: 5,
          label: 'Scrap' // for legend
        },
		
		{
          data: [<?php echo $Reworks; ?>],
		  backgroundColor: 'transparent',
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
		 
        type: 'line',
		
        data: data,
		
		options: {
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
		  
}		  		  
		 

function chart3 (){
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
		  
		 // The type of chart we want to create
       
        type: 'pie',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		
			 
		
		options: {
			labels: {
				fontColor: 'rgb(255, 99, 132)'
			}
			
			
        }
	
		
	  });
		  
}




function chart4 (){
 // chart DOM Element
      var ctx = document.getElementById("Chart4");
      var data = {
        datasets: [
		
		{
          data: [<?php echo $RFTs; ?>],
		  backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "#39a",
		  borderWidth: 5,
          label: 'RFT' // for legend
        },
		
		{
          data: [<?php echo $Scraps; ?>],
		  backgroundColor: 'transparent',		  
		  borderColor: "#000000",
		  borderWidth: 5,
          label: 'Scrap' // for legend
        },
		
		{
          data: [<?php echo $Reworks; ?>],
		  backgroundColor: 'transparent',
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
        type: 'line',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		options: {
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


		 
		 
		 
</script>
















<script>
window.onload = start(); 
</script>

<script>
function start(){
chart1();
chart2();
chart3();
chart4();
}
</script>

<script>
window.onload = start(); 
</script>


<script>
$('button').on('click', function () {
$('h1').text('Updating...'); 
//start();
location.reload();
   
});


</script>