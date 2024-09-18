<?php ob_start();


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include '../includes/check.php';
include '../includes/functions.php';

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
  


    <!-- Form Name -->
<h3> Todays Timeline For Enquiry Management</h3>
<small class='text-muted'>Show in the Given Below Table to Follow then Enquiry Management and manage existing data</small>
<hr></hr>


<table class="table table-striped table-sm" id="example">
            <thead>
                <th>#</th>
                <th>Source</th>
                <th>Enq Date</th>
                <th>Name</th>
                <th>Enquiry For</th>
                <th>Task Date</th>
                <th>Task</th>
                
                <!-- <th>POA</th> -->
                <th>Remark</th>
                <th>Action</th>
                <th class="text-center">||</th>
                <th>Pending For</th>
                <th>Remark</th>
                <th>Task For</th>
                <th>Created On</th>
            </thead>

            <tfoot>
            <th>#</th>
                 <th>Source</th>
                <th>Enq Date</th>
                <th>Name</th>
                <th>Enquiry For</th>
                <th>Task Date</th>
                <th>Task</th>
               
                <th>Remark</th>
                <th>Action</th>
                <th class="text-center">||</th>
                <th>Pending For</th>
                <th>Remark</th>
                <th>Task For</th>
                <th>Created On</th>

            </tfoot>


            <tbody>
            <?php
            $c=0;
            $start_date = date('Y-m-d');
$sql="SELECT *  FROM `enquiry_management_timeline` WHERE `status`='1'    ORDER BY `date` > CURRENT_DATE, ABS(DATEDIFF(date, CURRENT_DATE))";
$query=mysqli_query($conn,$sql);
echo mysqli_error($conn);

while($row1=mysqli_fetch_array($query)){

    $enquiry_management_timeline_id=$row1["id"];
    $enquiry_id=$row1["enquiry_management_id"];
    $poa=$row1["poa"];
    $remarks1=$row1['remarks1'];
    $poa_action_status=$row1["poa_action_status"];
    
    
    
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
   


  

$edit_modal_params_string='"'.$enquiry_management_timeline_id.'","'.$poa.'","'.$remarks1.'","'.$poa_action_status.'","'.$start_call_openmodel1.'","'.$enquiry_id.'"';
$edit_modal_params='openModel1('.$edit_modal_params_string.')';

$enquiry_management=fetch_data($conn,"enquiry_management","id",$enquiry_id);

$store_id_fetched=$enquiry_management['store_id'];
$customer_name=$enquiry_management['customer_name'];
$customer_mobile=$enquiry_management['customer_mobile'];
$customer_mail=$enquiry_management['customer_mail'];
$enquiry_date=$enquiry_management['enquiry_date'];
$enquiry=$enquiry_management['enquiry'];

$created_by_id=$enquiry_management['created_by'];
$last_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "last_name");
$first_name=singleRowFromTable($conn,"SELECT * FROM `users` WHERE `id`='$created_by_id'", "first_name");
$created_by=$first_name." ".$last_name;



    $source_type=$enquiry_management['source_type'];
    $source_id=$enquiry_management['source'];
    if($source_type=="referral"){
        
        $source=singleRowFromTable($conn,"SELECT * FROM `customer_details` WHERE `id`='$source_id'", "display_name");
    
    }elseif($source_type=="walking"){
        $source=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$source_id'", "name");
    }else{
        $source=$source_id;
    }
    
    
// echo $numOfDays;

if($store_id_fetched==$store_id){
    
        $c++;

 echo "<tr><td>".$c."</td>";
  echo '<td>'. $source_type ." || ".$source.'</td>';
 echo '<td>'.$enquiry_date.'</td>';
 echo '<td>'.$customer_mobile." ". $customer_name." ".$customer_mail.'</td>';
 echo '<td>'. $enquiry.'</td>';
 echo "<td>".$row1["date"]."</td>";
 echo "<td>".$row1["poa"]."</td><td>".$row1["remarks1"]."</td>";
 
 
          if($poa_action_status==1){
            echo "<td><button type='button' class='btn btn-warning'  data-toggle='modal' data-target='#myModal1' onclick='".$edit_modal_params."'>waiting</button></td>";
            echo "<td class='text-center'>||</td>";
            echo   "<td>--</td>";


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
            echo "<td><button type='button' class='btn btn-success'>action taken</button></td>";
            echo "<td class='text-center'>||</td>";
           
        echo   "<td>".$row1["remarks2"]."</td>";

 // <td> Start Call - ".$start_call."End Call - ".$end_call."</td>
// $start_date = date('Y-m-d');
// $end_date   = date('Y-m-d',strtotime($row1["action_taken_date"]));
// $dateDiff   =   $end_date - strtotime($start_date);
// $numOfDays  = $dateDiff / 86400 ;
// $status_for_numOfDays="Late";

$status_for_numOfDays="";
$numOfDays=$row1["action_taken_date"]."<br>".$end_call;


        
          }     
          
          echo '<td> '.$numOfDays.'  <br>' .$status_for_numOfDays.'</td>';
          echo '<td>'. $created_by.'</td>';
          echo '<td>'.$row1["row_created_on"].'</td>';

      echo  "</tr>";
}
}
?>
            </tbody>
        </table>
        
        
        
        
        
        <!--    <div class="modal" id="myModal1">-->
        <!--    <div class="modal-dialog modal-lg">-->
        <!--        <div class="modal-content">-->

                    <!-- Modal Header -->
        <!--            <div class="modal-header">-->
        <!--                <h4 class="modal-title"><b>POA ACTION</b></h4>-->
        <!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <!--            </div>-->

                    <!-- Modal body -->
        <!--            <div class="modal-body">-->

        <!--                <form action="" method="POST">-->
        <!--                    <input type="hidden" name="enqiry_timeline_id_for_action"-->
        <!--                        id="enqiry_timeline_id_for_action">-->

        <!--                        <input type="hidden" name="enqiry_id"-->
        <!--                        id="enqiry_id">-->

        <!--                    <div class="card">-->
        <!--                        <div class="card-header">-->
        <!--                            <div class='form-group row'>-->
        <!--                                <div class='col-md-6'>-->
        <!--                                    <h5 align="center"><b>Enquiry For</b></h5>-->
        <!--                                </div>-->
        <!--                                <div class='col-md-6'>-->
        <!--                                    <h5 align="center"><b>Remarks</b></h5>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        <div class="card-body">-->
        <!--                            <div class='form-group row'>-->
        <!--                                <div class='col-md-6'>-->
        <!--                                    <p id="exnquiry_show_for_action" align="center"></p>-->
        <!--                                </div>-->
        <!--                                <div class='col-md-6'>-->
        <!--                                    <p id="remarks_show_for_action" align="center"></p>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->

        <!--                    <br>-->
                            <!-- name='start_time_onclick' -->
        <!--                    <div class='form-group row'>-->
        <!--                        <div class='col-md-4'>Start Time</div>-->
        <!--                        <div class='col-md-6' id='start_time'></div>-->
        <!--                    </div>-->
                            
        <!--                    <div class='form-group row'>-->
        <!--                        <div class='col-md-4'>Status</div>-->
        <!--                        <div class='col-md-6'> <select class='form-control' name='enquiry_status' id='enquiry_status' onclick='enquiry_management_status()' style='width:100%' required></select></div>-->
        <!--                    </div>-->



        <!--                    <div class='form-group row'>-->
        <!--                        <div class='col-md-4'>Remarks For Action</div>-->
        <!--                        <div class='col-md-6'><textarea type='text' class='form-control' name='remarks2'-->
        <!--                                id='remarks' placeholder='Enter Remarks For '></textarea></div>-->
        <!--                    </div>-->

        <!--                    <div class='form-group row'>-->
        <!--                        <div class='col-md-4'></div>-->
        <!--                        <div class='col-md-6' id='submit_button'><button type="submit" class="btn btn-primary btn-block" name="submit_poa_action" id="submit_poa_action">submit</button></div>-->
        <!--                    </div>-->



        <!--                </form>-->


        <!--            </div>-->

                    <!-- Modal footer -->
        <!--            <div class="modal-footer">-->
        <!--                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
        <!--            </div>-->

        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->


        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div>
    <script>
        
        
        $('#example tfoot th').each(function() {

        var title = $(this).text();

        $(this).html('<input type="text" class="" placeholder="Search" />');

    });

    var table = $('#example').DataTable({

        dom: 'Bfrtip',

        lengthMenu: [

            [25, 50, -1],

            ['25 rows', '50 rows', 'Show all']

        ],


        buttons: [

            'pageLength'

        ]

    });


    table.columns().every(function() {

        var that = this;


        $('input', this.footer()).on('keyup change', function() {

            if (that.search() !== this.value) {

                that.search(this.value).draw();

            }

        });

    });


</script>
</body></html>
