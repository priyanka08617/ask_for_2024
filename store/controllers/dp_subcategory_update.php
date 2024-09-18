<?php 
 include '../includes/check.php';
   include '../includes/functions.php';
$id=sanitize_input($conn,$_POST['id_E']);
$category_id_y=sanitize_input($conn,$_POST['dp_category_id_E']);
$subcategory_y=sanitize_input($conn,$_POST['subcategory_E']);

$sql="UPDATE  dp_subcategory SET dp_category_id= '$category_id_y', dp_subcategory= '$subcategory_y' WHERE id='$id'";
$query=mysqli_query($conn,$sql);

header('location:../views/dp_subcategory.php');
?>