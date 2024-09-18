<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

$fst_name   = sanitize_input($conn,$_POST["fst_name"]);   
$last_name        = sanitize_input($conn,$_POST["last_name"]);   
$user_email  = sanitize_input($conn,$_POST["user_email"]);      
$address     = sanitize_input($conn,$_POST["address"]); 
$phone_no         = sanitize_input($conn,$_POST["phone_no"]); 
  



$sql="UPDATE employees SET  first_name ='$fst_name',last_name ='$last_name', email_id='$user_email', address ='$address', mobile_no ='$phone_no' WHERE  id ='$user_id'";




$query=mysqli_query($conn,$sql);
echo $sql;
echo mysqli_error($conn);
header("location:../views/profile.php");
exit();
 ?>