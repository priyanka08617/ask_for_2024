<?php 
 include 'connection.php';
 include '../../includes/functions.php';


$uom_id=$_GET['uom_id'];
$c=$_GET['c'];
$location_id=$_GET['location_id'];
$item_id=$_GET['item_id'];
$item_type=$_GET['item_type'];
$need_qty="";
$uom_id_false="";
$base_quantity=$_GET['qty'];


$total_stock_qty=find_stock_quantity_recipe_location($conn, $item_id,$item_type,$need_qty,$uom_id_false,$location_id);
$max_value=stock_interchange_uom_qty($conn, $total_stock_qty["uom_id"], $total_stock_qty["total"], $uom_id);

 

echo $max_value;

?>