<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-save']))
{
	// variables for input data
	$part = $_POST['part']; 
	$failure = $_POST['failure']; 
	$status = $_POST['status'];
	$Date_ = $_POST['Date_']; 
	$Time_ = $_POST['Time_'];
	$Month_ = $_POST['Month_'];
	$WK_ = $_POST['WK_'];
	
	
	
	// sql query for inserting data into database
	$sql_query = "INSERT INTO faults2(part,failure,status,Date_,Time_,Month_, WK_ ) VALUES('$part','$failure','$status', '$Date_','$Time_','$Month_', '$WK_')";
	
	
	// sql query execution function
	$result_set = $mysqli->query($sql_query);
	if($mysqli->query($sql_query))
	
	{
		?>
		<script type="text/javascript">
		alert('Data Are Inserted Successfully ');
		window.location.href='index.php';
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
		alert('error occured while inserting your data');
		</script>
		<?php
	}
	// sql query execution function
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CRUD Operations With PHP and MySql</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>

<div id="header">
	<div id="content">
    <label></label>
    </div>
</div>
<div id="body">
	<div id="content">
    <form method="post">
    <table align="center">
    
	<tr>
    <td align="center"><a href="index.php">back to main page</a></td>
    </tr>
    
	<tr>
    <td><input type="text" name="part" placeholder="part" required /></td>
    </tr>
    
	<tr>
    <td><input type="text" name="failure" placeholder="failure" required /></td>
    </tr>
    
	<tr>
    <td><input type="text" name="status" placeholder="status" required /></td>
    </tr>
	
	<tr>
	<td><input type="text" name="Date_" placeholder="Date_" required /></td>
	</tr>
    
	<tr>
	<td><input type="text" name="Time_" placeholder="Time_" required /></td>
	</tr>
	
	<tr>
    <td><input type="text" name="Month_" placeholder="Month_" required /></td>
    </tr>
    
	<tr>
    <td><input type="text" name="WK_" placeholder="WK_" required /></td>
    </tr>
    
	
	
	<tr>
    <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center>
</body>
</html>