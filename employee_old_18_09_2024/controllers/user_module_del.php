<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE user_module SET status='0' WHERE id='$id'";
// $sql="DELETE FROM user_module WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/user_module.php');

?>