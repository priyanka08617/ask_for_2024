<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$uom_cate_id_x=sanitize_input($conn,$_POST['uom_cate_id']);
$uom_x=sanitize_input($conn,$_POST['uom']);
$symbol_x=sanitize_input($conn,$_POST['symbol']);
$sql="INSERT INTO  uom ( uom_cate_id, uom_name, symbol,status)VALUES('$uom_cate_id_x', '$uom_x', '$symbol_x', '1')";
$query=mysqli_query($conn,$sql);
header('location:../views/uom.php');
?>