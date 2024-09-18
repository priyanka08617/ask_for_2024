<?php
 include '../includes/check.php';

$item_id=$_GET['item_id'];
$location_id=$_GET['location_id'];
echo "DELETE FROM stock_transfer_location WHERE item_id='$item_id' AND location_id='$location_id'";
mysqli_query($conn, "DELETE FROM stock_transfer_location WHERE item_id='$item_id' AND location_id='$location_id'");
// echo "item_id - ".$item_id." location  - ".$location_id;
header('location:../views/inventory_in_location.php');



?>