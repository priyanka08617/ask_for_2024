<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Inventory Shifting</title>
    <?php 
 
              include '../includes/header.php'; 
              include '../includes/navbar.php'; 
              include '../includes/functions.php';
             
?>
    <style>
    .grText {
        color: green;
    }


    .redText {
        color: red;
    }

    .blueText {
        color: blueviolet;
    }
    </style>
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Inventory Location Shifting </h3>
        <small class='text-muted'>Start typing the item details, the stock will be shown accordingly.</small>
       
        <hr>
        <!-- <hr> -->
<br>


<form method="post" action="../controllers/shift_stock_cont.php">


        <div class='form-group row'>
            <div class='col-md-1'></div>
            <div class='col-md-2'><label class='control-label' for='uom'>
                   Item Name
                </label></div>
            <div class='col-md-8'>


                <select class="form-control" onchange="fetch_location_item_details(this.value);" name='item_details'
                    id='item_details' style="width:100%">
                    <option value="">--Select--</option>
                    <?php
$sql="SELECT p.product_id as product_id, concat(p.product_id,'2') as concated_id FROM price_management p WHERE p.status='1' AND location_id='$store_id'  UNION SELECT i.id as item_id, concat(i.id,'1')  FROM item i WHERE i.status='1'";


$query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query)){
    
    $item_concated_id=$row["concated_id"];

$item_type_after_split=substr($item_concated_id,-1);
$item_id_after_split= substr( $item_concated_id,0,-1);


    // $len = strlen($item_id); 
    //  $item_id_split=(explode($len-1,$item_id));

     if($item_type_after_split=='1'){
        $name="(D.P)";
        $product_name= singleRowFromTable($conn, "SELECT * FROM item WHERE id='$item_id_after_split'", "item");
      
      }elseif($item_type_after_split=='2'){
        $name="(A.P)";
        $product_name= singleRowFromTable($conn, "SELECT * FROM product WHERE id='$item_id_after_split'", "name");
      }


  echo "<option  value='".$row["concated_id"]."'>".$product_name." (".$row["concated_id"].") ".$name."</option>";
  }
  ?>
                </select>
            </div>
        </div>





        

        <!-- <br> -->




        <!-- <hr> -->

        <br>
        <br>
        <!-- Showing item details for item id - 1003 -->

        <div id="summary"></div>


        <!-- <div class="form-group row tohide">
        <div class="col-md-1"></div>
        <div class="col-md-2"><label class="control-label" for="uom">Item Details</label></div>
        <div class="col-md-8">

        </div>
        </div> -->
      


        
       






        <script>
        $("#item_details").select2();
        $("#to_location_details").select2();

        function fetch_location_item_details(item_id) {

            // alert(item_id);
            $("#summary").html("");
            // var d=$("#item_details").val();

            $.ajax({
                type: "get",
                data: {
                    item_id: item_id
                },
                url: "../controllers/ajax/ajax_find_item_stock_location_details_for_stock_shifting.php",
                success: function(rvalue) {
                    $("#summary").append(rvalue);
                }
            });
        }
        </script>