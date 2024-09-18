<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Item Details</title>
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


</head>

<body>

    <div class='container-fluid'>
        <div id='main'>
            <h3>UoM Category</h3>
            <small class="text-muted">Fill in the given below tab to create UoM Category and manage existing UoM
                Category
            </small>
            <hr> </hr>




            <!-- Nav tabs -->
            <ul class='nav nav-tabs nav-justified' role='tablist'>
                <li class='nav-item'>
                    <a class='nav-link' data-toggle='tab' href='#create_dc'> UoM Category Creation</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' data-toggle='tab' href='#existing_dc'>Existing UoM Category</a>
                </li>

            </ul>
<br>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane  container fade in" id="create_dc">
                    <form method="post" action="../controllers/uom_category_add.php">

                        <div class="d-grid gap-2">
                            <div class="form-group row">
                                <div class="col-sm-1">
                                    <label for="email"></label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="name">Uom Category</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="uom category" id="name"
                                        name="name" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="email"></label>
                                </div>
                            </div>



                            <div class="form-group row">

                                <div class="col-sm-1">
                                    <label for="email"></label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="name"></label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-block btn-primary" id="submit"
                                            name="submit">Submit</button>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </form>


                </div>
                <div class="tab-pane active in" id="existing_dc">
                    <table id='example' class='table table-sm table-hover'>
                        <thead>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Action</th>
                        </thead>
                        <tfoot>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Action</th>
                        </tfoot>
                        <tbody>
                            <?php
                  $c=0;
                  $sql="SELECT * FROM uom_category WHERE status='1' ORDER BY id DESC";
                  $query=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_array($query)){
                    $c++;


                     $id=$row["id"];
                     $name=$row["name"];
                       echo "<tr>";
                       echo "<td>".$c."</td>";
                       echo "<td>".$name."</td>";


                            $edit_modal_params_string="'$id','$name'";
                            $edit_modal_params="openModel(".$edit_modal_params_string.")";

                            echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"></td>';

                            echo '<td><a href="../controllers/uom_category_del.php?UomCategory_id='.$id.'" onclick="return confirm(\'Are you sure ?\')"><img src="../img/delete.png" width="30px"></a></td>'; 

                      echo "</tr>";

                  }
                echo "</tr>";
                    //   }
              ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- //modal start -->


            <!-- The Modal -->
            <div class='modal' id='myModal'>
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>
                        <!-- Modal Header -->
                        <div class='modal-header'>
                            <h4 class='modal-title'>Modal Heading</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                        </div>
                        <!-- Modal body -->
                        <div class='modal-body'>
                            <form class='form' action='../controllers/uom_category_update.php'
                                method='POST'>

                                <div class="d-grid gap-2">
                                    <!-- //  content  1 -->
                                    <div class=' form-group row'>
                                        <div class='col-md-2'></div>
                                        <div class='col-md-2'>

                                        </div>
                                        <div class='col-md-5'>
                                            <input type='hidden' class='form-control' placeholder='Enter id' name='id_E'
                                                id='id_E'>
                                        </div>
                                    </div>

                                    <!-- //  content  2 -->
                                    <div class=' form-group row'>
                                        <div class='col-md-2'></div>
                                        <div class='col-md-2'>
                                            <label for='comment'>Name</label>
                                        </div>
                                        <div class='col-md-5'>
                                            <input type='text' class='form-control' placeholder='Enter name'
                                                name='name_E' id='name_E'>
                                        </div>
                                    </div>

                           
                                            <input type='hidden' class='form-control' placeholder='Enter status'
                                                name='status_E' id='status_E'>
                              
                                


                                    <div class=' form-group row'>
                                        <div class='col-md-4'></div>
                                        <div class='col-md-5'>
                                                <button type='submit'
                                                    class='btn btn-primary btn-block btn-sm'>Submit</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- End of Main Content -->

        <script>
        function openModel(id, name, status) {
            $('#id_E').val(id);
            $('#name_E').val(name);
            $('#status_E').val(status);
        }
        $(document).ready(function() {
            $('#example').dataTable();
        });
        $(document).ready(function() {
            $('#example').DataTable();
            $('.a').addClass('active');
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