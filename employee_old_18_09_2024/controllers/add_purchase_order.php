<?php
include '../includes/check.php';
include '../includes/functions.php';
$store_id=1;
$last_data_id=$_POST['p_id'];
$item_id = $_POST['item_id'];
$qty  = $_POST['qty'];
$unit_id = $_POST['unit_id'];
$rate = $_POST['rate'];
$disc = $_POST['disc'];
$tax  = $_POST['tax'];
$now   = date("Y-m-d H:i:s");


  

$sql="INSERT INTO purchase_order_details(`po_id`,`item_id`,`qty`, `unit_id`,`rate`,`discount`,`tax`,`entry_status`,`date_of_entry`,`store_id`) VALUES ('$last_data_id','$item_id','$qty','$unit_id','$rate','$disc','$tax','1','$now','$store_id')";
// mysqli_query($conn,$sql);
 if (!mysqli_query($conn,$sql)){
   echo("Error description: " . mysqli_error($conn));

 }else{
 echo  $last_data_id;
 }

 
// $data=array('data'=>$sl_no);
// json_encode($data);
?>