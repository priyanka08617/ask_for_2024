<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

$co=date('Y-m-d H:i:s');





    $subhead_id_y=sanitize_input($conn,$_POST['specification_subheadId']);
    $specification_subhead_name_y=sanitize_input($conn,$_POST['subhead_data_name']);


$sql="INSERT INTO  specification_subhead_data ( specification_subhead_id,subhead_data,status)VALUES('$subhead_id_y', '$specification_subhead_name_y','1')";
if(mysqli_query($conn,$sql)==true){
   echo 1;
}else{
    echo 0;
}

    


?>