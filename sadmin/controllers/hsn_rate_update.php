<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$rate_y=sanitize_input($conn,$_POST['rate_E']);
$sql="UPDATE  hsn_rate_master SET rate= '$rate_y' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/hsn_rate.php');
?>