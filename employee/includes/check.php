<?php
ob_start();
include '../includes/connection.php';
session_start();
date_default_timezone_set('Asia/Kolkata');


$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
$user_category_id=$_SESSION['user_category_id'];
if(!isset($username))
{
	header("location:../../index.php");
}

$sql_comp="SELECT * FROM `company_details` WHERE `status`='1'";
$sql_query=mysqli_query($conn,$sql_comp);
$sql_comp=mysqli_fetch_array($sql_query);
$comp_name=$sql_comp["name"];



$sql_user="SELECT * FROM `users` Where id='$user_id' AND status='1'";
$sql_query_user=mysqli_query($conn,$sql_user);
$sql_query_row=mysqli_fetch_array($sql_query_user);
$name=$sql_query_row["first_name"]." ".$sql_query_row["last_name"];


$sql_user_login="SELECT * FROM `user_login` Where user_category_id='$user_category_id' AND user_id='$user_id'";
$sql_query_user_login=mysqli_query($conn,$sql_user_login);
$sql_query_row_user_login=mysqli_fetch_array($sql_query_user_login);

$store_id=$sql_query_row_user_login["branch_id"];
$user_login_id=$sql_query_row_user_login["id"];
$password=$sql_query_row_user_login["password"];



// echo $store_id;





?>

