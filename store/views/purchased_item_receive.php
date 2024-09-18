<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';

$po_id=$_GET["pi_id"];


?>
<!DOCTYPE html>
<html>

<head>
    <title>Purchase Resume Inventory || </title>
    <?php include '../includes/header.php';?>
    <style>
    tfoot {
        display: table-header-group;
    }

    tfoot input {
        width: 100%;
    }


    .unselectable {
        background-color: #ddd;
        cursor: not-allowed;
    }
    </style>
</head>

<body>
    <?php include '../includes/navbar.php'; ?>

    <div id="Order">
        <?php
      $sql="SELECT * FROM purchase WHERE id='$po_id'";
      $query=mysqli_query($conn,$sql);
      $row=mysqli_fetch_array($query);
      $po_no=$row["invoice_no"];
      $distributor_id =$row["distributor_id"];
      $distributor= fetch_data($conn,"vendor","id",$distributor_id);
    //   $po= fetch_data($conn,"inventory_details","po_id",$po_id);
      $po= fetch_data($conn,"purchase_details","po_id",$po_id);
      
    ?>

        <div class="container-fluid">

            <form action="../controllers/add_purchase_complete_entry.php" method="post">

                <input id="po_id" name="po_id" class="form-control" type="hidden" value="<?php echo $po_id;?>">


                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        <p>PO Invoice </p>
                    </div>
                    <div class="col-sm-6">
                        <input id="invoice_no" name="invoice_no" class="form-control" placeholder="Enter invoice number"
                            type="text" required="" value="<?php echo $po_no;?>" readonly>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        <p>Select Distributor</p>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" id="distributor_id" name="distributor_id" class="form-control"
                            value="<?php echo $distributor['name'];?>" readonly>
                    </div>
                </div>

         
                        <table class="table table table-sm table-hover table-striped">
                            <thead>

                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Disc (%)</th>
                                <th>Tax (%)</th>
                            </thead>

                            <tbody>

                                <?php
        $c=0;
        $total=0;
        $sql="SELECT * FROM purchase_details WHERE po_id='$po_id'";
        
        $query=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($query);
   while($row=mysqli_fetch_array($query)){
     $c++;

$item_id_concated=$row["item_id"];

$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);
$item_product=check_item_or_product_data($conn,$item_id,$item_type);

$id=$row["id"];
$unit_id=$row["unit_id"];
$unit= fetch_data($conn,"uom","id",$unit_id);
$qty=$row["qty"];
// $rate=$row["rate"];
$disc=$row["discount"];
$tax=$row["tax"];

    echo   '<input type="hidden" id="id" name="id[]" value="'.$id.'">';
    echo "<tr  class='unselectable'>";
    echo "<td>".$c."</td>";
    echo "<td>".$item_product["name"]."</td>";
    echo "<td>".$qty."</td>";
    echo "<td>".$unit["uom_name"]."</td>";
    echo "<td>".$disc."</td>";
    echo "<td>".$tax."</td>";
    echo "</tr>";
}
?>
                            </tbody>
                        </table>
                        <!-- <div id="serial_no" class="row"></div><br> -->


 
              

              

                <div class="row">
                    <div class="col-md-12">
                        <button id="submit" name="submit" class="btn btn-primary btn-block">Received</button>
                    </div>
                </div>



                <bR><br><br>
            </form>
        </div>
    </div>
</body>

</html>