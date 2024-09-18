<?php 
 include '../includes/check.php';
include '../includes/functions.php';

$price_management_id=$_GET['price_management_id'];


$sql="UPDATE price_management SET status='0' WHERE id='$price_management_id' AND location_id='$store_id'";
$query=mysqli_query($conn,$sql);

header('location:../views/assembled_product.php');

?>