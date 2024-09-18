<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Hsn Details</title>
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
        <h3> Hsn Table</h3>
        <small class='text-muted'>Fill in the given below tab to create Hsn and manage existing data</small>
        <hr>
        </hr>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>

                <a class='nav-link' data-toggle='tab' href='#home'>Hsn Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Hsn</a>
            </li>
        </ul>






        <br><br>


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='../controllers/hsn_add.php' method='post'>

                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Type</label></div>
                        <div class='col-md-6'>

                            <select name="type" id="type" class="form-control">
                                <option value=" ">Select</option>
                                <option value='1'>HSN</option>
                                <option value='2'>SAC</option>
                            </select>

                        </div>
                    </div>

                    <!-- //  content  2 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Code</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter Code' name='code' id='code'>
                        </div>
                    </div>

                    <!-- //  content  3 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Description</label></div>
                        <div class='col-md-6'>
                            <textarea id='description' name='description' rows='4' style='width:100%'></textarea>
                        </div>
                    </div>

                    <!-- //  content  4 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Rate</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='rate' id='rate'>
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


                    <div class='form-group row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                                <button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
                            
                        </div>
                    </div>



                </form>
            </div>
            <div id='menu1' class='tab-pane in active'>
                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Type</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Rate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>Type</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Rate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM hsn_table WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){


  $id=$row['id'];
 $status=$row['status'];              
$type_id=$row['type'];


if($type_id==1){
$type="HSN";
}elseif($type_id==2){
  $type="SAC";
}



$code=$row['code'];
$description=$row['description'];
$rate_id=$row['rate'];

// echo $rate_id;

echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'. $type.'</td>';
 echo '<td>'. $row['code'].'</td>';
 echo '<td>'. $row['description'].'</td>';
 echo '<td>'.singleRowFromTable($conn, "SELECT * FROM hsn_rate_master WHERE id='$rate_id'", "rate").'</td>';

 $c++;

$edit_modal_params_string="'$id','$type_id','$code','$description','$rate_id','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"></td>';
echo '<td><a href="../controllers/hsn_del.php?id='.$id.'"><img src="../img/delete.png" width="30px" onclick="return confirm(\'Are you Sure , you want to remove ?\')"></a></td>';
echo '</tr>';

}
 ?>
                    </tbody>
                </table>
            </div>
        </div>
        



        <div class='modal' id='myModal'>

            <div class='modal-dialog modal-lg'>

                <div class='modal-content'>

                    <!-- Modal Header -->

                    <div class='modal-header'>

                        <h4 class='modal-title'>Hsn Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/hsn_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Type</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='type_E' id='type_E'>
                                        <option value=" ">Select</option>
                                        <option value='1'>HSN</option>
                                        <option value='2'>SAC</option>
                                    </select>
                                </div>
                            </div>



                            <!-- //  content  2 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Code</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Code' name='code_E'
                                        id='code_E'>
                                </div>
                            </div>




                            <!-- //  content  3 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Description</label>
                                </div>
                                <div class='col-md-8'>
                                    <textarea id='description_E' name='description_E' rows='4'
                                        style='width:100%'></textarea>
                                </div>
                            </div>



                            <!-- //  content  4 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Rate</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='rate_E' id='rate_E'>
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
    function openModel(id, type, code, description, rate, status) {
        $('#id_E').val(id);
        $('#type_E').val(type);
        $('#code_E').val(code);
        $('#description_E').val(description);
        $('#rate_E').val(rate);
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