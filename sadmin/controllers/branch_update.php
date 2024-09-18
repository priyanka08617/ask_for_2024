<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$name_y=sanitize_input($conn,$_POST['name_E']);
$address_y=sanitize_input($conn,$_POST['address_E']);
$gst_y=sanitize_input($conn,$_POST['gst_E']);
$contact_no_y=sanitize_input($conn,$_POST['contact_no_E']);
$city_y=sanitize_input($conn,$_POST['city_E']);
$state_y=sanitize_input($conn,$_POST['state_E']);
$sql="UPDATE  branch SET name= '$name_y', address= '$address_y', gst= '$gst_y', contact_no= '$contact_no_y', city= '$city_y', state= '$state_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);

// echo mysqli_error($conn);
header('location:../views/branch.php');
?>