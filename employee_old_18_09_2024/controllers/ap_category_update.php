<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$category_y=sanitize_input($conn,$_POST['category_E']);
$sql="UPDATE  ap_category SET category= '$category_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/ap_category.php');
?>