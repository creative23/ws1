<!DOCTYPE html>
<html>
<head>
<style>


table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 50%;
}

th {
    border: 1px solid #dddddd;
    text-align: left;
	padding: 20px;
    
}

td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 25px;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}


</style>
</head>
<body>

<?php
//$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','tg');


if(isset($_GET['edit_id']))
{
	$sql="SELECT * FROM team WHERE id=".$_GET['edit_id'];
	//$result_set = $mysqli->query($sql_query);	
	//$fetched_row=mysqli_fetch_array($result_set);
	
	$result = mysqli_query($con,$sql);
}

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
//$sql="SELECT * FROM oee WHERE id = '".$q."'";
//$sql="SELECT id, date(Datetime_) as Datetime_, User_, Comment_ FROM action_lines order by id " ;
//$result = mysqli_query($con,$sql);


echo "<center> <table>
<tr>
<th>Id</th>
<th>Date</th>
<th>TeamLeader</th>
<th>Area</th>
<th>Issue</th>
<th>Date_Required</th>
<th>Comment</th>
<th>Champion</th>
<th>Status</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['Date'] . "</td>";
    echo "<td>" . $row['TeamLeader'] . "</td>";
	echo "<td>" . $row['Area'] . "</td>";
	echo "<td>" . $row['Issue'] . "</td>";
	echo "<td>" . $row['Date_Required'] . "</td>";
	echo "<td>" . $row['Comment'] . "</td>";
	echo "<td>" . $row['Champion'] . "</td>";
	echo "<td>" . $row['Status'] . "</td>";
	
    
   
    echo "</tr>";
}

echo "</table> </center> " ;

mysqli_close($con);
?>
</body>
</html>