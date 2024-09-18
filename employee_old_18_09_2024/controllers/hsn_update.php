<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$type_y=sanitize_input($conn,$_POST['type_E']);
$code_y=sanitize_input($conn,$_POST['code_E']);
$description_y=sanitize_input($conn,$_POST['description_E']);
$rate_y=sanitize_input($conn,$_POST['rate_E']);

$sql="UPDATE  hsn_table SET type= '$type_y', code= '$code_y', description= '$description_y', rate= '$rate_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/hsn.php');
?>