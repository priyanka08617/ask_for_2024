<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE enquiry_management SET status='0' WHERE id='$id'";
$sql="DELETE FROM enquiry_management WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/enquiry_management.php');

?>