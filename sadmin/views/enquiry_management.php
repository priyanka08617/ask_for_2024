<?php ob_start();
include '../includes/check.php';
$co=date('Y-m-d');
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Enquiry Management Details</title>
    <?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
include '../includes/functions.php'; 
             
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
        <h3> Enquiry Management </h3><small class='text-muted'>Fill in the given below tab to create Enquiry Management
            and manage existing data</small>
        <HR></HR>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>

                <a class='nav-link' data-toggle='tab' href='#home'>Enquiry Management Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Enquiry Management</a>
            </li>


        </ul>



        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
            <form class='form-horizontal' action='../controllers/enquiry_management_add.php' method='post'>
<BR>

<input type='hidden' name='created_by' id='created_by' value='<?php echo $user_id;?>'>
<input type='hidden' name='user_category_id' id='user_category_id' value='<?php echo $user_category_id;?>'>
 <!-- //  content  2 -->
       
 <!-- <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Created By</label></div>
                        <div class='col-md-6'>
                            <select  class='form-control'   name='created_by' id='created_by'><option value=''>Select</option>
                                <?php
                                $sql1="SELECT * FROM `users` WHERE `user_category_id`='4' AND  `user_category_id`='5' AND `status`='1'";
                                $query1=mysqli_query($conn,$sql1);
                                while($row1=mysqli_fetch_array($query1)){
                                    $row1["user_category_id"];
                                    if($row1["user_category_id"]==4){
                                        $store=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$store_id'", "name"); 
                                    }else{
                                        $store="";
                                    }
                                   
                                    echo "<option value='".$row1["id"]."'>".$row1["first_name"]." ".$row1["last_name"]." ||  ".$store." </option>";
                                }
                                
                                ?>
</select>
                        </div>
                    </div> -->





                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Source</label></div>
                        <div class='col-md-4'>

                            <select class='form-control' name='source' id='source'  onchange="change_source(this.value,<?php echo $store_id;?>)" required>
                                  <option value=''>Select</option>
                                <option value='walking'>Walking</option>
                                <option value='lead'>Lead</option>
                                <option value='referral'>Referral</option>
                                <option value='social_media'>Social Media</option>
                                <option value='lenovo'>Lenovo</option>
                                <option value='google'>Google</option>
                                <option value='print_media'>Print Media</option>

                            </select>
                        </div>
                        <div class='col-md-2' id="source_div"></div>
                    </div>

                    <!-- //  content  2 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Customer Name</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter Customer Name'
                                name='customer_name' id='customer_name'>
                        </div>
                    </div>

                    <!-- //  content  3 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Customer Mobile</label></div>
                        <div class='col-md-6'>
                            <!--<input type='text' class='form-control' placeholder='Enter Customer Mobile'  onclick='GetMobile_no(this.value)'-->
                            <!--    name='customer_mobile' id='customer_mobile'>-->
                                
                                <input type='number' class='form-control' placeholder='Enter Customer Mobile'
                                name='customer_mobile' id='customer_mobile' onkeyup='GetMobile_no(this.value)'  pattern="[0-9]{3} [0-9]{3} [0-9]{4}" maxlength="10" >
                                <span id="email_error"></span>
                                
                                
                        </div>
                    </div>



                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Customer Mail</label></div>
                        <div class='col-md-6'>
                            <input type='email' class='form-control' placeholder='Enter Customer Mail'
                                name='customer_mail' id='customer_mail'>
                        </div>
                    </div>

                    <div class='form-group row' >
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry Date</label></div>
                        <div class='col-md-6'> 
                            <input type='date' class='form-control'  name='enquiry_date' id='enquiry_date' value='<?php echo $co;?>' required>
                        </div>
                    </div>

                    <!-- //  content  4 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry For</label></div>
                        <div class='col-md-6'>
                            <textarea id='enquiry' name='enquiry' rows='4' style='width:100%' required></textarea>
                        </div>
                    </div>

                    <!-- //  content  5 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>POA</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='poa' id='poa'>
                                <option value=''>select</option>
                                <option value='Call'>Call</option>
                                <option value='Visit'>Visit</option>
                                <option value='Massage'>Mail/Massage</option>
                            </select>
                        </div>
                    </div>

                      <!-- //  content  5 -->
                      <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'></label></div>
                        <div class='col-md-6'>
                        <div class='row'>
                        <div class='col-md-4'><input type='date' name='poa_date' id='poa_date' class='form-control' placeholder="Date"></div>
                        <div class='col-md-4'><input type='text' name='poa_time' id='poa_time' class='form-control' placeholder="Time"></div>
                        <div class='col-md-4'><input type='text' name='poa_remarks' id='poa_remarks' class='form-control' placeholder="remarks"></div>
                        </div>
                        </div>
                    </div>


                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry Status</label></div>
                        <div class='col-md-6'>

        <select class='form-control' name='enquiry_status' id='enquiry_status' onclick='enquiry_management_status()' style='width:100%' required></select>
                        </div>
                        <div class='col-md-2'>
                        <!-- <button type='button' id='add_status' class='btn btn-secondary' onclick='enquiry_management_status_add()'>+Add</button> -->
                        <img src="../img/add.png" style="width:30px"  data-toggle="modal" data-target="#myModal2" >
                    </div>
                    </div>



                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                                <button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
                        
                        </div>
                    </div>



                </form>
            </div>
            <br>
            <div id='menu1' class='tab-pane in active'>
            <table class='table table-striped table-sm' id='example'>
                    <thead>
                    <th>#</th>
                    <th>Branch</th>
                        <th>Enquiry Date</th>
                        <th>Source</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Enquiry For</th>
                        <th>Task</th>
                        <th>POA</th>
                      
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>Branch</th>
                        <th>Enquiry Date</th>
                        <th>Source</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Enquiry For</th>
                        <th>Task</th>
                        <th>POA</th>
                       
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM `enquiry_management` WHERE `status`="1" ORDER BY `id` DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){

$id=$row['id'];
$store_id=$row['store_id'];
$store_name=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$store_id' ORDER BY `id` DESC", "name");
$enquiry_status_id=$row['enquiry_status'];
$enquiry_status=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_status` WHERE `id`='$enquiry_status_id'", "enquiry_status");
$status=$row['status'];
$source_type=$row['source_type'];
$source_id=$row['source'];
$customer_name=$row['customer_name'];
$customer_mobile=$row['customer_mobile'];
$customer_mail=$row['customer_mail'];
$enquiry_date=dateForm1($row['enquiry_date']);
$enquiry=$row['enquiry'];
$created_by_id=$row['created_by'];
$poa=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_timeline` WHERE `enquiry_management_id`='$id' ORDER BY `id` DESC", "poa");


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


 echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'.$store_name.'</td>';
 echo '<td>'. $enquiry_date.'</td>';
 echo '<td>'. $source_type ." || ".$source.'</td>';
 echo '<td>'. $customer_name.'</td>';
 echo '<td>'. $customer_mobile.'</td>';
 echo '<td>'. $customer_mail.'</td>';
 echo '<td>'. $row['enquiry'].'</td>';
 echo '<td>'.$poa.'</td>';
 echo '<td><a href="../views/enquiry_timeline.php?enquiry_id='.$id.'"><button type="button" class="btn btn-primary btn-sm btn-block">view</button></a></td>';

if($enquiry_status=='OPEN'){
    echo "<td><button type='button' class='btn btn-primary'>".$enquiry_status."</button></td>";
}elseif($enquiry_status=='closed'){
    echo "<td><button type='button' class='btn btn-secondary'>".$enquiry_status."</button></td>";
}else{
    echo "<td><button type='button' class='btn btn-warning'>".$enquiry_status."</button></td>";
}

 
 echo '<td>'. $created_by.'</td>';
 echo '<td>'. dateForm($row['row_created_on']).'</td>';
$edit_modal_params_string="'$id','$source','$customer_name','$customer_mobile','$customer_mail','$enquiry','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><img src="../img/edit.png" style="width:30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">';
echo '<a href="../controllers/enquiry_management_del.php?id='.$id.'"><img src="../img/delete.png" style="width:30px" ></a></td>';
echo '</tr>';


 $c++;

}
 ?>
                    </tbody>
                </table>
            </div>
            <!--// for tab-content  -->
        </div>


        
        <!-- The Modal -->
        <div class="modal" id="myModal2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Adding Status</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="modal_body">
                    <form class='form' action='' method='POST'>
 

                           <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Enquiry Status</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Continue'
                                        name='enquiry_poa_status' id='enquiry_poa_status'>
                                </div>
                            </div>

                            <!-- //  content  3 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Enquiry Status</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Open / Close / Failed'
                                        name='enquiry_status' id='enquiry_status'>
                                </div>
                            </div>

                            <div class='row mt-3'>
                                <div class='col-md-4'></div>
                                <div class='col-md-8'>
                                    <button type='button' class='btn btn-primary btn-block btn-sm' onclick="enquiry_management_status_add()">Submit</button>
                                </div>
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






        <!-- The Modal -->
        <div class='modal' id='myModal'>

            <div class='modal-dialog modal-lg'>

                <div class='modal-content'>

                    <!-- Modal Header -->

                    <div class='modal-header'>

                        <h4 class='modal-title'>Enquiry Management Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/enquiry_management_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            

                            <!-- //  content  2 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Customer Name</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Customer Name'
                                        name='customer_name_E' id='customer_name_E'>
                                </div>
                            </div>

                            <!-- //  content  3 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Customer Mobile</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Customer Mobile'
                                        name='customer_mobile_E' id='customer_mobile_E'>
                                </div>
                            </div>


                            <!-- //  content  3 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Customer Email</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Customer mail'
                                        name='customer_mail_E' id='customer_mail_E'>
                                </div>
                            </div>



                            <!-- //  content  4 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Enquiry</label>
                                </div>
                                <div class='col-md-8'>
                                    <textarea id='Enquiry_E' name='Enquiry_E' rows='4' style='width:100%'></textarea>
                                </div>
                            </div>

                         
                            <div class='row mt-3'>
                                <div class='col-md-4'></div>
                                <div class='col-md-8'>
                                    <button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
    function openModel(id, source, customer_name, customer_mobile,customer_mail, enquiry, status) {
        $('#id_E').val(id);
        $('#source_E').val(source);
        $('#customer_name_E').val(customer_name);
        $('#customer_mobile_E').val(customer_mobile);
        $('#customer_mail_E').val(customer_mail);
        $('#Enquiry_E').val(enquiry);
    }


    $(function() {
  $('#poa_time').datetimepicker({
    format: 'HH:mm'
  });
  
});

    $(document). ready(function(){ 
    enquiry_management_status();
    $("#enquiry_status").select2();
    $("#disable_button").hide();    
    });

  

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

            'pageLength', 'copy', 'excel', 'pdf', 'print'

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


    

    function change_source(source_id) {
        // alert(source_id);
        $.ajax({
            url: "../controllers/ajax/ajax_source_for_enquiry_management.php",
            type: "POST",
            data: {
                source_id: source_id
            },
            success: function(res) {
            
                $("#source_div").empty();
                $("#source_div").append(res);


                console.log(res);
            }
        });
    }


    function enquiry_management_status() {   
        $.ajax({
            url: "../controllers/ajax/enquiry_management_status_ajax.php",
            type: "POST",
            data: {
                show_data:"show_data"
            },
            success: function(res) {
                // alert(res);
                $("#enquiry_status").empty();
                $("#enquiry_status").select2();
                $("#enquiry_status").append("<option value=''>select</option>"+res);


                // console.log(res);
            }
        });
    }


    function enquiry_management_status_add() {   
      var enquiry_poa_status=  $("#enquiry_poa_status").val();
      var enquiry_status=  $("#enquiry_status").val();
        $.ajax({
            url: "../controllers/ajax/enquiry_management_status_ajax.php",
            type: "POST",
            data: {
                show_data:"add_data",
                enquiry_poa_status:enquiry_poa_status,
enquiry_status:enquiry_status
            },
            success: function(res) {
             
                $('#myModal2').modal('hide');
                $("#enquiry_status").empty();
                $("#enquiry_status").select2();
                $("#enquiry_status").append(res);


                console.log(res);
            }
        });
    }




   function GetMobile_no(mobile_no){
        if(mobile_no.length==10) {
            $.ajax({
type: "POST",
data: {
name:mobile_no,
table_name:'enquiry_management',
table_col_name:'customer_mobile'
},
url: "../../sadmin/controllers/ajax/ajax_check_duplicate.php",
success: function(data) {
// alert(data);
if(data==1){

// alert("You Can't Proceed ,this 'Mobile NO' is already Exist");

swal({
                type: "error",
                title: "Enquiry Management",
                text: "You Can't Proceed ,this 'Mobile NO' is already Exist!",
                icon: "error",
                button: "ok!",
            });



$("#customer_mobile").css('border-color', 'red');

$("#email_error").remove();
$("#customer_mobile").after("<span id='email_error' class='text-danger'>This Contact no. is already Exist</span>");

$("#disable_button").show();
$("#active_button").hide();


}
if(data==0){
    $("#email_error").remove();
    $("#customer_mobile").css('border-color', '');

    $("#active_button").show();
    $("#disable_button").hide();
}
}
});


        }else{

      
$("#customer_mobile").css('border-color', 'red');
$("#email_error").remove();
$("#customer_mobile").after("<span id='email_error' class='text-danger'>Enter 10 Digit Mobile No.</span>");
$("#disable_button").show();
$("#active_button").hide();

}
}




    </script>
      <!-- </html> -->