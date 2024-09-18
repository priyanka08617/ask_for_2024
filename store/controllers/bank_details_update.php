<?php 
 include '../includes/check.php';
include '../includes/functions.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$id=sanitize_input($conn,$_POST['id_E']);
$bank_name_x=sanitize_input($conn,$_POST['bank_name_E']);
$account_noo_x=sanitize_input($conn,$_POST['account_no_E']);
$ifsc_code_x=sanitize_input($conn,$_POST['ifsc_code_E']);
$branch_x=sanitize_input($conn,$_POST['branch_E']);
$address_x=sanitize_input($conn,$_POST['address_E_for_bank']);
$micr_code_x=sanitize_input($conn,$_POST['micr_code_E']);


// echo $bank_name_x."--".$account_noo_x."--".$ifsc_code_x."--".$branch_x."--".$address_x."--".$micr_code_x;

// $sql="UPDATE  `bank_details` SET `bank_name`= '$bank_name_x', `account_no`= '$account_noo_x', `ifsc_code`= '$ifsc_code_x', `branch`= '$branch_x', `address`='$address_x', `micr_code`='$micr_code_x' WHERE id='$id'";

$sql="UPDATE `bank_details` SET `bank_name`='$bank_name_x',`account_no`='$account_noo_x',`ifsc_code`='$ifsc_code_x',`branch`='$branch_x',`address`='$address_x',`micr_code`='$micr_code_x' WHERE `id`='$id'";
$query=mysqli_query($conn,$sql);
echo mysqli_error($conn);
// echo $sql;
header('location:../views/company.php');
?>