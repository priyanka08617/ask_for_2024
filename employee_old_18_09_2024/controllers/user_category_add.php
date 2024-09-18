<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$module_id_x=sanitize_input($conn,$_POST['module_id']);
$user_category_x=sanitize_input($conn,$_POST['user_category']);
$username_prefix_x=sanitize_input($conn,$_POST['username_prefix']);
$sql="INSERT INTO  user_category ( module_id, user_category, username_prefix,status, row_created_on)VALUES('$module_id_x', '$user_category_x', '$username_prefix_x', '1','$co')";
$query=mysqli_query($conn,$sql);
header('location:../views/user_category.php');
?>