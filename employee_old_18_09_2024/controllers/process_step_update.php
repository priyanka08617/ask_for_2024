<?php
 include '../includes/check.php';
 include '../includes/functions.php';

 $co=date('Y-m-d H:i:s');
 $step_change_id=$_POST["step_change_id"];


 $sql="UPDATE `process_action_details` SET `submitted_on`='$co',`status`='2' WHERE `id`='$step_change_id'";
 $query=mysqli_query($conn,$sql);
 echo mysqli_error($conn);

echo $sql;
?>