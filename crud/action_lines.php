<?php
include_once 'dbconfig.php';

session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}

$con = mysqli_connect('localhost','root','','tg');


if(isset($_GET['edit_id']))
{
	
$id2 = $_GET['edit_id'];		
//$mail = $_GET['mail'];	
	
}
else {
    echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Comment</title>
<!-- bootstrap-3.3.7 -->
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- JQUERY -->
<script type="text/javascript" language="javascript" src="jquery/jquery.js"></script>

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
    padding: 50px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}




* {
    box-sizing: border-box;
}

input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}
</style>
</head>

<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html");   
});
</script>

<body>

<div id="header">
</div>

<div id="server_response"><b>Server here.</b></div>

 <div class="row">
    <div class="col-sm-12">
	<center>	
		<h1>Add a Comment</h1>   
		<h3>id <?php echo $id2; ?> </h3> 	
		<h3>id <?php echo $_SESSION["mail"]; ?> </h3> 	
	</center>	
    </div>
 </div>
  
<center>
<br>
<div id="sqltable"><b>Records to be listed here.</b></div>
<br>
</center>

  <center>
<input type="button" id="clickMe"  value="List Records" onclick="showData();" />
</center>
  
<div class="container">
  <form>
  

    
	
	 

	<div class="row">
		  <div class="col-25">
			<label for="subject">Comments</label>
		  </div>
		  <div class="col-75">
			<textarea id="comments" name="comments" placeholder="Write something.." style="height:200px"></textarea>
		  </div>
		
   </div>
	
	
			
		
	
  </form>
  
  <div class="row">
      <input type="submit"  id="submit_button">
  </div>
  
</div>






<center>

<br>
<br>
<br>

<div id="body">
	<div id="content">
    <table align="center" id="images" >
   
    <th>id</th>
	<th>Date</th>
	<th>Person</th>	
	<th>Comment</th>
	

    

    <?php	
	
	$sql_query="SELECT id, date(Datetime_) as Datetime_, User_, Comment_ FROM action_lines WHERE id2=".$_GET['edit_id'];
	
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

<br>
<br>
<br>
<br>

<center>
	<div class="col-sm-3 col-md-12 ">	
		<?php include 'footer.php';?>		
	</div>
</center>

</body>
</html>

<script>
        $(document).ready(function(){
            $("#submit_button").click(function(){
				 
				var value_0 = <?php echo $id2; ?>;	
				var value_1 = "<?php echo $_SESSION["mail"]; ?>";       														
				var value_2 = $("#comments").val();								

				$('#comments').val("");
				
                $.ajax({
                    url:'insert_action_lines.php',					
                    method:'POST',
                    data:{
						id2_:  value_0,                       								
						User_:value_1,		
						Comment_:value_2				                        
                    },
                   success:function(data){
                       alert(data);
					   $('#part').val("");
					   $('#server_response').html(data);
                   }
                });
            });
        });
</script>

<script>  
 
  function showData(){
	  
	  var str = <?php echo $id2; ?>;	
                      $.ajax({
                         type: 'GET',
                         //url: 'get_action_lines.php', 
						 url: "get_action_lines.php?edit_id="+str, 									 
                         success: function(data){
                            //alert(str);
							$('#sqltable').html(data);
						
                         }
                      });
					  
	 //location.reload();				  
   } 

</script>