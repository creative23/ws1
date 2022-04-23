<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>

<!-- bootstrap-3.3.7 -->
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- JQUERY -->
<script type="text/javascript" language="javascript" src="jquery/jquery.js"></script>

<link href="style/style.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" language="javascript" src="style/style.js"></script>

</head>

<script> 
$(function(){
  
  $("#footer").load("footer.html"); 
});
</script>


<body>

<div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/avatar.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" value="i.singh7@wlv.ac.uk" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" name="password"  value="1" class="form-control" placeholder="Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"  name="login">Sign in</button>
            </form>
            
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
<?php
include "dbconfig.php";
IF(ISSET($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//$result = mysqli_query("SELECT * FROM table1", $link);
	//$num_rows = mysqli_num_rows($result);
	
	$cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM user_login WHERE email='$email' AND password='$password'"));
	$data = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM user_login WHERE email='$email' AND password='$password'"));
	IF($cek > 0)
	{
		session_start();
		//$_SESSION["mail"] = "green";
		
		//For some reason $data is blank, so local variable assigned which works.
		echo $_SESSION['mail'] = $data['email'];
		//$_SESSION['name'] = $data['full_name'];
		echo "<script language=\"javascript\">alert(\"welcome \");document.location.href='welcome.php';</script>";
	}else{
		echo "<script language=\"javascript\">alert(\"Invalid username or password\");document.location.href='login.php';</script>";
	}
}
?>