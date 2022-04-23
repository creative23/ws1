<?php
include_once 'dbconfig.php';

if(isset($_GET['edit_id']))
{
	$sql_query="SELECT * FROM faults2 WHERE id=".$_GET['edit_id'];
	$result_set = $mysqli->query($sql_query);
	
	$fetched_row=mysqli_fetch_array($result_set);
}
if(isset($_POST['btn-update']))
{
	// variables for input data
	$part = $_POST['part']; 
	$failure = $_POST['failure']; 
	$status = $_POST['status'];
	$Date_ = $_POST['Date_']; 
	$Time_ = $_POST['Time_'];
	$month_ = $_POST['Month_'];
	$wk_ = $_POST['WK_'];
	
	
	$sql_query = "UPDATE faults2 SET part='$part', failure='$failure', status='$status', Date_='$Date_', Time_='$Time_', Month_='$month_', WK_='$wk_' WHERE id=".$_GET['edit_id'];

	
	if($mysqli->query($sql_query))
	
	{
		?>
		<script type="text/javascript">
		alert('Data Are Updated Successfully');
		window.location.href='index.php';
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
		alert('error occured while updating data');
		</script>
		<?php
	}
	// sql query execution function
}
if(isset($_POST['btn-cancel']))
{
	header("Location: index.php");
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
    <label>CRUD Operations With PHP and MySql</label>
    </div>
</div>

<div id="body">
	<div id="content">
    <form method="post">
    <table align="center">
    <tr>
    <td><input type="text" name="part" placeholder="part" value="<?php echo $fetched_row['part']; ?>" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="failure" placeholder="failure" value="<?php echo $fetched_row['failure']; ?>" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="status" placeholder="status" value="<?php echo $fetched_row['status']; ?>" required /></td>
	</tr>
	<tr>
    <td><input type="text" name="Date_" placeholder="Date_" value="<?php echo $fetched_row['Date_']; ?>" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="Time_" placeholder="Time_" value="<?php echo $fetched_row['Time_']; ?>" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="Month_" placeholder="Month_" value="<?php echo $fetched_row['Month_']; ?>" required /></td>
	</tr>
	<tr>
    <td><input type="text" name="WK_" placeholder="wk_" value="<?php echo $fetched_row['WK_']; ?>" required /></td>
	</tr>
	<tr>
  
    
	<tr>
    <td>
    <button type="submit" name="btn-update"><strong>Update</strong></button>
    <button type="submit" name="btn-cancel"><strong>Cancel</strong></button>
    </td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center>
</body>
</html>