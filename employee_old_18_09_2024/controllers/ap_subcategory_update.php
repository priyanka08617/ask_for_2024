<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$category_id_y=sanitize_input($conn,$_POST['category_id_E']);
$sub_category_y=sanitize_input($conn,$_POST['sub_category_E']);
$sql="UPDATE  ap_subcategory SET category_id= '$category_id_y', sub_category= '$sub_category_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/ap_subcategory.php');
?>