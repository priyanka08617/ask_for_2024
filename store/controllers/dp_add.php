<?php 
 include '../includes/check.php';

include '../includes/functions.php';
 $co=date('Y-m-d H:i:s');


$cat_id_x = sanitize_input($conn,$_POST['cat_id']);
$sub_cat_id_x = sanitize_input($conn,$_POST['sub_cat_id']);

$item_x = sanitize_input($conn,$_POST['item']);
$name=sanitize_input($conn,$_POST['name']);
$sku=sanitize_input($conn,$_POST['sku']);

$uom_id_x = sanitize_input($conn,$_POST['uom_id']);
$short_code_x=sanitize_input($conn,$_POST['short_code']);
$hsn_table_id_x=sanitize_input($conn,$_POST['hsn_table_id']);
$barcode_x=sanitize_input($conn,$_POST['barcode']);
$alias_x=sanitize_input($conn,$_POST['alias']);


$hsn_rate_x=singleRowFromTable($conn, "SELECT * FROM hsn_table WHERE id='$hsn_table_id_x'", "rate");



$sql="INSERT INTO  dp (`cat_id`,`sub_cat_id`, `item_type`, `item_name`, `item`,`short_code`,`sku`, `uom_id`,`barcode`,
`alias`,  `hsn_table_id`, `hsn_rate_id`,`table_name`,`status`, `row_created_on`,location_id)VALUES('$cat_id_x','$sub_cat_id_x','1', '$name', '$item_x','$short_code_x','$sku','$uom_id_x','$barcode_x', '$alias_x',  '$hsn_table_id_x', '$hsn_rate_x','1','1','$co','1')";
$query=mysqli_query($conn,$sql);
echo $sql;
echo "<br>";
echo mysqli_error($conn);
$last_id = mysqli_insert_id($conn);


$specification_data_id_x=$_POST['subhead_id'];


for($i=0;$i<count($specification_data_id_x);$i++){

    if(!empty($specification_data_id_x[$i])){

    $specification_subhead_id=singleRowFromTable($conn, "SELECT * FROM specification_subhead_data WHERE id='$specification_data_id_x[$i]'", "specification_subhead_id");
$specification_head_id=singleRowFromTable($conn, "SELECT * FROM specification_subhead WHERE id='$specification_subhead_id'", "specification_head_id");

$sql="INSERT INTO `dp_details`(`dp_id`,`specification_head_id`, `specification_subhead_id`, `specification_subhead_data_id`,`status`) VALUES('$last_id','$specification_head_id','$specification_subhead_id','$specification_data_id_x[$i]','1')";
$query=mysqli_query($conn,$sql);
echo mysqli_error($conn);
echo "<br>";
echo $sql;
    }

}



header('location:../views/dp.php');
?>