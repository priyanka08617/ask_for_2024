<?php
ob_start();
include '../includes/connection.php';
include '../includes/functions.php';


$bank_name = sanitize_input($conn,$_POST["bank_name"]);
$account_no = sanitize_input($conn,$_POST["account_no"]);
$ifsc_code = sanitize_input($conn,$_POST["ifsc_code"]);
$branch = sanitize_input($conn,$_POST["branch"]);
$micr_code = sanitize_input($conn,$_POST["micr_code"]);


$row_created_on=date('Y-m-d h:s:a');


$sql="INSERT INTO `bank_details`(`bank_name`, `account_no`, `ifsc_code`, `branch`, `micr_code`, `active_status`, `status`) VALUES ('$bank_name','$account_no','$ifsc_code','$branch','$micr_code','1','1')";
$query=mysqli_query($conn,$sql);

header("location:../views/company.php");

?>