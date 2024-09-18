<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$name_y=sanitize_input($conn,$_POST['name_E']);
$sql="UPDATE  uom_category SET name= '$name_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/uom_category.php');
?>