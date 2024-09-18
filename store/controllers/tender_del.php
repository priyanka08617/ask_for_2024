<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

$id=sanitize_input($conn,$_GET['id']);
$table_status=sanitize_input($conn,$_GET['table_status']);
if($table_status==1){
$table_name="item";
}elseif($table_status==2){
    $table_name="product";
}
$sql="UPDATE $table_name SET status='0' WHERE id='$id'";
// $sql="DELETE FROM item WHERE id='$id'";
$query=mysqli_query($conn,$sql);
header('location:../views/tender_details.php');

?>