<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$name_x=sanitize_input($conn,$_POST['name']);
$sql="INSERT INTO  uom_category ( name,status)VALUES('$name_x', '1')";
$query=mysqli_query($conn,$sql);
header('location:../views/uom_category.php');
?>