<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE Terms_condition SET status='0' WHERE id='$id'";
$sql="DELETE FROM Terms_condition WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/Terms_condition.php');

?>