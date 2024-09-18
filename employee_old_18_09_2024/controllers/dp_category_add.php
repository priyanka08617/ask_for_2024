<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$cat_x=sanitize_input($conn,$_POST['dp_category']);
$sql="INSERT INTO  dp_category (category_name,status)VALUES('$cat_x','1')";
$query=mysqli_query($conn,$sql);
header('location:../views/dp_category.php');
?>