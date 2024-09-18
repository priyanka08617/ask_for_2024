<?php 
 include '../includes/check.php';

include '../includes/functions.php';
$id=sanitize_input($conn,$_GET['id']);
$sql="UPDATE bank_details SET status='0' WHERE id='$id'";
// $sql="DELETE FROM bank_details WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/company.php');

?>