<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

$co=date('Y-m-d H:i:s');

$dp_category_id_modal_x=sanitize_input($conn,$_POST['dp_category_id_modal']);
$specification_head_name_x=sanitize_input($conn,$_POST['specification_head_name']);

$sql="INSERT INTO  specification_head ( category_id,head_name,status)VALUES('$dp_category_id_modal_x', '$specification_head_name_x','1')";
if(mysqli_query($conn,$sql)==true){
    echo 1;
}else{
    echo 0;
}
?>