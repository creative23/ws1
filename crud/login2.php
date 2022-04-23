<?php
// Start the session
session_start();
?>


<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["mail"] = "green";

echo "Session variables are set.";

echo "<script language=\"javascript\">alert(\"welcome \");document.location.href='welcome.php';</script>";

?>

</body>
</html>