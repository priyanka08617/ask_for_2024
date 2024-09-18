<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$category_id_x=sanitize_input($conn,$_POST['category_id']);
$sub_category_x=sanitize_input($conn,$_POST['sub_category']);


$sql="INSERT INTO  ap_subcategory ( category_id, sub_category,location_id,status)VALUES('$category_id_x', '$sub_category_x','$store_id', '1')";
$query=mysqli_query($conn,$sql);
header('location:../views/ap_subcategory.php');
?>