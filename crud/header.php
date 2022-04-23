<?php
include_once 'dbconfig.php';

session_start();

IF(!ISSET($_SESSION['mail']))
{
echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='login.php';</script>";	
}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
	background-color: #ffffff;
	background-image: url('img/beach.jpg');
    background-repeat: no-repeat;
	filter:sepia(100%);
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 40px;
}

.sidenav a {
    padding: 8px 8px 8px 8px;
    text-decoration: none;
    font-size: 20px;
    color: #000000;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0px;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: right;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 10px 10px;
  text-decoration: none;
  font-size: 14px;
}

.navbar a:hover {
  background: #ddd;
  color: black;
}

#mySearch {
  width: 100%;
  font-size: 20px;
  padding: 5px;
  border:1px solid #ddd;
}

#main {
    transition: margin-left .5s;
    padding: 10px;
}

@media screen and (max-height: 400px) {
  .sidenav {padding-top: 10px;}
  .sidenav a {font-size: 10px;}
}
</style>
</head>
<body>

<div class="navbar">
<a class="navbar-brand pull-right" href="logout.php"> <span class="glyphicon glyphicon-off"></span> Logout </a>
<a class="navbar-brand pull-center"> <?php echo $_SESSION["mail"]; ?> </a>
<a class="navbar-brand pull-right"><span class="glyphicon glyphicon-user"></span>   </a>
<a class="navbar-brand pull-center"> <p id="date"></p></a>
<a class="navbar-brand pull-center"> Business Intelligence Web App </a>

</div>


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
	<h3>Business Intelligence</h3>
	
	<input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
  
  <ul id="myMenu">

  
	<div> 
	
	
	  <li><a href="welcome.php"><i class="fa fa-fw fa-home" ></i>Welcome</a></li>
	  <li><a href="dashboard.php"><i class="fa fa-line-chart"></i>Dashboard</a></li>
	  <li><a href="partlogger.php"><i class="fa fa-fw fa-wrench"></i>Part Logger</a></li>	
	  <li><a href="partmetrics.php"><i class="fa fa-line-chart"></i> Part Metrics</a></li>
	  <li><a href="actionslogger.php"><i class="fa fa-fw fa-envelope"></i> Actions Logger</a></li>
	  <li><a href="actionsmetrics.php"><i class="fa fa-line-chart"></i> Actions Metrics</a></li>
	  <li><a href="oee.php"><i class="fa fa-line-chart"></i> OEE Metrics</a></li>
	  <li><a href="images.php"><i class="fa fa-image"></i> Images</a></li>
	  <li><a href="android.php"><i class="fa fa-android"></i> Android</a></li>
	  <li><a href="#"><i class="fa fa-wrench"></i> Admin</a></li>
	  <li><a href="logout.php"><i class="fa fa-fw fa-user"></i>Log Out</a></li>
	
	</div>
	
  </ul>
  
</div>

<div id="main">
  <h2></h2>  
  <span style="font-size:40px;cursor:pointer"  onclick="openNav()">&#9776;</span>
</div>






<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
</script>
<script>
var n = new Date();

y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
document.getElementById("date").innerHTML = d + "/" + m + "/" + y;

</script>

<script>
function myFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  ul = document.getElementById("myMenu");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>
  
</body>
</html> 