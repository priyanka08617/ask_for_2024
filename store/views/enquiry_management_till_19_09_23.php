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
                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Source</label></div>
                        <div class='col-md-4'>

                            <select class='form-control' name='source' id='source'  onchange="change_source(this.value,<?php echo $store_id;?>)">
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
                            <input type='text' class='form-control' placeholder='Enter Customer Mobile'
                                name='customer_mobile' id='customer_mobile'>
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

                    <!-- //  content  4 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Enquiry For</label></div>
                        <div class='col-md-6'>
                            <textarea id='enquiry' name='enquiry' rows='4' style='width:100%'></textarea>
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





                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                            <div class='d-grid'>
                                <button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
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
                        <th>Source</th>
                        <th>Customer Name</th>
                        <th>Customer Mobile</th>
                        <th>Customer Email</th>
                        <th>Enquiry</th>
                        <th>POA</th>
                        <!-- <th>Edit</th> -->
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>Source</th>
                        <th>Customer Name</th>
                        <th>Customer Mobile</th>
                        <th>Customer Email</th>
                        <th>Enquiry</th>
                        <th>POA</th>
                        <!-- <th>Edit</th> -->
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
$status=$row['status'];
$source_type=$row['source_type'];
$source_id=$row['source'];
$customer_name=$row['customer_name'];
$customer_mobile=$row['customer_mobile'];
$customer_mail=$row['customer_mail'];
$enquiry=$row['enquiry'];
$poa=singleRowFromTable($conn,"SELECT * FROM `enquiry_management_timeline` WHERE `enquiry_management_id`='$id' ORDER BY `id` DESC", "poa");





if($source_type=="referral"){
    
    $source=singleRowFromTable($conn,"SELECT * FROM `customer_details` WHERE `id`='$source_id'", "display_name");

}elseif($source_type=="walking"){
    $source=singleRowFromTable($conn,"SELECT * FROM `store` WHERE `id`='$source_id'", "store_name");
}else{
    $source=$source_id;
}


 echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'. $source_type ." (".$source.')</td>';
 echo '<td>'. $customer_name.'</td>';
 echo '<td>'. $customer_mobile.'</td>';
 echo '<td>'. $customer_mail.'</td>';
 echo '<td>'. $row['enquiry'].'</td>';
 echo '<td><a href="../views/enquiry_timeline.php?enquiry_id='.$id.'"><button type="button" class="btn btn-warning btn-sm btn-block">'.$poa.'</button></a></td>';
$edit_modal_params_string="'$id','$source','$customer_name','$customer_mobile','$enquiry','$status'";
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

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Source</label>
                                </div>
                                <div class='col-md-8'>


                                    <!-- <select class='form-control' name='source_E' id='source_E'>
                                        <option value=''>select</option>
                                        <?php
 
                    //   $sql='SELECT * FROM source WHERE status="1"';
                    //   $result=mysqli_query($conn,$sql);
                    //   while($row=mysqli_fetch_array($result)){
                    //     $id=$row['id'];
                    //     echo '<option value="'.$id.'">'.$row['value'].'</option>';
                    //   }
            ?>
                                    </select> -->
                                </div>
                            </div>

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

                            <!-- //  content  4 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Enquiry</label>
                                </div>
                                <div class='col-md-8'>
                                    <textarea id='Enquiry_E' name='Enquiry_E' rows='4' style='width:100%'></textarea>
                                </div>
                            </div>

                            <!-- //  content  5 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>POA</label>
                                </div>
                                <div class='col-md-8'>


                                    <!-- <select class='form-control' name='POA_E' id='POA_E'>
                                        <option value=''>select</option>
                                        <?php
 
                    //   $sql='SELECT * FROM POA WHERE status="1"';
                    //   $result=mysqli_query($conn,$sql);
                    //   while($row=mysqli_fetch_array($result)){
                    //     $id=$row['id'];
                    //     echo '<option value="'.$id.'">'.$row['value'].'</option>';
                    //   }
            ?>
                                    </select> -->
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
    function openModel(id, source, customer_name, customer_mobile, enquiry, status) {
        $('#id_E').val(id);
        $('#source_E').val(source);
        $('#customer_name_E').val(customer_name);
        $('#customer_mobile_E').val(customer_mobile);
        $('#Enquiry_E').val(enquiry);
        // $('#POA_E').val(POA);
    }

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


    

    function change_source(source_id,store_id) {
        // alert(source_id);
        $.ajax({
            url: "../controllers/ajax/ajax_source_for_enquiry_management.php",
            type: "POST",
            data: {
                source_id: source_id,
                store_id: store_id
            },
            success: function(res) {
            
                $("#source_div").empty();
                $("#source_div").append(res);


                console.log(res);
            }
        });
    }



    </script>
      <!-- </html> -->