<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';


// $username   = sanitize_input($conn,$_POST["username"]); 
$password   = sanitize_input($conn,$_POST["password"]); 


// username='$username',
$sql1="UPDATE `user_login` SET  password='$password' WHERE `id`='$user_login_id' ";
$query=mysqli_query($conn,$sql1);


if(session_destroy()){

    header("location:../index.php");

  }; 

 ?>
