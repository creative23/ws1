<?php
//include_once 'dbconfig.php';
include('database_connection.php');

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

  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

  

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
	

<title>Images</title>




<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html");   
});
</script>


</head>

<body>

<div id="header">
</div>



<div class="container">
 <div class="row">
         <br />
         <h2 align="center">Uploaded Images</h2>
         <br />
    <center>
	
	<form action="images_upload.php">
		<input class="btn btn-success"  type="submit" value="Upload an Image" />
	</form>
	</center>

  <div class="col-md-3">                    
    
		<div class="list-group">
		 
			 <h3>Priority</h3>
					<input type="hidden" id="hidden_minimum_" value="0" />
						<input type="hidden" id="hidden_maximum_" value="5" />
							   <p id="_show">1 - 5</p>
			 <div id="_range"></div>
		 
		</div>    
                
		<div class="list-group">  
				<h3>Area</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
		<?php

                    $query = "SELECT DISTINCT(area) FROM images_web WHERE archive = '0' ORDER BY area ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector area" value="<?php echo $row['area']; ?>"  > <?php echo $row['area']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
        </div>

		<div class="list-group">
			<h3>Status </h3>
                    <?php

                    $query = "
                    SELECT DISTINCT(status_) FROM images_web WHERE archive = '0' ORDER BY status_
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector status_" value="<?php echo $row['status_']; ?>" > <?php echo $row['status_']; ?> </label>
                    </div>
                    <?php    
                    }

                    ?>
		</div>
    
		<div class="list-group">
			<h3>User</h3>
     <?php
                    $query = "
                    SELECT DISTINCT(user) FROM images_web WHERE archive = '0' ORDER BY user 
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector user" value="<?php echo $row['user']; ?>"  > <?php echo $row['user']; ?> </label>
                    </div>
                    <?php
                    }
                    ?> 
        </div>
    </div>

    <div class="col-md-9">
             <br />
                <div class="row filter_data">
                </div>
    </div>
 </div>

</div>
<style>
#loading
{
 text-align:center; 
 background: url('loader.gif') no-repeat center; 
 height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_ = $('#hidden_minimum_').val();
        var maximum_ = $('#hidden_maximum_').val();
        
		var area = get_filter('area');
        var status_ = get_filter('status_');
        var user = get_filter('user');
		
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_:minimum_, maximum_:maximum_, area:area, status_:status_, user:user},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#_range').slider({
        range:true,
        min:1,
        max:5,
        values:[1, 5],
        step:1,
        stop:function(event, ui)
        {
            $('#_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_').val(ui.values[0]);
            $('#hidden_maximum_').val(ui.values[1]);
            filter_data();
        }
    });

});
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