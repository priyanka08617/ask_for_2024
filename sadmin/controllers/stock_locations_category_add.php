<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$locations_category_x=$_POST['locations_category'];
$sql="INSERT INTO  stock_locations_category ( locations_category,status, row_created_on)VALUES('$locations_category_x', '1','$co')";
$query=mysqli_query($conn,$sql);
header('location:../views/stock_locations_category.php');
?>