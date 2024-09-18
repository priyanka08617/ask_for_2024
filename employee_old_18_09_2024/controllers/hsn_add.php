<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$type_x=sanitize_input($conn,$_POST['type']);
$code_x=sanitize_input($conn,$_POST['code']);
$description_x=sanitize_input($conn,$_POST['description']);
$rate_x=sanitize_input($conn,$_POST['rate']);

$sql="INSERT INTO  hsn_table ( type, code, description, rate,status)VALUES('$type_x', '$code_x', '$description_x', '$rate_x', '1')";
$query=mysqli_query($conn,$sql);

// echo $sql;
header('location:../views/hsn.php');
?>