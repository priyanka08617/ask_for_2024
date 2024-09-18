<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE enquiry_management SET status='0' WHERE id='$id'";
$query=mysqli_query($conn,$sql);


$sql1="UPDATE enquiry_management_timeline SET status='0' WHERE enquiry_management_id='$id'";
$query=mysqli_query($conn,$sql1);

header('location:../views/enquiry_management.php');

?>