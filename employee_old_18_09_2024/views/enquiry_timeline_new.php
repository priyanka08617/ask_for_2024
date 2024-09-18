<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php';

$mobile_no=sanitize_input($conn,$_GET["mobile_no"]);

?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Todays Timeline</title>
    <?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 

             
?>

    <style>
    tfoot {

        display: table-header-group;

    }


    tfoot input {

        width: 100%;

        /* background: #868E85; */

        border: none;

        border: 1px solid #868E85;

        padding: 0px 5px;

    }


    table #example tr td {

        padding: 9px;

        font-weight: bold;

    }



    table #example2 tr td {

        padding: 9px;

        font-weight: bold;

    }


    thead tr td {

        text-align: center;

    }
    </style>
</head>

<body>
    <div class='container-fluid' style=''>
    <input type="hidden" value="<?php echo $user_id;?>" id="user_id">

<?php
$enquiry_id_array=array();
$sql_customer_detail="SELECT * FROM `enquiry_management` WHERE `customer_mobile`='$mobile_no'";
$customer_detail_query=mysqli_query($conn,$sql_customer_detail);
while($row_customer_detail=mysqli_fetch_array($customer_detail_query)){
    $enquiry_id_array[] = $row_customer_detail['id'];


echo '<div class="card">
<div class="card-header">
    <div class="row">
        <div class="col-md-4"><h5 ><span style="font-weight:bold"> Name - </span><span>'.$row_customer_detail["customer_name"].'</span></h5> </div>
        <div class="col-md-4"><h5 ><span  style="font-weight:bold">Contact No. -</span> <span>'.$row_customer_detail["customer_mobile"].'</span></h5> </div>
        <div class="col-md-4"><h5 style="font-weight:bold">Email - </h5>'.$row_customer_detail["customer_mail"].'</div>
    </div>
</div>
</div>';



}
?>



<br>


<?php

// print_r($enquiry_id_array);

foreach ($enquiry_id_array as $key => $enquiry_id) {



    $enquiry_details=singleRowArryFromTable($conn,"SELECT * FROM `enquiry_management`  WHERE `id`='$enquiry_id'");

    $enquiry_status="";
     if($enquiry_details["enquiry"]==1){ 
        $enquiry_status="<span class='text-success' style='float:right'>Open</span>";
    }else{
        $enquiry_status="<span class='text-danger' style='float:right'>Closed</span>";
    }

    if($enquiry_details["for"]==1){
        $for="Sale";
    }else{
        $for="Service";
    }

?>




    <div class="card">
        <div class="card-header" >
            <h4>Enquiry Management Timeline  || <span class="text-primary" style="font-weight:bold"><?php echo $for;?></span> <?php echo $enquiry_status;?></h4> 
        </div>
        <div class="card-body" id="task_1_card_header">
    <table id="example" class="table table-bordered  table-sm" id="example" style="width:100%">
    <thead>            
                <tr>
                    <th colspan="8"><h4>Timeline History</h4></th>
                    <th colspan="2" class="text-right">
                        <button type="button" class="btn btn-secondary" data-toggle='modal' data-target='#create_poa'>Create POA</button>
                    </th>
                </tr>

            
                       <tr>
                        <th>#</th>
                        <th>POA</th>
                        <th>POA Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                        <th class="text-center">||</th> 
                        <th> Call Time</th> 
                        <th>Action Date</th> 
                        <th>Remarks</th> 
                        <th>Following By</th> 
                        </tr>
                    </thead> 
        <tbody id="t_body">
<?php

$c=0;
$sql="SELECT enquiry_management_timeline.id as id, enquiry_management_timeline.enquiry_management_id as enquiry_management_id, enquiry_management_timeline.poa as poa,enquiry_management_timeline.following_by as following_by, enquiry_management_timeline.date as date, enquiry_management_timeline.time as poa_time, enquiry_management_timeline.remarks1 as remarks1, enquiry_management_timeline.start_call as start_call, enquiry_management_timeline.end_call as end_call, enquiry_management_timeline.action_taken_date as action_taken_date, enquiry_management_timeline.remarks2 as remarks2, enquiry_management_timeline.poa_action_status as poa_action_status, enquiry_management_timeline.enquiry_status as enquiry_status, enquiry_management_timeline.row_created_on as row_created_on,enquiry_management.store_id as store_id,enquiry_management.customer_name as customer_name,enquiry_management.customer_mobile as customer_mobile,enquiry_management.customer_mail as customer_mail,enquiry_management.enquiry_date as enquiry_date,enquiry_management.enquiry as enquiry,enquiry_management.created_by as created_by,enquiry_management.source_type as source_type,enquiry_management.source as source   FROM enquiry_management_timeline INNER JOIN enquiry_management ON enquiry_management.id=enquiry_management_timeline.enquiry_management_id WHERE  enquiry_management_timeline.enquiry_management_id='$enquiry_id'";

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
        
        

        $time="";
        if($row1["poa_time"]=="00:00:00"){
            $time="";
        }else{
            $time=date('H:i', strtotime($row1["poa_time"]));
        }
    
     echo "<tr>";
     echo "<td>".$c."</td>";
     echo "<td>".$row1["poa"]."</td>";
     echo "<td>".date('d-m-Y',strtotime($row1["date"]))." || ".$time."</td><td>".$row1["remarks1"]."</td>";
     
     
              if($poa_action_status==1){
                echo  "<td><button type='button' class='btn btn-warning btn-sm'  onclick='enquiry_timeline_call(".$enquiry_management_timeline_id.",".$enquiry_id.");'>waiting</button></td>";
                echo  "<td class='text-center'>||</td>";
                echo  "<td>--</td>";
                echo  "<td>--</td>";
                echo  "<td>--</td>";
    
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

                echo   "<td><button type='button' class='btn btn-success btn-sm'>action taken</button></td>";
                echo   "<td class='text-center'>||</td>";
                echo  "<td><small class='text-muted'>".$start_call."<br>".$end_call."</small></td>";
                echo  '<td>'.$action_taken_date.'</td>';
                echo  "<td>".$row1["remarks2"]."</td>";
              }     
              
             

            echo '<td>'. $following_by.'</td>';
            echo  '</tr>';
            }


?>
        </tbody>
    </table>


<table id="example2" class="table table-bordered  table-sm" id="example" style="width:100%">
    <thead>            
                <tr>
                    <th colspan="5"><h4>Timeline Service</h4></th>
                    <th colspan="1" class="text-right">
                    <button type="button" class="btn btn-secondary" data-toggle='modal' data-target='#invenstigation'>Investigation</button>
        </th>
                    <th colspan="1" class="text-right">
                        <button type="button" class="btn btn-secondary" data-toggle='modal' data-target='invenstigation_system_deposit'>Investigation & System Deposit</button>
                    </th>
                </tr>

            
                       <tr>
                        <th>MTM</th>
                        <th>Serial No</th>
                        <th>Warrenty Status</th>
                        <th>Status</th>
                        <th>Problem</th> 
                        <th>Remark</th>
                        <th>Investigation Report</th>
                        </tr>
                    </thead> 
        <tbody>

<?php
$sql="SELECT * FROM `service_book` WHERE `enquiry_id`='$enquiry_id'";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){

    if($row["query_status"]==1){
        $query_status="<span class='text-primary'>Enquiry</span>";
    }elseif($row["query_status"]==2){
        $query_status="<span class='text-warning'>Investigation</span>";
    }elseif($row["query_status"]==3){
        $query_status="<span class='text-success'>Investigation & Deposit</span>";
    }

    if($row["problem"]==0){
        $problem="--";
    }else{
        $problem="Investigation & Deposit";
    }


    if($row["remarks"]==''){
        $remark="--";
    }else{
        $remark="Investigation & Deposit";
    }


    if(empty($row["job_sheet"])){
        $remark="--";
    }else{
        $remark="<button type='button' class='btn btn-primary'>Jobsheet</button>";
    }




    echo "<tr>";
    echo "<td>".$row["mtm"]."</td>";
    echo "<td>".$row["serial_no"]."</td>";
    echo "<td>".$row["warrenty_status"]."</td>";
    echo "<td>".$query_status."</td>";
    echo "<td>".$problem."</td>";
    echo "<td>".$remark."</td>";
    echo "</tr>";
}

?>

        </tbody>
</table>




</div>
    </div>

      

<?php } ?>
        


        <div class="modal" id="invenstigation">
       <div class="modal-dialog modal-xl">
      <div class="modal-content">

                    <!-- Modal Header -->
                   <div class="modal-header">
                  <h4 class="modal-title"><b>Investigation</b> || </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                    <!-- Modal body -->


                   <div class="modal-body">
<div class="card"><div class="card-body">
  

                       <form action="" method="POST">
                           <input type="hidden" name="enqiry_timeline_id_for_action"
                               id="enqiry_timeline_id_for_action">

<input type="hidden" name="enqiry_id" id="enqiry_id">

                         
                           <div class='form-group row'>
                               <div class='col-md-4'>Problem</div>
                               <div class='col-md-6'>
                                
<select class='form-control' width="100%" name="problem_id" id="problem_id">
    <option value="">select</option>
    <?php
    $sql="SELECT * FROM `form_subcategory` WHERE `category_id`='2'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){

        echo "<option value='".$row["id"]."'>".$row["data"]."</option>";
    }
    ?>
</select>

                               </div>
                           </div>
                            
              



                           <div class='form-group row'>
                               <div class='col-md-4'>Remarks</div>
                               <div class='col-md-6'><textarea type='text' class='form-control' name='remarks'
                                       id='remarks' placeholder='Enter Remarks For'></textarea></div>
                           </div>

                           <div class='form-group row'>
                               <div class='col-md-4'></div>
                               <div class='col-md-6' id='submit_button'><button type="button" class="btn btn-primary btn-block"  onclick="submit_investigation();">submit</button></div>
                           </div>

                      

                       </form>

                       </div></div>
                   </div>

                    <!-- Modal footer -->
                   <div class="modal-footer">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   </div>

               </div>
           </div>
         </div>
         </div>

<!-- /////////////////////////////////////////////////////////////////////////////////// -->




<div class="modal" id="poa_action">
       <div class="modal-dialog modal-xl">
      <div class="modal-content">

                    <!-- Modal Header -->
                   <div class="modal-header">
                  <h4 class="modal-title"><b>POA ACTION</b> || </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                    <!-- Modal body -->


                   <div class="modal-body">
<div class="card"><div class="card-header" id="poa_header"></div><div class="card-body">
  

                       <form action="" method="POST">
                           <input type="hidden" name="enqiry_timeline_id_for_action"
                               id="enqiry_timeline_id_for_action">

<input type="hidden" name="enqiry_id" id="enqiry_id">

                         
                           <div class='form-group row'>
                               <div class='col-md-4'>Start Time</div>
                               <div class='col-md-6' id='start_time'><button type='button' class='btn btn-secondary btn-block' onclick='start_time_end_time_function();'>Start Time</button></div>
                           </div>
                            
                           <div class='form-group row'>
                               <div class='col-md-4'>Status</div>
                               <div class='col-md-6'> <select class='form-control' name='enquiry_status' id='enquiry_status'  style='width:100%' required></select></div>
                           </div>



                           <div class='form-group row'>
                               <div class='col-md-4'>Remarks For Action</div>
                               <div class='col-md-6'><textarea type='text' class='form-control' name='remarks2'
                                       id='remarks2' placeholder='Enter Remarks For'></textarea></div>
                           </div>

                           <div class='form-group row'>
                               <div class='col-md-4'></div>
                               <div class='col-md-6' id='submit_button'><button type="button" class="btn btn-primary btn-block"  onclick="submit_poa_action();">submit</button></div>
                           </div>

                      

                       </form>

                       </div></div>
                   </div>

                    <!-- Modal footer -->
                   <div class="modal-footer">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   </div>

               </div>
           </div>
         </div>
         </div>

<!-- /////////////////////////////////////////////////////////////////////////////////// -->




<div class="modal" id="create_poa">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><b>POA CREATION</b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <form action="" method="POST">
                          
                        <input type="hidden" name="enqiry_id_for_poa_creation"
                                id="enqiry_id_for_poa_creation" value="<?php echo $enquiry_id;?>">
                            <!-- //  content  5 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>POA</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='poa' id='poa'>
                                <!-- <option value=''>select</option> -->
                                <option value='Call'>Call</option>
                                <option value='Visit'>Visit</option>
                                <option value='Massage'>Mail/Massage</option>
                            </select>
                        </div>
                    </div>

                      <!-- //  content  5 -->
                      <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Date</label></div>
                        <div class='col-md-6'><input type='text' name='poa_date' id='poa_date' class='form-control' placeholder="Date"></div>
                    </div>

                           <!-- //  content  5 -->
                      <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Time</label></div>
                        <div class='col-md-6'><input type='text' name='poa_time' id='poa_time' class='form-control' placeholder="Time"></div>
                        </div>

                           <!-- //  content  5 -->
                      <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Remark</label></div>
                        <div class='col-md-6'><input type='text' name='poa_remarks' id='poa_remarks' class='form-control' placeholder="remarks"></div>
                        </div>


                              <!-- //  content  5 -->
                      <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Follow By</label></div>
                        <div class='col-md-6'>
                            <select name='follow_by' id='follow_by' class='form-control' placeholder="remarks">

<?php
$sql="SELECT * FROM `users` WHERE `user_category_id`='3' AND `status`='1'";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){
    echo "<option value='".$row["id"]."'>".$row["first_name"]." ".$row["last_name"]."</option>";
}
?>
                            </select>
                        </div>
                        </div>


                        <div class='form-group row'>
                                <div class='col-md-3'></div>
                                <div class='col-md-6' ><button type="button" class="btn btn-primary btn-block" onclick='submit_poa_creation();'>submit</button></div>
                            </div>



                        </form>

                    
                        </div>
                         <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                        </div>
                    </div>
                    </div>




</div>
</body>
    <script>
    $(document).ready(function() {
        // enquiry_management_timeline_waiting_list($enquiry_id);
        
        $("#follow_by").val(<?php echo $user_id;?>);

        


        $("#poa_date").datepicker({
        dateFormat: "yy/mm/dd"
    }).datepicker("setDate", new Date()); // Set the current date
 

    $('#poa_time').timepicker({

        timeFormat: 'HH:mm',
        interval: 30,  // Time intervals in minutes
        startTime: '10:00',  // Start time for the timepicker
        dynamic: false,  // Prevent dropdown from closing after selection
        dropdown: true,  // Enable dropdown to select time
        scrollbar: true  // Enable scrollbar for time selection


    })
        


    




});

 // Function to update the timepicker with the current time
 function setCurrentTime() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        $('#poa_time').timepicker('setTime', hours + ':' + minutes);
        var timeString = hours + ':' + minutes;
        // console.log("Timestring : "+timeString);
        $('#poa_time').val(timeString);
        // alert(timeString);
    }


function enquiry_timeline_call(enquiry_management_timeline_id,enquiry_id){


    $.ajax({
        url: '../controllers/ajax/task_page_ajax.php', // The PHP script URL
        type: 'POST',
        dataType: 'json',
        data:{
            task_no:"1",
            enquiry_id:enquiry_id,
            enquiry_management_timeline_id:enquiry_management_timeline_id
            },

        success: function(res) {
            
$('#modal_head').empty();
$('#poa_action').modal({ show: true });
            $.each(res.data, function(key, val) {
                $('#modal_head').append(val);
            });

          //   $('#task_1_card_header').empty();
          //   $('#task_1_card_header').append(res.enquiry_for);

             $('#enqiry_id').empty();
             $('#enqiry_id').val(res.enquiry_id);

             $('#enqiry_timeline_id_for_action').empty();
             $('#enqiry_timeline_id_for_action').val(res.enquiry_management_timeline_id);


             

             enquiry_management_status();

        }
    }); 
}  

function start_time_end_time_function(){
    var today = new Date();
    var start_time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
$("#start_time").empty();
$("#start_time").append('<input type="text" class="form-control" name="start_time" id="start_time_call" value="'+start_time+'" readonly>');
}

function enquiry_management_status() {   
        $.ajax({
            url: "../../sadmin/controllers/ajax/enquiry_management_status_ajax.php",
            type: "POST",
            data: {
                show_data:"show_data"
            },
            success: function(res) {
                
                $("#enquiry_status").empty();
                $("#enquiry_status").append(res);
                $("#enquiry_status").select2();

                // console.log(res);
            }
        });
    }




    function submit_poa_action(){
   
   var   task_no = 2;
   var   enqiry_timeline_id= $("#enqiry_timeline_id_for_action").val();
   var   enquiry_id= $("#enqiry_id").val();
   var   start_time        = $("#start_time_call").val();
   var   enquiry_status    = $("#enquiry_status").val();
   var   remarks2          = $("#remarks2").val();
   alert(start_time);
      $.ajax({
          url: '../controllers/ajax/enquiry_timeline_calling_ajax.php', // The PHP script URL
          type: "POST",
          dataType: 'json',
          data: {
              task_no :task_no,
              enquiry_id :enquiry_id,
              enqiry_timeline_id :enqiry_timeline_id,
              start_time :start_time,
              enquiry_status :enquiry_status,
              remarks2 :remarks2
          },
          success: function(res) {
console.log(res.data);

 if(res.data==1){

  $("#enqiry_id_for_poa_creation").empty();
  $("#enqiry_id_for_poa_creation").val(res.enquiry_id);
  Swal.fire({
      title: " POA  Taken Successfully",
      text: "Action has been Taken!",
      icon: "success"
    }).then((result) => {
      if (result.isConfirmed) {

      
         
        $('#poa_action').modal('hide');
        $('#create_poa').modal('show');
        setCurrentTime();
      }
    });


     }else{
      Swal("POA Action is Unsuccessfull");
     }
}
  });     
  }





    function submit_investigation(){
   
     var   task_no = 4;
     var   enquiry_id    = $("#enqiry_id").val();
     var   start_time    = $("#problem_id").val();
     var   remarks2      = $("#remarks").val();

        $.ajax({
            url: '../controllers/ajax/enquiry_timeline_calling_ajax.php', // The PHP script URL
            type: "POST",
            dataType: 'json',
            data: {
                task_no :task_no,
                enquiry_id :enquiry_id,
                start_time :start_time,
                remarks2 :remarks2
            },
            success: function(res) {
console.log(res.data);

   if(res.data==1){

    $("#enqiry_id_for_poa_creation").empty();
    $("#enqiry_id_for_poa_creation").val(res.enquiry_id);
    Swal.fire({
        title: " POA  Taken Successfully",
        text: "Action has been Taken!",
        icon: "success"
      }).then((result) => {
        if (result.isConfirmed) {

        
           
          $('#poa_action').modal('hide');
          $('#create_poa').modal('show');
          setCurrentTime();
        }
      });


       }else{
        Swal("POA Action is Unsuccessfull");
       }
}
    });     
    }








    
    function submit_poa_creation(){
     

     var   enqiry_id_for_poa_creation= $("#enqiry_id_for_poa_creation").val();
     var   poa    = $("#poa").val();
     var   poa_date = $("#poa_date").val();
     var   poa_time = $("#poa_time").val();
     var   poa_remarks= $("#poa_remarks").val();
     var   follow_by  = $("#follow_by").val();

    //  alert(poa_date+" "+poa_time+" "+poa_remarks+" "+follow_by+" ");

        $.ajax({
            url: '../controllers/ajax/enquiry_timeline_calling_ajax.php', // The PHP script URL
            type: "POST",
            dataType: 'json',
            data: {
                task_no :3,
                enqiry_id_for_poa_creation :enqiry_id_for_poa_creation,
                poa :poa,
                poa_date :poa_date,
                poa_time :poa_time,
                poa_remarks :poa_remarks,
                follow_by :follow_by
            },
            success: function(res) {
   if(res.data==1){

    $("#poa_remarks").empty();
    Swal.fire({
        title: "Plan OF Action Creation",
        text: "POA has been Created Successfully!",
        icon: "success"
      }).then((result) => {
        if (result.isConfirmed) {
            $('#create_poa').modal('hide');
            // $("#example").dataTable().fnDestroy();
            enquiry_management_timeline_waiting_list(enqiry_id_for_poa_creation);
            
          
        }
      });


       }else{
        Swal("POA Creation is Unsuccessfull");
       }
}
    });     
    }



function enquiry_management_timeline_waiting_list(enquiry_id){

    $.ajax({
        url: '../controllers/ajax/enquiry_timeline_calling_ajax.php', // The PHP script URL
        type: 'POST',
        data:{
            task_no:1,
            enquiry_id:enquiry_id
        },
        dataType: 'json', // Expect JSON response
        success: function(res) {
            $('#task_1_card_header').empty();
            $('#poa_header').empty();
            //  $('#task_1_card_header').append(res.enquiry_for);
             $('#poa_header').append(res.enquiry_for);
             

            $('#t_body').empty();
            // Loop through each item in the data array
            $.each(res.data, function(key, value) {
                $('#t_body').append(value);

            });

        }
        });
    }
    </script>
    </html>

    