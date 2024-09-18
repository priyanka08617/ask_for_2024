<?php
 include '../includes/check.php';

 include '../includes/functions.php';


	$name=$_POST['name'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $phone_no=$_POST['phone_no'];
    $pin_code=$_POST['pin_code'];
    $country_id=$_POST['country_id'];
    $state_id=$_POST['state_id'];
    $remarks=$_POST['remarks'];
    $gstin=$_POST['gstin'];
    $credentials_set_id=$_POST['credentials_set_id'];
    $datetime=date("Y-m-d H:i:s");



$sql="INSERT INTO vendor(name,address,email,phone_no,pin_code,country_id,state_id,remarks,gstin,credentials_set_id,entry_date,status,password) VALUES ('$name','$address','$email','$phone_no','$pin_code','$country_id','$state_id','$remarks','$gstin','$credentials_set_id','$datetime','1','123')";

echo $sql;

if (!mysqli_query($conn,$sql)){
  echo("Error description: " . mysqli_error($conn));
}

	// $indent_id=mysqli_insert_id($conn);


header ("location: ../views/vendor.php");
      

?>