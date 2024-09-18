<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$module_id_y=sanitize_input($conn,$_POST['module_id_E']);
$user_category_y=sanitize_input($conn,$_POST['user_category_E']);
$username_prefix_y=sanitize_input($conn,$_POST['username_prefix_E']);
$sql="UPDATE  user_category SET module_id= '$module_id_y', user_category= '$user_category_y', username_prefix= '$username_prefix_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/user_category.php');
?>