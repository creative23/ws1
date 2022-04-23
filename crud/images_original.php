<?php
include_once 'dbconfig.php';
session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='http://192.168.1.11/ws/crud/login.php';</script>";	
}



// delete condition
if(isset($_GET['delete_id']))
{
	$sql_query="DELETE FROM images_web WHERE id=".$_GET['delete_id'];
	
	$result_set = $mysqli->query($sql_query);
	
	
	header("Location: $_SERVER[PHP_SELF]");
}


?>

<!DOCTYPE html>
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<title>Images</title>

<script type="text/javascript">

function delete_id(id)
{
	if(confirm('Sure to Delete ?'))
	{
		window.location.href='images.php?delete_id='+id;
	}
}
</script>

<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html");   
});
</script>




<style>
img{
    max-width:450px;
    max-height:650px;
}

.popover {
    top: 250px !important;
    left: 379px !important;
	max-width:1000px;
    max-height:1000px;
}

#images td, #images th {
    border: 3px solid #333;
    padding: 8px;
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

</head>
<body>

<div id="header"></div>


<div class="container">  
	<h1 align="center">Images</h1>             
</div>
<br>

<br>

<br>

<br>
<div id="body">
	
	<div id="content">
    
	<table align="center" id="images" >
    
	<tr>
 
    </tr>
	<th>FileName</th>
    <th>Uploaded On <align="center"/> </th>
    <th>Name <align="center"/> </th>
	<th>Image</th>	    
	<th>Delete</th>
    
    </tr>
    <?php
	
	//$mysqli = new mysqli("localhost", "root", "", "tg");
	
	$sql_query="SELECT * FROM images_web";
	
	$result_set = $mysqli->query($sql_query);
		
	if(mysqli_num_rows($result_set)>0)
	{
        while($row=mysqli_fetch_array($result_set))
		{
		?>
            <tr>
			
            <td><p style="font-size:14px;"> <?php echo $row[1]; ?></td>
            <td><p style="font-size:14px;"> <?php echo $row[2]; ?></td>						
			
			<td><p style="font-size:14px;"><?php echo $row[5]; ?></td>		         
			
			<td>  <img  class="img-circle" src="<?php echo $row[4]; ?>"/>   </td>
			
		
            <td align="center"><a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
            
			</tr>
			
		
    </div>

   </div>
			
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



</body>
</html>