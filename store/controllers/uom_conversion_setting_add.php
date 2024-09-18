<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$basic_uom_x=sanitize_input($conn,$_POST['basic_uom']);
$base_uom_unit_x=sanitize_input($conn,$_POST['base_uom_unit']);
$terget_uom_x=sanitize_input($conn,$_POST['terget_uom']);
$terget_uom_unit_x=sanitize_input($conn,$_POST['terget_uom_unit']);





$sql="INSERT INTO  uom_conversion_setting ( form_unit_source, form_unit_value, to_unit_source, to_unit_value,status)VALUES('$basic_uom_x', '$base_uom_unit_x', '$terget_uom_x', '$terget_uom_unit_x', '1')";


$query=mysqli_query($conn,$sql);
header('location:../views/uom_conversion.php');
?>