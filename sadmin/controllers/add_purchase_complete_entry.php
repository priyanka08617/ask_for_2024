<?php
include '../includes/check.php';
include '../includes/functions.php';



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



$po_id=$_POST['po_id'];
$grand_total=$_POST['grand_total'];
$now=date("Y-m-d H:i:s");
$payment_status = $_POST['pay_status'];

$store_id="1";

if($payment_status==1){

  $check_box_id = $_POST['check_box_id'];
$amount_array  = $_POST['amount'];
$institute_name_array  = $_POST['institute_name'];
$slip_no_array  = $_POST['slip_no'];



$total_amount=0;
    for($i=0;$i<count($amount_array);$i++){
    
        $total_amount+=$amount_array[$i];
      
        $check_box= $check_box_id[$i];
        $amount= $amount_array[$i];
        $institute_name =$institute_name_array[$i];
        $slip_no = $slip_no_array[$i];


       $mode_of_pay[] = array('mode_of_pay_id' => $check_box,'amount'=> $amount,'institute_id'=> $institute_name,'slip_no'=> $slip_no);
}

$mode_of_pay_serz=serialize($mode_of_pay);

$sql1="UPDATE purchase SET payment_id='$mode_of_pay_serz',payment_status='1' WHERE id='$po_id'";
mysqli_query($conn,$sql1);
// echo $sql1;

}



$inventory_sql="SELECT * FROM purchase_details WHERE po_id='$po_id'";
$inventory_query=mysqli_query($conn,$inventory_sql);
while($inventory_row=mysqli_fetch_array($inventory_query)){
  $inventory_id=$inventory_row["id"];

  $sql2="UPDATE purchase_details SET entry_status='2' WHERE id='$inventory_id'";
  mysqli_query($conn,$sql2);


}

$sql3="UPDATE purchase SET position_status='1' WHERE id='$po_id'";
mysqli_query($conn,$sql3);




if($_POST['item_id']=" "){


}else{


    
    $item_id=$_POST['item_id'];
    $qty=$_POST['qty'];
    $rate=$_POST['rate'];
    $disc=$_POST['disc'];
    $tax=$_POST['tax'];
    $unit_id=$_POST['unit_id'];
    $total=$_POST['total'];
    $now=date("Y-m-d H:i:s");




$sql="INSERT INTO purchase_details(`po_id`, `item_id`,`qty`, `unit_id`,`rate`,`discount`, `tax`, `price`, `entry_status`,`date_of_entry`,`store_id`,`status`) VALUES ('$po_id','$item_id','$qty','$unit_id','$rate','$disc','$tax','$total','2','$now','$store_id','1')";

$query=mysqli_query($conn,$sql);
echo mysqli_error($conn);

$sl_no  = $_POST["sl_no"];
for($i=0;$i<count($sl_no);$i++){
  $serial_no=$sl_no[$i];
  $sql1="INSERT INTO `serial_no_of_item`(`purchase_id`, `sl_no`, `row_created_on`, `status`) VALUES ('$po_id','$serial_no','$now','1')";
  $query=mysqli_query($conn,$sql1);

}


}
header("location:../views/purchase_entry.php");


?>