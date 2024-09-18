<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$terms_for_x=sanitize_input($conn,$_POST['terms_for']);
$terms_x=sanitize_input($conn,$_POST['terms']);
$sql="INSERT INTO  Terms_condition ( terms_for, terms,status, row_created_on)VALUES('$terms_for_x', '$terms_x', '1','$co')";
$query=mysqli_query($conn,$sql);
header('location:../views/Terms_condition.php');
?>