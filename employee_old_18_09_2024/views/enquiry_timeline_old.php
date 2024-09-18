<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php'; 


$enquiry_id=sanitize_input($conn,$_GET["enquiry_id"]);

?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Enquiry Management Timeline</title>
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
  


        <?php
$c=1; 
 
$sql="SELECT * FROM `enquiry_management` WHERE `status`='1' AND `id`='$enquiry_id'";

$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){

$id=$row['id'];
$status=$row['status'];
$source_type=$row['source_type'];
$source_id=$row['source'];
$customer_name=$row['customer_name'];
$customer_mobile=$row['customer_mobile'];
$customer_email=$row['customer_mail'];
$enquiry=$row['enquiry'];

$poa=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_timeline` WHERE `enquiry_management_id`='$id'", "poa");

$edit_modal_params_string1="$enquiry_id";
$edit_modal_params1='openModel2('.$edit_modal_params_string1.')';

}
 ?>

    <!-- Form Name -->
<h3> Enquiry Management Of (<b><?php echo $customer_name;?> -- <?php echo $customer_mobile;?> -- <?php echo $customer_email;?></b>)</h3>
<small class='text-muted'>Fill in the given below tab to create Enquiry Management and manage existing data</small><span style="float:right"></span>



        <table class="table table-bordered table-sm" id="example">
            <thead>
                <tr>
                <h4> <th colspan="6" class="text-center">POA</th>
                <th colspan="1" class="text-center">||</th>
                    <th colspan="3" class="text-center">ACTION</th>
                    <th colspan="2" class="text-right"><button type="button" class="btn btn-secondary" data-toggle='modal' data-target='#create_poa' onclick="<?php echo $edit_modal_params1;?>">Create POA</button></th>
                    <h4>
                </tr>
               <th>#</th>
                <th>Date</th>
                <th>Time</th>
                <th>POA</th>
                <th>Remark</th>
                <th>Action</th>
                <th class="text-center">||</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Date</th>
                <th>Remark</th>
                <th>Status</th>


            </thead>
            <tbody>
            <?php
            $c=0;
$sql="SELECT *  FROM `enquiry_management_timeline` WHERE `status`='1' AND  `enquiry_management_id`='$enquiry_id'";
$query=mysqli_query($conn,$sql);
while($row1=mysqli_fetch_array($query)){
    $c++;
    
    $enquiry_status_id=$row1["enquiry_status"];
    $enquiry_status=fetch_data($conn,"enquiry_management_status","id",$enquiry_status_id);
    
    
    $enquiry_management_timeline_id=$row1["id"];
    $enquiry_id=$row1["enquiry_management_id"];
    $poa=$row1["poa"];
    $remarks1=$row1['remarks1'];
    $poa_action_status=$row1["poa_action_status"];

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
    
     if($row1["action_taken_date"]=="00:00:00"){
       $action_take_date="--";
    }else{
       $action_take_date=date($row1["action_taken_date"]); 
    }
    
    //'$remarks1',
  

$edit_modal_params_string='"'.$enquiry_management_timeline_id.'","'.$poa.'","'.$remarks1.'","'.$poa_action_status.'","'.$start_call_openmodel1.'","'.$enquiry_id.'"';
$edit_modal_params='openModel1('.$edit_modal_params_string.')';


    echo "<tr>
          <td>".$c."</td>
          <td>".$row1["date"]."</td>
          <td>".TimeForm($row1["time"])."</td>
          <td>".$row1["poa"]."</td>
          <td>".$row1["remarks1"]."</td>";
          if($poa_action_status==1){
            echo "<td><button type='button' class='btn btn-warning'  data-toggle='modal' data-target='#myModal1' onclick='".$edit_modal_params."'>waiting for action</button></td>";
          }elseif($poa_action_status==2){
            echo "<td><button type='button' class='btn btn-success'>action taken</button></td>";
          }
          echo "<td class='text-center'>||</td><td>".$start_call."</td>
          <td>".$end_call."</td>
          <td>". $action_take_date."</td>
          <td>".$row1["remarks2"]."</td>";
          
 if($enquiry_status_id==0){
          echo "<td><button type='button' class='btn btn-danger'>Pending</button></td>";
          }else{
            echo "<td><button type='button' class='btn btn-default'>".$enquiry_status["enquiry_poa_status"]."</button></td>";
          }
          
      echo    "</tr>";
}
?>
            </tbody>
        </table>

       



        <div class="modal" id="myModal1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><b>POA ACTION</b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <form action="" method="POST">
                            <input type="hidden" name="enqiry_timeline_id_for_action"
                                id="enqiry_timeline_id_for_action">

                                <input type="hidden" name="enqiry_id"
                                id="enqiry_id">

                            <div class="card">
                                <div class="card-header">
                                    <div class='form-group row'>
                                        <div class='col-md-6'>
                                            <h5 align="center"><b>Enquiry For</b></h5>
                                        </div>
                                        <div class='col-md-6'>
                                            <h5 align="center"><b>Remarks</b></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class='form-group row'>
                                        <div class='col-md-6'>
                                            <p id="exnquiry_show_for_action" align="center"></p>
                                        </div>
                                        <div class='col-md-6'>
                                            <p id="remarks_show_for_action" align="center"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <!-- name='start_time_onclick' -->
                            <div class='form-group row'>
                                <div class='col-md-4'>Start Time</div>
                                <div class='col-md-6' id='start_time'></div>
                            </div>
                            <!--onchange='enquiry_management_status()'-->
                            
                            <div class='form-group row'>
                                <div class='col-md-4'>Status</div>
                                <div class='col-md-6'> <select class='form-control' name='enquiry_status' id='enquiry_status'  style='width:100%' required></select></div>
                            </div>



                            <div class='form-group row'>
                                <div class='col-md-4'>Remarks For Action</div>
                                <div class='col-md-6'><textarea type='text' class='form-control' name='remarks2'
                                        id='remarks' placeholder='Enter Remarks For '></textarea></div>
                            </div>

                            <div class='form-group row'>
                                <div class='col-md-4'></div>
                                <div class='col-md-6' id='submit_button'><button type="submit" class="btn btn-primary btn-block" name="submit_poa_action" id="submit_poa_action">submit</button></div>
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
                                id="enqiry_id_for_poa_creation">
                            <!-- //  content  5 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>POA</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='poa' id='poa'>
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
                        <div class='col-md-6'><input type='date' name='poa_date' id='poa_date' class='form-control' placeholder="Date"></div>
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
                        <div class='col-md-2'><label class='control-label' for='uom'>Remarks</label></div>
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
                                <div class='col-md-6' ><button type="submit" class="btn btn-primary btn-block" name="submit_poa_creation" id='submit_poa_creation'>submit</button></div>
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
           








<?php

if(isset($_POST['submit_poa_action'])){
    $action_taken_date=date('Y-m-d');
    $end_time=date('Y-m-d H:i:s');
    $enqiry_id=sanitize_input($conn,$_POST["enqiry_id"]);
      $enquiry_status=sanitize_input($conn,$_POST["enquiry_status"]);
    $remarks2=sanitize_input($conn,$_POST["remarks2"]);
    $enquiry_management_timeline_id=sanitize_input($conn,$_POST["enqiry_timeline_id_for_action"]);
    
mysqli_query($conn,"UPDATE `enquiry_management_timeline` SET `remarks2`='$remarks2',`end_call`='$end_time',`action_taken_date`='$action_taken_date',`poa_action_status`='2',`enquiry_status`='$enquiry_status' WHERE `id`='$enquiry_management_timeline_id'");

header("location:enquiry_timeline.php?enquiry_id=".$enqiry_id);
}



if(isset($_POST['submit_poa_creation'])){
    $start_call="00:00:00";
$end_Call="00:00:00";
$remark2=" ";


    $co=date('Y-m-d H:i:s');
    $enqiry_id=sanitize_input($conn,$_POST['enqiry_id_for_poa_creation']);
    $poa_x=sanitize_input($conn,$_POST['poa']);
    $poa_date_x=sanitize_input($conn,$_POST['poa_date']);
    $poa_time_x=sanitize_input($conn,$_POST['poa_time']);
    $poa_remarks_x=sanitize_input($conn,$_POST['poa_remarks']);
    $follow_by_x   =  sanitize_input($conn,$_POST['follow_by']);


$sql1_poa_creation="INSERT INTO `enquiry_management_timeline`(`enquiry_management_id`,`poa`,`date`, `time`, `remarks1`, `row_created_on`,`poa_action_status`, `status`,`start_call`,`end_call`,`remarks2`,`following_by`) VALUES ('$enquiry_id','$poa_x','$poa_date_x','$poa_time_x','$poa_remarks_x','$co','1','1','$start_call','$end_Call','$remark2','$follow_by_x')";
mysqli_query($conn,$sql1_poa_creation);
echo mysqli_error($conn);

header("location:enquiry_timeline.php?enquiry_id=".$enqiry_id);

}

?>



















    </div>





    <script>
    function openModel1(id, poa, remarks1, status,start_time,enqiry_id) {

        $("#enqiry_id").val(enqiry_id);
        $('#enqiry_timeline_id_for_action').val(id);
          $('#exnquiry_show_for_action').empty();
        $('#exnquiry_show_for_action').append(poa);
          $('#remarks_show_for_action').empty();
        $('#remarks_show_for_action').append(remarks1);
        $('#status_E').val(status);
        
if(start_time=="00:00:00"){
    $('#start_time').empty();
    $('#start_time').append("<span class='start_time_button'><button type='button' class='btn btn-secondary btn-block' onclick='start_time_end_time_function();'>Start Time</button></span>");
}else{
    $('#start_time').empty();
    $('#start_time').append('<input type="text" class="form-control" value="'+start_time+'" readonly>');
}






    }



    function openModel(id, source, customer_name, customer_mobile, enquiry, status) {
        $('#id_E').val(id);
        $('#source_E').val(source);
        $('#customer_name_E').val(customer_name);
        $('#customer_mobile_E').val(customer_mobile);
        $('#Enquiry_E').val(enquiry);
        // $('#POA_E').val(POA);
    }

    function openModel2(enquiry_id) {
       
        $('#enqiry_id_for_poa_creation').val(enquiry_id);
        setCurrentTime();
    }
    
    
    $(document). ready(function(){ 

            enquiry_management_status();

    });
    
  
    function change_source(source_id) {
        alert(source_id);
        $.ajax({
            url: "../controllers/ajax/ajax_source_for_enquiry_management.php",
            type: "POST",
            data: {
                source_id: source_id
            },
            success: function(res) {
                // alert(res);


                // alert();
                $("#source_div").empty();
                $("#source_div").append(res);


                console.log(res);
            }
        });
    }

    function start_time_end_time_function() {
        var enquiry_management_timeline_id = $('#enqiry_timeline_id_for_action').val();
        // alert(enquiry_management_timeline_id);
        $.ajax({
            type: "POST",
            data: {
                enquiry_management_timeline_id: enquiry_management_timeline_id
            },
            url: "../controllers/ajax/ajax_update_poa_action.php",
            success: function(result) {
                
                var res = result.split('_');
                // alert(res[0]+" -- "+res[1]);
                if(res[0]==1){
                    $(".start_time_button").hide();
                    $("#start_time").empty();
                    $("#start_time").append("<input type='text' class='form-control' value='"+res[1]+"' readonly>");
                    $('#submit_poa_action').attr("disabled", false);

                }
             
            }
        });

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
    
    function setCurrentTime() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        $('#poa_time').timepicker('setTime', hours + ':' + minutes);
        var timeString = hours + ':' + minutes;
        $('#poa_time').val(timeString);
    }
    
    </script>