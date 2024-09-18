<?php
  ob_start();
  include '../includes/check.php';
  include '../includes/functions.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Take Away || Store Admin</title>
    <?php
  include '../includes/header.php';
?>

    <style>
    /* .DproductBillItems{
    background: <?php echo $color_hex; ?>;
  }
  .DproductItemsContainer{
    background: <?php echo $color_hex; ?>;
  } */



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

    <div class="container-fluid">
        <?php
  include '../includes/navbar.php';
?>
        <div class='container-fluid'>
            <div id='main'>
                <h3>Uom Conversion Setting </h3><small class="text-muted">Fill in the given below tab to create Uom and
                    manage existing Uom </small>
                <hr>
                </hr>


                <ul class='nav nav-tabs nav-justified' role='tablist'>
                    <li class='nav-item'>
                        <a class='nav-link ' data-toggle='tab' href='#home'>uom conversion setting Creation</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing UoM Conversion setting</a>
                    </li>

                </ul>
                <br><br>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade container" id="home">
                        <form method="post" action="../controllers/uom_conversion_setting_add.php">

                            <div class="d-grid gap-2">

                                <div class="form-group row">
                                    <div class="col-sm-1">
                                        <label for="email"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="name">Source UoM</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="basic_uom" name="basic_uom" class="form-control"
                                            onchange="getTergetSymbol(this.value)" style="width:100%">
                                            <option value="">Select</option>

                                            <?php
                   $sql='SELECT * FROM uom WHERE status="1" order by id desc';
                   $result=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($result)){
                    $id=$row['id'];
                    $uom_name=$row['uom_name'];
                    echo "<option value='$id'>".$uom_name."</option>";
                    }
              ?>
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-1">
                                        <label for="email"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="name">Value</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Base Uom Unit"
                                            id="base_uom_unit" name="base_uom_unit" required>
                                    </div>

                                </div>
                            </div>
                            <br><br>







                            <div class="d-grid gap-2">

                                <div class="form-group row">
                                    <div class="col-sm-1">
                                        <label for="email"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="name">Target Uom</label>
                                    </div>
                                    <div class="col-sm-6">

                                        <select id="terget_uom" name="terget_uom" class="form-control"  style="width:100%">
                                            <option>Select</option>

                                        </select>

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
                                        <label for="name">Terget Uom Unit</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="symbol"
                                            id="terget_uom_unit" name="terget_uom_unit" required >
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
                    <div class="tab-pane active" id="menu1">



                        <table class='table table-sm table-hover' id='example'>
                            <thead>
                                <th>#</th>
                                <th>Conversion Details</th>
                                <th>Edit</th>
                                <th>Action</th>
                            </thead>
                            <tfoot>
                                <th>#</th>
                                <th>Conversion Details</th>
                                <th>Edit</th>
                                <th>Action</th>
                            </tfoot>
                            <tbody>
                                <?php
   $c=1; 
 
              $sql='SELECT * FROM uom_conversion_setting WHERE status="1" order by id desc';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];


$form_unit_source_id=$row['form_unit_source'];
$form_unit_value=$row['form_unit_value'];

$to_unit_source_id=$row['to_unit_source'];
$to_unit_value=$row['to_unit_value'];

$form_unit_source=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$form_unit_source_id'", "uom_name");
$to_unit_source=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$to_unit_source_id'", "uom_name");

										// form_unit_source
										// form_unit_value
										// to_unit_source
										// to_unit_value
								     
                        $id=$row["id"];

										echo "<tr>";		
										echo "<td>".$c."</td>";
										echo "<td>".$row["form_unit_value"]."  ".$form_unit_source." = ".$row["to_unit_value"]." ".$to_unit_source."</td>";	

            $edit_modal_params_string="'$id','$form_unit_source_id','$form_unit_value','$to_unit_source_id','$to_unit_value'";

            $edit_modal_params="openModel(".$edit_modal_params_string.")";
         
						echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"></td>';


              echo '<td><a href="../controllers/uom_conversion_setting_del.php?id='.$id.'" onclick="return confirm(\'Are you sure ?\')"><img src="../img/delete.png" width="30px"></a></td>';
         



										echo "</tr>";	
								
									}
                    ?>





                            </tbody>
                        </table>

                        <!-- //modal start -->

                        <div class="modal" id="myModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Uom Convertion</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <form method="post" action="../controllers/uom_conversion_setting_update.php">


                                            <input type="hidden" name="id_E" id="id">

                                  

                                                <div class="form-group row">
                                                    <div class="col-sm-1">
                                                        <label for="email"></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="name">Base Uom Unit</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="baseUomUnitEdit"
                                                            name="basic_uom_E">

                                                    </div>

                                                </div>






                                                <div class="form-group row">
                                                    <div class="col-sm-1">
                                                        <label for="email"></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="name">Base Uom</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select id="baseUomEdit" name="base_uom_unit_E" class="form-control"
                                                            onchange="SymbolEdit(this.value);"  style="width:100%">
                                                            <option>Select</option>
                                                            <?php
                                                            $sql='SELECT * FROM uom WHERE status="1" order by id desc';
                   $result=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($result)){
                    $id=$row['id'];
                    $uom_name=$row['uom_name'];
                    echo "<option value='$id'>".$uom_name."</option>";
                    }
                    ?>

                                                        </select>


                                                    </div>

                                                </div>




                                                <div class="form-group row">
                                                    <div class="col-sm-1">
                                                        <label for="email"></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="name">Target Uom Unit</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="tergetUomUnitEdit"
                                                            name="terget_uom_E">

                                                    </div>
                                                </div>





                                                <div class="form-group row">
                                                    <div class="col-sm-1">
                                                        <label for="email"></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="name">Target Uom</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select id="tergetUomEdit" name="terget_uom_unit_E"
                                                            class="form-control"  style="width:100%">
                                                            <!-- <option value=""></option>Select</option> -->
                                                            <?php
                                                            $sql='SELECT * FROM uom WHERE status="1" order by id desc';
                   $result=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($result)){
                    $id=$row['id'];
                    $uom_name=$row['uom_name'];
                    echo "<option value='$id'>".$uom_name."</option>";
                    }
                    ?>

                                                        </select>

                                                    </div>
                                                </div>






                                                <div class="form-group row">

                                                    <div class="col-sm-1">
                                                        <label for="email"></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="name"></label>
                                                    </div>

                                                    <div class="col-sm-6">
                                                            <button type="submit" class="btn btn-block btn-primary"
                                                                id="submit" name="submit">Submit</button>
                                                        
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
                        <!-- modal end -->



                        <!-- //end my code  -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->


                <script>
                $(document).ready(function() {
                    $('#example').dataTable();
                });
                // $(".i").addClass('active');

                $(document).ready(function() {
                    $('#example').DataTable();
                    // $('.a').addClass('active');
                });




                function openModel(id, a, b, c, d) {
                    $("#id").val(id);
                    $("#baseUomEdit").val(a);
                    $("#baseUomUnitEdit").val(b);
                    $("#tergetUomEdit").val(c);
                    $("#tergetUomUnitEdit").val(d);
                }

                function getTergetSymbol(id) {
                    // alert(id);
                    $.ajax({
                        type: 'post',
                        data: {
                            id: id
                        },
                        url: "../controllers/ajax/uom_convertion_get_symbol.php",
                        dataType: 'json',
                        success: function(response) {
                            $("#terget_uom").empty();
                            $.each(response, function(key, input) {
                                $("#terget_uom").append("<option value='" + input.id + "'>" + input
                                    .uom_name + "</option>");
                            });

                        }
                    });
                }

                // function SymbolEdit(id) {
                //     alert(id);
                //     $.ajax({
                //         type: 'post',
                //         data: {
                //             id: id
                //         },
                //         url: "../controllers/ajax/uom_convertion_get_symbol.php",
                //         dataType: 'json',
                //         success: function(response) {
                //             $("#tergetUomEdit").empty();
                //             $.each(response, function(key, input) {
                //                 // alert(input.symbol);
                //                 $("#tergetUomEdit").append("<option value='" + input.id + "'>" +
                //                     input.symbol + "</option>");
                //             });

                //         }
                //     });
                // }

                $("#uomName").select2();
                $("#terget_uom").select2();




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