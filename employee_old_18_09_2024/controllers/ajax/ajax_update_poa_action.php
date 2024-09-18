<?php
include 'connection.php';
include '../../includes/functions.php';
$data="";
$hsn_slab="";



    $enquiry_management_timeline_id=sanitize_input($conn,$_POST['enquiry_management_timeline_id']);

	$sql="SELECT * FROM `enquiry_management_timeline` WHERE id='$enquiry_management_timeline_id'";
	$result=mysqli_query($conn,$sql);
	 $row=mysqli_fetch_array($result);

	$start_call=$row["start_call"];
    $end_call=$row["end_call"];
	 
	
	
	if($start_call=="00:00:00"){
        $start_call_time = date('Y-m-d H:i:s');;
        mysqli_query($conn,"UPDATE `enquiry_management_timeline` SET `start_call`='$start_call_time' WHERE `id`='$enquiry_management_timeline_id'");

  
         $start_call_time_only_time = date('H:i:s', strtotime($start_call_time));

	echo "1_".$start_call_time_only_time;
	}else{
        $end_call_time = date('Y-m-d H:i:s');
        mysqli_query($conn,"UPDATE `enquiry_management_timeline` SET `end_call`='$end_call_time' WHERE `id`='$enquiry_management_timeline_id'");

        $end_call_time_only_time = date('H:i:s', strtotime($end_call_time));
        echo  "2_".$end_call_time_only_time;
	}

	
?>

      

