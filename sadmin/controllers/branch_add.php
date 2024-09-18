<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$name_x=sanitize_input($conn,$_POST['name']);
$address_x=sanitize_input($conn,$_POST['address']);
$gst_x=sanitize_input($conn,$_POST['gst']);
$contact_no_x=sanitize_input($conn,$_POST['contact_no']);
$city_x=sanitize_input($conn,$_POST['city']);
$state_x=sanitize_input($conn,$_POST['state']);
$sql="INSERT INTO  branch ( name, address, gst, contact_no, city, state,status, row_created_on)VALUES('$name_x', '$address_x', '$gst_x', '$contact_no_x', '$city_x', '$state_x', '1','$co')";

echo $sql;
$query=mysqli_query($conn,$sql);
echo mysqli_error($conn);
// header('location:../views/branch.php');
?>