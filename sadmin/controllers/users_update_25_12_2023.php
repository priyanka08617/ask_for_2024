<?php 
 include '../includes/check.php';

   include '../includes/functions.php';
$id=$_POST['id_E'];
$user_category_y=sanitize_input($conn,$_POST['user_category_E']);
$first_name_y=sanitize_input($conn,$_POST['first_name_E']);
$middle_name_y=sanitize_input($conn,$_POST['middle_name_E']);
$last_name_y=sanitize_input($conn,$_POST['last_name_E']);
$date_of_birth_y=sanitize_input($conn,$_POST['date_of_birth_E']);
$gender_y=sanitize_input($conn,$_POST['gender_E']);
$phone_y=sanitize_input($conn,$_POST['phone_E']);
$email_y=sanitize_input($conn,$_POST['email_E']);
$address_y=sanitize_input($conn,$_POST['address_E']);
$agent_code_y=sanitize_input($conn,$_POST['agent_code_E']);
$sql="UPDATE  users SET user_category_id= '$user_category_y', first_name= '$first_name_y', middle_name= '$middle_name_y', last_name= '$last_name_y', date_of_birth= '$date_of_birth_y', gender= '$gender_y', phone= '$phone_y', email= '$email_y', address= '$address_y', agent_code= '$agent_code_y',status='1' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/users.php');
?>