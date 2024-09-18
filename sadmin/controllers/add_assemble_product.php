<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

 $co=date('Y-m-d H:i:s');

 




$product_id_x  = $_POST['product_id'];
$product_qty_x = $_POST['product_qty'];
$uom_id_x      = $_POST['uom_id'];
$location_id_x = $_POST['location_id'];


$item_id_x     = $_POST['item_id'];
$item_type_x   = $_POST['item_type'];
$need_qty_x    = $_POST['need_qty'];
$need_qty_uom_id_x  = $_POST['need_qty_uom_id'];



$assemble_sql="INSERT INTO `assembled_product`(`product_id`, `qty`, `uom_id`,`location_id`, `date_of_entry`, `status`) VALUES ('$product_id_x','$product_qty_x','$uom_id_x','$location_id_x','$co','1')";
$assemble_query=mysqli_query($conn,$assemble_sql);
$assemble_last_id = mysqli_insert_id($conn);

$sql="INSERT INTO `inventory_transfer`(`date_of_change`, `transfer_initiated_by`, `transfer_reason`, `transfer_reason_supporting_id`, `status`, `status_remarks`, `row_created_on`,`location_id`) VALUE('$co', '$user_id', '9', '$assemble_last_id', '2','A.S','$co','$location_id_x')";
$query=mysqli_query($conn,$sql);
$last_id = mysqli_insert_id($conn);
echo $sql;
echo "<br>";

$assemble_sql_update_status="UPDATE assembled_product SET inventory_transfer_id='$last_id' WHERE id='$assemble_last_id'";
$assemble_sql_update_query=mysqli_query($conn,$assemble_sql_update_status);



$sql2="INSERT INTO `inventory_transfer_details`(`inventory_transfer_id`, `transfer_type`, `item_id`, `item_type`, `quantity`, `uom_id`, `status`, `row_created_on`,`location_id`) VALUES('$last_id','1','$product_id_x', '2', '$product_qty_x', '$uom_id_x','2','$co','$location_id_x')";
$query=mysqli_query($conn,$sql2);

echo $sql2;
echo "<br>";


// $sql3="INSERT INTO stock_transfer_location(inventory_transfer_id, item_type, item_id, quantity, uom_id, transfer_type, location_id, status, row_created_on) VALUES ('$last_id','2','$product_id_x','$product_qty_x','$uom_id_x','1','$location_id_x','1','$co')";
// mysqli_query($conn,$sql3);

// echo $sql3;
// echo "<br>";


for($i=0;$i<count($item_id_x);$i++){

// $sql1="INSERT INTO `inventory_transfer_details`(`inventory_transfer_id`, `transfer_type`, `item_id`, `item_type`, `quantity`, `uom_id`, `status`, `row_created_on`) VALUES('$last_id','2','$item_id_x[$i]', '$item_type_x[$i]', '$need_qty_x[$i]', '$need_qty_uom_id_x[$i]','1','$co')";
// $query=mysqli_query($conn,$sql1);


$assemble_sql_detail="INSERT INTO `assembled_product_history`(`product_id`, `item_id`, `item_type`, `qty`, `uom_id`, `entry_date_time`, `status`) VALUES('$assemble_last_id','$item_id_x[$i]', '$item_type_x[$i]', '$need_qty_x[$i]', '$need_qty_uom_id_x[$i]','$co','1')";
$assemble_sql_detail_query=mysqli_query($conn,$assemble_sql_detail);



echo $assemble_sql_detail;
echo "<br>";

$sql4="INSERT INTO inventory_transfer_details(inventory_transfer_id, transfer_type, item_id, item_type, quantity, uom_id,location_id, status, row_created_on) VALUES ('$last_id','2','$item_id_x[$i]','$item_type_x[$i]','$need_qty_x[$i]','$need_qty_uom_id_x[$i]', '$location_id_x','2' ,'$co')";
mysqli_query($conn,$sql4);


echo $sql4;
echo "<br>";

// $sql5="INSERT INTO stock_transfer_location(inventory_transfer_id, item_type, item_id, quantity, uom_id, transfer_type, location_id, status, row_created_on) VALUES ('$last_id','$item_type_x[$i]','$item_id_x[$i]','$need_qty_x[$i]','$need_qty_uom_id_x[$i]','2','$location_id_x','1','$co')";
// mysqli_query($conn,$sql5);

// echo $sql5;
// echo "<br>";

}


header('location:../views/product_assembly.php');
?>