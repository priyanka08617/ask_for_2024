<?php
include '../includes/check.php';
include '../includes/functions.php';


$po_id=$_POST['po_id'];
$sl_no  = $_POST["sl_no"];
// $item_id=$_POST['item_id'];

for($i=0;$i<count($sl_no);$i++){
  $serial_no=$sl_no[$i];
  $sql1="INSERT INTO `serial_no_of_item`(`purchase_id`, `sl_no`, `row_created_on`, `status`) VALUES ('$po_id','$serial_no','$now','1')";
  $query=mysqli_query($conn,$sql1);
  echo mysqli_error($conn);

}



if($_POST['item_id']==""){}else{
    
    $item_id=$_POST['item_id'];
    $qty=$_POST['qty'];
    $rate=$_POST['rate'];
    $disc=$_POST['disc'];
    $tax=$_POST['tax'];
    $unit_id=$_POST['unit_id'];
    $total=$_POST['total'];
    $now=date("Y-m-d H:i:s");






$sql="INSERT INTO purchase_details(`po_id`, `item_id`,`qty`, `unit_id`,`rate`,`discount`,`tax`,`price`, `entry_status`,`date_of_entry`,`store_id`) VALUES ('$po_id','$item_id','$qty','$unit_id','$rate','$disc','$tax','$total','1','$now','$store_id')";


//  echo $sql;
 if (!mysqli_query($conn,$sql)){
   echo("Error description: " . mysqli_error($conn));
 }else{
 echo  $last_id;
 }






}
?>