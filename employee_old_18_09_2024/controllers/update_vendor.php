<?php
 include '../includes/check.php';

 include '../includes/functions.php';

  	$id=$_POST['id'];
    $name_edit=$_POST['name_edit'];
    $email_edit=$_POST['email_edit'];
    $phone_no_edit=$_POST['phone_no_edit'];
    $address_edit=$_POST['address_edit'];
    $state_id_edit=$_POST['state_id_edit'];
    $pin_code_edit=$_POST['pin_code_edit'];
    $gstin_edit=$_POST['gstin_edit'];
    $remarks_edit=$_POST['remarks_edit'];
    $credentials_set_id_edit=$_POST['credentials_set_id_edit'];


$sql="UPDATE vendor SET `name`='$name_edit',`address`='$address_edit',`pin_code`='$pin_code_edit',`state_id`='$state_id_edit',`email`='$email_edit',`phone_no`='$phone_no_edit',`remarks`='$remarks_edit',`gstin`='$gstin_edit',`credentials_set_id`='$credentials_set_id_edit' WHERE id='$id'";

// echo $sql;

if (!mysqli_query($conn,$sql)){
  echo("Error description: " . mysqli_error($conn));
}



header ("location: ../views/vendor.php");
      

?>