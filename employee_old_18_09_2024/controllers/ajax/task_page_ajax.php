<?php 
 include 'connection.php';
 include '../../includes/functions.php';



$json_array=array();
$data=array();
$task_no=sanitize_input($conn,$_POST['task_no']);


if($task_no==1){

    $enquiry_id=sanitize_input($conn,$_POST['enquiry_id']);
    $enquiry_management_timeline_id=sanitize_input($conn,$_POST['enquiry_management_timeline_id']);



$data=array();
$enquiry_for_data="";

$c=0;
$sql="SELECT enquiry_management_timeline.id as id, enquiry_management_timeline.enquiry_management_id as enquiry_management_id, enquiry_management_timeline.poa as poa,enquiry_management_timeline.following_by as following_by, enquiry_management_timeline.date as date, enquiry_management_timeline.time as time, enquiry_management_timeline.remarks1 as remarks1, enquiry_management_timeline.start_call as start_call, enquiry_management_timeline.end_call as end_call, enquiry_management_timeline.action_taken_date as action_taken_date, enquiry_management_timeline.remarks2 as remarks2, enquiry_management_timeline.poa_action_status as poa_action_status, enquiry_management_timeline.enquiry_status as enquiry_status, enquiry_management_timeline.row_created_on as row_created_on,enquiry_management.store_id as store_id,enquiry_management.customer_name as customer_name,enquiry_management.customer_mobile as customer_mobile,enquiry_management.customer_mail as customer_mail,enquiry_management.enquiry_date as enquiry_date,enquiry_management.enquiry as enquiry,enquiry_management.created_by as created_by,enquiry_management.source_type as source_type,enquiry_management.source as source   FROM enquiry_management_timeline INNER JOIN enquiry_management ON enquiry_management.id=enquiry_management_timeline.enquiry_management_id WHERE  enquiry_management_timeline.enquiry_management_id='$enquiry_id'";

    $query=mysqli_query($conn,$sql);
    while($row1=mysqli_fetch_array($query)){

    $c++;


    
        $enquiry_for=$row1["enquiry"];
        $enquiry_management_timeline_id=$row1["id"];
        $enquiry_id=$row1["enquiry_management_id"];
        $poa=$row1["poa"];
        $remarks1=$row1['remarks1'];
        $poa_action_status=$row1["poa_action_status"];
        $start_date=$row1["date"];
        $following_by_id=$row1["following_by"];
        
        $start_call="00:00:00";
        $end_call="00:00:00";
    
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
    
    // $store_id_fetched=$enquiry_management['store_id'];
    $customer_name=$row1['customer_name'];
    $customer_mobile=$row1['customer_mobile'];
    $customer_mail=$row1['customer_mail'];
    $enquiry_date=$row1['enquiry_date'];
    $enquiry=$row1['enquiry'];
    
    $created_by_id=$row1['created_by'];
    $last_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "last_name");
    $first_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "first_name");
    $created_by=$first_name." ".$last_name;
    
    

    $last_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$following_by_id'", "last_name");
    $first_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$following_by_id'", "first_name");
    $following_by=$first_name." ".$last_name;


    
        $source_type=$row1['source_type'];
        $source_id=$row1['source'];
        if($source_type=="referral"){
            
            $source=singleRowFromTable($conn,"SELECT * FROM `customer_details` WHERE `id`='$source_id'", "display_name");
        
        }elseif($source_type=="walking"){
            $source=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$source_id'", "name");
        }else{
            $source=$source_id;
        }
        
        


   
        // $data[]= '<td>'. $source_type ." || ".$source.'</td>';
        // $data[]= '<td>'.$enquiry_date.'</td>';
        // $data[]= '<td>'.$customer_mobile." ". $customer_name." ".$customer_mail.'</td>';
        // $data[]= '<td>'. $enquiry.'</td>';
  
    
     $data[]="<tr>";
     $data[]="<td>".$c."</td>";
     $data[]= "<td>".$row1["poa"]."</td>";
     $data[]= "<td>".dateForm1($row1["date"])."</td><td>".$row1["remarks1"]."</td>";
     
     
              if($poa_action_status==1){
                $data[]="<td><button type='button' class='btn btn-warning btn-sm'  data-toggle='modal' data-target='#myModal1'>waiting</button></td>";
                $data[]="<td class='text-center'>||</td>";
                $data[]="<td>--</td>";
                $data[]="<td>--</td>";
                $data[]="<td>--</td>";
    
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
}elseif($poa_action_status==2){

         

              if($row1["start_call"]=="00:00:00" || $row1["end_call"]=="00:00:00"){
                $start_call="";
                $end_call="";
              }else{
                $start_call   = $row1["start_call"];
                $end_call   = $row1["end_call"];
              }
              $status_for_numOfDays="";
              $action_taken_date=date("d-m-Y",strtotime($row1["action_taken_date"]));

                $data[]= "<td><button type='button' class='btn btn-success btn-sm'>action taken</button></td>";
                $data[]= "<td class='text-center'>||</td>";
                $data[]="<td>".$start_call."<br>".$end_call."</td>";
                $data[]='<td> '.$action_taken_date.'</td>';
                $data[]="<td><small class='text-muted'>".$row1["remarks2"]."</small></td>";
              }     
              
             
            //   $data[]='<td>'. $created_by.'</td>';
              $data[]='<td>'. $following_by.'</td>';
              $data[]='</tr>';




       $enquiry_for_data='<div class="form-group row">
    <div class="col-md-3"><b>Name - </b>'.$customer_name.'</div>
    <div class="col-md-3"><b>Mobile - </b>'.$customer_mobile.'</div>
    <div class="col-md-3"><b>Source - </b>'.$source.' || '.$source.'</div>
    <div class="col-md-3"><b>Enquiry For - </b>'.$enquiry_for.'</div>
    </div></div>';



    }

    $json_array=array("data"=>$data,"enquiry_for"=>$enquiry_for_data,"enquiry_management_timeline_id"=>$enquiry_management_timeline_id,"enquiry_id"=>$enquiry_id);


 
    }

    elseif($task_no==2){

        $data=array();
        $enquiry_id = sanitize_input($conn,$_POST['enquiry_id']);
    $enquiry_management_timeline_id = sanitize_input($conn,$_POST['enqiry_timeline_id']);
    $start_time     =  sanitize_input($conn,$_POST['start_time']);
    $enquiry_status =  sanitize_input($conn,$_POST['enquiry_status']);
    $remarks2       =  sanitize_input($conn,$_POST['remarks2']);

    $end_time=date('Y-m-d H:i:s');
    $action_taken_date=date('Y-m-d');

$sql="UPDATE `enquiry_management_timeline` SET `remarks2`='$remarks2',`end_call`='$end_time',`action_taken_date`='$action_taken_date',`poa_action_status`='2',`enquiry_status`='$enquiry_status' WHERE `id`='$enquiry_management_timeline_id'";
    if (mysqli_query($conn,$sql)==TRUE){
    $data=1;

 }else{

    $data=0;
 }

$json_array=array("data"=>$data,"enquiry_management_timeline_id"=>$enquiry_management_timeline_id,"enquiry_id"=>$enquiry_id);
 }




 elseif($task_no==3){

$data=array();

$enqiry_id_for_poa_creation = sanitize_input($conn,$_POST['enqiry_id_for_poa_creation']);
$poa_x     =  sanitize_input($conn,$_POST['poa']);
$poa_date_x =  sanitize_input($conn,$_POST['poa_date']);
$poa_time_x =  sanitize_input($conn,$_POST['poa_time']);
$poa_remarks_x =  sanitize_input($conn,$_POST['poa_remarks']);
$follow_by_x   =  sanitize_input($conn,$_POST['follow_by']);

$co=date('Y-m-d H:i:s');

$sql1_poa_creation="INSERT INTO `enquiry_management_timeline`(`enquiry_management_id`,`poa`,`date`, `time`, `remarks1`, `row_created_on`,`poa_action_status`, `status`,`following_by`) VALUES ('$enqiry_id_for_poa_creation','$poa_x','$poa_date_x','$poa_time_x','$poa_remarks_x','$co','1','1','$follow_by_x')";
if (mysqli_query($conn,$sql1_poa_creation)==TRUE){

    $data=1;

    }else{

    $data=0;

    }

$json_array=array("data"=>$data);

}




echo json_encode($json_array);

// echo "<pre>";
// print_r($json_array);
// echo "</pre>";
?>