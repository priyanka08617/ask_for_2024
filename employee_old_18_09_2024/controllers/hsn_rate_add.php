<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$rate_x=sanitize_input($conn,$_POST['rate']);
$sql="INSERT INTO  hsn_rate_master ( rate,status)VALUES('$rate_x', '1')";
$query=mysqli_query($conn,$sql);
header('location:../views/hsn_rate.php');
?>