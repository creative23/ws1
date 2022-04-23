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
	$sql_query="DELETE FROM team WHERE id=".$_GET['delete_id'];
	
	$result_set = $mysqli->query($sql_query);	
	
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
<title>Action Logger</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">
function edt_id(id)
{
	if(confirm('Sure to edit ?'))
	{
		window.location.href='action_lines.php?edit_id='+id;
	}
}
function delete_id(id)
{
	if(confirm('Sure to Delete ?'))
	{
		window.location.href='actionslogger.php?delete_id='+id;
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
    td = tr[i].getElementsByTagName("td")[3];
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

<script>
function myFunction3() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput3");
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
function myFunction4() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput4");
  filter = input.value.toUpperCase();
  table = document.getElementById("images");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[10];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";		 
      } else {
        tr[i].style.display = "none";
      }	  	
    } 	
  } 
	
  myFunctionCount();
}



</script>

<script>
function myFunctionCount() {
    
	var x = document.getElementById("images").rows.length;	
	
	var y = 0;
	
	//take into account header
	y = x - 1;
	
    document.getElementById("TableCount").innerHTML = "Found :" + y + "";
}
</script>





</head>
<body>
<div id="header"></div>

<div align="center" id="Title">
  <p style="font-size:36px;">Action Logger</p>
</div>

<br>


<br>
<center>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Team Leader.." title="Type in a name">
</center>

<center>
<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search by Area.." title="Type in a name">
</center>

<center>
<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search by Issue.." title="Type in a name">
</center>


<center>
<input type="text" id="myInput4" onkeyup="myFunction4()" placeholder="Search by Status.." title="Type in a name">
</center>

<center>
<button class="btn btn-primary"  onclick="myFunctionCount()">Count</button>
</center>
<br>
<center>
<p id="TableCount"></p>
</center>

<center>
<p id="TableCount2"></p>
</center>

<center>


<div id="body">
	<div id="content">
    <table align="center" id="images2"  class="table table-bordered" >
   
	<tr>
    <th colspan="12"><a href="action_header.php">Raise an Action.</a></th>
    </tr>
   
    <th>ID</th>
    <th>Date</th>
	<th>Time</th>
	<th>Team Leader</th>	
	<th>Area</th>
	<th>Issue</th>
	<th>Date Required</th>
	<th>Comment</th>
	<th>Champion</th>
	<th>Qty</th>
	<th>Status</th>
	<th>Add Comment</th>

    

    <?php
	//$sql_query="SELECT * FROM faults2";
	$sql_query="SELECT `ID`, DATE(`Date`), TIME(`Time`), `TeamLeader`, `Area`, `Issue`, `Date_Required`, `Comment`, `Champion`, `Qty`, `Status` FROM `team` ORDER BY ID ";
	
	$result_set = $mysqli->query($sql_query);
	
	function switchColor($rowValue) { 

	//Red for Red
    $color1 = '#f45942'; 	
	// Yellow for Amber
    $color2 = '#f4ee42'; 
	//Green for Green
    $color3 = '#92f441'; 
	
	//white for else
	$color4 = '#ffffff'; 
    
      
		switch ($rowValue) { 
			case 'Red': 
				echo $color1; 
				break; 
			case 'Amber': 
				echo $color2; 
				break; 
			case 'Green': 
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
				<td style="background-color:<?php switchColor($row[10]) ?>; ?>;color:black;"><?php echo $row[10]; ?></td>		
				<td align="center"><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
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