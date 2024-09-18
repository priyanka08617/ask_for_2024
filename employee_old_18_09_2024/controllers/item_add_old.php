<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$item_x=sanitize_input($conn,$_POST['item']);
$uom_id_x=sanitize_input($conn,$_POST['uom_id']);
$part_no_x=sanitize_input($conn,$_POST['part_no']);
$hsn_table_id_x=sanitize_input($conn,$_POST['hsn_table_id']);
$hsn_rate_id_x=sanitize_input($conn,$_POST['hsn_rate_id']);
$sql="INSERT INTO  item (cat_id,sub_cat_id, item_type, item, uom_id, part_no, hsn_table_id, hsn_rate_id,table_name,status, row_created_on)VALUES('1','1','1','$item_x', '$uom_id_x', '$part_no_x', '$hsn_table_id_x', '$hsn_rate_id_x','1','1','$co')";
$query=mysqli_query($conn,$sql);
header('location:../views/item.php');
?>