<?php
$conn = new mysqli('localhost', 'root', '', 'tg');

$Id2   = $_POST['id2_'];
$User   = $_POST['User_'];
$Comment   = $_POST['Comment_'];

if ($Comment == "") {
	echo "empty string";
	
	// any query needed to ensure $sql variable is not empty for last If statement below
	$sql="INSERT any";
	
} else {
    $sql="INSERT INTO action_lines (id, id2, Datetime_, user_, comment_ ) VALUES ('null', '$Id2' ,now() , '$User', '$Comment' )";
}



if ($conn->query($sql) === TRUE) {
    echo "row data inserted  "  ;
	}
else 
{
    echo " row insert failed";
}
?>