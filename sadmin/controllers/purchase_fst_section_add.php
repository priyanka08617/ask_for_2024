<?php 
 include '../includes/check.php';

 include '../includes/functions.php';


 $co=date('Y-m-d H:i:s');


 $invoice_no = sanitize_input($conn,$_POST['invoice_no']);
$invoice_date = sanitize_input($conn,$_POST['invoice_date']);
$distributor_id = sanitize_input($conn,$_POST['distributor_id']);
$remark = sanitize_input($conn,$_POST['remark']);


 

$sql1="INSERT INTO purchase(`po_no`,`invoice_no`,`invoice_date`,`remark`, `distributor_id`,`entry_date_time`,`position_status`,status) VALUES ('1','$invoice_no','$invoice_date','$remark','$distributor_id','$co','0','1')";
if(mysqli_query($conn,$sql1)==true){
 $last_data_id = mysqli_insert_id($conn);
 echo $last_data_id;
}

// echo mysqli_error($conn);
?>