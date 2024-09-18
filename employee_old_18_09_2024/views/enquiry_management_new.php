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

                <a class='nav-link active' data-toggle='tab' href='#home'>Enquiry Management Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link ' data-toggle='tab' href='#menu1'>Existing Enquiry Management</a>
            </li>
        </ul>


        <!-- ../controllers/enquiry_management_add.php -->
        <div class='tab-content'>
            <div id='home' class='tab-pane in active'>
                <form class='form-horizontal' action='' method='post' id='add_enquiry_management_form'>
                    <BR>

                    <input type='hidden' name='user_category_id' id='user_category_id'
                        value='<?php echo $user_category_id;?>'>

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


                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>For</label></div>
                        <div class='col-md-3'>

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

                        <div class='col-md-3'>
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


                   



                   
                  



                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry Date</label></div>
                        <div class='col-md-3'>
                            <input type='date' class='form-control' name='enquiry_date' id='enquiry_date'
                                value="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class='col-md-3'>
                        <input type='number'  id="mobileNo" name="mobileNo" style="width:100%"  class="form-control" onkeyup="contact_no_check(this.value)" placeholder="Customer mobile no" required>
                        <small id="customer_div" class="text-success"></small>

                        </div>
                        <div class="col-md-2"><span><img src='../img/add.png' width='20px' height='20px'
                                                data-toggle="modal" data-target="#add_new_customer"></span></div>

                    </div>



                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Customer Name.</label></div>
                        <div class='col-md-3'>
                            <input type='text' class='form-control' name='client_name' id='client_name' placeholder='enter name'>
                        </div>

                        <div class='col-md-3'>
                        <input type="email" id="email" name="email" style="width:100%"  class="form-control" placeholder='enter email'>

                        </div>

                    </div>



                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry Category</label></div>
                        <div class='col-md-3'>

                            <select class='form-control' name='enquiry_category' id='enquiry_category' onchange='call_sadmin_dp(this.value)'  required></select>

                        </div>

                        <div class='col-md-3'>
                        <select class='form-control' name='enquiry_product[]' id='enquiry_product' multiple  required></select>
                        <span id='enquiry_product_result_span'></span>
                            </div>
                            <div class='col-md-1'><img src='../../sadmin/img/add.png' width='20px' data-toggle='modal' data-target='#dp_creation'></div>
                    </div>

                 


                    <!-- //  content  4 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry Detail</label></div>
                        <div class='col-md-6'>
                            <textarea id='enquiry' name='enquiry' rows='2' style='width:100%' required></textarea>
                        </div>
                    </div>


                    <div id="service_div"></div>
                      <!-- //  content  4 -->
                      



               

                    <!-- //  content  5 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>POA Creation</label></div>
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
                        <div class='col-md-2'><label class='control-label' for='uom'>POA By</label></div>

                        <div class='col-md-3'>

<select class='form-control' name='poa' id='poa' required>
    <option value='Call'>Call</option>
    <option value='Visit'>Visit</option>
    <option value='Massage'>Mail/Massage</option>
</select>
</div>


                        <div class='col-md-3'>
                        <!-- onclick='enquiry_management_status()' -->
                            <select class='form-control' name='enquiry_status' id='enquiry_status'
                                style='width:100%' required>
                            <option value='1'>Open</option>
                            <option value='2'>Close</option>
                            </select>
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
                                <button type='submit' id='submit_button' class='btn btn-primary btn-block btn-sm'
                                    onclick='return confirm("Are you sure ?")'>submit</button>
                            </div>

                        </div>
                    </div>



                </form>
            </div>

        
            <div id='menu1' class='tab-pane in fade'>
                <table class='table table-striped table-sm' id='example' width='100%'>
                    <thead>
                        <th>#</th>
                        <th>For</th>
                        <th>Enquiry Date</th>
                        <th>Source</th>
                        <th>Customer</th>
                        <th>Enquiry Category</th>
                        <th>Enquiry Product</th>
                        <th>Enquiry Detail</th>
                        <th>Timeline</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <!-- <th>Created On</th>
                        <th>Action</th> -->
                    </thead>
                    <tbody id="t_body"></tbody>
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




<!-- ADD PROBLEM  -->
<div class="modal" id="service_problem_creation" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Service Issue Creation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class='service_issu_add_form'>
      <div class="modal-body">

   
      <input type='hidden' class='form-control' name='form_subcategory_id_for_service_problem_x' id='form_subcategory_id_for_service_problem_x' value='2'>


<!-- //  content  3 -->
<div class='row mt-3'>
    <div class='col-md-4'>
        <label for='comment'>Issue</label>
    </div>
    <div class='col-md-8'>
        <input type='text' class='form-control' placeholder='Create New Issue'
            name='issue_x' id='issue_x'>
    </div>
</div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="add_issue_for_service()">Add Issue</button>
      </div>
                            </form>
    </div>
  </div>
</div>





<!-- ADD PROBLEM  -->
<div class="modal" id="dp_creation" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Product Creation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id='dp_add_form'>
      <div class="modal-body">


      <!-- //  content  1 -->
      <div class='row'>
                        <div class='col-md-6'>
                            <div class='form-group row'>
                                <div class='col-md-4'><label class='control-label' for='uom'>Category</label></div>
                                <div class='col-md-8'>

<select class='form-control' name='cat_id' id='cat_id' style='width:100%' onchange='getSubcategory(this.value)' required></select>
                                </div>

                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='row'>
                                <div class='col-md-4'><label class='control-label' for='uom'>Subcategory</label></div>
                                <div class='col-md-8'>

                                    <select class='form-control' name='sub_cat_id' id='sub_cat_id' style='width:100%' required>
                                        <option value=''>select</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div class='row'>
                        <div class='col-md-6'>


                        <div class='form-group row'>
                        <div class='col-md-4'><label class='control-label text-danger' for='uom'>MTM *</label></div>
                        <div class='col-md-8'>

                                <input type='text' class='form-control' placeholder='Enter Item' name='item' id='item'
                                    onkeyup="check_duplicate();" required>
                                    <span  id="dp_creation_add"></span>
                        

                                    
                        </div></div>


                    </div>




                    <div class='col-md-6'>
                    <div class='form-group row'>
                        <div class='col-md-4'><label class='control-label' for='uom'>Short Code</label></div>
                        <div class='col-md-8'>
                            <input type='text' class='form-control' placeholder='Enter Short Code' name='short_code'
                                id='short_code'>
                        </div>
                    </div>
                    </div>
                    </div>


                    <div class='form-group row'>
                    
                    <div class='col-md-6'>
                    <div class='form-group row'>
                        <div class='col-md-4'><label class='control-label text-danger' for='uom'>Name *</label></div>
                        <div class='col-md-8'>
                            <input type='text' class='form-control' placeholder='Enter  Name' name='name'
                                id='name' required>
                        </div>
                    </div>
                    </div>


                    <div class='col-md-6'>
                    <div class='form-group row'>
                        <div class='col-md-4'><label class='control-label' for='uom'>SKU</label></div>
                        <div class='col-md-8'>
                            <input type='text' class='form-control' placeholder='Enter SKU' name='sku'
                                id='sku'>
                        </div>
                    </div>
                    </div>
                    </div>






                            <script>
                            function check_duplicate() {
                                var name = $("#item").val();
                                var table_name = "dp";
                                var table_col_name = "mtm";
                                
                                if (name.length > 0) {
      $('#item_btn').prop('disabled', false); // Enable button if input is not empty
  
                               

                                $.ajax({
                                    data: {
                                        name: name,
                                        table_name: table_name,
                                        table_col_name: table_col_name,
                                    },
                                    type: "POST",
                                    url: "../../sadmin/controllers/ajax/ajax_check_duplicate.php",
                                    success: function(data) {
                                        console.log(data);

                                        if(data == 1){
                                            $('#username_check_response').html(
                                                "<span style='color:red;'>* This data is already added<span>");
                                                $('#item_btn').attr('disabled', true);
                                        }else{
                                            $('#item_btn').attr('disabled', false);
                                            $('#username_check_response').empty();
                                        }

                                        

                                    }
                                });

                            } else {
      $('#item_btn').prop('disabled', true); // Disable button if input is empty
    }
                            }
                            </script>

                      



<div class='form-group row'>
<div class='col-md-6'>
                   <div class=' row'>
                        <div class='col-md-4'><label class='control-label' for='uom'>UoM</label></div>
                        <div class='col-md-8'>

                            <select class='form-control' name='uom_id' id='uom_id' style='width:100%'>
                                <option value=''>select</option>
                                <?php
 
                                        $sql='SELECT * FROM uom WHERE status="1"';
                                        $result=mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_array($result)){
                                            $id=$row['id'];
                                            echo '<option value="'.$id.'">'.$row['uom_name'].'</option>';
                                        }
                                ?>
                            </select>
                        </div>
                    </div>
</div>
<div class='col-md-6'>


            <div class='row'>
                                    
                                    <div class='col-md-4'><label class='control-label' for='uom'>Hsn Code</label></div>
                                    <div class='col-md-8'>

                                        <select class='form-control' name='hsn_table_id' id='hsn_table_id' style='width:100%'>
                                            <option value=''>select</option>
                                            <?php
            
                                $sql='SELECT * FROM hsn_table WHERE status="1"';
                                $result=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['id'];
                                    echo '<option value="'.$id.'">'.$row['code'].'</option>';
                                }
                        ?>
                                        </select>
                                    </div>
            </div>

</div>
</div>






<div class='form-group row'>
<div class='col-md-6'>
                   <div class='row'>
                        <div class='col-md-4'><label class='control-label' for='uom'>Barcode</label></div>
                        <div class='col-md-8'>

                            <input type='text' class='form-control' name='barcode' id='barcode' placeholder="Enter Barcode">
                              
                        </div>
                    </div>
</div>
<div class='col-md-6'>


            <div class='row'>
                                    
                                    <div class='col-md-4'><label class='control-label' for='uom'>Alias</label></div>
                                    <div class='col-md-8'>

                                        <input type='text' class='form-control' name='alias' id='alias' placeholder="Enter Alias">
                                          
                                    </div>
            </div>

</div>
</div>







      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="item_btn">Add Product</button>
      </div>
                            </form>
    </div>
  </div>
</div>




 <!-- The Modal -->
 <div class='modal' id='add_new_customer'>

<div class='modal-dialog modal-xl'>

    <div class='modal-content'>

        <!-- Modal Header -->

        <div class='modal-header'>

            <h4 class='modal-title'><b>Add New Customer || </b> <img src='../../sadmin/img/icon/customer.png'
                    width='60px' height='60px'></h4>

            <button type='button' class='close' data-dismiss='modal'>&times;</button>
        </div>

        <!-- Modal body enctype="multipart/form-data"-->

        <div class='modal-body'>

            <form class="form-horizontal new_customer_add_form" action="" method="post">
                <!-- <center> -->

                <div class="form-group row">

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:600px">

                            <input type="radio" id="html" name="customer_type" value="2">&nbsp &nbsp
                            <label for="css">Business</label>&nbsp &nbsp
                            <input type="radio" id="css" name="customer_type" value="1" checked>&nbsp &nbsp
                            <label for="css">Indivisual</label><br>

                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">


                            <span class="input-group-text text-danger">Mobile *</span>
                            <input type="number" class="form-control" placeholder="enter your contact no "
                                id="phone" name="phone" onkeyup='GetMobile_no(this.value)'
                                onclick='GetMobile_no(this.value)' required>



                            
                        </div>
                        <span id="mobile_error" class="text-danger"></span>

                    </div>


                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Attention</span>
                            <input type="text" class="form-control" placeholder="" id="attention"
                                name="attention">
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" placeholder="enter your name " id="name"
                                name="name">
                        </div>



                    </div>

                    <div class="col-md-6">

                        <div class="input-group mb-3" style="width:500px">



                            <select class="form-control" name="state_id" id="state_id" style="width:100%">
                                <option value="">select state</option>
                                <?php
    $sql="SELECT * FROM `states` WHERE `status`='1'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){
        ?>
      echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
      <option value="<?= $row['id'] ?>" <?= $row['id'] == 28 ? 'selected' : '' ?>><?php echo $row["name"]; ?></option>
      <?php
    }
    ?>
                            </select>


                        </div>






                    </div>
                </div>



                <div class="row">

                    <div class="col-md-6">

                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Email</span>
                            <input type="email" class="form-control" placeholder="enter your mail address"
                                id="email" name="email">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">City</span>
                            <input type="text" class="form-control" placeholder="enter your city " id="city"
                                name="city">
                        </div>

                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Display Name</span>
                            <input type="text" class="form-control" placeholder="enter your display name"
                                id="display_name" name="display_name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">Zip Code</span>
                            <input type="text" class="form-control" placeholder="zip code" id="zip_code"
                                name="zip_code">

                        </div>

                    </div>
                </div>





                <div class="row">

                    <div class="col-md-6">

                        <div class="input-group mb-3" style="width:500px">
                            <span class="input-group-text">GST</span>
                            <input type="text" class="form-control" placeholder="Enter gst (if)" id="gst"
                                name="gst">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:500px">


                            <span class="input-group-text">Address</span>
                            <textarea type="text" class="form-control"
                                placeholder=" enter your full address" id="address"
                                name="address"></textarea>



                        </div>
                    </div>

                </div>

                <!-- <div class="input-group mb-3" style="width:1070px">
        <button type="submit" class="btn btn-primary btn-block">+ Add </button>
    </div> -->

                <!-- <div id="disable_button">
                    <button type='button' id='submit_button' class='btn btn-danger btn-block disabled'>+
                        Add</button>
                </div>
                <div id="active_button"> -->
                    <button type='submit' id='submit_button_of_new_customer' class='btn btn-primary btn-block btn-sm'>+ Add</button>
                <!-- </div> -->

                <!-- </center> -->


            </form>


        </div>
        <!-- Modal footer -->
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
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
     
    }



    $(document).ready(function() {

        call_sadmin_customer_details();
        call_sadmin_dp_category();
        call_sadmin_dp(1);
        getSubcategory(1);


$("#cat_id").select2();
$("#uom_id").select2();

$("#hsn_table_id").select2();
$("#customer_id").select2();
$("#state_id").select2()
$('#item_btn').prop('disabled', true);
$('#submit_button_of_new_customer').attr('disabled', true);

// $('#example').DataTable({
//             "processing": true, // Show the processing indicator
//             "serverSide": true,  // Enable server-side processing
//             "ajax": {
//                 "url": "../controllers/enquiry_management_new_view.php", // PHP script URL
//                 "type": "GET"
//             },
//             "columns": [
//                 { "data": "enquiry_id" },
//                 { "data": "enquiry_for" },
//                 { "data": "source_type" },
//                 { "data": "source" },
//                 { "data": "customer_name" },
//                 { "data": "customer_mobile" },
//                 { "data": "branch_name" },
//                 { "data": "enquiry_date" },
//                 { "data": "enquiry_detail" },
//                 { 
//                     "data": null, 
//                     "render": function ( data, type, row ) {
//                         return row.user_category_first_name + ' ' + row.user_category_middle_name + ' ' + row.user_category_last_name;
//                     }
//                 },
//                 { "data": "enquiry_status" }
//             ],
//             "pageLength": 10, // Number of records per page
//             "lengthMenu": [10, 25, 50, 100], // Page length options
//             "order": [[0, 'desc']] // Initial sorting (by ID descending)
//         });


        $('#example_aa').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                // "url": "../controllers/enquiry_management_call_tableNew.php",
                // "url": "../controllers/enquiry_management_table_final_call.php",
                // "url": "../controllers/enq_tab.php",
                  "url": "../controllers/e.php",
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
                    "data": "product_category"
                },
                {
                    "data": "enquiry_product"
                },
                {
                    "data": "enquiry_detail"
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
     

        $("#enquiry_status").select2();
        $("#disable_button").hide();

    });








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









//     function enquiry_managment_fetch_product_category() {
//         $('#enquiry_category').empty();
//         $('#enquiry_product').empty();
// $.ajax({
//     type: 'POST',
//     data: {
//         enquiry_managment_task_no: 1
//     },
//     url: '../controllers/ajax/enquiry_management_call_table_new.php', // The PHP script URL
//     dataType: 'json', 
//     success: function(data) {
//         console.log(data.category);
//         $.each(data.category, function(key, value) {
//             $('#enquiry_category').append(value);
//         })
//         $('#enquiry_product').append("<option value=''>Select</option>");
//         $.each(data.dp_roduct, function(key, value) {
//             $('#enquiry_product').append(value);
//         })

//     }
// })
// }








function call_for_service(val){

if(val==2){


    $("#service_div").empty();
var service_div="<div class='form-group row'><div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Problem</label></div><div class='col-md-3'><select class='form-control' id='problem_id' name='problem_id' width='100%' multiple></select><span id='service_issue_add'></span></div><div class='col-md-1'><img src='../../sadmin/img/add.png' width='20px' data-toggle='modal' data-target='#service_problem_creation'></div><div class='col-md-2'><select  id='warrenty_status' name='warrenty_status' class='form-control' width='100%'><option>Out Of Warrenty</option><option>Full Warrenty</option><option>Labor Only</option><option>Parts Only</option> </select></div></div>";


$.ajax({
type: 'POST',
data: {
enquiry_managment_task_no: 2
},
url: '../controllers/ajax/enquiry_management_call_table_new.php', // The PHP script URL
dataType: 'json', 
success: function(data) {
// console.log(data);
$('#problem_id').empty();
$('#problem_id').append("<option value=''>Select</option>");

$.each(data, function(key, value) {
    $('#problem_id').append(value);
   
})

}
})


    $("#service_div").append(service_div);
    $('#problem_id').select2();

}else{
    $("#service_div").empty();
}

}



$('#service_problem_creation').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting through the browser


var issue_x =$("#issue_x").val();
var form_subcategory_id_for_service_problem_x = $("#form_subcategory_id_for_service_problem_x").val();

        $.ajax({
            type: "POST",
            url: '../controllers/ajax/enquiry_management_call_table_new.php',
            data: {
                issue_x:issue_x,
                form_subcategory_id_for_service_problem_x:form_subcategory_id_for_service_problem_x,
                enquiry_managment_task_no: 3
                

               },
            success: function(response) {
                var newItem = JSON.parse(response);
                $("#service_problem_creation").modal("hide");
if(newItem.status==1){

                $('#problem_id').append($('<option value="'+newItem.id+'" selected>'+newItem.name+'</option>', {
                }));
                $('#service_issue_add').html('<small class="text-success">Item added successfully: </small>' + newItem.name);

                                // Reset the form to clear all input fields
                             $('#issue_x').val('');
                            
            }else{
                $('#service_issue_add').html('<small class="text-danger">This Data is Already Added :</small> '+ newItem.name);
            }

            },
            error: function() {
                $('#service_issue_add').html('<span class="text-danger">There was an error processing your request. </span>');
            }
            
        });


})

function getSubcategory(cat_id) {
        $.ajax({
            type: 'POST',
            data: {
                cat_id: cat_id
            },
            url: "../../sadmin/controllers/ajax/ajax_fetch_subcategory.php",
            success: function(result) {
                // alert(result);
                $("#sub_cat_id").empty();
                $("#sub_cat_id").append(result);
                $("#sub_cat_id").select2();
                // alert(result);
            }
        });
    }




    
$('#dp_add_form').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting through the browser

    var cat_id_x = $("#cat_id").val();
    var sub_cat_id_x = $("#sub_cat_id").val();
    var item_x = $("#item").val();
    var name=$("#name").val();
    var sku=$("#sku").val();
    var uom_id_x = $("#uom_id").val();
    var short_code_x=$("#short_code").val();
    var hsn_table_id_x=$("#hsn_table_id").val();
    var barcode_x=$("#barcode").val();
    var alias_x=$("#alias").val();

        $.ajax({
            type: "POST",
            url: '../controllers/ajax/enquiry_management_call_table_new.php',
            data:{
                enquiry_managment_task_no: 4,
                cat_id : cat_id_x,
sub_cat_id : sub_cat_id_x,
item : item_x,
name : name,
sku : sku,
uom_id : uom_id_x,
short_code : short_code_x,
hsn_table_id : hsn_table_id_x,
barcode : barcode_x,
alias : alias_x
            },

            success: function(response) {
                var newItem = JSON.parse(response);

                // console.log(response);
                $("#dp_creation").modal("hide");

                document.getElementById('dp_add_form').reset();         
if(newItem.status==1){

                $('#enquiry_product').append($('<option value="'+newItem.id+'" selected>'+newItem.name+'</option>', {
                }));
                $('#enquiry_product_result_span').html('<small class="text-success">Item added successfully: </small>' + newItem.name);

                                // Reset the form to clear all input fields
                         
            }else{
                $('#enquiry_product_result_span').html('<small class="text-danger">This Data is Already Added :</small> '+ newItem.name);
            }

            },
            error: function() {
                $('#enquiry_product_result_span').html('<span class="text-danger">There was an error processing your request. </span>');
            }
            
        });


})










    $('.new_customer_add_form').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting through the browser

 
  var form=  $('.new_customer_add_form').serialize();

    $.ajax({
       type: "POST",
       data: form,
       url: "../../sadmin/controllers/customer_cont.php",
     
        success: function(res) {
        
            $('#add_new_customer').modal('hide');
            $('.new_customer_add_form').trigger("reset");
            $("#customer_id").append(res);
            $("#customer_div").empty();
            $("#customer_div").append("This data is added successfully : ");


        }
    });
});






function GetMobile_no(phone_no) {
    if ((phone_no.length) == 10) {
        $.ajax({
            type: "POST",
            data: {
                name: phone_no,
                table_name: 'customer_details',
                table_col_name: 'mobile'

            },
            url: "../../sadmin/controllers/ajax/ajax_check_duplicate.php",
            success: function(data) {
          
                if (data == 1) {


                    $("#phone").css('border-color', 'red');
                    $("#mobile_error").empty();
                    $("#mobile_error").append('This Mobile No. is already added');
                    $('#submit_button_of_new_customer').attr('disabled', true);

                    // swal({
                    //     type: "error",
                    //     title: "Customer Details || " + phone_no,
                    //     text: "This mobile no. is already Exist!",
                    //     icon: "error",

                    //     button: "ok!",
                    // });



                }
                if (data == 0) {
                    // $("#mobile_error").remove();
                    $("#phone").css('border-color', '');

                    // $("#active_button").show();
                    // $("#disable_button").hide();
                    $("#mobile_error").empty();
                    $('#submit_button_of_new_customer').attr('disabled', false);
                }
            }
        });
    } else {
        // $("#disable_button").show();
        // $("#active_button").hide();


        $('#submit_button_of_new_customer').attr('disabled', true);
    }



}



$('#add_enquiry_management_form').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting through the browser

 
  var form=  $('#add_enquiry_management_form').serialize();

    $.ajax({
       type: "POST",
       data: form,
       url: "../../sadmin/controllers/enquiry_management_new_add.php",
       
        success: function(res) {

            $('#add_enquiry_management_form')[0].reset(); // Reset form
            $('#source_div').empty();
            $("#enquiry_category").empty();
            $("#enquiry_product").empty();
            $("#customer_id").empty();

 call_sadmin_dp_category();
call_sadmin_dp(1);
call_sadmin_customer_details();



            swal({
                        type: "success",
                        title: "Enquiry Management ",
                        text: "Enquiry Management Added Successful!",
                        icon: "success",

                        button: "ok!",
                    });

        },
        error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error); // Debugging: Log AJAX errors
           

                 swal({
                        type: "error",
                        title: "Enquiry Management ",
                        text: "Enquiry Not Added Successful!",
                        icon: "error",

                        button: "ok!",
                    });

                }


            // }
               
                   
    });
});






////////////////////////////////////// NEW /////////////////////////////////////////




 
function call_sadmin_customer_details() {
        $.ajax({
            type: 'POST',
            data:{
                searchTerm:"customer_details"
            }, 
            url: "../../sadmin/controllers/ajax/ajax_all_data_table_fetch.php",
            success: function(result) {
                var newItem = JSON.parse(result);
                $("#customer_id").empty();
                $("#customer_id").append(newItem.customer_details);
                $("#customer_id").select2();
          
            }
        });
    }



    function call_sadmin_dp_category() {
        $.ajax({
            type: 'POST',
            data:{
                searchTerm:"dp_category"
            }, 
            url: "../../sadmin/controllers/ajax/ajax_all_data_table_fetch.php",
            success: function(response) {

                // alert(response);
               var newItem = JSON.parse(response);
               console.log(newItem.dp_category);
               $("#enquiry_category").empty();
               $("#enquiry_category").append(newItem.dp_category);
               $("#enquiry_category").select2();


               $("#cat_id").empty();
               $("#cat_id").append(newItem.dp_category);
               $("#cat_id").select2();
            
            }
        });
    }



    
    function call_sadmin_dp(dp_category_id) {
        $.ajax({
            type: 'POST',
            data:{
                searchTerm:"dp",
                dp_category_id:dp_category_id
            }, 
            url: "../../sadmin/controllers/ajax/ajax_all_data_table_fetch.php",
            success: function(response) {

                // alert(response);
               var newItem = JSON.parse(response);
            //    console.log(newItem.dp);
               $("#enquiry_product").empty();
               $("#enquiry_product").append(newItem.dp);
               $("#enquiry_product").select2();
               
          
            }
        });
    }







    // Function to check the mobile number when user finishes typing
    $('#mobileNo').on('blur', function() {
        var mobileNo = $('#mobileNo').val(); // Get the mobile number from the input field

        // Validate if the mobile number has exactly 10 digits
        var mobilePattern = /^[0-9]{10}$/;

        if(mobileNo === "") {
            $("#customer_div").text("Please enter a mobile number.");
            return;
        } else if (!mobilePattern.test(mobileNo)) {
            // alert("Please enter a valid 10-digit mobile number.");
            $("#customer_div").text("Please enter a valid 10-digit mobile number.");
            return;
        }

        // AJAX request to check mobile number
        $.ajax({
            url: '../controllers/ajax/ajax_check_mobile.php', // Your backend PHP file to handle the search
            type: 'POST',
            dataType: 'json',
            data: { mobile: mobileNo },
            success: function(response) {
            
                if(response.exists) {
                    // If mobile number exists, show name and email
                    $('#client_name').val(response.name);
                    $('#email').val(response.email);
                    // alert('Data found! Name: ' + response.name + ', Email: ' + response.email);
                    $("#customer_div").text('Data found! Name: ' + response.name + ', Email: ' + response.email);
                } else {
                    // If mobile number doesn't exist, show new data prompt
                    // alert('New Data! This mobile number is not in our database.');
                    $("#customer_div").text('New Data! This mobile number is not in our database.');
                    $('#client_name').val(''); // Clear the fields
                    $('#email').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any error in console
                alert('Something went wrong. Please try again.');
            }
        });
    });


    </script>
</html>


