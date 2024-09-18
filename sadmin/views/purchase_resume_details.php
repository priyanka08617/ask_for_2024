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

                <!-- <hr> -->

                <div class="card">
                    <div class="card-body">
                        <table class="table table table-sm table-hover table-bordered">
                            <thead>

                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>MRP</th>
                                <th>Disc (%)</th>
                                <th>Tax (%)</th>
                                <th>Total</th>
                                <th>Action</th>
                            </thead>

                            <tbody id="box">

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
$rate=$row["rate"];
$disc=$row["discount"];
$tax=$row["tax"];
$price=$row["price"];
$total+=$row["price"];

// echo $num;
    // echo   '<input type="hidden" id="count" name="count" value="'.$num.'">';
    echo   '<input type="hidden" id="id" name="id[]" value="'.$id.'">';
    echo "<tr  class='unselectable'>";
    echo "<td>".$c."</td>";
    echo "<td><input type='text' class='form-control' value='".$item_product["name"]."'  readonly></td>";
    echo "<td><input type='text' class='form-control' value='".$qty."' readonly></td>";
    echo "<td><input type='text' class='form-control' value='".$unit["uom_name"]."' readonly></td>";
    echo "<td><input type='text' class='form-control' value='".$rate."' readonly></td>";
    echo "<td><input type='text' class='form-control' value='".$disc."' readonly></td>";
    echo "<td><input type='text' class='form-control' value='".$tax."' readonly></td>";
    echo "<td><input type='text' class='form-control' value='".$price."' readonly></td>";
    echo "<td></td>";
    echo "</tr>";
}
?>



                            </tbody>
                           
                            <!-- <tr>
                                <td colspan="5"><button id="additems_for_resume"
                                        class="btn btn-success btn-block btn-sm" type="button">Add Items</button>
                                </td>
                                <td colspan="2">
                                    <p><b>Grand Total</b></p>
                                </td>
                                <td colspan="4">
                                    <input type="text" id="grand_total" name="grand_total" class="form-control"
                                        readonly>
                                </td>
                            </tr> -->

                        </table>
                        <div id="serial_no" class="row"></div><br>

 <div class="row">
         <div class="col-md-6">
            <input type="text" id="count" value="<?php echo $num;?>">
            <button id="additems_for_resume"   class="btn btn-success btn-block btn-sm" type="button">Add Items</button>
        </div>
        <div class="col-md-6">
        <input type="text" id="grand_total" name="grand_total" class="form-control"  readonly> 
        </div>
</div>


                     
                    </div>
                </div>


                <input type="hidden" id="t" name="t" value="<?php echo $total;?>">

                <div class="card">
                    <div class="card-header">
                        <h5>Payment Details</h5>
                    </div>
                    <div class="card-body">




                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">

                                    <div class="col-sm-4">
                                        <label for="name">Total Amount</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" value="<?php echo $total;?>" class="form-control">
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Pay Status </p>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="radio" id="vehicle1" name="pay_status" value="1"
                                            onclick="get_pay_status(this.value)">
                                        <label for="vehicle1"> Paid</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type="radio" id="vehicle2" name="pay_status" value="2"
                                            onclick="get_pay_status(this.value)">
                                        <label for="vehicle2"> Un- Paid</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div id="paid">


                                    <div class="row">

                                        <div class="col-md-3">
                                            <p>Mode of payment</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Amount</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Payment Type</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Slip No</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php
                              $sql="SELECT * FROM mode_of_payment WHERE status='1'";
                              $query=mysqli_query($conn,$sql);
                              while($row=mysqli_fetch_array($query)){
                                // if($row['mode']!="Cash"){
                                  $id=$row['id'];
                                  ?>




                                    <div class="row">

                                        <div class="col-md-3">
                                            <input type="checkbox" id="check_box_id<?php echo $row['id'];?>"
                                                name="check_box_id[]" value="<?php echo $id;?>"
                                                onclick="get_mode_of_payment(this.value)">
                                            <label for="vehicle2"><?php echo $row['mode'];?></label>
                                        </div>

                                        <div class="col-md-3">
                                            <input type="number" value='0' name="amount[]" class="form-control"
                                                placeholder="amount" id="amount<?php echo $row['id'];?>" disabled>
                                        </div>



                                        <div class="col-md-3">
                                            <select name="institute_name[]" class="form-control"
                                                id="institute_name<?php echo $row['id'];?>" disabled>
                                                <option value="0">select</option>
                                                <?php
                                        $sql1="SELECT * FROM financial_institute WHERE mop_id='$id'";
                                        $query1=mysqli_query($conn,$sql1);
                                        while($row1=mysqli_fetch_array($query1)){
                                          echo "<option value='".$row1['id']."'>".$row1['institute_name']."</option>";
                                        }
                                        ?>
                                            </select>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="text" name="slip_no[]" class="form-control"
                                                placeholder="slip no" value='0' id="slip_no<?php echo $row['id'];?>"
                                                disabled>
                                        </div>



                                    </div>


                                    <hr>
                                    <?php    } ?>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <button id="submit" name="submit" class="btn btn-primary btn-block">submit</button>
                    </div>
                </div>



                <bR><br><br>
            </form>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {

    $("#paid").hide();
    var c = $("#count").val();
    c++;
    get_data(c);

    $("#additems_for_resume").click(function() {
        additems_for_resume(c);

    });

    var t = $("#t").val();
    $("#grand_total").val(t);

});





function get_data(c) {

    $.ajax({
        type: "POST",
        data: {
            id: c
        },
        url: "../controllers/ajax/ajax_purchase_entry.php",
        success: function(result) {
            // alert(result);
            $("#box").append(result);

            $(document).on('click', '.remove', function() {
                var button_id = $(this).attr("id");

                // var subTotal = parseFloat($('#pSubTotalA' + button_id + '').val());
                // var total = parseFloat($('#total').val());
                // var totalprice = total - subTotal;
                // $('#total').val(totalprice.toFixed(2));


                $("#oneBox" + button_id + "").remove();

            });
        }
    });




}




function additems_for_resume(c) {
    // var invoice_no = $('#invoice_no').val();
    // var distributor_id = $('#distributor_id').val();
    // alert(c);
    var po_id = $("#po_id").val();
    var item_id = $('#item_id' + c).val();
    var qty = $('#qty' + c).val();
    var unit_id = $('#unit_id' + c).val();
    var rate = $('#rate' + c).val();
    var total = $('#total' + c).val();
    var discount = $('#discount' + c).val();
    var tax = $('#tax' + c).val();

    var lang = [];
    $("input[name^='sl_no']").each(function(){
            lang.push(this.value);
        });



    if (item_id != "" && qty != "" && unit_id != "" && total != "") {
        $.ajax({
            url: "../controllers/add_purchase_resume_item.php",
            method: "POST",
            data: {
                sl_no: lang,
                po_id: po_id,
                item_id: item_id,
                qty: qty,
                unit_id: unit_id,
                rate: rate,
                disc: discount,
                tax: tax,
                total: total
            },
            cache: false,
            success: function(res) {
                // alert(res);

    $('#item_id'+c).attr("disabled", true);
    $('#qty'+c).attr("disabled", true);
    $('#unit_id'+c).attr("disabled", true);
    $('#rate'+c).attr("disabled", true);
    $('#disc'+c).attr("disabled", "disabled");
    $('#tax'+c).attr("disabled", "disabled");
    $('#total'+c).attr('disabled', 'disabled');


      
    $("#serial_no").empty();
    $("#serial_no").hide();

    c++;

$("#count").empty();
$("#count").val(c);


                get_data(c);


            }
        });
    } else {
        alert("Plz Fill all the field");
    }
}



function get_uom(unit_cat_id, c) {
    // alert(unit_cat_id + " " + c);
    $.ajax({
        url: "../controllers/ajax/get_unit_from_purchase.php",
        type: "POST",
        data: {
            id: unit_cat_id
        },
        cache: false,
        success: function(res) {
            // alert(res);

            // $("#unit_cat_id"+c).val();
            // $("#unit_id"+c).empty();
            // $("#unit_id"+c).append(res);
            var uom_tax = res.split('-');
            $("#unit_id" + c).empty();
            $("#unit_id" + c).append("<option value=''>select</option>" + uom_tax[0]);

            $("#tax" + c).empty();
            $("#tax" + c).append("<option value=''>select</option>" + uom_tax[1]);
        }
    });

}





function totalPriceCal(value, status, id) {
    var total = "";
    var grand_total = "";
    var qty = $("#qty" + id).val();
    var mrp = $("#rate" + id).val();
    var tax = $("#tax" + id).val();
    var disc = $("#disc" + id).val();



    $("#total" + id).val(total);

    if (status == 1) {

        if (mrp != "") {
            total = parseFloat(value) * parseFloat(mrp);
        } else {
            total = "";
        }
    } else if (status == 2) {
        if (qty != "") {
            total = parseFloat(value) * parseFloat(qty);
        } else {
            total = "";
            $("#rate" + id).val("")
            alert("Please check Qty!");
        }
        calculateGrandTotal()
    }


    // var disc_percent= ((rate/100)*disc);
    //     var discount=rate-disc_percent;
    //     // alert(discount);
    //     $("#total"+id).empty();
    //     $("#total"+id).val(discount);




    //         var tax_amount=(tax*discount)/100;
    //         var net_price=(+discount)+(+tax_amount);
    //         $("#total"+id).val(net_price*qty);

    var p_b_t = (mrp / ((tax / 100) + 1));
    var discount = p_b_t * (disc / 100);
    var discount_price = p_b_t - discount;
    var final_price = (Math.round(((100 * discount_price) + (tax * discount_price)) / 100));
    $("#total" + id).val(final_price * qty);

    calculateGrandTotal();
}


function calculateGrandTotal() {
    var grandTotal = 0;

    $("#Order").find('input[name^="total"]').each(function() {
        var t = $("#t").val();
        grandTotal += +$(this).val() + (+t);
    });

    $("#grand_total").empty();
    $("#grand_total").val(grandTotal);

}







function get_pay_status(value) {
    // alert(value);
    if (value == 1) {
        $("#paid").show();
        $(':input[type="submit"]').prop('disabled', false);
    } else {
        $("#paid").hide();
        $(':input[type="submit"]').prop('disabled', false);
    }
}



function get_mode_of_payment(value) {
    // alert(value);
    if (value == 1) {

        $('#institute_name' + value).hide();
        $('#slip_no' + value).hide();

        $('#amount' + value).prop("disabled", false);
        $('#institute_name' + value).prop('disabled', false);
        $('#slip_no' + value).prop('disabled', false);


        $('#institute_name' + value).val(0);
        $('#slip_no' + value).val(0);


    } else {
        $('#amount' + value).prop("disabled", false);
        $('#institute_name' + value).prop('disabled', false);
        $('#slip_no' + value).prop('disabled', false);
    }
}


function check_qty(qty){
var i;
var data="";
for (i = 1; i <= qty; ++i) {
    data+= '<div class="col-md-3"><input type="text" name="sl_no[]" id="sl_no'+i+'" class="form-control" placeholder="Enter  Serial No '+i+'"></div>';
}
$("#serial_no").empty();
$("#serial_no").show();
$("#serial_no").append(data);
}



</script>

</html>