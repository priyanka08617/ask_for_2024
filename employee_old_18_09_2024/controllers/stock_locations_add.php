<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$locations_category_id_x=$_POST['locations_category_id'];
$location_name_x=$_POST['location_name'];
$location_address_x=$_POST['location_address'];
$phone_no_x=$_POST['phone_no'];
$sql="INSERT INTO  stock_locations ( locations_category_id, location_name, location_address, phone_no,status, row_created_on)VALUES('$locations_category_id_x', '$location_name_x', '$location_address_x', '$phone_no_x', '1','$co')";
$query=mysqli_query($conn,$sql);
header('location:../views/stock_locations.php');
?>