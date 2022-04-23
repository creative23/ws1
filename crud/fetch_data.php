<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
 $query = "   SELECT * FROM images_web WHERE archive = '0'  ";
 
 if(isset($_POST["minimum_"], $_POST["maximum_"]) && !empty($_POST["minimum_"]) && !empty($_POST["maximum_"]))
 {   $query .= "    AND priority BETWEEN '".$_POST["minimum_"]."' AND '".$_POST["maximum_"]."'";  } 
 
 if(isset($_POST["area"]))
 {
  $brand_filter = implode("','", $_POST["area"]);
  $query .= "    AND area IN('".$brand_filter."')   ";
 }
 
 if(isset($_POST["status_"]))
 {
  $ram_filter = implode("','", $_POST["status_"]);
  $query .= "    AND status_ IN('".$ram_filter."')
  ";
 }
 
 if(isset($_POST["user"]))
 {
  $storage_filter = implode("','", $_POST["user"]);
  $query .= "    AND user IN('".$storage_filter."')
  ";
 }

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:5px solid #ccc; border-radius:5px; padding:10px; margin-bottom:16px; height:475px;">
     <img src="uploads/'. $row['file_name'] .'" alt="" class="img-responsive" >
     <p align="center"><strong><a href="#">'. $row['name'] .'</a></strong></p>
     <h4 style="text-align:center;" class="text-success" >'. $row['priority'] .'</h4>
     <p>Comments : '. $row['Comments'].'  <br />
     Area : '. $row['Area'] .' <br />
     Status : '. $row['Status_'] .' <br />
     User : '. $row['User'] .' </p>
    </div>

   </div>
   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
}

?>
