<?php
include '../includes/check.php';
include '../includes/functions.php';
$store_id=1;
$last_data_id=$_POST['p_id'];
$item_id = $_POST['item_id'];
$qty  = $_POST['qty'];
$rate = $_POST['rate'];
$disc = $_POST['disc'];
$tax  = $_POST['tax'];
$sl_no  = $_POST["sl_no"];
$unit_id = $_POST['unit_id'];
$total = $_POST['total'];
$now   = date("Y-m-d H:i:s");


for($i=0;$i<count($sl_no);$i++){
  $serial_no=$sl_no[$i];
  $sql1="INSERT INTO `serial_no_of_item`(`purchase_id`, `sl_no`, `row_created_on`, `status`) VALUES ('$last_data_id','$serial_no','$now','1')";
  $query=mysqli_query($conn,$sql1);

}

// Converting the array to comma separated string



  

$sql="INSERT INTO purchase_details(`po_id`,`item_id`,`qty`, `unit_id`,`rate`,`discount`,`tax`,`price`, `entry_status`,`date_of_entry`,`store_id`) VALUES ('$last_data_id','$item_id','$qty','$unit_id','$rate','$disc','$tax','$total','1','$now','$store_id')";
// mysqli_query($conn,$sql);
 if (!mysqli_query($conn,$sql)){
   echo("Error description: " . mysqli_error($conn));

 }else{
 echo  $last_data_id;
 }

 
// $data=array('data'=>$sl_no);
// json_encode($data);
?>