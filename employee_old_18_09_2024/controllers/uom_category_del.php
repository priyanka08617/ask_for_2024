<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['UomCategory_id']);
$sql="UPDATE uom_category SET status='0' WHERE id='$id'";
// $sql="DELETE FROM uom_category WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/uom_category.php');

?>