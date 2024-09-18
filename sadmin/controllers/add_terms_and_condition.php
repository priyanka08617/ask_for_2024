<?php
include '../includes/connection.php';
include '../includes/functions.php';


	$name=$_POST['name'];
  $terms_for_x=sanitize_input($conn,$_POST['terms_for']);


for($i=0;$i<count($name);$i++){

$terms_condition_name=sanitize_input($conn,$name[$i]);
$sql="INSERT INTO `terms_and_condition`(`terms_for`,`name`,`status`) VALUES ('$terms_for_x','$terms_condition_name','1')";
if (!mysqli_query($conn,$sql)){
  echo("Error description: " . mysqli_error($conn));
}
}
header ("location: ../views/terms_and_condition.php");
      

?>