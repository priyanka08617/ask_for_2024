<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

 $co=date('Y-m-d H:i:s');
$process_name_x  = sanitize_input($conn,$_POST['process_name']);
$process_description_x = sanitize_input($conn,$_POST['process_description']);

$item_id_x      = $_POST['item_id'];
$quantity_x     = $_POST['quantity'];
$uom_id_x       = $_POST['uom_id'];
$step_description_x= $_POST['step_description'];




// echo $item_id_after_split;
// echo "<br>";
// echo $item_type_after_split;
// echo strlen($item_id_x);

$progress_sql="INSERT INTO `process_master`(`process_name`, `process_description`, `status`, `row_created_on`) VALUES ('$process_name_x','$process_description_x','1','$co')";
$progress_query=mysqli_query($conn,$progress_sql);
$progress_last_id = mysqli_insert_id($conn);


for($i=0;$i<count($item_id_x);$i++){

$len = strlen((string)$item_id_x[$i]); 
$item_id_split=str_split(((string)$item_id_x[$i]),$len-1);

$item_id_after_split=$item_id_split[0];
$item_type_after_split=$item_id_split[1];

$process_steps_master="INSERT INTO `process_steps_master`(`process_master_id`, `item_id`, `item_type`, `uom_id`, `quantity`, `step_description`, `status`, `row_created_on`)VALUES('$progress_last_id','$item_id_after_split','$item_type_after_split', '$uom_id_x[$i]', '$quantity_x[$i]',  '$step_description_x[$i]','1','$co')";
$process_steps_master_query=mysqli_query($conn,$process_steps_master);
echo $process_steps_master;
echo mysqli_error($conn);

}


header('location:../views/process_master.php');
?>