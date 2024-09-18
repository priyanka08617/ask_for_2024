<?php
ob_start();
include '../includes/connection.php';
session_start();
$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
// $login_id=$_SESSION['login_id'];
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
$store_id=$sql_query_row["branch_id"];

// echo $store_id;
// ECHO "<BR>";
// echo $user_id;
// $store_id=1;
// $created_by=1;

// $sql_loc="SELECT * FROM location Where status='1'";
// $sql_query_loc=mysqli_query($conn,$sql_loc);
// $sql_loc_details=mysqli_fetch_array($sql_query_loc);
// $store_id=$sql_loc_details['id'];
// $sql = "SELECT * FROM color_hex";
// $query = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($query);
// $color_hex = $row['hex'];





?>

