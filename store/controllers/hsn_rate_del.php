<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE hsn_rate_master SET status='0' WHERE id='$id'";
// $sql="DELETE FROM hsn_rate WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/hsn_rate.php');

?>