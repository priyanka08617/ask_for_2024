<?php
include 'connection.php';
include '../../includes/functions.php';

    $show_data=sanitize_input($conn,$_POST['show_data']);
 
    if($show_data=="show_data"){
        $status="";
	$sql="SELECT * FROM `enquiry_management_status` WHERE `status`='1'";
	$result=mysqli_query($conn,$sql);
	 while($row=mysqli_fetch_array($result)){
       $status_id= $row["id"];
       $enquiry_poa_status=$row["enquiry_poa_status"];
         $status.="<option value='".$status_id."'>".$enquiry_poa_status."</option>";
     }

	echo $status;
    }elseif($show_data=="add_data"){
        $status="";
        $enquiry_poa_status=sanitize_input($conn,$_POST['enquiry_poa_status']);
        $enquiry_status=sanitize_input($conn,$_POST['enquiry_status']);

$enquiry_management_status_add_query=mysqli_query($conn,"INSERT INTO `enquiry_management_status`(`enquiry_poa_status`, `enquiry_status`, `status`) VALUES ('$enquiry_poa_status','$enquiry_status','1')");
$last_id=mysqli_insert_id($conn);


$sql="SELECT * FROM `enquiry_management_status` WHERE `status`='1'";
	$result=mysqli_query($conn,$sql);
	 while($row=mysqli_fetch_array($result)){
       $status_id= $row["id"];
       $enquiry_poa_status=$row["enquiry_poa_status"];
         $status.='<option  value="'.$status_id.'"'.($status_id == $last_id ? 'selected' : '').'>'.$enquiry_poa_status.'</option>';
     }

     echo $status;

    }
?>