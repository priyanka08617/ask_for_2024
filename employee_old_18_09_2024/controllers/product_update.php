<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

 
 $status_x=$_POST['status'];
$ass_product_id=$_POST['ass_product_id'];
$category_id_y=$_POST['category_id'];
$subcategory_id_y=$_POST['subcategory_id'];
// $price_y=$_POST['price'];

$name_y=$_POST['name'];
$qty_y=$_POST['qty_ed'];
$uom_id_y=$_POST['uom_id_new_ed'];
$hsn_table_id_y=$_POST['hsn_table_id'];
$hsn_rate_id_y=$_POST['hsn_rate_id'];
// $alias=$_POST['alias'];


// $sql="UPDATE  product SET category_id= '$category_id_y', subcategory_id= '$subcategory_id_y', price= '$price_y', name='$name_y', qty= '$qty_y', uom_id= '$uom_id_y', hsn_table_id= '$hsn_table_id_y', hsn_rate_id= '$hsn_rate_id_y' WHERE id='$ass_product_id'";

$sql="UPDATE  product SET category_id= '$category_id_y', subcategory_id= '$subcategory_id_y', name='$name_y', qty= '$qty_y', uom_id= '$uom_id_y', hsn_table_id= '$hsn_table_id_y', hsn_rate_id= '$hsn_rate_id_y' WHERE id='$ass_product_id'";

$query=mysqli_query($conn,$sql);



// mysqli_query($conn,"DELETE  FROM recipe WHERE product_id='$ass_product_id'");
mysqli_query($conn,"UPDATE  recipe SET  status='0' WHERE product_id='$ass_product_id'");




$item_id_concat_array=$_POST['item'];
$item_qty_array=$_POST['item_qty'];
$uom_id_array=$_POST['uom_id'];

for($j=0; $j<count($item_id_concat_array); $j++){
echo $item_id_concat_array[$j]."<br>";
$item_id=substr( $item_id_concat_array[$j],0,-1);
$item_type=substr( $item_id_concat_array[$j],-1);
$item_qty=$item_qty_array[$j];
$uom_id=$uom_id_array[$j];

$sql_in="INSERT INTO recipe(product_id, item, table_name, item_qty, uom_id, status) VALUES ('$ass_product_id','$item_id','$item_type','$item_qty','$uom_id','1')";
mysqli_query($conn, $sql_in);

}

// if($status_x==1){
  header('location:../views/assembled_product.php');
// }elseif($status_x==2){
//   header('location:../views/tender_details.php');
// }

?>