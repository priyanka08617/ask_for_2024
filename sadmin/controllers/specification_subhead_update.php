<?php 
 include '../includes/check.php';
 include '../includes/functions.php';

$co=date('Y-m-d H:i:s');

$specification_head_id=sanitize_input($conn,$_POST['specification_head_id']);
for($i=0;$i<count($_POST['subhead_id']);$i++){

    $subhead_id_y=sanitize_input($conn,$_POST['subhead_id'][$i]);
    $specification_subhead_name_y=sanitize_input($conn,$_POST['subhead_data'][$i]);

$sql="UPDATE `specification_subhead` SET `subhead_name`='$specification_subhead_name_y' WHERE `id`='$subhead_id_y'";
mysqli_query($conn,$sql);
}

header("location:../views/specification_subhead.php?specification_head_id=".$specification_head_id);

?>