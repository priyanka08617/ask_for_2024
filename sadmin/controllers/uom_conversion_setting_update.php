<?php 
 include '../includes/check.php';
 include '../includes/functions.php';
$id=$_POST['id_E'];
$basic_uom_y=sanitize_input($conn,$_POST['basic_uom_E']);
$base_uom_unit_y=sanitize_input($conn,$_POST['base_uom_unit_E']);
$terget_uom_y=sanitize_input($conn,$_POST['terget_uom_E']);
$terget_uom_unit_y=sanitize_input($conn,$_POST['terget_uom_unit_E']);

// terget_uom_E
// terget_uom_unit_E
// status

$sql="UPDATE  uom_conversion_setting SET form_unit_source= '$base_uom_unit_y', form_unit_value= '$basic_uom_y', to_unit_source= '$terget_uom_unit_y', to_unit_value= '$terget_uom_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/uom_conversion.php');
?>