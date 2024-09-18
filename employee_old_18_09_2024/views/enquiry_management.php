<?php ob_start();
include '../includes/check.php';

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
        <HR>
        </HR>
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

                    <input type='hidden' name='user_category_id' id='user_category_id'
                        value='<?php echo $user_category_id;?>'>


                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>For</label></div>
                        <div class='col-md-6'>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"  name="sale_or_service" value="1" onchange="call_for_service(1)" checked>Sale Enquiry
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"  name="sale_or_service" value="2" onchange="call_for_service(2)" >Service Enquiry
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Created By</label></div>
                        <div class='col-md-6'>
                            <select class='form-control' name='created_by' id='created_by' required>
                                <!-- <option value=''>Select</option> -->
                                <?php
                                $sql1="SELECT * FROM `users` WHERE `id`='$user_id' AND `status`='1'";
                                $query1=mysqli_query($conn,$sql1);
                                while($row1=mysqli_fetch_array($query1)){
                                    $store=singleRowFromTable($conn,"SELECT * FROM `branch` WHERE `id`='$store_id'", "name"); 
                                    echo "<option value='".$row1["id"]."'>  MR. ".$row1["first_name"]." ".$row1["last_name"]." ||  ".$store." </option>";
                                }
                                
                                ?>
                            </select>
                        </div>
                    </div>





                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Source</label></div>
                        <div class='col-md-3'>

                            <select class='form-control' name='source' id='source'
                                onchange="change_source(this.value,<?php echo $store_id;?>)" required>
                                <option value=''>Select</option>
                                <option value='walking'>Walking</option>
                                <option value='lead'>Lead</option>
                                <option value='referral'>Referral</option>
                                <option value='social_media'>Social Media</option>
                                <option value='lenovo'>Lenovo</option>
                                <option value='google'>Google</option>
                                <option value='Visit'>Visit</option>
                                <option value='print_media'>Print Media</option>

                            </select>
                        </div>
                        <div class='col-md-3' id="source_div"></div>
                    </div>

                    <!-- //  content  2 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Customer Name</label></div>
                        <div class='col-md-3'>
                            <input type='text' class='form-control' placeholder='Enter Customer Name'
                                name='customer_name' id='customer_name'>
                        </div>

                        <div class='col-md-3'>
                            <input type='email' class='form-control' placeholder='Enter Customer EMail'
                                name='customer_mail' id='customer_mail'>
                        </div>


                    </div>


                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Customer Mobile</label></div>
                        <div class='col-md-6'>
                            <input type='number' class='form-control' placeholder='Enter Customer Mobile'
                                name='customer_mobile' id='customer_mobile' onkeyup='GetMobile_no(this.value)'
                                onclick='GetMobile_no(this.value)' pattern="[0-9]{3} [0-9]{3} [0-9]{4}" maxlength="10">
                            <span id="email_error"></span>

                        </div>
                    </div>



                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry Date</label></div>
                        <div class='col-md-6'>
                            <input type='date' class='form-control' name='enquiry_date' id='enquiry_date'
                                value="<?php echo date('Y-m-d'); ?>" required>
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


                    <div id="service_div"></div>
                      <!-- //  content  4 -->
                      



                    <!-- //  content  5 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>POA</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='poa' id='poa' required>

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
                                <div class='col-md-4'><input type='date' name='poa_date' id='poa_date'
                                        class='form-control' placeholder="Date" value="<?php echo date('Y-m-d'); ?>"
                                        required></div>
                                <div class='col-md-4'>



                                    <div class="container">
                                        <div class="form-group">
                                            <div class="input-group date" id="datetimepicker"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker" value="11:00" name="poa_time"/>
                                                <div class="input-group-append" data-target="#datetimepicker"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>



                                <div class='col-md-4'><input type='text' name='poa_remarks' id='poa_remarks'
                                        class='form-control' placeholder="remarks"></div>
                            </div>
                        </div>
                    </div>


                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry Status</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='enquiry_status' id='enquiry_status'
                                onclick='enquiry_management_status()' style='width:100%' required></select>
                        </div>
                    </div>



                    <div class='form-group row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                            <div id="disable_button">
                                <button type='button' id='submit_button'
                                    class='btn btn-danger btn-block disabled'>submit</button>

                            </div>
                            <div id="active_button">
                                <button type='submit' id='submit_button' class='btn btn-primary btn-block'
                                    onclick='return confirm("Are you sure ?")'>submit</button>
                            </div>

                        </div>
                    </div>



                </form>
            </div>
            <br>
            <div id='menu1' class='tab-pane in active'>
                <table class='table table-striped table-sm' id='example'>
                    <thead>
                        <th>#</th>
                        <th>For</th>
                        <th>Enquiry Date</th>
                        <th>Source</th>
                        <th>Customer</th>
                        <th>Enquiry For</th>
                        <th>Task</th>
                        <th>POA</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </thead>

                    <tbody id="t_body">
                        <!--- // ************************************************************ -->

                    </tbody>
                </table>
            </div>
            <!--// for tab-content  -->
        </div>
        <!--// container-fluid -->

        <!-- The Modal -->
        <div class='modal' id='myModal'>

            <div class='modal-dialog modal-lg'>

                <div class='modal-content'>

                    <!-- Modal Header -->

                    <div class='modal-header'>

                        <h4 class='modal-title'>Enquiry_management Edit</h4>

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
    function openModel(id, source, customer_name, customer_mobile, customer_mail, enquiry, status) {
        $('#id_E').val(id);
        $('#source_E').val(source);
        $('#customer_name_E').val(customer_name);
        $('#customer_mobile_E').val(customer_mobile);
        $('#customer_mail_E').val(customer_mail);
        $('#Enquiry_E').val(enquiry);
        // $('#POA_E').val(POA);
    }
    $(document).ready(function() {


        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "../controllers/enquiry_management_call_tableNew.php",
                "type": "POST"
            },
            "columns": [{
                    "title": "#",
                    "render": function(data, type, row, meta) {
                        // Correct calculation for row number in server-side processing
                        return meta.row + 1 + meta.settings._iDisplayStart;
                    }
                },
                {
                    "data": "for"
                },
                {
                    "data": "enquiry_date"
                },
                {
                    "data": "source_type"
                },
                {
                    "data": "customer_details"
                },
                {
                    "data": "enquiry"
                },
                {
                    "data": "poa"
                },
                {
                    "data": "view"
                },
                {
                    "data": "enquiry_status"
                },
                {
                    "data": "created_by"
                },
                {
                    "data": "row_created_on"
                },
                {
                    "data": "action"
                }
            ]
        });

        enquiry_management_status();
        $("#enquiry_status").select2();
        $("#disable_button").hide();
        // enquiry_management();
    });


    function enquiry_management_status() {
        $.ajax({
            url: "../../sadmin/controllers/ajax/enquiry_management_status_ajax.php",
            type: "POST",
            data: {
                show_data: "show_data"
            },
            success: function(res) {

                $("#enquiry_status").empty();
                $("#enquiry_status").append(res);
                $("#enquiry_status").select2();

                // console.log(res);
            }
        });
    }






    function enquiry_management() {

        $.ajax({
            type: 'POST',
            data: {
                task_no: 1
            },
            url: '../controllers/enquiry_management_call_table_new.php', // The PHP script URL
            dataType: 'json', // Expect JSON response
            success: function(data) {
                // alert(data);
                // console.log(data);
                // $('#t_body').empty();
                // // Loop through each item in the data array
                $.each(data, function(key, value) {
                    $('#t_body').append(value);
                })
            }
        })
    }







    function GetMobile_no(mobile_no) {
        if (mobile_no.length == 10) {
            $.ajax({
                type: "POST",
                data: {
                    name: mobile_no,
                    table_name: 'enquiry_management',
                    table_col_name: 'customer_mobile'
                },
                url: "../../sadmin/controllers/ajax/ajax_check_duplicate.php",
                success: function(data) {
                    // alert(data);
                    if (data == 1) {

                        swal({
                            type: "error",
                            title: "Enquiry Management",
                            text: "You Can't Proceed ,this 'Mobile NO' is already Exist!",
                            icon: "error",
                            button: "ok!",
                        });

                        $("#customer_mobile").css('border-color', 'red');

                        $("#email_error").remove();
                        $("#customer_mobile").after(
                            "<span id='email_error' class='text-danger'>This Contact no. is already Exist</span>"
                            );

                        $("#disable_button").show();
                        $("#active_button").hide();


                    }
                    if (data == 0) {
                        $("#email_error").remove();
                        $("#customer_mobile").css('border-color', '');

                        $("#active_button").show();
                        $("#disable_button").hide();
                    }
                }
            });


        } else {


            $("#customer_mobile").css('border-color', 'red');
            $("#email_error").remove();
            $("#customer_mobile").after("<span id='email_error' class='text-danger'>Enter 10 Digit Mobile No.</span>");
            $("#disable_button").show();
            $("#active_button").hide();

        }
    }


    function change_source(source_id, store_id) {
    var sale_or_service = $('input[name="sale_or_service"]:checked').val();
     alert(sale_or_service);
        $.ajax({
            url: "../controllers/ajax/ajax_source_for_enquiry_management.php",
            type: "POST",
            data: {
                source_id: source_id,
                store_id: store_id,
                sale_or_service:sale_or_service
            },
            success: function(res) {

                $("#source_div").empty();
                $("#source_div").append(res);


                console.log(res);
            }
        });
    }


    function call_for_service(val){
        // console.log(val);

        var service_div="<div class='form-group row'><div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Product Details</label></div><div class='col-md-2'><input type='text'  id='mtm' name='mtm' class='form-control' placeholder='MTM'></div><div class='col-md-2'><input type='text'  id='serial_no' name='serial_no' class='form-control'  placeholder='Serial No'></div><div class='col-md-2'><select  id='warrenty_status' name='warrenty_status' class='form-control' width='100%'><option>Out Of Warrenty</option><option>Full Warrenty</option><option>Labor Only</option><option>Parts Only</option> </select></div></div>";
        if(val==2){
            $("#service_div").empty();
            $("#service_div").append(service_div);
        }else{
            $("#service_div").empty();
        }

    }
    </script>

</html>