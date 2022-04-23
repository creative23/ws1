<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td {
    border: 3px solid #333;
    padding: 4px;
	font-size:18px;
	text-align: center;
}


th {
	border: 3px solid #333;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #333;
    color: white;
	font-size:14px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}



</style>
</head>
<body>

<?php
include_once 'dbconfig.php';

$q = $_GET['q'];
//$q = intval($_GET['q']);

//$con = mysqli_connect('localhost','root','','tg');
if (!$mysqli) {
    die('Could not connect: ' . mysqli_error($mysqli));
}

mysqli_select_db($mysqli,"ajax_demo");
$sql="SELECT * FROM oee WHERE DateTime_ = '".$q."' ";

//$sql="SELECT * FROM oee WHERE id = '".$q."'";
//$sql="SELECT * FROM oee" ;
$result = mysqli_query($mysqli,$sql);

echo "<table> 
<tr>
<th>Date</th>
<th>Shift Length (mins)</th>
<th>Breaks (mins)</th>
<th>Down Time (mins)</th>
<th>Cycle Time (s)</th>
<th>Scrap Count</th>
<th>Good Parts</th>
<th>Total</th>
<th>Availability % </th>
<th>Performance % </th>
<th>.Quality % </th>
<th>OEE_Value % </th>

</tr>";

//echo $q;

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
	
	echo "<td>" . $row['Datetime_'] . "</td>";
    echo "<td>" . $row['Shift_Length'] . "</td>";
    echo "<td>" . $row['Breaks'] . "</td>";
    echo "<td>" . $row['Down_Time'] . "</td>";
	echo "<td>" . $row['Cycle_Time'] . "</td>";
    echo "<td>" . $row['Scrap_Count'] . "</td>";
    echo "<td>" . $row['Good_Parts'] . "</td>";
    echo "<td>" . $row['Total_Count'] . "</td>";
    echo "<td>" . $row['Availability'] . "</td>";
    echo "<td>" . $row['Performance'] . "</td>";
    echo "<td>" . $row['Quality'] . "</td>";
    echo "<td>" . $row['OEE_Value'] . "</td>";
   
    echo "</tr>";
}
echo "</table>";
mysqli_close($mysqli);
?>
</body>
</html>