<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

 $co=date('Y-m-d H:i:s');
//  $co_date=$co;
$process_id_x        = sanitize_input($conn,$_POST['process_id']);
$client_id_x         = sanitize_input($conn,$_POST['client_id']);
$po_tender_id_x      = sanitize_input($conn,$_POST['po_tender_id']);
$process_reason_id_x = sanitize_input($conn,$_POST['process_reason_id']);
$tender_po_specification_id_x =sanitize_input($conn,$_POST['tender_po_specification_id']);


$progress_sql="INSERT INTO `process_action`(`process_id`, `process_reason`, `client_id`, `tender_po_specification_id`, `po_tender_id`, `row_created_on`, `status`) VALUES ('$process_id_x','$process_reason_id_x','$client_id_x','$tender_po_specification_id_x','$po_tender_id_x','$co','1')";
$progress_query=mysqli_query($conn,$progress_sql);
$progress_last_id = mysqli_insert_id($conn);

// echo mysqli_error($conn);
// echo "<br>";
// echo $progress_sql;




$sql="SELECT * FROM process_steps_master WHERE process_master_id='$process_id_x'";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){


    $process_master_step_description_id=$row["id"];
    $item_id           =$row["item_id"];
    $item_type         =$row["item_type"];
    $uom_id            =$row["uom_id"];
    $quantity          =$row["quantity"];
    $step_description  =$row["step_description"];
    


    $process_action_details_master="INSERT INTO process_action_details(`process_action_id`, `process_master_id`,`item_id`,`item_type`,`uom_id`,`quantity`,`step_description`, `submitted_on`, `status`) VALUES('$progress_last_id','$process_id_x','$item_id','$item_type','$uom_id','$quantity','$step_description', '', '1')";
    $process_action_details_master_query=mysqli_query($conn,$process_action_details_master);
// echo  $process_action_details_master;
// echo "<br>";
// echo mysqli_error($conn);
// echo "<br>";
    
    }





header('location:../views/process_action.php');
?>