<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=$_GET['id'];
$sql="UPDATE stock_locations_category SET status='0' WHERE id='$id'";
$sql="DELETE FROM stock_locations_category WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/stock_locations_category.php');

?>