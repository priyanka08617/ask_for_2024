<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Category Details</title>
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
        <h3> Category </h3>
        <small class='text-muted'>Fill in the given below tab to create Category and manage existing data</small>
        <hr>
        </hr>




        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>
                <a class='nav-link' data-toggle='tab' href='#home'>Category Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Category</a>
            </li>
        </ul>
<br>
        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='../controllers/dp_category_add.php' method='post'>

                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Dp Category</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter Dp Category' name='dp_category' id='dp_category' required>
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


            <div id='menu1' class='tab-pane in active'>
                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>DP Category</th>
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>DP Category</th>
                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM dp_category WHERE status="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$cat=$row['category_name'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $cat.'</td>';
$c++
;$edit_modal_params_string="'$id','$cat','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
// echo '<td><a data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"><img src="../img/edit.png" width="30px"></a></td>';
echo '<td><a data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"><img src="../img/edit.png" width="30px"></a>&nbsp &nbsp<a href="../controllers/dp_category_del.php?id='.$id.'" onclick="return confirm(\'Are you sure, you want to remove ?\')"><img src="../img/delete.png" width="30px"></a></td>';
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

                        <h4 class='modal-title'>Category Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/dp_category_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Dp Category</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Dp Category' name='dp_category_E'
                                        id='dp_category_E'>
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
    function openModel(id, cat, status) {
        $('#id_E').val(id);
        $('#dp_category_E').val(cat);
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