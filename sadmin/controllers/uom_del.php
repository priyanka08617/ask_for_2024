<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE uom SET status='0' WHERE id='$id'";
// $sql="DELETE FROM Uom WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/uom.php');

?>