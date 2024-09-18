<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$uom_cate_id_y=sanitize_input($conn,$_POST['uom_cate_id_E']);
$uom_y=sanitize_input($conn,$_POST['uom_E']);
$symbol_y=sanitize_input($conn,$_POST['symbol_E']);
$sql="UPDATE  uom SET uom_cate_id= '$uom_cate_id_y', uom_name= '$uom_y', symbol= '$symbol_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);


header('location:../views/uom.php');
?>