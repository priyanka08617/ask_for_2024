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
$user_type_y=sanitize_input($conn,$_POST['user_type_E']);

$branch_id_y=sanitize_input($conn,$_POST['branch_id_E']);
$username_y=sanitize_input($conn,$_POST['username_E']);
$password_y=sanitize_input($conn,$_POST['password_E']);
// `agent_code`= '$agent_code_y',

$user_category_prefix=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_y'", "username_prefix");
$final_username=$user_category_prefix.$username_y;

$sql="UPDATE  users SET `user_category_id`= '$user_category_y', `first_name`= '$first_name_y', `middle_name`= '$middle_name_y', `last_name`= '$last_name_y', `date_of_birth`= '$date_of_birth_y', `gender`= '$gender_y', `phone`= '$phone_y', `email`= '$email_y', `address`= '$address_y', `branch_id`= '$branch_id_y',`assign_status`='$user_type_y',`status`='1' WHERE `id`='$id'";
$query=mysqli_query($conn,$sql);

if($user_type_y==1){
  $sql1="UPDATE `user_login` SET `user_category_id`= '$user_category_y',`branch_id`='$branch_id_y',`username`='$final_username',`password`='$password_y' WHERE `id`='$id'";
  $query1=mysqli_query($conn,$sql1);
}


header('location:../views/users.php');  
?>