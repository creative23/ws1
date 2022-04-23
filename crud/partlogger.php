<?php
include_once 'dbconfig.php';
session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}



// delete condition
if(isset($_GET['delete_id']))
{
	$sql="DELETE FROM faults2 WHERE id=".$_GET['delete_id'];
	
	$result_set = $mysqli->query($sql);	
	
	header("Location: $_SERVER[PHP_SELF]");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>




 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
  


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Part Logger</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">
function edt_id(id)
{
	if(confirm('Sure to edit ?'))
	{
		window.location.href='edit_data.php?edit_id='+id;
	}
}
function delete_id(id)
{
	if(confirm('Sure to Delete ?'))
	{
		window.location.href='partlogger.php?delete_id='+id;
	}
}
</script>

<style>
img{
    max-width:250px;
    max-height:250px;
}

#images td, #images th {
    border: 3px solid #333;
    padding: 3px;
	font-size:14px;
}

#images tr:nth-child(even){background-color: #f2f2f2;}

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
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("images");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<script>
function myFunction2() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("images");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[5];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<script>
function myFunction3() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("images");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

</head>
<body>
<div id="header"></div>

<div align="center" id="Title">  
  <p style="font-size:36px;">Part Logger</p>
</div>

<br>
<center>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Status.." title="Type in a name">
</center>

<center>
<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search by Failure.." title="Type in a name">
</center>

<center>
<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search by Part.." title="Type in a name">
</center>

<br>

<center>

<div id="body">
 <div class="container box">
	<div id="content">
    <table align="center" id="images2" class="table table-bordered" >
    <tr>
    
    </tr>
    <th>Date</th>
	<th>Month</th>
	<th>WK</th>	
	<th>Time</th>
	<th>Part</th>
	<th>Failure</th>
	<th>Status</th>
	
   
    
    </tr>
    <?php
	//$sql_query="SELECT * FROM faults2";
	$sql_query="SELECT id, Date_ , Month_, WK_, Time_ , part, failure, status FROM `faults2` order by Date_, Time_";
	
	$result_set = $mysqli->query($sql_query);
	
		
	function switchColor($rowValue) { 

	//Red for Scrap
    $color1 = '#f45942'; 	
	// Yellow for Rework
    $color2 = '#f4ee42'; 
	//Green for Rft
    $color3 = '#92f441'; 
	
	//white for else
	$color4 = '#ffffff'; 
          
		switch ($rowValue) { 
			case 'Scrap': 
				echo $color1; 
				break; 
			case 'Rework': 
				echo $color2; 
				break; 
			case 'RFT': 
				echo $color3; 
				break; 	
			default: 
				echo $color4; 
		} 
	}
	
	if(mysqli_num_rows($result_set)>0)
	{
        while($row=mysqli_fetch_array($result_set))
		{
		?>
            <tr>
            
			<td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
			<td><?php echo $row[4]; ?></td>
			<td><?php echo $row[5]; ?></td>
			<td><?php echo $row[6]; ?></td>
			
			<td style="background-color:<?php switchColor($row[7]) ?>; ?>;color:black;"><?php echo $row[7]; ?></td>
			

			
		
           
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
<br>
<br>

<center>
	<div class="col-sm-3 col-md-12 ">	
		<?php include 'footer.php';?>		
	</div>
</center>

</center>
</body>
</html>