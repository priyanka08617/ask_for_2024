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
  $sql="SELECT p.id as product_id, concat(p.id,'2') as concated_id,p.name as product_name FROM product p WHERE p.status='1'  UNION SELECT i.id as item_id, concat(i.id,'1') , i.item as item_name FROM item i WHERE i.status='1'";
// $sql="SELECT * FROM item WHERE status='1'";  
$query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query)){
    
//   echo "<option  value='".$row["id"]."'>".$row["item"]."</option>";

    $item_id=$row["concated_id"];
    $len = strlen($item_id); 
     $item_id_split=(explode($len-1,$item_id));

     if($item_id_split[1]=='1'){
        $name="(D.P)";
      }elseif($item_id_split[1]=='2'){
        $name="(A.P)";
      }


  echo "<option  value='".$row["concated_id"]."'>".$row["product_name"]." (".$row["concated_id"].") ".$name."</option>";
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


    //     function check_uom_for_max_qty(uom_id,c,location_id,item_id,item_type){
            
    //    var stock_qty=     $("#stock_quantity"+c).val();
    //    alert(uom_id+" "+c+" "+item_id+" "+item_type+" "+stock_qty);
    //         $.ajax({
    //             type: "get",
    //             data: {
    //                 uom_id: uom_id,
    //                 c: c,
    //                 location_id: location_id,
    //                 item_id: item_id,
    //                 item_type: item_type,
    //                 qty: stock_qty
    //             },
    //             url: "../controllers/ajax/uom_check_for_max.php",
    //             success: function(max_value) {
    //                 // $("#summary").append(rvalue);

    //                 // $("input").attr({"max" : max_value });
    //                 // $('#stock_quantity'+c).prop('maxLength', max_value);
    //                 // alert(max_value);
    //                 $('input#stock_quantity'+c).attr('max', max_value); 

    //             }
    //         });

    //     }
        </script>