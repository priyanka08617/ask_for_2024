<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Inventory Timeline</title>
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

    .grText{
        color: green;
    }

    
    .redText{
        color: red;
    }

    .blueText{
        color: blueviolet;
    }
    </style>
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Item Timeline </h3>
        <small class='text-muted'>Start typing the item details, the timeline will be shown accordingly.</small><hr>
        <!-- <hr> -->


        <div class='form-group row'>
<div class='col-md-1'></div>
<div class='col-md-2'><label class='control-label' for='uom'><h5>Item Details</h5></label></div>
<div class='col-md-8'>


<select class="form-control"  onchange="fetch_location_item_details(this.value);" name='item_details' id='item_details'  style="width:100%">
     <option value="">--Select--</option>
    <?php
//   $sql="SELECT p.id as product_id, concat(p.id,'2') as concated_id,p.name as product_name FROM product p WHERE p.status='1'  UNION SELECT i.id as item_id, concat(i.id,'1') , i.item as item_name FROM item i WHERE i.status='1'";

$sql="SELECT p.product_id as product_id, concat(p.product_id,'2') as concated_id FROM price_management p WHERE p.status='1' AND location_id='$store_id'  UNION SELECT i.id as item_id, concat(i.id,'1')  FROM item i WHERE i.status='1'";

 
$query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query)){
    
    $item_concated_id=$row["concated_id"];
    // $len = strlen($item_id); 
    //  $item_id_split=(explode($len-1,$item_id));


$item_type_after_split=substr($item_concated_id,-1);
$item_id_after_split= substr( $item_concated_id,0,-1);



     if($item_type_after_split=='1'){
        $name="(d.p)";
        $product_name= singleRowFromTable($conn, "SELECT * FROM item WHERE id='$item_id_after_split'", "item");
      }elseif($item_type_after_split=='2'){
        $name="(a.p)";
        $product_name= singleRowFromTable($conn, "SELECT * FROM product WHERE id='$item_id_after_split'", "name");
      }


  echo "<option  value='".$item_concated_id."'>".$product_name." ".$name."</option>";
  }
  ?>
  </select>
</div>
</div>
<hr>

<!-- <br> -->
<!-- <br> -->
<!-- Showing item details for item id - 1003 -->

<div  id="summary"></div>
    <script>
        $("#item_details").select2();

   function fetch_location_item_details(item_id){
    
// alert(item_id);
    $("#summary").html("");
    // var d=$("#item_details").val();
    
          $.ajax({
            type:"get",
            data:{
                item_id:item_id
            },
            url:"../controllers/ajax/ajax_find_item_timeline.php",
              success:function(rvalue){
            $("#summary").append(rvalue);

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







              }
          });
   }
    </script>