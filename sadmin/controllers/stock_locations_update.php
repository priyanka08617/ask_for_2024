<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$locations_category_id_y=$_POST['locations_category_id_E'];
$location_name_y=$_POST['location_name_E'];
$location_address_y=$_POST['location_address_E'];
$phone_no_y=$_POST['phone_no_E'];
$sql="UPDATE  stock_locations SET locations_category_id= '$locations_category_id_y', location_name= '$location_name_y', location_address= '$location_address_y', phone_no= '$phone_no_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/stock_locations.php');
?>