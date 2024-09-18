<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$item_y=sanitize_input($conn,$_POST['item_E']);
$uom_id_y=sanitize_input($conn,$_POST['uom_id_E']);
$part_no_y=sanitize_input($conn,$_POST['part_no_E']);
$hsn_table_id_y=sanitize_input($conn,$_POST['hsn_table_id_E']);
$hsn_rate_id_y=sanitize_input($conn,$_POST['hsn_rate_id_E']);
$sql="UPDATE  job_work SET item= '$item_y', uom_id= '$uom_id_y', part_no= '$part_no_y', hsn_table_id= '$hsn_table_id_y', hsn_rate_id= '$hsn_rate_id_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/job_work.php');
?>