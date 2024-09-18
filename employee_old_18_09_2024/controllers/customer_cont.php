<?php
ob_start();
include '../includes/connection.php';
include '../includes/functions.php';


$customer_type = sanitize_input($conn,$_POST["customer_type"]);
$phone = sanitize_input($conn,$_POST["phone"]);
$name = sanitize_input($conn,$_POST["name"]);
$attention = sanitize_input($conn,$_POST["attention"]);
$display_name = sanitize_input($conn,$_POST["display_name"]);
$address = sanitize_input($conn,$_POST["address"]);
$email = sanitize_input($conn,$_POST["email"]);
$city = sanitize_input($conn,$_POST["city"]);
$gst = sanitize_input($conn,$_POST["gst"]);
$state_id = sanitize_input($conn,$_POST["state_id"]);
$zip_code = sanitize_input($conn,$_POST["zip_code"]);

$row_created_on=date('Y-m-d h:s:a');


$sql="INSERT INTO `customer_details`(`customer_type`, `primary_name`, `display_name`, `mob`, `email`,`gst`, `row_created_on`,`status` ) VALUES ('$customer_type','$name','$display_name','$phone','$email','$gst','$row_created_on','1')";
$query=mysqli_query($conn,$sql);
$customer_last_id=mysqli_insert_id($conn);

$sql1="INSERT INTO `billing_shipping_address`(`customer_id`, `attention`, `address`, `city`, `state_id`, `zip_code`, `phone`, `status`) VALUES ('$customer_last_id','$attention','$address','$city','$state_id','$zip_code','$phone','1')";

header("location:../views/customer_details.php");

?>