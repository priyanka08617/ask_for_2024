<?php 
 include '../includes/check.php';
 include '../includes/functions.php';


 $co=date('Y-m-d H:i:s');


$po_no = sanitize_input($conn,$_POST['po_no']);
$po_date = sanitize_input($conn,$_POST['po_date']);
$distributor_id = sanitize_input($conn,$_POST['distributor_id']);
$remark = sanitize_input($conn,$_POST['remark']);


 

$sql1="INSERT INTO purchase_order(`po_no`,`po_date`,`remark`, `distributor_id`,`row_created_on`,`position_status`,status) VALUES ('$po_no','$po_date','$remark','$distributor_id','$co','0','1')";
if(mysqli_query($conn,$sql1)==true){
 $last_data_id = mysqli_insert_id($conn);
 echo $last_data_id;
}

// echo mysqli_error($conn);
?>