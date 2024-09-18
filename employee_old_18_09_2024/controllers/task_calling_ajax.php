<?php
 include '../includes/check.php';
 include '../includes/functions.php';

$data= array();
$c=0;

$start_date = date('Y-m-d');
$start_call="00:00:00";
$end_call="00:00:00";

    $sql = "SELECT 
    t.id AS id, 
    t.enquiry_management_id AS enquiry_management_id, 
    t.poa AS poa, 
    t.following_by AS following_by, 
    t.date AS date, 
    t.time AS time, 
    t.remarks1 AS remarks1, 
    t.start_call AS start_call, 
    t.end_call AS end_call, 
    t.action_taken_date AS action_taken_date, 
    t.remarks2 AS remarks2, 
    t.poa_action_status AS poa_action_status, 
    t.enquiry_status AS enquiry_status, 
    t.row_created_on AS row_created_on,
    e.store_id AS store_id,
    e.customer_name AS customer_name,
    e.customer_mobile AS customer_mobile,
    e.customer_mail AS customer_mail,
    e.enquiry_date AS enquiry_date,
    e.enquiry AS enquiry,
    e.created_by AS created_by,
    e.source_type AS source_type,
    e.source AS source   
    FROM enquiry_management_timeline  t, enquiry_management e WHERE  e.id = t.enquiry_management_id AND t.status = '1' AND t.poa_action_status = '1' AND e.store_id ='2'   AND t.date < CURDATE() ORDER BY t.date DESC";

$query=mysqli_query($conn,$sql);    
$total_row=mysqli_num_rows($query);
if ( $total_row> 0) {
while($row1=mysqli_fetch_array($query)){

$enquiry_management_timeline_id=$row1["id"];
$enquiry_id=$row1["enquiry_management_id"];
$poa=$row1["poa"];
$remarks1=$row1['remarks1'];
$poa_action_status=$row1["poa_action_status"];

$store_id_fetched = $row1['store_id'];
$customer_name = $row1['customer_name'];
$customer_mobile = $row1['customer_mobile'];
$customer_mail = $row1['customer_mail'];
$enquiry_date = date('d-m-Y',strtotime($row1['enquiry_date']));
$enquiry = $row1['enquiry'];
$created_by_id = $row1['created_by'];
$following_by_id = $row1['following_by'];

$source_type=$row1['source_type'];
$source_id=$row1['source'];
$c++;

$customer_details=$customer_mobile." ". $customer_name." ".$customer_mail;








                                                if($row1["start_call"]=="00:00:00"){
                                                    $start_call="<p class='text-danger'>n.a</p>";
                                                }else{
                                                    $start_call=TimeForm($row1["start_call"]);
                                                }

                                                $start_call_openmodel1=$row1["start_call"];

                                                if($row1["end_call"]=="00:00:00"){
                                                    $end_call="<p class='text-danger'>n.a</p>";
                                                }else{
                                                    $end_call=TimeForm($row1["end_call"]); 
                                                }





                                                    $edit_modal_params_string='"'.$enquiry_management_timeline_id.'","'.$poa.'","'.$remarks1.'","'.$poa_action_status.'","'.$start_call_openmodel1.'","'.$enquiry_id.'"';
                                                    $edit_modal_params='openModel1('.$edit_modal_params_string.')';


                                                    $last_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "last_name");
                                                    $first_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "first_name");
                                                    $created_by=$first_name." ".$last_name;


if($following_by_id>0){
    $last_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$following_by_id'", "last_name");
    $first_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$following_by_id'", "first_name");
    $following_by=$first_name." ".$last_name;
}else{
    $following_by="-";
}
                                                  

                                                  
                                                    



                                                if($source_type=="referral"){

                                                $source=singleRowFromTable($conn,"SELECT * FROM `customer_details` WHERE `id`='$source_id'", "display_name");

                                                }elseif($source_type=="walking"){
                                                $source=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$source_id'", "name");
                                                }else{
                                                $source=$source_id;
                                                }

                                                $source_type_source=$source_type ." || ".$source;
                                                $poa_date=date('d-m-Y',strtotime($row1["date"]));
$poa=$row1["poa"];
$remarks1=$row1["remarks1"];
$waiting_or_action_taken="";


                                // if($poa_action_status==1){


                                $waiting_or_action_taken="<button type='button' class='btn btn-warning btn-sm'   onclick='enquiry_timeline_call(".$enquiry_management_timeline_id.",".$enquiry_id.")'> waiting</button>";
                                $nothing="||";
                                $remarks2="--";


                                                   $end_date   = $row1["date"];

                                                    if($end_date=="0000-00-00"){
                                                    $numOfDays=0;
                                                    $status_for_numOfDays="";


                                                    } else{


                                                    $dateDiff   =  strtotime($start_date) - strtotime($end_date);
                                                    $numOfDays  = ($dateDiff / 86400) ." Days";

                                                        if($numOfDays<1){
                                                            $status_for_numOfDays="";
                                                        }else{
                                                            $status_for_numOfDays='<span class="text-danger">Late</span>';

                                                        }

                                                    }
                                                // }
                              


$num_od_days_with_status_for_numOfDays=$numOfDays." ".$status_for_numOfDays;
                             


$data[]=array($c,
$source_type_source,
$enquiry_date,
$customer_details,
 $enquiry,
$poa_date,
$poa,
$remarks1,
$waiting_or_action_taken,
$num_od_days_with_status_for_numOfDays,
$following_by,
$created_by,
$enquiry_management_timeline_id);




}
}
echo json_encode($data);

// print_r($data);














?>