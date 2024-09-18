<?php 
 include '../includes/check.php';
include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');

 
$category_x=sanitize_input($conn,$_POST['category']);
$sql="INSERT INTO  ap_category ( category,status)VALUES('$category_x', '1')";
$query=mysqli_query($conn,$sql);
header('location:../views/ap_category.php');
?>