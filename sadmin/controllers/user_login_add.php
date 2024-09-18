<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$module_id_x=sanitize_input($conn,$_POST['user_module']);
$user_category_id_x=sanitize_input($conn,$_POST['user_category']);


$username_x=sanitize_input($conn,$_POST['username']);
$user_category_prefix=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_id_x'", "username_prefix");

$username=$user_category_prefix.$username_x;

$password_x=sanitize_input($conn,$_POST['password']);
$sql="INSERT INTO  user_login ( module_id, user_category_id, username, password,status, row_created_on)VALUES('$module_id_x', '$user_category_id_x', '$username', '$password_x', '1','$co')";
$query=mysqli_query($conn,$sql);
header('location:../views/user_login.php');
?>


