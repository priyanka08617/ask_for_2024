<?php 
 include '../includes/check.php';

   include '../includes/functions.php';

$id=sanitize_input($conn,$_POST['id_E']);
$customer_mail_y=sanitize_input($conn,$_POST['customer_mail_E']);
$customer_name_y=sanitize_input($conn,$_POST['customer_name_E']);
$customer_mobile_y=sanitize_input($conn,$_POST['customer_mobile_E']);
$Enquiry_y=sanitize_input($conn,$_POST['Enquiry_E']);

$sql="UPDATE  `enquiry_management` SET `customer_name`= '$customer_name_y', `customer_mobile`= '$customer_mobile_y', `Enquiry`= '$Enquiry_y', `customer_mail`= '$customer_mail_y', `status`='1' WHERE `id`='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/enquiry_management.php');
?>