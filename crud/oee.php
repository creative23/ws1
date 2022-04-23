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
  background-color:  red;
  text-align: center;
  line-height: 30px;
  color: white;
}



#myBar2 {
  width: 15%;
  height: 30px;
  background-color:  #42bff4 ;
  text-align: center;
  line-height: 30px;
  color: white;
}



#myBar3 {
  width: 15%;
  height: 30px;
  background-color: #00FF00 ;
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


#images td, #images th {
    border: 3px solid #333;
    padding: 2px;
	font-size:18px;
}



#images tr:hover {background-color: #ddd;}

#images th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
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
  
  <br>
  
  <div class="row">			
				<div class="col-sm-6">		
					<table id="images2" class="table table-bordered"  >
								
								<th>No.</th>
								<th>Criterion</th>
								<th>Value</th>
								
								<tr>
									<td>1</td>
									<td>Shift Length (mins)</td>
									<td><input type="text" id="txt1" placeholder="Shift Length" value="480" maxlength="6" size="6" ></td>
									
								</tr>
								<tr>
									<td>2</td>
									<td>Breaks (mins)</td>
									<td><input type="text" id="txt2" placeholder="Breaks" value="60"  maxlength="6" size="6" ></td>
									
								</tr>
								<tr>
									<td>3</td>
									<td>Down Time (mins) </td>
									<td><input type="text" id="txt3" placeholder="Down Time" value="47" maxlength="6" size="6" ></td>
									
								</tr>
								<tr>
									<td>4</td>
									<td>Cycle Time (s)</td>
									<td><input type="text" id="txt4" placeholder="Cycle Time" value="1" maxlength="6" size="6" ></td>
									
								</tr>
								<tr>
									<td>5</td>
									<td>Scrap Count (units)</td>
									<td><input type="text" id="txt5" placeholder="Scrap Count" value="423"  maxlength="6" size="6"></td>
									
								</tr>
								
								<tr>
									<td>6</td>		
									<td>Total Count (units) </td>
									<td><input type="text" id="txt6" placeholder="Total Count" value="19721" maxlength="6" size="6" ></td>
							
								</tr>
								
								<tr>
									<td></td>		
									<td> </td>
									<td><input type="text" id=""  value="" maxlength="6" size="6" ></td>		
								</tr>
								
								<tr>
									<td>7</td>

									<td>Planned Production Time (mins)  </td>
									<td><input type="text" id="txt7"  placeholder="Planned Production Time" maxlength="6" size="6" disabled></td>				
								</tr>
								
								<tr>
									<td>8</td>
									<td>Run Time (mins) </td>
									<td><input type="text" id="txt8" placeholder="Run Time" maxlength="6" size="6" disabled></td>				
								</tr>
								
								<tr>
									<td>9</td>
									<td>Good Count (units)</td>
									<td><input type="text" id="txt9" placeholder="Good Parts" maxlength="6" size="6" disabled></td>				
								</tr>
								
								<tr>
									<td></td>		
									<td> </td>
									<td><input type="text" id=""  value="" maxlength="6" size="6"></td>		
								</tr>
								
								
								<tr style="text-align:center;">
									<td>10</td>
									<td bgcolor="#f4425f" >Quality</td>
									<td><input type="text" id="txt10" placeholder="Quality" maxlength="6" size="6" disabled></td>				
								</tr>
								
									<tr style="text-align:center;">
									<td>11</td>
									<td bgcolor="#42bff4" >Availability</td>
									<td><input type="text" id="txt11" placeholder="Availability" maxlength="6" size="6" disabled></td>				
								</tr>
								
								<tr style="text-align:center;">
									<td>12</td>
									<td bgcolor="#00FF00" >Performance</td>
									<td ><input type="text" id="txt12" placeholder="Performance" maxlength="6" size="6" disabled></td>				
								</tr>
								
									<tr>
									<td></td>		
									<td> </td>
										
									<td><input type="text" id=""  value="" maxlength="6" size="6" ></td>		
								</tr>
								
								
								<tr style="text-align:center;">
									<td>13</td>
									<center>
									<td bgcolor="#FFA500" >OEE</td>
									<td><input type="text" id="txt13" maxlength="6" size="6"  disabled></td>				
									</center>
								</tr>
								
							
							</table>
					
					
  
				</div>

  
  
  
  	
				<div class="col-sm-2">		
					<center>
						<h3></h3>
					</center>						
							<div >
										
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
							
				<div class="col-sm-4">
					<center>
						<h3></h3>
					</center>
						<div>						
							<canvas id="OEEc" width="600" height="400"> ></canvas>
						</div>
				</div>
	  </div>








<br>	
<br>
<center>
	<button onclick="method1()" class="btn btn-info" >Progress Bar</button>
	<button onclick="calculateSum()"  class="btn btn-primary">Calculate</button>
	<button onclick="Reset()" class="btn btn-success">Reset</button>
	<button onclick="Example()" class="btn btn-warning">Example</button> 
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

	$(document).ready(function(){
			calculateSum();	
	});

	function calculateSum() {
		
		//
		var ShiftLength = parseInt($("#txt1").val());		
		var Breaks = parseInt($("#txt2").val());	
		var DownTime = parseInt($("#txt3").val());		
		var CycleTime = parseInt($("#txt4").val());
		var RejectCount = parseInt($("#txt5").val());
		var TotalCount = parseInt($("#txt6").val());
	
			
				
		var PlannedProductionTime = ShiftLength - Breaks;
		var RunTime = PlannedProductionTime - DownTime;
		var GoodCount = TotalCount - RejectCount;
				
		var Availability = RunTime / PlannedProductionTime;
		var Performance = (CycleTime * TotalCount) / (RunTime * 60) ;
		var Quality = GoodCount / TotalCount;
		
		var OEE = Availability * Performance * Quality;
			
		$("#txt7").val(PlannedProductionTime);
		$("#txt8").val(RunTime);
		$("#txt9").val(GoodCount);
		//alert(PlannedProductionTime);
		
		$("#txt10").val(Quality.toFixed(3));
		$("#txt11").val(Availability.toFixed(3));
		$("#txt12").val(Performance.toFixed(3));

		
		$("#txt13").val(OEE.toFixed(3));
		

	}
	
	function Reset() {
					
		$("#txt1").val(0);
		$("#txt2").val(0);
		$("#txt3").val(0);		
		$("#txt4").val(0);
		$("#txt5").val(0);
		$("#txt6").val(0);
		$("#txt7").val(0);			
		$("#txt8").val(0);
		$("#txt9").val(0);
		$("#txt10").val(0);
		$("#txt11").val(0);		
		$("#txt12").val(0);
		$("#txt13").val(0);
	
	}
	
	function Example() {
					
		$("#txt1").val(480);
		$("#txt2").val(60);
		$("#txt3").val(47);		
		$("#txt4").val(1);
		$("#txt5").val(423);
		$("#txt6").val(19721);
		
		calculateSum();	
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