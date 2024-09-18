<?php
ob_start();
include '../includes/connection.php';
include '../includes/functions.php';


$customer_id = sanitize_input($conn,$_POST["customer_id"]);
$subject = sanitize_input($conn,$_POST["subject"]);
$item_id = $_POST["item_id"];
$price_array = $_POST["price"];
$working_day = sanitize_input($conn,$_POST["working_day"]);
$valid_upto  = sanitize_input($conn,$_POST["valid_upto"]);
$total_price = sanitize_input($conn,$_POST["total_price"]);
$entry_date_time=date('Y-m-d h:s:a');

foreach ($item_id as $key => $item_value) {
  $item[]=$item_value;
}
$item_srz=serialize($item);

foreach ($price_array as $key => $price_value) {
  $price[]=$price_value;
}
$price_srz=serialize($price);

$sql="INSERT INTO `quotation`(`customer_id`, `item_id`, `subject`, `delivery_working_day`, `price_valid_day`, `price`, `entry_date_time`, `status`) VALUES ('$customer_id','$item_srz','$subject','$working_day','$valid_upto','$price_srz','$entry_date_time','1')";

if (!mysqli_query($conn,$sql)){
  echo("Error description: " . mysqli_error($conn));
}

header("location:../views/quotation.php");
exit();
?>