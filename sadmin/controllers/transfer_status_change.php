<?php 
 include '../includes/check.php';

   include '../includes/functions.php';

   
$inventory_transfer_id_e=$_POST['inventory_transfer_id_e'];
$inventory_transfer_change_e=$_POST['inventory_transfer_change_e'];
$inventory_transfer_remarks_e=$_POST['inventory_transfer_remarks_e'];

$td=date("Y-m-d H:i:s");



$sql="UPDATE inventory_transfer SET status='$inventory_transfer_change_e', status_remarks='$inventory_transfer_remarks_e' WHERE id='$inventory_transfer_id_e'";
$query=mysqli_query($conn,$sql);

if($inventory_transfer_change_e==2){


  // $stock_location=$_POST['stock_location'];
  
$sql=mysqli_query($conn, "SELECT * FROM inventory_transfer_details WHERE inventory_transfer_id='$inventory_transfer_id_e'");

while($row=mysqli_fetch_array($sql)){
$item_id=$row['item_id'];
$quantity=$row['quantity'];
$transfer_type=$row['transfer_type'];
$item_type=$row['item_type'];
$uom_id=$row['uom_id'];
}

mysqli_query($conn,"UPDATE inventory_transfer_details SET status='2' WHERE inventory_transfer_id='$inventory_transfer_id_e'");
}
elseif($inventory_transfer_change_e==3){

  mysqli_query($conn,"UPDATE inventory_transfer_details SET status='0' WHERE inventory_transfer_id='$inventory_transfer_id_e'");
}




header('location:../views/inventory_transfers.php');
?>