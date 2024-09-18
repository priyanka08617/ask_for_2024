<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$terms_for_y=sanitize_input($conn,$_POST['terms_for_E']);
$terms_y=sanitize_input($conn,$_POST['terms_E']);
$sql="UPDATE  Terms_condition SET terms_for= '$terms_for_y', terms= '$terms_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/Terms_condition.php');
?>