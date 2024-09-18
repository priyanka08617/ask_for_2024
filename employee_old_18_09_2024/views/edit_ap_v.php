<?php ob_start();
include '../includes/check.php';

$ass_product_id=$_GET['apid'];
// $ass_product_id="47";


$sqlp=mysqli_query($conn,"SELECT * FROM product WHERE id='$ass_product_id'");

$rowp=mysqli_fetch_array($sqlp);

// $status=$rowp['status'];
$category_id_p=$rowp['category_id'];
$subcategory_id_p=$rowp['subcategory_id'];
$price_p=$rowp['price'];
$name_p=$rowp['name'];
$qty_p=$rowp['qty'];
$uom_id_p=$rowp['uom_id'];
$hsn_table_id_p=$rowp['hsn_table_id'];
$hsn_rate_id_p=$rowp['hsn_rate_id'];
// $alias_p=$rowp['alias'];




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
<h3> Assembled Product Edit - <b> <?php echo $name_p; ?></b></h3><small class='text-muted'>Fill in the given below tab to create assemble product and manage
            existing product </small>
        <hr>
<br>
    <form class='form-horizontal' action='../controllers/product_update.php' method='post'>
    <?php echo " <input type='hidden'  class='form-control' value=".$ass_product_id." placeholder='Enter price (Optional)' name='ass_product_id' id='ass_product_id'>";?>
     
    <!-- <div class='form-group row'>
                        <div class='col-md-2'><label class='control-label' for='uom'>Item Type</label></div>
                        <div class='col-md-10'>

                            <select class='form-control' name='status' id='status'>
                                <option value=''>select</option>  
                                <option value='2'  <?php if($status == '2'){echo("selected");}?>>For Tender </option>       
                                <option value='1'  <?php if($status == '1'){echo("selected");}?>>Assembled Purchase</option>  
                                </select>
                        </div>
                    </div>
    
     -->
    
    
    
    
    <!-- //  content  1 -->
        <div class='form-group row'>

            <div class='col-md-2'><label class='control-label' for='uom'>Category</label></div>
            <div class='col-md-10'>

                <select class='form-control' name='category_id' required id='category_id'>
                    <option value=''>select</option>
                    <?php
 
                      $sql='SELECT * FROM assemble_purchase_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        if($id==$category_id_p){
                            echo '<option selected value="'.$id.'">'.$row['category'].'</option>';

                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['category'].'</option>';

                        }
                      }
            ?>
                </select>
            </div>
        </div>

        <!-- //  content  2 -->
        <div class='form-group row'>

            <div class='col-md-2'><label class='control-label' for='uom'>Sub-Category</label></div>
            <div class='col-md-10'>

                <select class='form-control' name='subcategory_id' required id='subcategory_id'>
                    <option value=''>select</option>
                    <?php
 
                      $sql='SELECT * FROM assemble_purchase_sub_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        if($id==$subcategory_id_p){
                            echo '<option selected value="'.$id.'">'.$row['sub_category'].'</option>';

                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['sub_category'].'</option>';

                        }
                        
                      }
            ?>
                </select>
            </div>
        </div>

        <!-- //  content  3 -->
        <div class='form-group row'>

            <div class='col-md-2'><label class='control-label' for='uom'>Price</label></div>
            <div class='col-md-10'>

            <?php echo " <input type='number' min='0' step='0.01' class='form-control' value=".$price_p." placeholder='Enter price (Optional)' name='price' id='price' disabled>";?>
            <small class="text-danger" style="font-style:italic">Price is selected by super admin you cant's Change</small>
               
            </div>
        </div>



        <!-- //  content  5 -->
        <div class='form-group row'>

            <div class='col-md-2'><label class='control-label' for='uom'>Name</label></div>
            <div class='col-md-10'>
               

                

                <div class="input-group ">
                <?php echo "  <input type='text' onkeyup='check_duplicate();' class='form-control' placeholder='Enter name' value='".$name_p."' name='name' required id='name'>";?>

<div class="input-group-append">
    <span class="input-group-text" id="username_check_response"></span>
</div>

</div>


            </div>
        </div>



      



        <!-- //  content  6 -->
        <div class='form-group row'>

            <div class='col-md-2'><label class='control-label' for='uom'>Qty</label></div>
            <div class='col-md-10'>
            <?php echo " <input type='number' min='1' class='form-control' placeholder='Enter qty' value=".$qty_p." required name='qty_ed' id='qty' step='0.01'>";?>
               
            </div>
        </div>

        <!-- //  content  7 -->
        <div class='form-group row'>

            <div class='col-md-2'><label class='control-label' for='uom'>UoM</label></div>
            <div class='col-md-10'>

                <select class='form-control' required name='uom_id_new_ed' id='uom_id'>
                    <option value=''>select</option>
                    <?php
 
                      $sql='SELECT * FROM uom WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];

                        if($id==$uom_id_p){
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

        <!-- //  content  8 -->
        <div class='form-group row'>

            <div class='col-md-2'><label class='control-label' for='uom'>Hsn Code</label></div>
            <div class='col-md-10'>
                <!-- <input type='text'  class='form-control' placeholder='Enter hsn_table_id' name='hsn_table_id' id='hsn_table_id'> -->
                <select class='form-control' name='hsn_table_id' required id='hsn_table_id'>
                    <option value=''>select</option>
                    <?php
 
                      $sql='SELECT * FROM hsn_table WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];

                        if($id==$hsn_table_id_p){
                            echo '<option selected value="'.$id.'">'.$row['code'].'</option>';

                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['code'].'</option>';

                        }


                        
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

                <select class='form-control' name='hsn_rate_id' required id='hsn_rate_id'>
                    <option value=''>select</option>
                    <?php
 
                      $sql='SELECT * FROM hsn_rate_master WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];

                        if($id==$hsn_rate_id_p){
                            echo '<option selected value="'.$id.'">'.$row['rate'].'</option>';


                        }
                        else{
                            echo '<option value="'.$id.'">'.$row['rate'].'</option>';


                        }


                      }
            ?>
                </select>

            </div>
        </div>




        <!-- <div class='form-group row'>

<div class='col-md-2'><label class='control-label' for='uom'>Alias</label></div>
<div class='col-md-10'>
    
        <?php echo " <input type='text'  class='form-control' placeholder='Enter Alias' value='".$alias_p."'  name='alias' id='alias'>";?>

</div>
</div> -->








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

                    <tbody id='table_block'>

                      

                            <?php
$c=1;
// echo "SELECT * FROM recipe WHERE product_id='$ass_product_id' AND status='1' ORDER BY table_name";
$sql=mysqli_query($conn,"SELECT * FROM recipe WHERE product_id='$ass_product_id' AND status='1' ORDER BY table_name");
while($row=mysqli_fetch_array($sql)){
    $item_id=$row['item'].$row['table_name'];
    // echo  $item_id."<br>";
    
$item_qty=$row['item_qty'];
$uom_id=$row['uom_id'];
// $uom=singleRowFromTable($conn,"SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
   
echo '<tr id="row_'.$c.'">';
echo '<td>'.$c.'</td>'; 
echo '<td><select class="form-control" onchange="fetch_item_uom('.$c.')"; required type="text" style="width:100%" name="item[]" id="item_'.$c.'"/>
     <option value="">----------------Select-------------------</option> 
    ';
   
   
   
//    $sqli="SELECT p.id as product_id, concat(p.id,'2') as concated_id, p.name as product_name FROM product p WHERE p.status='1'  
//    UNION 
//    SELECT i.id as item_id, concat(i.id,'1') , i.item as item_name FROM item i WHERE i.status='1' 
//    UNION 
//    SELECT j.id,  concat(j.id,'3') , j.item FROM job_work j WHERE j.status='1'";

      
$sqli="SELECT p.id as product_id, concat(p.id,'2') as concated_id, p.name as product_name FROM product p   
UNION 
SELECT i.id as item_id, concat(i.id,'1') , i.item as item_name FROM item i";

   $queryi=mysqli_query($conn,$sqli);
  while($rowi=mysqli_fetch_array($queryi)){


    $item_idi=$rowi["concated_id"];
   
     $item_id_split=substr($item_idi,-1);

     if($item_id_split=='1'){
        $name="(D.P)";
      }elseif($item_id_split=='2'){
        $name="(A.P)";
      }


      if($item_idi==$item_id){
        echo "<option selected value='".$rowi["concated_id"]."'>".$rowi["product_name"]." ".$name."</option>";

      }
      else{
        echo "<option  value='".$rowi["concated_id"]."'>".$rowi["product_name"]." ".$name."</option>";

      }
  }
   
 echo '</select></td>';
echo '<td><input class="form-control" required type="number" min="0.01" value="'.$item_qty.'" step="0.01" name="item_qty[]" id="item_qty_'.$c.'"/></td>';

echo '<td><select class="form-control"   required type="text" name="uom_id[]" id="uom_id_'.$c.'"/>
     <option value="">-----</option> 
   ';


//    $uom_id_y=$rowi['uom_id'];

   $dataUN =  fetch_data($conn,"uom","id",$uom_id);
//    $dataUN["uom_name"] 
   echo "<option value='".$uom_id."' selected>".$dataUN["uom_name"] ."</option>";

   $sqlcs="SELECT * FROM uom_conversion_setting WHERE form_unit_source='$uom_id' OR to_unit_source='$uom_id'";
   $resultcs=mysqli_query($conn,$sqlcs);
    while($rowcs=mysqli_fetch_array($resultcs)){
   

   if($rowcs["form_unit_source"]==$uom_id){
   
   
       $to_unit_source = $rowcs["to_unit_source"];
       $datacs =  fetch_data($conn,"uom","id",$to_unit_source);
         
       echo "<option value='".$rowcs["to_unit_source"]."'>". $datacs["uom_name"]."</option>";
   
   }elseif($rowcs["to_unit_source"]==$uom_id){
   
     $form_unit_source = $rowcs["form_unit_source"];
     $datacs =  fetch_data($conn,"uom","id",$form_unit_source);
       
       echo "<option value='".$rowcs["form_unit_source"]."'>". $datacs["uom_name"]."</option>";
   }


    }


   
echo'</select></td>';
echo '<td><span href="" class="btn btn-danger btn-block remove" onclick="remove_line('.$c.');"
id="row_rem_'.$c.'">Remove</span></td>';
echo '</tr>'; 
    $c++;
}


?>



                    </tbody>
                    <tr>
                        <td colspan='4'></td>
                        <td> <span class="btn btn-success btn-block" onclick="add_line();">Add</span>
                        </td>
                    </tr>
                   


                </table>
            </div>
        </div>
    





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

    var original_name="<?php echo $name_p; ?>";

    console.log(original_name);

    for (let index = 0; index < c; index++) {
        $("#item_"+index).select2();
        
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
                $("#item_"+c).select2();

            }
        });

    }

    function remove_line(id) {
        $("#row_" + id).remove();
    }



    
    function fetch_item_uom(line_id){

$("#uom_id_"+line_id).empty();
// alert(line_id);

var product_id=$("#item_"+line_id).val();
// alert(product_id);

$.ajax({
    data: {
        product_id: product_id
    },
    type: "GET",
    url: "../controllers/ajax/ajax_product_uoms.php",

    success: function(data) {

    

        $("#uom_id_"+line_id).append(data);


    }
});

}



    </script>

<script>
                    function check_duplicate() {
                        var name = $("#name").val();
                        var table_name = "product";
                        var table_col_name = "name";

                        if(name!=original_name){
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