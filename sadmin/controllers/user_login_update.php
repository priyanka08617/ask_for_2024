<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$module_id_y=sanitize_input($conn,$_POST['module_id_E']);
$user_category_id_y=sanitize_input($conn,$_POST['user_category_id_E']);
$username_y=sanitize_input($conn,$_POST['username_E']);
$password_y=sanitize_input($conn,$_POST['password_E']);
$sql="UPDATE  user_login SET module_id= '$module_id_y', user_category_id= '$user_category_id_y', username= '$username_y', password= '$password_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/user_login.php');
?>