<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Item Details</title>
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
<h3> Tender Details </h3><small class='text-muted'>Show in the given below tab  manage
            existing product .</small>
            <hr>

<ul class='nav nav-tabs nav-justified'>
        <li class='nav-item'>
                  <a   class='nav-link active' data-toggle='tab' href='#home'>Tender Item (D.P) </a></li>
          <li class='nav-item'>
                  <a class='nav-link'  data-toggle='tab' href='#menu1'>Tender Item (A.P)  </a></li>
        </ul>





        <div class='tab-content'>
<div id='home' class='tab-pane in active'>

<br><br>
<table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Item</th>
                        <th>Uom</th>
                        <th>Part No.</th>
                        <th>Hsn Code</th>
                        <th>Hsn Rate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>


                    <tfoot>
                        <th>#</th>
                        <th>Item</th>
                        <th>Uom</th>
                        <th>Part No.</th>
                        <th>Hsn Code</th>
                        <th>Hsn Rate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tfoot>

                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=1; 
 
              $sql='SELECT * FROM item WHERE status="2" order by id desc';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$item=$row['item'];
$uom_id=$row['uom_id'];
$uom=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
$part_no=$row['part_no'];
$hsn_table_id=$row['hsn_table_id'];
$hsn_code=singleRowFromTable($conn, "SELECT * FROM hsn_table WHERE id='$hsn_table_id'", "code");
$hsn_rate_id=$row['hsn_rate_id'];
$hsn_rate=singleRowFromTable($conn, "SELECT * FROM hsn_rate_master  WHERE id='$hsn_rate_id'", "rate");
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $row['item'].'</td>';
 echo '<td>'. $uom.'</td>';
 echo '<td>'. $row['part_no'].'</td>';
 echo '<td>'. $hsn_code.'</td>';
 echo '<td>'. $hsn_rate.'</td>';
$c++
;$edit_modal_params_string="'$id','$item','$uom_id','$part_no','$hsn_table_id','$hsn_rate_id','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/tender_del.php?id='.$id.'&table_status=1" onclick="return confirm(\'Are you sure?\')"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
 echo '</tr>';
}
 ?>
                    </tbody>
                </table>
</div>
<div id='menu1' class='tab-pane fade'>

<br><br>
<table class='table' id='example1'>
                    <thead>
                        <th>#</th>
                        <th>Product</th>
                        <th>Alias</th>
                        <th>Category</th>
                        <th>Sub-category</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Hsn Code</th>
                        <th>Hsn %</th>
                        <th>Assembly</th>
                        <th>Mutate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </thead>


                    <!-- <tfoot>
                        <th>#</th>
                        <th>Product</th>
                        <th>Alias</th>
                        <th>Category</th>
                        <th>Sub-category</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Hsn Code</th>
                        <th>Hsn %</th>
                        <th>Assembly</th>
                        <th>Mutate</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tfoot> -->

                    <tbody>
                        <!--- // ************************************************************ -->
  <?php

  
function fetch_receipe($conn,$ass_product_id){
    $item_str="<br><div class='card' style='padding:20px;'><br><b>Item Details</b><table class='table mt-3'>
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
            $item_name=singleRowFromTable($conn,"SELECT * FROM item WHERE id='$item_id'", "item")." (D.P.)";
            
        }
elseif($row['table_name']==2){
    $item_name=singleRowFromTable($conn,"SELECT * FROM product WHERE id='$item_id'", "name")." (A.P.)";

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







    $job_str="<div class='card' style='padding:20px;'><br><b>Job Details</b><table class='table mt-3'>
    <tr>
    <th>#</th>
    <th>Job Name</th>
    <th>Qty</th>
    </tr>";
    $a=1;
    // echo "SELECT * FROM recipe WHERE id='$ass_product_id' AND status='1' AND table_name='3'";
    $sql=mysqli_query($conn,"SELECT * FROM recipe WHERE product_id='$ass_product_id' AND status='1' AND table_name='3'");
    while($row=mysqli_fetch_array($sql)){
        $item_id=$row['item'];

        
    $item_name=singleRowFromTable($conn,"SELECT * FROM job_work WHERE id='$item_id'", "item")." (J.W.)";


$item_qty=$row['item_qty'];
$uom_id=$row['uom_id'];
$uom=singleRowFromTable($conn,"SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
       
        $job_str.="<tr>
        <td>".$a."</td>
        <td>".$item_name."</td>
        <td>".$item_qty ." ".$uom."</td>
        </tr>";
        $a++;
    }

    $job_str.="</table></div>";

return $item_str."<hr>".$job_str;


}




                        $c=1; 
 
 $sql='SELECT * FROM product WHERE status="2" ORDER BY id DESC';
 $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($result)){
   
  $id=$row['id'];
  $status=$row['status'];
$category_id=$row['category_id'];
$category=singleRowFromTable($conn,"SELECT * FROM assemble_purchase_category WHERE id='$category_id'", "category");

$subcategory_id=$row['subcategory_id'];
$subcategory=singleRowFromTable($conn,"SELECT * FROM assemble_purchase_sub_category WHERE id='$subcategory_id'", "sub_category");



$price=$row['price'];

$name=$row['name'];
$qty=$row['qty'];

$uom_id=$row['uom_id'];
$uom=singleRowFromTable($conn,"SELECT * FROM uom WHERE id='$uom_id'", "uom_name");

$hsn_table_id=$row['hsn_table_id'];
$hsn_code=singleRowFromTable($conn,"SELECT * FROM hsn_table WHERE id='$hsn_table_id'", "code");

$hsn_rate_id=$row['hsn_rate_id'];
$hsn_rate=singleRowFromTable($conn,"SELECT * FROM hsn_rate_master WHERE id='$hsn_rate_id'", "rate");

echo '<tr>';
echo '<td>'.$c.'</td>';
echo '<td>'. $row['name'].'</td>';
echo '<td>'. $row['alias'].'</td>';
echo '<td>'. $category.'</td>';
echo '<td>'. $subcategory.'</td>';


echo '<td>'. $row['qty'].' '.$uom.'</td>';
//  echo '<td>'. $uom.'</td>';
echo '<td>'. $row['price'].'</td>';

echo '<td>'. $hsn_code.'</td>';
echo '<td>'. $hsn_rate.'</td>';


echo '<td> <button data-toggle="collapse" class="btn btn-info btn-block" style="width:400px;" data-target="#demo'.$c.'">View Details </button>
<div id="demo'.$c.'" class="collapse well" >

'.fetch_receipe($conn,$id).'
</div> </td>';

echo '<td><a class="btn btn-success" href="mutate.php?apid='.$id.'">Mutate</a></td>';


echo '<td><a class="btn btn-warning" href="edit_ap_v.php?apid='.$id.'">Edit</a></td>';
echo '<td><a href="../controllers/tender_del.php?id='.$id.'&table_status=2" onclick="return confirm(\'Are you sure?\')"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
echo '</tr>';
$c++;
}
?>
                    </tbody>
                </table>




</div>
</div>
</div>
</body>
<script>
    $(document).ready(function() {

        $("#example1").dataTable();


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






    });
    </script>
</html>