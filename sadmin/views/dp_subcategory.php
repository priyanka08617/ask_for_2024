<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Subcategory Details</title>
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
        <h3>DP Subcategory Details</h3><small class='text-muted'>Fill in the given below tab to create DP Subcategory and manage
            existing data</small>
        <hr> </hr>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>

                <a class='nav-link' data-toggle='tab' href='#home'>DP Subcategory Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>DP Existing Subcategory</a>
            </li>
        </ul>






        <br>


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='../controllers/dp_subcategory_add.php' method='post'>

                    <!-- //  content  1 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Dp Category</label></div>
                        <div class='col-md-6'>

                            <select class='form-control' name='dp_category_id' id='dp_category_id' style='width:100%'
                                required>
                                <option value=''>select</option>
                                <?php
 
                      $sql='SELECT * FROM dp_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['category_name'].'</option>';
                      }
            ?>
                            </select>
                        </div>
                    </div>

                    <!-- //  content  2 -->
                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Dp Subcategory</label></div>
                        <div class='col-md-6'>
                            <input type='text' class='form-control' placeholder='Enter DP Subcategory' name='dp_subcategory'
                                id='dp_subcategory' required>
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
                        <th>Subcategory</th>
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>DP Category</th>
                        <th>Subcategory</th>
                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
   
   
              $sql='SELECT * FROM dp_subcategory WHERE status="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$category_id=$row['dp_category_id'];
$subcategory=$row['dp_subcategory'];
$category=singleRowFromTable($conn, "SELECT * FROM dp_category WHERE id='$category_id'", "category_name");


 echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'. $category.'</td>';
 echo '<td>'. $subcategory.'</td>';

$edit_modal_params_string="'$id','$category_id','$subcategory','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';

echo '<td><a data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"><img src="../img/edit.png" width="30px"></a>&nbsp &nbsp<a href="../controllers/dp_subcategory_del.php?id='.$id.'" onclick="return confirm(\'Are you sure, you want to remove ?\')"><img src="../img/delete.png" width="30px"></a></td>';
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

                        <h4 class='modal-title'>Subcategory Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/dp_subcategory_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Category</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='dp_category_id_E' id='dp_category_id_E'>
                                        <option value=''>select</option>
                                        <?php
 
                      $sql='SELECT * FROM dp_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['category_name'].'</option>';
                      }
            ?>
                                    </select>
                                </div>
                            </div>

                            <!-- //  content  2 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Subcategory</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Subcategory'
                                        name='subcategory_E' id='subcategory_E' required>
                                </div>
                            </div>
                            <div class='row mt-3'>
                                <div class='col-md-4'></div>
                                <div class='col-md-8'>
                                    <button type='submit' class='btn btn-primary btn-block btn-sm'
                                        onclick="return confirm('Are you sure ?')">Submit</button>
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

    function openModel(id, category_id, subcategory, status) {
        $('#id_E').val(id);
        $('#dp_category_id_E').val(category_id);
        $('#subcategory_E').val(subcategory);

        $("#dp_category_id").select2();
    }



    $("#dp_category_id").select2();
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
    </body>
    </html>