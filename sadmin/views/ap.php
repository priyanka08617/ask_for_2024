<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Assembled Product</title>
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
        <!-- Form Name -->
        <h3> Product </h3><small class='text-muted'>Fill in the given below tab to create assemble product and manage
            existing product . 
        </small>
        <hr></hr>

        <ul class='nav nav-tabs nav-justified'>
        <li class='nav-item'>
                  <a   class='nav-link ' data-toggle='tab' href='#home'> Ap Creation</a></li>
          <li class='nav-item'>
                  <a class='nav-link active'  data-toggle='tab' href='#menu1'> Existing Ap  </a></li>
        </ul>





        <br>


        <div class='tab-content'>
            <div id='home' class='tab-pane in fade'>
                <form class='form-horizontal' action='../controllers/product_add.php' method='post'>

                    <!-- //  content  1 -->


                    



                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Category</label></div>
                        <div class='col-md-10'>

                            <select class='form-control' name='category_id' required id='category_id' onchange='getSubcategory(this.value)' style='width:100%'>
                                <option value=''>select</option>
                                <?php
 
                      $sql='SELECT * FROM ap_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['category'].'</option>';
                      }
            ?>
                            </select>
                        </div>
                    </div>

                    <!-- //  content  2 -->
                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Sub-Category</label></div>
                        <div class='col-md-10'>

                            <select class='form-control' name='subcategory_id' required id='subcategory_id' style='width:100%'>
                                <option value=''>select</option>
                            </select>
                        </div>
                    </div>

                    <!-- //  content  3 -->
                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Price</label></div>
                        <div class='col-md-10'>
                            <input type='number' step='0.01' min="0" class='form-control'
                                placeholder='Enter price (Optional)' name='price' id='price'>
                        </div>
                    </div>



                    <!-- //  content  5 -->
                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Name</label></div>
                        <div class='col-md-10'>


                            <div class="input-group ">

                                <input type='text' class='form-control' onkeyup="check_duplicate();"
                                    placeholder='Enter name' name='name' required id='name'>

                                <div class="input-group-append">
                                    <span class="input-group-text" id="username_check_response"></span>
                                </div>
                             
                            </div>



                        </div>
                    </div>

                    <script>
                    function check_duplicate() {
                        var name = $("#name").val();
                        var table_name = "ap";
                        var table_col_name = "name";

                        $('#product_submit').attr('disabled', true);

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


                                    $('#product_submit').attr('disabled', false);

                                } else {
                                    $('#username_check_response').html(
                                        "<span style='color:red;'>* Name not Available<span>");


                                }

                            }
                        });


                    }
                    </script>

                    <!-- //  content  6 -->
                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Qty</label></div>
                        <div class='col-md-10'>
                            <input type='number' min="1" class='form-control' placeholder='Enter qty' required
                                name='qty' id='qty' step='0.01'>
                        </div>
                    </div>

                    <!-- //  content  7 -->
                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>UoM</label></div>
                        <div class='col-md-10'>

                            <select class='form-control'  name='uom_id_new' id='uom_id' style='width:100%' required>
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

                    <!-- //  content  8 -->
                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Hsn Code</label></div>
                        <div class='col-md-10'>
                            <!-- <input type='text'  class='form-control' placeholder='Enter hsn_table_id' name='hsn_table_id' id='hsn_table_id'> -->
                            <select class='form-control' name='hsn_table_id' required id='hsn_table_id'  style='width:100%'>
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

                    <!-- //  content  9 -->
                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Hsn Rate</label></div>
                        <div class='col-md-10'>
                            <!-- <input type='text'  class='form-control' placeholder='Enter hsn_rate_id' name='hsn_rate_id' id='hsn_rate_id'> -->

                            <select class='form-control' name='hsn_rate_id' required id='hsn_rate_id'  style='width:100%'>
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


 
                    <!-- <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Product Type</label></div>
                        <div class='col-md-10'>

                            <select class='form-control' name='item_type_status' id='item_type_status'>
                                <option value=''>select</option>  
                                <option value='1'>On-Order</option>  
                                <option value='2'>Pre-made</option>       
                                </select>
                        </div>
                    </div> -->


                    <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Product Sell Type</label></div>
                        <div class='col-md-10'>

                            <select class='form-control' name='sell_type_status' id='sell_type_status'>
                                <option value=''>select</option>  
                                <option value='1'>selling Product</option>  
                                <option value='2'>Non-selling product</option>       
                                </select>
                        </div>
                    </div>


                    <div class='form-group row'>

                        <div class='col-md-2'><label class='control-label' for='uom'>Assembly Details</label></div>
                        <div class='col-md-10'>
                            <table class='table'>
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>UoM</th>
                                    <th>Actions</th>
                                </tr>

                                <tbody id='table_block'></tbody>
                                <tr>
                                    <td colspan='4'></td>
                                    <td> <span class="btn btn-success btn-block" onclick="add_line();">Add</span></td>
                                </tr>


                            </table>

                        </div>
                    </div>












                    <div class='form-group row'>
                        <div class='col-md-2'></div>
                        <div class='col-md-10'>

                            <button type='submit' id="product_submit" class='btn btn-primary btn-block btn-sm' onclick='return confirm("Are you sure ?")'>Submit</button>

                        </div>
                    </div>





                </form>
            </div>
            
            <div id='menu1' class='tab-pane in active'>
                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Product Type</th>
                        <th>Sale Type</th>
                        <th>Category</th>
                        <th>Sub-category</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Hsn Code</th>
                        <th>Gst %</th>
                        <th>Assembly</th>
                        <!-- <th>Mutate</th> -->
                        <th>Edit</th>
                        <th>Action</th>

                    </thead>

                    <tfoot>
                        <th>#</th>
                        <th>Product Type</th>
                        <th>Sale Type</th>
                        <th>Category</th>
                        <th>Sub-category</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Hsn Code</th>
                        <th>Gst %</th>
                        <th>Assembly</th>
                        <!-- <th>Mutate</th> -->
                        <th>Edit</th>
                        <th>Action</th>

                    </tfoot>


                    <tbody>
                        <?php



function fetch_receipe($conn,$ass_product_id){
    $item_str=" <div class='card' style='padding:20px;'><table class='table mt-3'>
    <tr>
    <th>#</th>
    <th>Item Name</th>
    <th>Qty</th>
    </tr>";
    $a=1;
    // echo "SELECT * FROM recipe WHERE id='$ass_product_id' AND status='1' AND table_name<>'3'";
    $sql=mysqli_query($conn,"SELECT * FROM recipe WHERE product_id='$ass_product_id' AND status='1' AND table_name<>'3'");
    while($row=mysqli_fetch_array($sql)){
        $item_id=$row['item'];

        if($row['table_name']==1){
            $item_name=singleRowFromTable($conn,"SELECT * FROM dp WHERE id='$item_id'", "item")." (D.P.)";
            
        }
elseif($row['table_name']==2){
    $item_name=singleRowFromTable($conn,"SELECT * FROM ap WHERE id='$item_id'", "name")." (A.P.)";

}

$item_qty=$row['item_qty'];
$uom_id=$row['uom_id'];
$uom=singleRowFromTable($conn,"SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
       
        $item_str.="<tr>
        <td>".$a."</td>
        <td>".$item_name."</td>
        <td>".$item_qty ." ".$uom."</td>
        </tr>";
        $a++;
    }

    $item_str.="</table></div>";



return $item_str;


}




   $c=1; 

   $sql_price_management="SELECT * FROM price_management WHERE location_id='$store_id' AND status='1' ORDER BY id DESC";
   $sql_query=mysqli_query($conn,$sql_price_management);
   while($row_price_management=mysqli_fetch_array($sql_query)){
    $price_management_id=$row_price_management["id"];
    $price=$row_price_management["price"];
    $product_id=$row_price_management["product_id"];
 
              $sql="SELECT * FROM ap WHERE status='1'  AND id='$product_id'";
              $result=mysqli_query($conn,$sql);
               $row=mysqli_fetch_array($result);
                
               $id=$row['id'];
            $product_name=singleRowFromTable($conn, "SELECT * FROM ap WHERE id='$product_id'", "name");
               $status=$row['status'];
$category_id=$row['category_id'];
$category=singleRowFromTable($conn,"SELECT * FROM ap_category WHERE id='$category_id'", "category");

$subcategory_id=$row['subcategory_id'];
$subcategory=singleRowFromTable($conn,"SELECT * FROM ap_subcategory WHERE id='$subcategory_id'", "sub_category");



// $price=$row['price'];

$name=$row['name'];
$qty=$row['qty'];

$uom_id=$row['uom_id'];
$uom=singleRowFromTable($conn,"SELECT * FROM uom WHERE id='$uom_id'", "uom_name");

$hsn_table_id=$row['hsn_table_id'];
$hsn_code=singleRowFromTable($conn,"SELECT * FROM hsn_table WHERE id='$hsn_table_id'", "code");

$hsn_rate_id=$row['hsn_rate_id'];
$hsn_rate=singleRowFromTable($conn,"SELECT * FROM hsn_rate_master WHERE id='$hsn_rate_id'", "rate");



if($row['sale_type']==1){
    $sell_type="salable";
}elseif($row['sale_type']==2){
    $sell_type='non-salable';
}

if($row['product_type']==1){
    $product_type=" On-Order";
}elseif($row['product_type']==2){
    $product_type='Pre-made';
}
echo '<tr>';
echo '<td>'.$c.'</td>';
echo '<td>'. $product_type.'</td>';
echo '<td>'. $sell_type.'</td>';
 echo '<td>'. $category.'</td>';
 echo '<td>'. $subcategory.'</td>';
 
 echo '<td>'. $product_name.'</td>';

 echo '<td>'. $row['qty'].' '.$uom.'</td>';
//  echo '<td>'. $uom.'</td>';
 echo '<td>'. $price.'</td>';

 echo '<td>'. $hsn_code.'</td>';
 echo '<td>'. $hsn_rate.'</td>';


 echo '<td> <button data-toggle="collapse" class="btn btn-info btn-block" style="width:400px;" data-target="#demo'.$c.'">View Details </button>
 <div id="demo'.$c.'" class="collapse well" >

'.fetch_receipe($conn,$id).'
 </div> </td>';

//  echo '<td><a class="btn btn-success" href="mutate.php?apid='.$id.'">Mutate</a></td>';


echo '<td><a class="btn btn-warning" href="edit_ap_v.php?apid='.$id.'">Edit</a></td>';
echo '<td><a href="../controllers/product_del.php?price_management_id='.$price_management_id.'" onclick="return confirm(\'Are you sure?\')"><button type="button" class="btn btn-danger" >remove</button></a></td>';
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







    </div>
    <script>
    var c = 1;



    $(document).ready(function() {


        // $('#product_submit').attr('disabled', true);

        $("#category_id").select2();


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
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });



        add_first_line();


$("#uom_id").select2();
$("#hsn_table_id").select2();
$("#hsn_rate_id").select2();

        // $.ajax({
        //     data: {
        //         c: c
        //     },
        //     type: "GET",
        //     url: "../controllers/ajax/ajax_get_lines_of_form_dynamically_product_FGA.php",
        //     success: function(data) {


        //         console.log(data);
        //         // tableBody = $("tbody");
        //         //     tableBody.append(data);


        //         $("#table_block").append(data);

        //     }
        // });


    });



    function add_first_line() {
        // c++;
        // alert(c);
        $.ajax({
            data: {
                c: c
            },
            type: "GET",
            url: "../controllers/ajax/ajax_get_lines_of_form_dynamically_product_FGA.php",

            success: function(data) {

                // tableBody = $("tbody");
                //     tableBody.append(data);


                $("#table_block").append(data);
                $("#item_" + c).select2();

            }
        });

    }










    function add_line() {
        c++;
        // alert(c);
        $.ajax({
            data: {
                c: c
            },
            type: "GET",
            url: "../controllers/ajax/ajax_get_lines_of_form_dynamically_product_FGA.php",

            success: function(data) {

                // tableBody = $("tbody");
                //     tableBody.append(data);


                $("#table_block").append(data);
                $("#item_" + c).select2();
            }
        });

    }

    function remove_line(id) {
        $("#row_" + id).remove();
    }




    function fetch_item_uom(line_id) {

        $("#uom_id_" + line_id).empty();
        // alert(line_id);

        var product_id = $("#item_" + line_id).val();
        // alert(product_id);

        $.ajax({
            data: {
                product_id: product_id
            },
            type: "GET",
            url: "../controllers/ajax/ajax_product_uoms.php",

            success: function(data) {



                $("#uom_id_" + line_id).append(data);


            }
        });

    }



    function getSubcategory(cat_id){
        $.ajax({
		type: 'POST',
		data:{
			cat_id:cat_id
		},
        url: "../controllers/ajax/ajax_fetch_ap.php",    
		 success: function(result){
			$("#subcategory_id").empty();
			$("#subcategory_id").append(result);
            $("#subcategory_id").select2();
			// alert(result);
		 }
		});
    }



    </script>