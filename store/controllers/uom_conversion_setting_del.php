<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE uom_conversion_setting SET status='0' WHERE id='$id'";
// $sql="DELETE FROM uom_conversion_setting WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/uom_conversion.php');

?>