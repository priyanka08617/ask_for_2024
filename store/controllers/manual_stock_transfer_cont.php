<?php 
 include '../includes/check.php';

include '../includes/functions.php';


 $co=date('Y-m-d H:i:s');
$transfer_reason=$_POST['transfer_reason'];
$transfer_type=$_POST['transfer_type'];
$item_id_concated=$_POST['item'];
$quantity=$_POST['quantity'];
$uom_id=$_POST["uom_id"];


// $len = strlen($item_id); 
// $item_id_split=str_split($item_id,$len-1);

$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);

$item_id_after_split=$item_id;
$item_type_after_split=$item_type;



// $sql="INSERT INTO  stock_locations ( locations_category_id, location_name, location_address, phone_no,status, row_created_on)VALUES('$locations_category_id_x', '$location_name_x', '$location_address_x', '$phone_no_x', '1','$co')";


$q=mysqli_query($conn,"INSERT INTO inventory_transfer(date_of_change, transfer_initiated_by, transfer_reason, transfer_reason_supporting_id,location_id, status, status_remarks, row_created_on) VALUES ('$co','1','$transfer_reason','1','$store_id','1','test','$co')");
$last_id=mysqli_insert_id($conn);


// $item_func=fetch_data($conn,'item',"id",$item_id_after_split);
// $uom_id=$item_func["uom_id"];
// $item_uom=fetch_data($conn,'uom',"id",$uom_id);
// $uom_name=$item_uom

mysqli_query($conn,"INSERT INTO inventory_transfer_details(inventory_transfer_id, transfer_type, item_id, item_type, quantity, uom_id, status, row_created_on) VALUES ('$last_id', '$transfer_type','$item_id_after_split','$item_type_after_split','$quantity','$uom_id','1','$co')");


header('location:../views/inventory_transfers.php');
?>