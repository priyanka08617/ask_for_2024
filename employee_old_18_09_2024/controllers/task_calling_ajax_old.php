<?php
 include '../includes/check.php';
 include '../includes/functions.php';

$data= array();


$c=0;

$start_date = date('Y-m-d');


$start_call="00:00:00";
$end_call="00:00:00";


$start = isset($_GET['start']) ? intval($_GET['start']) : 0; // Starting offset
$length = isset($_GET['length']) ? intval($_GET['length']) : 25; // Page size (number of records per page)



$sql="SELECT enquiry_management_timeline.id as id, enquiry_management_timeline.enquiry_management_id as enquiry_management_id, enquiry_management_timeline.poa as poa, enquiry_management_timeline.date as date, enquiry_management_timeline.time as time, enquiry_management_timeline.remarks1 as remarks1, enquiry_management_timeline.start_call as start_call, enquiry_management_timeline.end_call as end_call, enquiry_management_timeline.action_taken_date as action_taken_date, enquiry_management_timeline.remarks2 as remarks2, enquiry_management_timeline.poa_action_status as poa_action_status, enquiry_management_timeline.enquiry_status as enquiry_status, enquiry_management_timeline.row_created_on as row_created_on,enquiry_management.store_id as store_id,enquiry_management.customer_name as customer_name,enquiry_management.customer_mobile as customer_mobile,enquiry_management.customer_mail as customer_mail,enquiry_management.enquiry_date as enquiry_date,enquiry_management.enquiry as enquiry,enquiry_management.created_by as created_by,enquiry_management.source_type as source_type,enquiry_management.source as source   FROM enquiry_management_timeline INNER JOIN enquiry_management ON enquiry_management.id=enquiry_management_timeline.enquiry_management_id WHERE enquiry_management.source_type='Lead' AND enquiry_management_timeline.poa_action_status='1' OR created_by='$user_id' ";
$sql .= " LIMIT $start, $length";
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
$enquiry_date = $row1['enquiry_date'];
$enquiry = $row1['enquiry'];
$created_by_id = $row1['created_by'];
$source_type=$row1['source_type'];
$source_id=$row1['source'];
$c++;
$sl=$c;
$customer_details=$customer_mobile." ". $customer_name." ".$customer_mail;
// $source_type_source="";







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



                                                if($source_type=="referral"){

                                                $source=singleRowFromTable($conn,"SELECT * FROM `customer_details` WHERE `id`='$source_id'", "display_name");

                                                }elseif($source_type=="walking"){
                                                $source=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$source_id'", "name");
                                                }else{
                                                $source=$source_id;
                                                }

                                                $source_type_source=$source_type ." || ".$source;
                                                $poa_date=$row1["date"];
$poa=$row1["poa"];
$remarks1=$row1["remarks1"];
$waiting_or_action_taken="";


                                // if($poa_action_status==1){


                                $waiting_or_action_taken="<button type='button' class='btn btn-warning btn-sm'   onclick='enquiry_timeline_call(".$enquiry_id.")'> waiting</button>";
                                $nothing="||";
                                $remarks2="--";


                                $end_date   = $row1["date"];

                                                    if($end_date=="0000-00-00"){
                                                    $numOfDays=0;
                                                    $status_for_numOfDays="";


                                                    }
                                                    else{


                                                    $dateDiff   =  strtotime($start_date) - strtotime($end_date);
                                                    $numOfDays  = ($dateDiff / 86400) ." Days";

                                                        if($numOfDays<1){
                                                            $status_for_numOfDays="";
                                                        }else{
                                                            $status_for_numOfDays='<span class="text-danger">Late</span>';

                                                        }

                                                    }

                                // }elseif($poa_action_status==2){


                                // $waiting_or_action_taken="<button type='button' class='btn btn-success btn-sm'>action taken</button>";
                                // $nothing="||";
                                // $remarks2=$row1["remarks2"];

                                // $status_for_numOfDays="";
                                // $numOfDays=$row1["action_taken_date"]."<br>".$end_call;


                                // }


                                $num_od_days_with_status_for_numOfDays=$numOfDays." ".$status_for_numOfDays;
                             




// $created_by=$created_by;
$row_created_on= "<small class='text-muted'>".dateForm($row1["row_created_on"])."</small>";




$data[]=array($c,
$source_type_source,
$enquiry_date,
$customer_details,
 $enquiry,
$poa_date,
$poa,
$remarks1,
$waiting_or_action_taken,
$num_od_days_with_status_for_numOfDays

);


// $data[]=array($c,
// $source_type_source,
// $enquiry_date,
// $customer_details,
//  $enquiry,
// $poa_date,
// $poa,
// $remarks1,
// $waiting_or_action_taken,
// // $nothing,
// // $remarks2,
// $num_od_days_with_status_for_numOfDays
// // $created_by
// // $row_created_on
// );



}

}




$json_data = array(
    "draw"            => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
    "recordsTotal"    => intval($total_row),
    "recordsFiltered" => intval($total_row),
    "data"            => $data   // Total data array
);

echo json_encode($json_data);



















?>