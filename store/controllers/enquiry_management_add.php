<?php 
 include '../includes/check.php';
 include '../includes/functions.php';


$co=date('Y-m-d H:i:s');

$user_category_id_x=sanitize_input($conn,$_POST['user_category_id']);
$created_by_x=sanitize_input($conn,$_POST['created_by']);
$source_type_x=sanitize_input($conn,$_POST['source']);
$source_data_id_x=sanitize_input($conn,$_POST['source_data_id']);
$customer_name_x=sanitize_input($conn,$_POST['customer_name']);
$customer_mobile_x=sanitize_input($conn,$_POST['customer_mobile']);
$customer_mail_x=sanitize_input($conn,$_POST['customer_mail']);
$enquiry_date_x=sanitize_input($conn,$_POST['enquiry_date']);
$enquiry_x=sanitize_input($conn,$_POST['enquiry']);
$poa_x=sanitize_input($conn,$_POST['poa']);
$poa_date_x=sanitize_input($conn,$_POST['poa_date']);
$poa_time_x=sanitize_input($conn,$_POST['poa_time']);
$poa_remarks_x=sanitize_input($conn,$_POST['poa_remarks']);
$enquiry_status_x=sanitize_input($conn,$_POST['enquiry_status']);
$start_call="00:00:00";
$end_Call="00:00:00";
$remark2="";



$sql3="INSERT INTO  `enquiry_management` ( `enquiry_date`,`source_type`,`source`, `customer_name`,`customer_mobile`,`customer_mail`, `enquiry`,`created_by`,`store_id`,`user_category_id`,`row_created_on`,`status`)VALUES('$enquiry_date_x','$source_type_x','$source_data_id_x', '$customer_name_x','$customer_mobile_x','$customer_mail_x','$enquiry_x','$created_by_x','$store_id','$user_category_id_x','$co','1')";

// echo $sql3;
$query3=mysqli_query($conn,$sql3);
$last_id=mysqli_insert_id($conn);


$sql1="INSERT INTO `enquiry_management_timeline`(`enquiry_management_id`,`poa`,`date`, `time`, `remarks1`, `row_created_on`,`poa_action_status`, `status`,`start_call`,`end_call`,`remarks2`,`enquiry_status`) VALUES ('$last_id','$poa_x','$poa_date_x','$poa_time_x','$poa_remarks_x','$co','1','1','$start_call','$end_Call','$remark2','$enquiry_status_x')";
$query1=mysqli_query($conn,$sql1);
echo mysqli_error($conn);


header('location:../views/enquiry_management.php');
?>