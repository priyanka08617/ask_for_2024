<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$category_id_x=sanitize_input($conn,$_POST['dp_category_id']);
$subcategory_x=sanitize_input($conn,$_POST['dp_subcategory']);
$sql="INSERT INTO  dp_subcategory( dp_category_id, dp_subcategory,status)VALUES('$category_id_x', '$subcategory_x','1')";
$query=mysqli_query($conn,$sql);
echo mysqli_error($conn);

// echo $sql;
header('location:../views/dp_subcategory.php');

?>