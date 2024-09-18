<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');
$category_id_x=$_POST['category_id'];
$subcategory_id_x=$_POST['subcategory_id'];
$price_x=$_POST['price'];
$name_x=$_POST['name'];
$qty_x=$_POST['qty'];
$uom_id_x=$_POST['uom_id_new'];
$hsn_table_id_x=$_POST['hsn_table_id'];
$hsn_rate_id_x=$_POST['hsn_rate_id'];
$alias=$_POST['alias'];




$sql="INSERT INTO  product ( category_id, subcategory_id, price,  name, qty, uom_id, table_name, hsn_table_id,alias, hsn_rate_id ,status, row_created_on)VALUES('$category_id_x', '$subcategory_id_x', '$price_x', '$name_x', '$qty_x', '$uom_id_x', '2', '$hsn_table_id_x', '$alias', '$hsn_rate_id_x', '1','$co')";

echo $sql;

$query=mysqli_query($conn,$sql);

$product_id=mysqli_insert_id($conn);




$item_id_concat_array=$_POST['item'];
$item_qty_array=$_POST['item_qty'];
$uom_id_array=$_POST['uom_id'];

for($j=0; $j<count($item_id_concat_array); $j++){
echo $item_id_concat_array[$j]."<br>";
$item_id=substr( $item_id_concat_array[$j],0,-1);
$item_type=substr( $item_id_concat_array[$j],-1);
$item_qty=$item_qty_array[$j];
$uom_id=$uom_id_array[$j];

$sql_in="INSERT INTO recipe(product_id, item, table_name, item_qty, uom_id, status) VALUES ('$product_id','$item_id','$item_type','$item_qty','$uom_id','1')";
mysqli_query($conn, $sql_in);

}

header('location:../views/assembled_product.php');

?>