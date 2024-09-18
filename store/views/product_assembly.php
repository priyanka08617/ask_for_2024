<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Stock Locations Details</title>
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
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3> Assembled Product Stock Generation Module</h3>
<p class='text-muted'>Fill in the given below tab to create and manage data.</p>
<hr></hr>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li   class="nav-item">
            <a class='nav-link active' data-toggle='tab' href='#home'>Assembled Product Stock Generation</a></li>
<li class="nav-item ">
            <a class='nav-link'  data-toggle='tab' href='#menu1'>Assembly History</a></li>
            </ul>






<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in active'>

<form class='form-horizontal' action='../controllers/add_assemble_product.php' method='post'>
     <!-- //  content  1 -->





 
            <div class='form-group row'>
            <div class='col-md-1'></div>
            <div class='col-md-2'>
                <label class='control-label' for='uom'>AP Creation</label>
            </div>
            <div class='col-md-8'>

                        <select class='form-control' name='product_id' id='product_id' onchange="fetch_uom(this.value);fetch_recipe();">
                        <option value=''>select</option>
                        <?php
            
                                $sql="SELECT * FROM price_management  WHERE status='1' AND location_id='$store_id'";
                                $result=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['id'];
                                    $product_id=$row['product_id'];
                                    $product_name= singleRowFromTable($conn, "SELECT * FROM product WHERE id='$product_id'", "name");
                                    echo '<option value="'.$product_id.'">'.$product_name.'</option>';
                                }
                        ?>
                        </select>
                        </div>
                    </div>



                     <!-- //  content  2 -->

            <div class='form-group row'>
            <div class='col-md-1'></div>
            <div class='col-md-2'><label class='control-label' for='uom'>Qty</label></div>
            <div class='col-md-8'>
            <div class='form-group row'>
                           <div class='col-md-6'>
                                 <input type='number' class='form-control' min='1' name='product_qty' id='product_qty' placeholder='Enter product qty' onchange="fetch_recipe()" >
                            </div>
                            <div class='col-md-6'>
                            
                            <input type='text'  class='form-control' name='uom' id='uom' readonly>
                            <input type='hidden'  class='form-control' name='uom_id' id='uom_id'>
                         
                           
                            </div>
                            </div>
                        </div>
                    </div>



            <div class='form-group row'>
            <div class='col-md-1'></div>
            <div class='col-md-2'>
                <label class='control-label' for='uom'>Location</label>
            </div>
            <div class='col-md-8'>

                        <select class='form-control' name='location_id' id='location_id' onchange="fetch_recipe()">
                        <!-- <option value=''>select</option> -->
                        <?php
            
                                $sql="SELECT * FROM location WHERE status='1' AND id='$store_id'";
                                $result=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['id'];
                                    $locations_category_id=$row['location_cat_id'];
                                    $locations_category= fetch_data($conn,"location_category","id",$locations_category_id);

                                    $location_name=$row['location'];
                                    echo '<option value="'.$id.'">'.$location_name." ( ".$locations_category["category"]." )".'</option>';
                                }
                        ?>
                        </select>
                        </div>
                    </div>



<!-- <hr> -->
<div class='form-group row'>
            <div class='col-md-1'></div>
            <div class='col-md-2'>
                            </div>
                            <div  class="col-md-8" id="box"></div>
</div>


</form>
</div>
<div id='menu1' class='tab-pane fade'>
<table class='table table-sm table-hover' id='example'>
<thead>
        <th>#</th>
        <th>Product Name</th>
        <th>Qty</th>
        <th>Recipe</th>
        <th>Date of entry</th>
        <!-- <th>Status</th> -->
</thead>

<tfoot>
        <th>#</th>
        <th>Product Name</th>
        <th>Qty</th>
        <th>Recipe</th>
        <th>Date of entry</th>
        <!-- <th>Status</th> -->
</tfoot>
<tbody>
 <!-- // ************************************************************  -->
<?php
   $c=0; 
 
              $sql='SELECT * FROM assembled_product WHERE status="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                $c++;
               
$id = $row['id']; 
$qty     = $row['qty'];
$uom_id  = $row['uom_id'];   
$product_id = $row['product_id'];
$date_of_entry = $row['date_of_entry'];
$status  = $row['status'];
$inventory_transfer_id  = $row['inventory_transfer_id'];


$product = fetch_data($conn,"product","id",$product_id);
$uom = fetch_data($conn,"uom","id",$uom_id);
// if($inventory_transfer_id==0){
//     $action_status="";
//     $action_status_val="";
// }else{
//     $action_status=fetch_data($conn,"inventory_transfer","id",$inventory_transfer_id);
//     $action_status_val=inventory_transfer_status($conn,$action_status['status']);
  
// }


 echo '<tr>';
 echo '<td>'. $c.'</td>';
 echo '<td>'. $product['name'].'</td>';
 echo '<td>'. $qty." ".$uom["uom_name"].'</td>';
 echo '<td> <button type="button" class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#demo'.$id.'" onclick="fetch_recipe_view('.$id.')" ">view</button><div id="demo'.$id.'" class="collapse abc"></div></td>';
 echo '<td>'.dateForm($date_of_entry).'</td>';
//  echo '<td>'.$action_status_val.'</td>';
  

// echo '<td><a href="../controllers/stock_locations_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
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

<h4 class='modal-title'>Stock Locations Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/stock_locations_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Locations Category</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='locations_category_id_E' id='locations_category_id_E'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM location_category WHERE status="1"';
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
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Location Name</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter location_name' name='location_name_E' id='location_name_E'>
</div>
</div>

 <!-- //  content  3 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Location Address</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter location_address' name='location_address_E' id='location_address_E'>
</div>
</div>

 <!-- //  content  4 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Phone No</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter phone_no' name='phone_no_E' id='phone_no_E'>
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
</div></div>

<script>

function openModel(id,locations_category_id,location_name,location_address,phone_no,status){

$('#id_E').val(id);
$('#locations_category_id_E').val(locations_category_id);
$('#location_name_E').val(location_name);
$('#location_address_E').val(location_address);
$('#phone_no_E').val(phone_no);

}


function  fetch_uom(product_qty){
    var product_id = $("#product_id").val();
    $.ajax({
            type:"POST",
            data:{
                product_id:product_id
            },
            url:"../controllers/ajax/ajax_find_uom_of_product.php",
              success:function(uom_id){

            //    var uom =(explode("-",$uom_id));
         var   uom = uom_id.split('-');
            // alert(uom_id);
            $("#uom").val(uom[0]);
            $('#uom_id').val(uom[1]);
            console.log(uom_id);
              }
          });
}



function fetch_recipe(){

 var product_id =   $("#product_id").val();
 var product_qty =  $("#product_qty").val();
 var location_id =  $("#location_id").val();
 var product_uom_id =  $("#uom_id").val();
 
//  alert(product_qty);

if(product_qty!="" && location_id!=""){

    $.ajax({
            type:"POST",
            data:{
                product_id:product_id,
                product_qty:product_qty,
                location_id:location_id,
                product_uom_id:product_uom_id,
            },
            url:"../controllers/ajax/ajax_find_recipe.php",
              success:function(rvalue){
                // alert(rvalue);

            $("#box").empty();
            $("#box").append(rvalue);
              }
          });
        }
}




function fetch_recipe_view(product_id){
    // alert(product_id);
    $.ajax({
            type:"POST",
            data:{
                product_id:product_id
            },
            url:"../controllers/ajax/ajax_fetch_recipe_view.php",
              success:function(recipe_view){
                // alert(rvalue);

            $(".abc").empty();
            $(".abc").append(recipe_view);
              }
          });
}



$(document).ready( function () {

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





    $("#location_id").select2();
    // $("#uom_id").select2();
    // $("#location_id").select2();
    $("#product_id").select2();
    });
</script>