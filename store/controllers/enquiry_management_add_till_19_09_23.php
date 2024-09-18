<?php 
ob_start();
 include '../includes/check.php';
 include '../includes/functions.php';


$co=date('Y-m-d H:i:s');
$source_type_x=sanitize_input($conn,$_POST['source']);
$source_data_id_x=sanitize_input($conn,$_POST['source_data_id']);
$customer_name_x=sanitize_input($conn,$_POST['customer_name']);
$customer_mobile_x=sanitize_input($conn,$_POST['customer_mobile']);
$customer_mail_x=sanitize_input($conn,$_POST['customer_mail']);
$enquiry_x=sanitize_input($conn,$_POST['enquiry']);
$poa_x=sanitize_input($conn,$_POST['poa']);
$poa_date_x=sanitize_input($conn,$_POST['poa_date']);
$poa_time_x=sanitize_input($conn,$_POST['poa_time']);
$poa_remarks_x=sanitize_input($conn,$_POST['poa_remarks']);
$start_call="00:00:00";
$end_Call="00:00:00";
$remark2="";


$sql3="INSERT INTO  `enquiry_management` ( `source_type`,`source`, `customer_name`,`customer_mobile`,`customer_mail`, `enquiry`,`row_created_on`,`status`)VALUES('$source_type_x','$source_data_id_x', '$customer_name_x','$customer_mobile_x','$customer_mail_x','$enquiry_x', '$co','1')";
$query3=mysqli_query($conn,$sql3);
echo mysqli_error($conn);
echo $sql3;
$last_id=mysqli_insert_id($conn);


$sql1="INSERT INTO `enquiry_management_timeline`(`enquiry_management_id`,`poa`,`date`, `time`, `remarks1`, `row_created_on`,`poa_action_status`, `status`,`start_call`,`end_call`,`remarks2`) VALUES ('$last_id','$poa_x','$poa_date_x','$poa_time_x','$poa_remarks_x','$co','1','1','$start_call','$end_Call','$remark2')";
$query1=mysqli_query($conn,$sql1);
echo mysqli_error($conn);
echo $sql1;


header('location:../views/enquiry_management.php');
?>