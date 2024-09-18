<?php 
 include '../includes/check.php';
 
include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$user_category_x=sanitize_input($conn,$_POST['user_category']);
$first_name_x=sanitize_input($conn,$_POST['first_name']);
$middle_name_x=sanitize_input($conn,$_POST['middle_name']);
$last_name_x=sanitize_input($conn,$_POST['last_name']);
$date_of_birth_x=sanitize_input($conn,$_POST['date_of_birth']);
$gender_x=sanitize_input($conn,$_POST['gender']);
$phone_x=sanitize_input($conn,$_POST['phone']);
$email_x=sanitize_input($conn,$_POST['email']);
$address_x=sanitize_input($conn,$_POST['address']);
// $agent_code_x=sanitize_input($conn,$_POST['agent_code']);


$username=sanitize_input($conn,$_POST['username']);
$password=sanitize_input($conn,$_POST['password']);



$user_category_prefix=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_x'", "username_prefix");

$final_username=$user_category_prefix.$username;



$sql="INSERT INTO  users ( module_id, user_category_id, first_name, middle_name, last_name, date_of_birth, gender, phone, email, address, status, row_created_on)VALUES('1', '$user_category_x', '$first_name_x', '$middle_name_x', '$last_name_x', '$date_of_birth_x', '$gender_x', '$phone_x', '$email_x', '$address_x',  '1','$co')";
$query=mysqli_query($conn,$sql);

$user_id=mysqli_insert_id($conn);



mysqli_query($conn,"INSERT INTO user_login(module_id, user_category_id, user_id, username, password, status, row_created_on) VALUES ('1','$user_category_x','$user_id','$final_username','$password','1','$co')");











header('location:../views/users.php');
?>