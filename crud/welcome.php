<?php 
session_start();
IF(ISSET($_SESSION['mail']))
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Welcome</title>
<!-- bootstrap-3.3.7 -->
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- JQUERY -->
<script type="text/javascript" language="javascript" src="jquery/jquery.js"></script>

</head>

<style>


</style>

<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.html"); 
});
</script>



<body>

<div id="header"></div>




<center><img src="img\pp.png" alt="device" width="1050" height="600"></center>





<br>
<br>
<br>
<center><p> </p></center>



<br>

<br>
<br>
<center>
	<div class="col-sm-3 col-md-12 ">
	
		<?php include 'footer.php';?>
		
	</div>
</center>


<br>

</body>
</html>

<?php 
}else{
	echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}
?>
