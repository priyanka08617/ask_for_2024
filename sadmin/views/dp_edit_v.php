<?php ob_start();
include '../includes/check.php';

$dp_id=$_GET['dp_id'];
// $ass_product_id="47";


$sqlp=mysqli_query($conn,"SELECT * FROM dp WHERE id='$dp_id'");
$rowp=mysqli_fetch_array($sqlp);


$cat_id=$rowp['cat_id'];
$sub_cat_id=$rowp['sub_cat_id'];
$mtm=$rowp['mtm'];
$name=$rowp['name'];
$sku=$rowp['sku'];
$short_code=$rowp['short_code'];
$qty=$rowp['qty'];
$uom_id=$rowp['uom_id'];
$hsn_table_id_p=$rowp['hsn_table_id'];
$barcode_p=$rowp['barcode'];
$alias_p=$rowp['alias'];




?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title>Edit Assembled Product</title>
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

    <!-- <script>
         $(document).ready(function() {


$('#product_submit').attr('disabled', true);
         });
    </script> -->
</head>

<body>



    <div class="container-fluid">
        <h3> Assembled Product Edit - <b> <?php echo $name; ?></b></h3><small class='text-muted'>Fill in the given below
            tab to create assemble product and manage
            existing product </small>
        <hr>
        <br>
        <form class='form-horizontal' action='../controllers/product_update.php' method='post'>
            <?php echo " <input type='hidden'  class='form-control' value=".$dp_id."  name='dp_id' id='dp_id'>";?>



            <!-- //  content  1 -->
            <div class='form-group row'>

                <div class='col-md-6'>
                    <div class='row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Category</label></div>
                        <div class='col-md-10'>

                            <select class='form-control' name='category_id' required id='category_id'>
                                <option value=''>select</option>
                                <?php
 
                      $sql='SELECT * FROM dp_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        if($id==$cat_id){
                            echo '<option selected value="'.$id.'">'.$row['category_name'].'</option>';

                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['category_name'].'</option>';

                        }
                      }
            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='row'>
                        <div class='col-md-3'><label class='control-label' for='uom'>Sub-Category</label></div>
                        <div class='col-md-9'>

                            <select class='form-control' name='subcategory_id' required id='subcategory_id'>
                                <option value=''>select</option>
                                <?php
 
                      $sql='SELECT * FROM dp_subcategory WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        if($id==$sub_cat_id){
                            echo '<option selected value="'.$id.'">'.$row['dp_subcategory'].'</option>';

                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['dp_subcategory'].'</option>';

                        }
                        
                      }
            ?>
                            </select>
                        </div>



                    </div>
                </div>

            </div>

            <!-- //  content  2 -->
            <div class='form-group row'>

                <div class='col-md-6'>
                    <div class='row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>MTM</label></div>
                        <div class='col-md-10'>
                            <div class="input-group">
                                <?php echo "  <input type='text' onkeyup='check_duplicate();' class='form-control' placeholder='Enter MTM' value='".$mtm."' name='item' required id='name'>";?>

                                <div class="input-group-append">
                                    <span class="input-group-text" id="username_check_response"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class='col-md-6'>
                    <div class='row'>
                        <div class='col-md-3'><label class='control-label' for='uom'>Short Code</label></div>
                        <div class='col-md-9'>
                            <input type='text' class='form-control' placeholder='Enter Short Code' name='short_code'
                                id='short_code' value='<?php echo $short_code;?>'>
                        </div>
                    </div>

                </div>
            </div>


    <!-- </div> -->




    <div class='form-group row'>


        <div class='col-md-6'>
            <div class='row'>
                <div class='col-md-2'><label class='control-label' for='uom'>Name</label></div>
                <div class='col-md-10'>
                    <input type='text' class='form-control' placeholder='Enter  Name' name='name' id='name'
                        value='<?php echo $name;?>'>
                </div>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='row'>
                <div class='col-md-3'><label class='control-label' for='uom'>SKU</label></div>
                <div class='col-md-9'>
                    <input type='text' class='form-control' placeholder='Enter Short Code' name='short_code'
                        id='short_code' value='<?php echo $sku;?>'>
                </div>

            </div>

        </div>
    </div>









    <div class='form-group row'>
    <!-- //  content  6 -->

    <div class='col-md-6'>
    <div class='row'>
        <div class='col-md-2'><label class='control-label' for='uom'>Hsn Code</label></div>
        <div class='col-md-10'>
            <select class='form-control' name='hsn_table_id' required id='hsn_table_id'>
                <option value=''>select</option>
                <?php
 
                      $sql='SELECT * FROM hsn_table WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];

                        if($id==$hsn_table_id){
                            echo '<option  value="'.$id.'" selected>'.$row['code'].'</option>';

                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['code'].'</option>';

                        }


                        
                      }
            ?>
            </select>

        </div>
    </div>   </div>

    <!-- //  content  7 -->
    <div class='col-md-6'>
    <div class='row'>

        <div class='col-md-3'><label class='control-label' for='uom'>UoM</label></div>
        <div class='col-md-9'>

            <select class='form-control' required name='uom_id_new_ed' id='uom_id'>
                <option value=''>select</option>
                <?php
 
                      $sql='SELECT * FROM uom WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];

                        if($id==$uom_id){
                            echo '<option selected value="'.$id.'">'.$row['uom_name'].'</option>';

                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['uom_name'].'</option>';

                        }

                        
                      }
            ?>
            </select>
        </div>
    </div>


    </div>   </div>



    
   




    

<div class='form-group row'>
<div class='col-md-6'>
                   <div class='row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Barcode</label></div>
                        <div class='col-md-10'>

                            <input type='text' class='form-control' name='barcode' id='barcode' placeholder="Enter Barcode" value='<?php echo $barcode_p;?>'>
                              
                        </div>
                    </div>
</div>
<div class='col-md-6'>



            <div class='row'>
                                    
                                    <div class='col-md-3'><label class='control-label' for='uom'>Alias</label></div>
                                    <div class='col-md-9'>

                                        <input type='text' class='form-control' name='alias' id='alias' placeholder="Enter Alias" value="<?php echo $alias_p;?>">
                                          
                                    </div>
            </div>

</div>
</div>








<?php 

 function fetchAllColumnName($conn,$head_id){
    $d="";
    $sql="SELECT * FROM specification_subhead WHERE specification_head_id='$head_id' AND  status='1'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){
     $head_id=$row["id"];
     $head_name=$row["subhead_name"]; 
     $d.="<div class='col-md-4'><select class='form-control' name='subhead_id[]' id='specification_data".$head_id."'>";
     $d.="<option value=''>".$head_name."</option>";
     $sql1="SELECT * FROM specification_subhead_data WHERE specification_subhead_id='$head_id' AND  status='1'";
     $query1=mysqli_query($conn,$sql1);
     while($row1=mysqli_fetch_array($query1)){
        $d.="<option value='".$row1["id"]."' >".$row1["subhead_data"]."</option>";
     }
$d.="</select></div>";
    }

    return $d;
 }


$data="";

$data.='<table class="table table-sm table-bordered">
          <thead>
              <tr>
                  <th style="width:20%">Head</th>
                  <th >Data</th>
              </tr>
          </thead>';

  $sql="SELECT * FROM specification_head WHERE `status`='1' AND `category_id`='$cat_id'";
       $query=mysqli_query($conn,$sql);
       $num_rows=mysqli_num_rows($query);
       if($num_rows>0){
       while($row=mysqli_fetch_array($query)){
        $head_id=$row["id"];
        $tabName=$row["head_name"]; 
        $fetchClm=fetchAllColumnName($conn,$head_id);

     

     
$data.='<tbody><tr><th>'.$tabName.'</th><td><div class="row">';
$data.=$fetchClm;
$data.= "</div><script>$('#specification_data".$head_id."').select2();</script>";
$data.='</td></tr>';

}
        
$data.='</tbody></table>';
echo $data;
       }


 
?>




    <div class='form-group row'>
        <div class='col-md-2'></div>
        <div class='col-md-10'>

            <button type='submit' id="product_submit" class='btn btn-primary btn-block btn-sm'>Submit</button>

        </div>
    </div>

    </form>

    </div>



    <script>
    var c = <?php echo ($c-1); ?>;

    var original_name = "<?php echo $name_p; ?>";

    console.log(original_name);

    for (let index = 0; index < c; index++) {
        $("#item_" + index).select2();

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
    </script>

    <script>
    function check_duplicate() {
        var name = $("#name").val();
        var table_name = "product";
        var table_col_name = "name";

        if (name != original_name) {
            // $('#product_submit').attr('disabled', false);

            // }
            // else{

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

    }


    $("#uom_id").select2();
    $("#hsn_table_id").select2();
    $("#hsn_rate_id").select2();
    </script>



</body>

</html>