<?php 
include '../includes/check.php';
include '../includes/functions.php';


$it_id=$_GET['it_id'];
mysqli_query($conn,"DELETE FROM inventory_transfer WHERE id='$it_id'");
$sql="DELETE FROM inventory_transfer_details  WHERE inventory_transfer_id='$it_id'";
mysqli_query($conn,$sql);
// mysqli_query($conn,"DELETE FROM stock_transfer_location WHERE inventory_transfer_id='$it_id'");
header('location:../views/inventory_transfers.php');



?>