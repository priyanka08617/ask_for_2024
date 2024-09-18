<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php'; 
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Uom Details</title>
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
        <h3> Uom </h3><small class='text-muted'>Fill in the given below tab to create Uom and manage existing
            data</small>
        <hr></hr>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>

                <a class='nav-link' data-toggle='tab' href='#home'>Uom Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Uom</a>
            </li>
        </ul>






        <br>


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='../controllers/uom_add.php' method='post'>

                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Uom Category</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='uom_cate_id' id='uom_cate_id' style='width:100%'>
                                <option value=''>select</option>
                                <?php
 
                      $sql='SELECT * FROM uom_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['name'].'</option>';
                      }
            ?>
                            </select>
                        </div>
                    </div>

                    <!-- //  content  2 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Uom</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter Uom' name='uom' id='uom'>
                        </div>
                    </div>

                    <!-- //  content  3 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Symbol</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter Symbol' name='symbol'
                                id='symbol'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                            <div class='d-grid'>
                                <button type='submit' class='btn btn-primary btn-block btn-sm' onclick='return confirm("Are you sure ?")'>Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id='menu1' class='tab-pane in active'>
                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>UoM Category</th>
                        <th>Uom</th>
                        <th>Symbol</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>UoM Category</th>
                        <th>Uom</th>
                        <th>Symbol</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM uom WHERE status="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                
                $id=$row['id'];
                $status=$row['status'];
                $uom_cate_id=$row['uom_cate_id'];
                $uom=$row['uom_name'];
                $symbol=$row['symbol'];

                
echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'.singleRowFromTable($conn, "SELECT * FROM uom_category WHERE id='$uom_cate_id'", "name").'</td>';
 echo '<td>'. $uom.'</td>';
 echo '<td>'. $row['symbol'].'</td>';

$c++;

$edit_modal_params_string="'$id','$uom_cate_id','$uom','$symbol','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"></td>';
echo '<td><a href="../controllers/uom_del.php?id='.$id.'" onclick="return confirm(\'Are you sure , you want to remove this data ? \')"><img src="../img/delete.png" width="30px"></a></td>';
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

                        <h4 class='modal-title'>Uom Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/uom_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Uom Cate</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='uom_cate_id_E' id='uom_cate_id_E' style='width:100%'>
                                        <option value=''>select</option>
                                        <?php
 
                      $sql='SELECT * FROM uom_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['name'].'</option>';
                      }
            ?>
                                    </select>
                                </div>
                            </div>

                            <!-- //  content  2 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Uom</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Uom' name='uom_E'
                                        id='uom_E'>
                                </div>
                            </div>

                            <!-- //  content  3 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Symbol</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Symbol' name='symbol_E'
                                        id='symbol_E'>
                                </div>
                            </div>
                            <div class='row mt-3'>
                                <div class='col-md-4'></div>
                                <div class='col-md-8'>
                                    <button type='submit' class='btn btn-primary btn-block btn-sm' onclick='return confirm("Are you sure ?")'>Submit</button>
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


    function openModel(id, uom_cate_id, uom, symbol, status) {
        $('#id_E').val(id);
        $('#uom_cate_id_E').val(uom_cate_id);
        $('#uom_E').val(uom);
        $('#symbol_E').val(symbol);

        $("#uom_cate_id_E").select2();
    }

$("#uom_cate_id").select2();


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