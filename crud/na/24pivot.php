<?php
include_once 'dbconfig.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="container">
  <div class="jumbotron">
	<h1 align="center">24HR Status Table</h1>        
    <p align="center"> Uploaded From Android</p>
  </div>
    
</div>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>24HR Pivot</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">



</script>

<style>
img{
    max-width:250px;
    max-height:250px;
}

#images td, #images th {
    border: 1px solid #ddd;
    padding: 8px;
	font-size:18px;
}

#images tr:nth-child(even){background-color: #f2f2f2;}

#images tr:hover {background-color: #ddd;}

#images th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: white;
    color: black;
	font-size:14px;
}

</style>

</head>
<body>
<center>

<div id="header">
	<div id="content">
    <label>24HR Pivot PHP and MySql</label>
    </div>
</div>

<div id="body">
	<div id="content">
    <table align="center" id="images" >
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
	//$sql_query="SELECT * FROM faults2";
	$sql_query="SELECT * FROM `24htpivot";
	
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
    </table>
    </div>
</div>

</center>
</body>
</html>