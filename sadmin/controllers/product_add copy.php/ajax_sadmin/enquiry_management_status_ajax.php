<?php
include 'connection.php';
include '../../includes/functions.php';

    $show_data=sanitize_input($conn,$_POST['show_data']);
    $status="";
	$sql="SELECT * FROM `enquiry_managment_status` WHERE `status`='1'";
	$result=mysqli_query($conn,$sql);
	 while($row=mysqli_fetch_array($result)){
       $status_id= $row["id"];
       $status_final_show=$row["status_final_show"];
         $status.="<option value='".$status_id."'>".$status_final_show."</option>";
     }

	echo $status;
?>