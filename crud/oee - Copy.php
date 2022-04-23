<?php
include_once 'dbconfig.php';
session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}

//$con = mysqli_connect('localhost','root','','tg');
if (!$mysqli) {
    die('Could not connect: ' . mysqli_error($mysqli));
}

mysqli_select_db($mysqli,"ajax_demo");
$sql="SELECT id, date(DateTime_) as DateTime_, DateTime_ as DateTime_2, Quality, Availability, Performance, OEE_Value FROM oee ORDER BY DateTime_ ";
$result = mysqli_query($mysqli,$sql);

$DateTime_;
$Quality;
$Availability;
$Performance;
$OEE_Value;

$dates = "";
$Qualitys = "";
$Availabilitys = "";
$Performances = "";
$OEE_Values = "";

$option = '';

while($row = mysqli_fetch_array($result)) {
   
   // echo $row['Quality']; 
	$DateTime_ = $row['DateTime_'];
	$Quality = $row['Quality'];
	$Availability = $row['Availability'];
	$Performance = $row['Performance'];
	$OEE_Value = $row['OEE_Value'];
	
	$option .= '<option value = "'.$row['DateTime_2'].'">'.$row['DateTime_2'].'</option>';
	
	$dates = $dates.'"'.$DateTime_.'",';	
	$Qualitys = $Qualitys.$Quality.',';
	$Availabilitys = $Availabilitys.$Availability.',';
	$Performances = $Performances.$Performance.',';
	$OEE_Values = $OEE_Values.$OEE_Value.',';
	
}

$dates = trim($dates, ",");
$Qualitys = trim($Qualitys, ",");
$Availabilitys = trim($Availabilitys, ",");
$Performances = trim($Performances, ",");
$OEE_Values = trim($OEE_Values, ",");

mysqli_close($mysqli);

//echo $dates; 
//echo $OEE_Values;

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>OEE Performance</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
	 <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
</script>
  
</head>

<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 10%;
  height: 30px;
  background-color: blue;
  text-align: center;
  line-height: 30px;
  color: white;
}



#myBar2 {
  width: 15%;
  height: 30px;
  background-color: green;
  text-align: center;
  line-height: 30px;
  color: white;
}



#myBar3 {
  width: 15%;
  height: 30px;
  background-color: red;
  text-align: center;
  line-height: 30px;
  color: white;
}



#myBar4 {
  width: 15%;
  height: 30px;
  background-color: orange;
  text-align: center;
  line-height: 30px;
  color: white;
}



</style>

<script> 
$(function(){
  $("#header").load("header.php");
  $("#footer").load("footer.html");   
});
</script>



<body>
<div id="header"></div>


<div class="container">

  <div class="row">
    <div class="col-sm-12">
		<center>	
		<h1>OEE Metrics</h1>
		</center>	
    </div>
  </div>
  
  <div class="row">			
				<div class="col-sm-6">		
					<center>
						<h3>OEE Values</h3>
					</center>						
							<div style= "margin-top:3px; float:left;">
							
												<h2>Quality</h2>
												<div id="myProgress">
												  <div id="myBar">10%</div>
												</div>												

												<h2>Availability</h2>
												<div id="myProgress">
												  <div id="myBar2">15%</div>
												</div>											

												<h2>Performance</h2>
												<div id="myProgress">
												  <div id="myBar3">15%</div>
												</div>										

												<h2>OEE Value</h2>
												<div id="myProgress">
												  <div id="myBar4">15%</div>
												</div>

							</div>
				</div>				
							
				<div class="col-sm-6">
					<center>
						<h3>OEE over Date</h3>
					</center>
						<div>						
							<canvas id="OEEc" width="600" height="400"> ></canvas>
						</div>
				</div>
	  </div>








<br>	
<br>
<center>
<button class="btn btn-primary" onclick="method1()">Progress Bar</button> 
</center>
<br>


<center>
<h3>Selection</h3>
</center>

<center>
<form>
 <select name="users2" onchange="showOEE(this.value)" > 
 <option value="">Select a record:</option>
<?php echo $option; ?>
</select>
</form>
</center>

<br>
<br>
 <!-- 
<h1>date <?php echo $dates; ?> </h1>
<h1>o <?php echo $OEE_Values; ?> </h1>
<h1>r <?php echo $Performances; ?> </h1>
<h1>Q <?php echo $Qualitys; ?> </h1>
<h1>A <?php echo $Availabilitys; ?> </h1>
  -->


<center>
<div id="txtHint"><b>OEE info will be listed here.</b></div>
<br>
</center>


</div>

<script>
            // line chart data
    var oeeData = {
                labels : [<?php echo $dates; ?>],
                datasets : [
                {
					label: "OEE_Values",
					fillColor: "rgba(220,220,220,0.2)",
					strokeColor: "orange",
					pointColor: "orange",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#FF0000",
					pointHighlightStroke: "rgba(220,220,220,1)",
                    data : [<?php echo $OEE_Values; ?>]
                },
				
				{
                    label: "Qualitys",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "blue",
                pointColor: "blue",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#FF0000",                 
                    data : [<?php echo $Qualitys; ?>]
                },
				
				{
				label: "Availabilitys",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "green",
                pointColor: "green",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#FF0000",
                pointHighlightStroke: "rgba(220,220,220,1)",
                    data : [<?php echo $Availabilitys; ?>]
                },
				
				{
                label: "Performances",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "red",
                pointColor: "red",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#FF0000",
                pointHighlightStroke: "rgba(220,220,220,1)",
			
                    data : [<?php echo $Performances; ?>]
                }
				
						   ]
    }
// get line chart canvas
var nchart = document.getElementById('OEEc').getContext('2d');
// draw line chart
new Chart(nchart).Line(oeeData); 

</script>


<script>
  $("#link1").click(function(event){
    
	event.preventDefault();
    
	var v1 = $("#div1").html();
	
    $.post("getval.php",{"div1": v1},function(data) {
      $('#message').addClass('success').hide().html(data).fadeIn();
    }, "html");

  });
  
  
  $("#link2").click(function(event){
    
	event.preventDefault();
    
	var v2 = $("#div2").html();
	
    $.post("getval2.php",{"div2": v2},function(data) {
      $('#message2').addClass('success').hide().html(data).fadeIn();
    }, "html");

  });
  
</script>

<script>
function method1() {
 move();
 move2();
 move3();
 move4();
 Chart2();
}
</script>

<script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 10;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= <?php echo $Quality  ?>) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}
</script>

<script>
function move2() {
  var elem = document.getElementById("myBar2");   
  var width = 10;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= <?php echo $Availability  ?>) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}
</script>

<script>
function move3() {
  var elem = document.getElementById("myBar3");   
  var width = 10;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= <?php echo $Performance  ?>) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}
</script>

<script>
function move4() {
  var elem = document.getElementById("myBar4");   
  var width = 10;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= <?php echo $OEE_Value  ?>) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}
</script>

<script>  
   function showOEE(str){
                      $.ajax({
                         type: 'GET',
                         //url: 'getuser.php', 
						  url: "getOEE.php?q="+str, 									 
                         success: function(data){
                           // alert(str);
							$('#txtHint').html(data);
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
	</div>
</center>


</body>
</html>