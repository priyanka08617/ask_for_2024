<?php 
 include '../includes/check.php';

include '../includes/functions.php';


$co=date('Y-m-d H:i:s');
$item_id=$_POST['item_id'];
$item_type=$_POST['item_type'];
$uom_id=$_POST['uom_id'];



$stock_quantity=$_POST['stock_quantity'];
$location_id=$_POST['location_id'];

$to_location_id=$_POST['to_location_id'];




$total_stock_transfer=0;


for ($i=0; $i < count($stock_quantity); $i++) { 
    $total_stock_transfer+=$stock_quantity[$i]; 
}




if( $total_stock_transfer > 0){

    mysqli_query($conn,"INSERT INTO inventory_transfer(
        date_of_change, 
        transfer_initiated_by, 
        transfer_reason, 
        transfer_reason_supporting_id, 
        status, 
        status_remarks, 
        row_created_on) VALUES (
            '$co',
            '1',
            '11',
            '5',
            '2',
            'Stock Shifting',
            '$co')");

    $it_id=mysqli_insert_id($conn);


for ($i=0; $i < count($stock_quantity) ; $i++) { 

    // echo "item_id - ".$item_id." item_type - ".$item_type." quantity - ".$stock_quantity[$i]." location id - ".$location_id[$i]."<br>";

    if($stock_quantity[$i]>0){


 mysqli_query($conn,"INSERT INTO inventory_transfer_details(inventory_transfer_id, transfer_type, item_id, item_type, quantity, uom_id, status, row_created_on) VALUES ('$it_id','2','$item_id','$item_type','$stock_quantity[$i]','$uom_id', '2' ,'$co')");
        mysqli_query($conn,"INSERT INTO stock_transfer_location(inventory_transfer_id, item_type, item_id, quantity, uom_id, transfer_type, location_id, status, row_created_on) VALUES ('$it_id','$item_type','$item_id','$stock_quantity[$i]','$uom_id','2','$location_id[$i]','1','$co')");
    }
}


mysqli_query($conn,"INSERT INTO inventory_transfer_details(inventory_transfer_id, transfer_type, item_id, item_type, quantity, uom_id, status, row_created_on) VALUES ('$it_id','1','$item_id','$item_type','$total_stock_transfer','$uom_id','2','$co')");

mysqli_query($conn,"INSERT INTO stock_transfer_location(inventory_transfer_id, item_type, item_id, quantity, uom_id, transfer_type, location_id, status, row_created_on) VALUES ('$it_id','$item_type','$item_id','$total_stock_transfer','$uom_id','1','$to_location_id','1','$co')");




}





header('location:../views/stock_shifting.php');





