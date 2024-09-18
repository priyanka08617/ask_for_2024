<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php';
$inventory_transfer_id=$_GET['inventory_transfer_id'];
$itm_status=singleRowFromTable($conn, "SELECT * FROM inventory_transfer WHERE id='$inventory_transfer_id' AND location_id='$store_id'", "status");
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Inventory Transfers Details</title>
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
        <h3> Inventory Transfers Details <?php echo ($itm_status==1)?("<span style='color:orange'> - Action Pending </span>"):("<span style='color:green'> - Action Performed</span>"); ?> </h3><small class='text-muted'>Show in the given below tab to  manage the
            existing data Inventory Transfers Details </small>
   
        <hr>
        <!-- </hr> -->




        <table class='table table-sm table-hover' id='example'>
            <thead>
                        <th>#</th>
                        <th>Item</th>
                        <th>Item Type</th>
                        <th>Quantity</th>
                        <th>Uom</th>
                        <th>Movement</th>
                        <?php if($itm_status==2){ echo '<th>Location</th>';}?>
                        <th>Total Stock</th>
                    </thead>
                    <tfoot>
                        <th>#</th>
                        <th>Item</th>
                        <th>Item Type</th>
                        <th>Quantity</th>
                        <th>Uom</th>
                        <th>Movement</th>
                        <?php if($itm_status==2){ echo '<th>Location</th>';}?>
                        <th>Total Stock</th>
             
                    </tfoot>
                   <?php 
                     $c=0;
                   $sql=mysqli_query($conn,"SELECT * FROM inventory_transfer_details WHERE  inventory_transfer_id='$inventory_transfer_id'");
                
                   while($row=mysqli_fetch_array($sql)){
                    $c++;
                    
                    $item_id=$row['item_id'];
                   $item_type=$row['item_type'];
                   $transfer_type=$row['transfer_type'];;
                    if($row['item_type']==1){
                       $item= fetch_data($conn,"dp","id",$row['item_id']);
                       $item_name=$item["item"];
                    }elseif($row['item_type']==2){
                        $item= fetch_data($conn,"ap","id",$row['item_id']);
                       $item_name=$item["name"];
                    }
                    echo "<tr>";
                    echo "<td>".$c."</td>";
                    echo "<td>".$item_name."</td>";
                    if($row['item_type']==1){
                        echo "<td>Direct Purchase</td>";
                    }
                    else{
                        echo "<td>Assembled Product </td>";
                    }
                    

                    echo "<td>".$row['quantity']."</td>";

                    $uom= fetch_data($conn,"uom","id",$row['uom_id']);
                    echo "<td>".$uom['uom_name']."</td>";

                    if($row['transfer_type']==1){
                        echo "<td style='color:green; font-weight:bold;'>Inward Transfer</td>";
                    }
                    else{
                        echo "<td style='color:red; font-weight:bold;'>Outward Transfer</td>";
                    }


                   if($itm_status==2){ 
                    
                    // $location_id=singleRowFromTable($conn, "SELECT * FROM stock_transfer_location WHERE inventory_transfer_id='$inventory_transfer_id' AND item_id='$item_id' AND transfer_type='$transfer_type' AND item_type='$item_type'", "location_id");
                    $location_id=$row['location_id'];

$location_name=singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location");
$location_category_id=singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location_cat_id");
$location_category=singleRowFromTable($conn, "SELECT * FROM  location_category  WHERE id='$location_category_id'", "category");


                    echo '<td>'.$location_name.' ('.$location_category.')</td>';
                
                }
                    
                    $total_stock_qty=find_stock_quantity_from_location_id($conn, $row['item_id'],$row['item_type'],$store_id);

                    echo "<td>".$total_stock_qty['total']." ".$total_stock_qty['uom_name']."</td>";
                    echo "</tr>";

                   }
                   ?>
                   </table>
        </table>

    </div>
    <!--// container-fluid -->

    <!-- The Modal -->
    <div class='modal' id='myModal'>

        <div class='modal-dialog modal-lg'>

            <div class='modal-content'>

                <!-- Modal Header -->

                <div class='modal-header'>

                    <h4 class='modal-title'>Item Details</h4>

                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                </div>

                <!-- Modal body -->

                <div class='modal-body'>
                   <table>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Item Type</th>
                        <th>Uom</th>
                        <th>Movement</th>
                    </tr>

                   <?php 
                //    $sql=mysqli_query($conn,"SELECT * FROM stock_location_transfer_details WHERE  stock_location_transfer_id=''");
                   ?>
                   </table>

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
    function openModel(id, rail_zone, status) {
        $('#id_E').val(id);
        $('#rail_zone_E').val(rail_zone);
    }


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
        //[ -1 ],
        //['Showing all' ]
        //],
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
    </script>