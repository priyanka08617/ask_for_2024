<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> DP Details</title>
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
                'pageLength'
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
        <h3> DP Details </h3><small class='text-muted'>Fill in the given below tab to create dp details and manage
            existing
            data</small>
        <HR>
        </HR>
        <!-- my code start  -->
        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#home'>DP Details Creation</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link ' data-toggle='tab' href='#menu1'>Existing DP Details</a>
            </li>
        </ul>




        <!-- <br> -->
        <br>


        <div class='tab-content'>
            <div id='home' class='tab-pane in active'>
                <form class='form-horizontal' action='../controllers/dp_add.php' method='post'>



                    <div class='row'>
                        <div class='col-md-6'>
                            <div class='form-group row'>
                                <div class='col-md-2'><label class='control-label' for='uom'>DP Category</label></div>
                                <div class='col-md-10'>

                                    <select class='form-control' name='cat_id' id='cat_id' style='width:100%'
                                        onchange='getSubcategory(this.value)'>
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
                        </div>
                        <div class='col-md-6'>
                            <div class='row'>
                                <div class='col-md-2'><label class='control-label' for='uom'>SubCategory</label></div>
                                <div class='col-md-10'>

                                    <select class='form-control' name='sub_cat_id' id='sub_cat_id' style='width:100%'>
                                        <option value=''>select</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div class='row'>
                        <div class='col-md-6'>


                        <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>MTM</label></div>
                        <div class='col-md-10'>


                            <div class="input-group ">

                                <input type='text' class='form-control' placeholder='Enter Item' name='item' id='item'
                                    onkeyup="check_duplicate();">

                                <div class="input-group-append">
                                    <span class="input-group-text" id="username_check_response"></span>
                                </div>

                            </div></div></div>


                    </div>




                    <div class='col-md-6'>
                    <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Short Code</label></div>
                        <div class='col-md-10'>
                            <input type='text' class='form-control' placeholder='Enter Short Code' name='short_code'
                                id='short_code'>
                        </div>
                    </div>
                    </div>
                    </div>


                    <div class='form-group row'>
                    
                    <div class='col-md-6'>
                    <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Name</label></div>
                        <div class='col-md-10'>
                            <input type='text' class='form-control' placeholder='Enter  Name' name='name'
                                id='name'>
                        </div>
                    </div>
                    </div>


                    <div class='col-md-6'>
                    <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>SKU</label></div>
                        <div class='col-md-10'>
                            <input type='text' class='form-control' placeholder='Enter SKU' name='sku'
                                id='sku'>
                        </div>
                    </div>
                    </div>
                    </div>





                    <!-- //  content  1 -->
                    <!-- <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Item</label></div>
                        <div class='col-md-6'>


                            <div class="input-group ">

                                <input type='text' class='form-control' placeholder='Enter Item' name='item' id='item'
                                    onkeyup="check_duplicate();">

                                <div class="input-group-append">
                                    <span class="input-group-text" id="username_check_response"></span>
                                </div>

                            </div> -->




                            <script>
                            function check_duplicate() {
                                var name = $("#item").val();
                                var table_name = "dp";
                                var table_col_name = "mtm";
                                
                                // alert(name);

                                $('#item_btn').attr('disabled', true);

                                $.ajax({
                                    data: {
                                        name: name,
                                        table_name: table_name,
                                        table_col_name: table_col_name,
                                    },
                                    type: "POST",
                                    url: "../controllers/ajax/ajax_check_duplicate.php",
                                    success: function(data) {

                                        console.log(data);

                                        if (data == 0) {
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

                      



<div class='form-group row'>
<div class='col-md-6'>
                   <div class=' row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>UoM</label></div>
                        <div class='col-md-10'>

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
                                    
                                    <div class='col-md-2'><label class='control-label' for='uom'>Hsn Code</label></div>
                                    <div class='col-md-10'>

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
                        <div class='col-md-2'><label class='control-label' for='uom'>Barcode</label></div>
                        <div class='col-md-10'>

                            <input type='text' class='form-control' name='barcode' id='barcode' placeholder="Enter Barcode">
                              
                        </div>
                    </div>
</div>
<div class='col-md-6'>


            <div class='row'>
                                    
                                    <div class='col-md-2'><label class='control-label' for='uom'>Alias</label></div>
                                    <div class='col-md-10'>

                                        <input type='text' class='form-control' name='alias' id='alias' placeholder="Enter Alias">
                                          
                                    </div>
            </div>

</div>
</div>





                   <hr>
                    <div id="specification"></div>









                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-12'>
                                <button type='submit' id="item_btn" class='btn btn-primary btn-block btn-sm'
                                    onclick='return confirm("Are you sure ?")'>Submit</button>
                         
                        </div>
                    </div>
                </form>
            </div>
            <div id='menu1' class='tab-pane in fade'>
                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Cate</th>
                        <th>SubCate</th>
                        <th>MTM</th>
                        <th>Short Code</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Barcode</th>
                        <th>Alias</th>
                        <th>UoM</th>
                        <th>Hsn Code</th>
                        <th>Hsn Rate</th>
                        <th>Specification</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>


                    <tfoot>
                        <th>#</th>
                        <th>Cate</th>
                        <th>Sub-Cate</th>
                        <th>MTM</th>
                        <th>Short Code</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Barcode</th>
                        <th>Alias</th>
                        <th>UoM</th>
                        <th>Hsn Code</th>
                        <th>Hsn Rate</th>
                        <th>Specification</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tfoot>

                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM dp WHERE status="1" order by id desc';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];

$cat_id=$row['cat_id'];
$subcategory_id=$row['sub_cat_id'];

$cat=singleRowFromTable($conn, "SELECT * FROM dp_category WHERE id='$cat_id'", "category_name");
$sub_cat=singleRowFromTable($conn, "SELECT * FROM dp_subcategory WHERE id='$subcategory_id'", "dp_subcategory");


$mtm=$row['mtm'];
$name=$row['name'];
$sku=$row['sku'];
$barcode=$row['barcode'];
$alias=$row['alias'];
$uom_id=$row['uom_id'];
$uom=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
$short_code=$row['short_code'];
$hsn_table_id=$row['hsn_table_id'];
$hsn_code=singleRowFromTable($conn, "SELECT * FROM hsn_table WHERE id='$hsn_table_id'", "code");
$hsn_rate_id=$row['hsn_rate_id'];
$hsn_rate=singleRowFromTable($conn, "SELECT * FROM hsn_rate_master  WHERE id='$hsn_rate_id'", "rate");


 echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'.$cat.'</td>';
 echo '<td>'.$sub_cat.'</td>';             
 echo '<td>'.$mtm.'</td>';    
 echo '<td>'. $short_code.'</td>';         
 echo '<td>'.$name.'</td>';             
 echo '<td>'.$sku.'</td>';             
 echo '<td>'.$barcode.'</td>';            
 echo '<td>'.$alias.'</td>';
 echo '<td>'. $uom.'</td>';

 echo '<td>'. $hsn_code.'</td>';
 echo '<td>'. $hsn_rate.'%</td>';
 echo '<td><a href="dp_details.php?dp_id='.$id.'"><button type="button" class="btn btn-default" style="background-color:#57bde1;color:#fff">Specifications</button></a></td>';
$c++;

echo '<td><a href="dp_edit_v.php?dp_id='.$id.'"><img src="../img/edit.png" width="30px" ></a></td>';
echo '<td><a href="../controllers/dp_del.php?id='.$id.'" onclick="return confirm(\'Are you sure?\')"><img src="../img/delete.png" width="30px"></a></td>';
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

                        <h4 class='modal-title'>Item Edit</h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class='modal-body'>
                        <form class='form' action='../controllers/item_update.php' method='POST'>
                            <input type='hidden' class='form-control' name='id_E' id='id_E'>


                            <div class='form-group row'>
                                <div class='col-md-4'><label class='control-label' for='uom'>Category</label></div>
                                <div class='col-md-8'>

                                    <select class='form-control' name='cat_id_E' id='cat_id_E' style='width:100%'
                                        onchange='getSubcategory_E(this.value)'>
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

                            <div class='form-group row'>
                                <div class='col-md-4'><label class='control-label' for='uom'>SubCategory</label></div>
                                <div class='col-md-8'>

                                    <select class='form-control' name='sub_cat_id_E' id='sub_cat_id_E'
                                        style='width:100%'>
                                        <option value=''>select</option>
                                        <?php
 
                      $sql='SELECT * FROM dp_subcategory WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['dp_subcategory'].'</option>';
                      }
            ?>

                                    </select>
                                </div>
                            </div>








                            <!-- //  content  1 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Item</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Item' name='item_E'
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
                                    <label for='comment'>Part No</label>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' class='form-control' placeholder='Enter Part No' name='part_no_E'
                                        id='part_no_E'>
                                </div>
                            </div>

                            <!-- //  content  4 -->
                            <div class='row mt-3'>
                                <div class='col-md-4'>
                                    <label for='comment'>Hsn Code</label>
                                </div>
                                <div class='col-md-8'>


                                    <select class='form-control' name='hsn_table_id_E' id='hsn_table_id_E'
                                        style='width:100%'>
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


                                    <select class='form-control' name='hsn_rate_id_E' id='hsn_rate_id_E'
                                        style='width:100%'>
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
    function openModel(id, cat_id, sub_cat_id, item, uom_id, part_no, hsn_table_id, hsn_rate_id, status) {


        $('#id_E').val(id);
        $('#cat_id_E').val(cat_id);
        $('#sub_cat_id_E').val(sub_cat_id);
        $('#item_E').val(item);
        $('#uom_id_E').val(uom_id);
        $('#part_no_E').val(part_no);
        $('#hsn_table_id_E').val(hsn_table_id);
        $('#hsn_rate_id_E').val(hsn_rate_id);

        $("#uom_id_E").select2();
        $("#hsn_table_id_E").select2();
        $("#hsn_rate_id_E").select2();
    }

    $("#cat_id").select2();
    $("#sub_cat_id").select2();
    $("#uom_id").select2();
    $("#hsn_table_id").select2();
    $("#hsn_rate_id").select2();



    function getSubcategory(cat_id) {
        $.ajax({
            type: 'POST',
            data: {
                cat_id: cat_id
            },
            url: "../controllers/ajax/ajax_fetch_subcategory.php",
            success: function(result) {
                // alert(result);
                $("#sub_cat_id").empty();
                $("#sub_cat_id").append(result);
                $("#sub_cat_id").select2();
                // alert(result);
            }
        });

        $.ajax({
            type: 'POST',
            data: {
                cat_id: cat_id
            },
            url: "../controllers/ajax/ajax_fetch_specification.php",
            success: function(result) {
                // alert(result);
                $("#specification").empty();
                $("#specification").append(result);
         
                // alert(result);
            }
        });

    }


    function getSubcategory_E(cat) {
        $.ajax({
            type: 'POST',
            data: {
                cat_id: cat
            },
            url: "../controllers/ajax/ajax_fetch_subcategory.php",
            success: function(result) {
                $("#sub_cat_id_E").empty();
                $("#sub_cat_id_E").append(result);
                $("#sub_cat_id_E").select2();
                // alert(result);
            }
        });
    }
    </script>