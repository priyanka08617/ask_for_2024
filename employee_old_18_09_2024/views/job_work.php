<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Job Work Details</title>
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

    /* thead{
    background: #2A4747;
  } */

    thead tr td {
        text-align: center;
    }
    </style>


    <script>
    $(document).ready(function() {
        $('#item_btn').attr('disabled', true);


        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="" placeholder="Search" />');
        });
        // DataTable
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
        // Apply the search
        table.columns().every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });






    });
    </script>
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Job Work </h3><small class='text-muted'>Fill in the given below tab to create Job Work and manage existing
            data</small>
        <hr></hr>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>
                <a class='nav-link' data-toggle='tab' href='#home'>Job Work Creation</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Job Work</a>
            </li>
        </ul>




        <br>
        <!-- <br> -->


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='../controllers/job_work_add.php' method='post'>

                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Job Work</label></div>
                        <div class='col-md-6'>


                            <div class="input-group ">

                                <!-- <input type='text' class='form-control' onkeyup="check_duplicate();"
    placeholder='Enter name' name='name' required id='name'> -->
                                <input type='text' class='form-control' placeholder='Enter Item' name='item' id='item'
                                    onkeyup="check_duplicate();">

                                <div class="input-group-append">
                                    <span class="input-group-text" id="username_check_response"></span>
                                </div>

                            </div>




                            <script>
                            function check_duplicate() {
                                var name = $("#item").val();
                                var table_name = "job_work";
                                var table_col_name = "item";

                                $('#item_btn').attr('disabled', true);

                                $.ajax({
                                    data: {
                                        name: name,
                                        table_name: table_name,
                                        table_col_name: table_col_name,
                                    },
                                    type: "GET",
                                    url: "../controllers/ajax/ajax_check_duplicate.php",
                                    success: function(data) {

                                        console.log(data);

                                        if (data == 1) {
                                            $('#username_check_response').html(
                                                "<span style='color:green;'>* Name Available<span>");


                                            $('#item_btn').attr('disabled', false);

                                        } else {
                                            $('#username_check_response').html(
                                                "<span style='color:red;'>* Name not Available<span>");


                                        }

                                    }
                                });


                            }
                            </script>

                        </div>
                    </div>

                    <!-- //  content  2 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>UoM</label></div>
                        <div class='col-md-6'>

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

                    <!-- //  content  3 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Alias</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter Alias' name='part_no'
                                id='part_no'>
                        </div>
                    </div>

                    <!-- //  content  4 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Hsn Code</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='hsn_table_id' id='hsn_table_id'>
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

                    <!-- //  content  5 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Hsn Rate</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='hsn_rate_id' id='hsn_rate_id'>
                                <option value=''>select</option>
                                <?php
 
                      $sql='SELECT * FROM hsn_rate_master WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['rate'].'</option>';
                      }
            ?>
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                            <div class='d-grid'>
                                <button type='submit' id="item_btn"
                                    class='btn btn-primary btn-block btn-sm'>Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <br> -->
            <div id='menu1' class='tab-pane in active'>
                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Job Work</th>
                        <th>Uom</th>
                        <th>Alias</th>
                        <th>Hsn Code</th>
                        <th>Hsn Rate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>


                    <tfoot>
                        <th>#</th>
                        <th>Job Work</th>
                        <th>Uom</th>
                        <th>Alias</th>
                        <th>Hsn Code</th>
                        <th>Hsn Rate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tfoot>

                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM job_work WHERE status="1" order by id desc';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$item=$row['item'];
$uom_id=$row['uom_id'];
$uom=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
$part_no=$row['part_no'];
$hsn_table_id=$row['hsn_table_id'];
$hsn_code=singleRowFromTable($conn, "SELECT * FROM hsn_table WHERE id='$hsn_table_id'", "code");
$hsn_rate_id=$row['hsn_rate_id'];
$hsn_rate=singleRowFromTable($conn, "SELECT * FROM hsn_rate_master  WHERE id='$hsn_rate_id'", "rate");
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $row['item'].'</td>';
 echo '<td>'. $uom.'</td>';
 echo '<td>'. $row['part_no'].'</td>';
 echo '<td>'. $hsn_code.'</td>';
 echo '<td>'. $hsn_rate.'%</td>';
$c++
;$edit_modal_params_string="'$id','$item','$uom_id','$part_no','$hsn_table_id','$hsn_rate_id','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/job_work_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
 echo '</tr>';
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

                        <h4 class='modal-title'>JOB WORK Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/job_work_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Job Work</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Job Work' name='item_E'
                                        id='item_E'>
                                </div>
                            </div>

                            <!-- //  content  2 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>UoM</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='uom_id_E' id='uom_id_E' style='width:100%'>
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

                            <!-- //  content  3 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Alias</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Alias' name='part_no_E'
                                        id='part_no_E'>
                                </div>
                            </div>

                            <!-- //  content  4 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Hsn Code</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='hsn_table_id_E' id='hsn_table_id_E'>
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

                            <!-- //  content  5 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Hsn Rate</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='hsn_rate_id_E' id='hsn_rate_id_E'>
                                        <option value=''>select</option>
                                        <?php
 
 $sql='SELECT * FROM hsn_rate_master WHERE status="1"';
 $result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){
   $id=$row['id'];
   echo '<option value="'.$id.'">'.$row['rate'].'</option>';
 }
            ?>
                                    </select>
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
    function openModel(id, item, uom_id, part_no, hsn_table_id, hsn_rate_id, status) {
        $('#id_E').val(id);
        $('#item_E').val(item);
        $('#uom_id_E').val(uom_id);
        $('#part_no_E').val(part_no);
        $('#hsn_table_id_E').val(hsn_table_id);
        $('#hsn_rate_id_E').val(hsn_rate_id);
        $("#uom_id_E").select2();
    }

    $("#uom_id").select2();
   
    </script>