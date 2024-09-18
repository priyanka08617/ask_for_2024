<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$locations_category_y=$_POST['locations_category_E'];
$sql="UPDATE  stock_locations_category SET locations_category= '$locations_category_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/stock_locations_category.php');
?>