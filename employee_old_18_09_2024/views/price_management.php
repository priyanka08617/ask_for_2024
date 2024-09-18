<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Price Management</title>
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



    /* table #example2 tr td {

        padding: 9px;

        font-weight: bold;

    }


    thead tr td {

        text-align: center;

    } */
    </style>
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Price Management </h3><small class='text-muted'>Fill in the given below tab to create Price Management and
            manage
            existing Price Management</small>
        <hr>
        </hr>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>

                <a class='nav-link' data-toggle='tab' href='#home'>Price Management Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Price Management</a>
            </li>
        </ul>






        <br>


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='../controllers/price_management_cont.php' method='post'>




                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Select Product</label></div>
                        <div class='col-md-6'>
                            <select id="product_id" name="product_id" class="form-control" style="width:100%">
                                <option value="">select</option>


                                <?php
                                        $sql="SELECT * FROM `ap`  WHERE status='1'";
                                        $query=mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_array($query)){

                                            echo "<option  value='".$row["id"]."'>".$row["name"]."</option>";

                                        }
                                        ?>
                            </select>

                        </div>
                    </div>


                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'><label class='control-label' for='uom'>Product Price</label></div>
                        <div class='col-md-6'>
                            <input type="number" id="product_price" name="product_price" class="form-control" style="width:100%" min="0" step="0.00" placeholder="Price">

                        </div>
                    </div>

                    <div class='form-group row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-2'></div>
                        <div class='col-md-6'>
                            <button type="button" id="apply" name="apply" class="btn btn-secondary" style="width:100%">Apply</button>

                        </div>
                    </div>

<div id="box">
<hr></hr>

                    <div class='form-group row'>
                    <div class='col-md-3'></div>
                        <div class='col-md-6'>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <th><input type="checkbox" name="select-all" id="select-all" /></th>
                                    <th>Location</th>
                                    <th>Price</th>
                                </thead>
                                <tbody>

                                    <?php
                      $sql='SELECT * FROM `location` WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){

                        $id=$row['id'];
                        echo '<tr>';
                        echo '<td><input type="checkbox" id="check_box_id'.$row['id'].'"  name="check_box_id[]" value="'.$id.'" onclick="check_box_enable(this.value)"></td>';
                      
                        echo '<td>'.$row['location'].'</td>';

                        echo '<td><input type="number" id="check_price'.$row['id'].'"  name="check_price[]" class="form-control check_price"></td>';


                        echo '</tr>';


                      }
            ?>
                                </tbody>
                            </table>
                        </div>
                        <div class='col-md-6'></div>
                    </div>



                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                            <div class='d-grid'>
                                <button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
                            </div>
                        </div>
                    </div>


                    </div>
                </form>




            </div>


            <div id='menu1' class='tab-pane in active'>
                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Product</th>
                        <th>Product Price</th>
                        <th>Location</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>Product</th>
                        <th>Product Price</th>
                        <th>Location</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM price_management WHERE status="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$product_id=$row['product_id'];
$product_price=$row['price'];
$location_id=$row['location_id'];
$product_name=singleRowFromTable($conn, "SELECT * FROM ap WHERE id='$product_id'", "name");
$location=singleRowFromTable($conn, "SELECT * FROM `location` WHERE id='$location_id'", "location");

 echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'. $product_name.'</td>';
 echo '<td>'. $product_price.'</td>';
 echo '<td>'. $location.'</td>';

$edit_modal_params_string="'$id','$product_id','$product_price','$location_id','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'" ></td>';
// echo '<td><a href="../controllers/subcategory_del.php?id='.$id.'" onclick="return confirm(\'Are you sure , you want to remove this data ? \')" disabled><img src="../img/cancel.png" width="30px"></a></td>';
echo '<td><a  onclick="return confirm(\'Are you sure , you want to remove this data ? \')" disabled><img src="../img/delete.png" width="30px"></a></td>';

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
                        <form class='form' action='../controllers/subcategory_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>

                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Category Id</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='category_id_E' id='category_id_E'>
                                        <option value=''>select</option>
                                        <?php
 
                    //   $sql='SELECT * FROM ap_category WHERE status="1"';
                    //   $result=mysqli_query($conn,$sql);
                    //   while($row=mysqli_fetch_array($result)){
                    //     $id=$row['id'];
                    //     echo '<option value="'.$id.'">'.$row['cat'].'</option>';
                    //   }
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
        $('#category_id_E').val(category_id);
        $('#subcategory_E').val(subcategory);
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








    $('#select-all').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });





    $("#category_id").select2();
  

 $("#box").hide();
$("#apply").on('click', function() {
   $("#apply").hide();
  var product_price= $("#product_price").val();
  
   
   $(".check_price").val(product_price);
   $("#box").show();
});



    </script>
</body>

</html>