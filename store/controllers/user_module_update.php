<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=sanitize_input($conn,$_POST['id_E']);
$module_name_y=$_POST['module_name_E'];
$sql="UPDATE  user_module SET module_name= '$module_name_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/user_module.php');
?>