<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$module_name_x=sanitize_input($conn,$_POST['module_name']);
$sql="INSERT INTO  user_module ( module_name,status, row_created_on)VALUES('$module_name_x', '1','$co')";
$query=mysqli_query($conn,$sql);
header('location:../views/user_module.php');
?>