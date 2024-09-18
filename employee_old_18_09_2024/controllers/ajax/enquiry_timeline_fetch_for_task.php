<?php ob_start();
include 'connection.php';
include '../../includes/functions.php';

$enquiry_id=sanitize_input($conn,$_GET["enquiry_id"]);

?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Enquiry Management Timeline</title>
    <?php 
 
// include '../includes/header.php'; 
// include '../includes/navbar.php'; 

             
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



        <table class="table table-striped table-sm" id="example">
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
    
     if($row1["action_taken_date"]=="0000:00:00"){
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

       





















</body></html>





    