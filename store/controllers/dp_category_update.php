<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$cat_y=sanitize_input($conn,$_POST['dp_category_E']);
$sql="UPDATE  dp_category SET category_name= '$cat_y' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/dp_category.php');
?>