<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

  ob_start();
  include '../includes/check.php';
  include '../includes/functions.php';
 $order_id= sanitize_input($conn,$_GET["order_id"]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice || Store Manager</title>
<?php
  include '../includes/header.php';
  $date = date("Y-m-d",time());
?>

</head>
<body>
    
    <?php 
// include '../includes/sidebar_head.php';
include '../includes/navbar.php';
     ?>
      <br>
     
    
        <div class="container-fluid" >



        <div class="mhb">
        <h4><b>
            
  
        <?php echo '<a href="receipts.php" ><img src="../../store/img/back.png" height="20px" ></a> ';?>
        
        
        |  Receipt Details | Invoice ID - <?php echo $order_id; ?> </b></h4><small class='text-muted'>Below given is the receipt details of the Invoice Id <?php echo $order_id; ?> .</small>
            </div>



<br>


<?php
     $sql="SELECT * FROM sale_order WHERE id='$order_id'";
     $query = mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($query);
$payment_type_id=$row["payment_type"];
$total_amount=$row['total_amount'];
$customer_id=$row['customer_id'];
$invoice_no=singleRowFromTable($conn, "SELECT * FROM invoices WHERE order_id='$order_id'", "invoice_no");
$invoice_date=singleRowFromTable($conn, "SELECT * FROM invoices WHERE order_id='$order_id'", "invoice_date");
$customer_pnone=singleRowFromTable($conn, "SELECT * FROM customer_details WHERE id='$customer_id'", "customer_pnone");
$customer_name=singleRowFromTable($conn, "SELECT * FROM customer_details WHERE id='$customer_id'", "customer_name");
$customer_name=singleRowFromTable($conn, "SELECT * FROM customer_details WHERE id='$customer_id'", "customer_name");
$ticket_no_for_this_order=order_ticket_no_count_data($conn,$order_id);


$position_status_id=$row['position_status'];
if($position_status_id==1){
  $position_status_check_fullfiled="<button type='submit' class='btn btn-warning btn-block' id='unfullfilled'  disabled>Unfulfilled</button>";
  }elseif($position_status_id==2){
  $position_status_check_fullfiled="<button type='button' class='btn btn-primary btn-block'>Fulfilled</button>";
  }

  if($payment_type_id==1){
    $position_status="<button type='button' class='btn btn-success btn-block'>Paid</button>";
    $unpaid_amount=$total_amount; // paid amount
    }elseif($payment_type_id==2){
    $position_status="<button type='button' class='btn btn-danger btn-block' disabled>Unpaid</button>";
   $unpaid_amount= $total_amount;
    }elseif($payment_type_id==3){
      $unpaid_amount=check_unpaid_amount($conn, $order_id);
      $unpaid_amount_tot= $total_amount-$unpaid_amount;
        $position_status="<button type='button' class='btn btn-warning btn-block' disabled>Unpaid ".$total_amount-$unpaid_amount."</button>";
       
        // $unpaid_amount= $total_amount;

      
        }

?>
<div class="mhb">
<div class="card">
<div class="card-header">
<div class="row">
<div class="col-md-4">
<h5> <b><label>Invoice No :</label></b> <small> <?php echo $invoice_no;?> </small></h5>
</div>

<div class="col-md-4">
<h5> <b><label>Customer Name :</label></b> <small> <?php echo $customer_name;?></small></h5>

</div>

<div class="col-md-4">
<h5><b> <label>Contact No :</label></b> <?php echo $customer_pnone;?></small> </h5>

</div>

<div class="col-md-4">
   <h5><b> <label>Invoice Date :</label></b> <small><?php echo dateForm($invoice_date);?></small> </h5>
</div>

<div class="col-md-4">
   <h5><b> <label>Total Amount :    </label></b> <?php echo $total_amount;?> </h5>
</div>
<div class="col-md-4">
   <h5><b> <label>Order Status :</label></b><?php echo $ticket_no_for_this_order;?>  </h5>
</div>


</div>
</div>
</div>
<input type="hidden" id="order_id_for_this_page" value="<?php echo $order_id;?>">


<table class="table table-bordered table-sm" id="example">
                <thead>
                <th>#</th>
                    <th>Hsn Code</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Discount Price</th>
                    <th>Tax</th>
                    <th>Tax amount</th>
                </thead>
                <tbody>
                  <?php 
                    $c=0;
                    $total_tax=0;
                    $total_amount=0;
                    $sql="SELECT * FROM order_details WHERE order_id='$order_id'";
                    $query = mysqli_query($conn,$sql);
                    while ($row=mysqli_fetch_array($query)) {
$c++;
                        $product_id=$row['product_id'];
                      $product=  check_item_or_product_data($conn,$product_id,"2");
                      
                      $hsn=fetch_data($conn,"hsn_table","id",$product["hsn_table_id"]);
                      $discount=$row["discount"];
                      $discount_type=$row["discount_type"];
                      $price=$row["price"];
                      $tax=$row["tax"];
                      $qty=$row['qty'];
                      $tax_percent=$row["tax"];

                      
if($discount_type==1){
  if($discount>0){
    $discount_type_name=" (Cash Discount)";
  }else{
    $discount_type_name="";
  }

  $subtotal = $price * $qty;
  $price_after_discount = ($subtotal - $discount);
  $after_discount_tax_amount = (($price_after_discount * $tax_percent) / 100);

  $total_amount+=$price_after_discount;
  $total_tax+=$after_discount_tax_amount;
 
 }elseif($discount_type==2){
  $discount_type_name="Percent";
     $percent_discount=($discount / 100) * $price;
      $discount_price = $price - $percent_discount;
      $price_after_discount = ($discount_price * $qty);
     $after_discount_tax_amount = (($price_after_discount * $tax_percent) / 100);

     $total_amount+=$price_after_discount;
     $total_tax+=$after_discount_tax_amount;
 }    

 






                      echo "<tr>";
                        echo "<td>".$c."</td>";
                        echo "<td>".$hsn['code']."</td>";
                        echo "<td>".$product['name']."</td>";
                      

                        echo "<td>".$row['qty']."</td>";
                        echo "<td>".$row['price']."</td>";
                        echo "<td>".$row['discount']." ".$discount_type_name."</td>";
                        echo "<td>".$price_after_discount."</td>";
                        echo "<td>".$row['tax']." %</td>";
                        echo "<td>".$after_discount_tax_amount."</td>";
                        
                      echo "</tr>";
                    }       
                  ?>
                  <tr>
                  <th colspan="5"></th>
                    <th colspan="3">Total Tax Amount <small>(round off)</small></th>
                    <th><?php echo round($total_tax);?></th>
                  </tr>
                  <tr>
                  <th colspan="5"></th>
                    <th colspan="3">Grand Total</th>
                    <th><?php echo round($total_amount) + round($total_tax);?></th>
                  </tr>
                </tbody>
            </table>

            <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <p><b>Payment History</b></p>
                </div>
                <div class="col-md-6">
                  <p><b>Order Status</b></p>
                </div>
              </div>
              </div>
<div class="card-body">
<div class="row">
<div class="col-md-6">
<?php
$sql1="SELECT * FROM payment_details WHERE order_id='$order_id'";
$query1=mysqli_query($conn,$sql1);
$num_rows=mysqli_num_rows($query1);
if($num_rows<1){
  echo "<button>Due </button>".$order_id;
}else{

  echo "<table class='table table-sm table-hover table-bordered'><thead><th>#</th><th>Amount</th><th>Paid By</th><th>Slip No</th><th>Paid On</th></thead>";
  $sl=0;
  while($row_pay=mysqli_fetch_array($query1)){
    $sl++;
$mode_of_pay_id=$row_pay["mode_of_pay_id"];
$amount=$row_pay["amount"];
$slip_no=$row_pay["slip_no"];
$row_created_on=dateForm($row_pay["row_created_on"]);
$mode_of_pay=fetch_data($conn,"mode_of_payment","id",$mode_of_pay_id);



echo "<tr>";
echo "<td>".$sl."</td>";
echo "<td>".$amount."</td>";
echo "<td>".$mode_of_pay["mode"]."</td>";
echo "<td>".$slip_no."</td>";
echo "<td>".$row_created_on."</td>";
echo "</tr>";
  }
  echo "</table>";
}

?>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-6"><?php echo $position_status;?></div><div class="col-md-6"><?php echo $position_status_check_fullfiled;?></div></div>
</div>



</div>
</div>
</div>



        </div>
          
  <!-- The Modal -->
  <div class="modal" id="myModal_payment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="width:100%">

                    <h4 class="modal-title">Payment Details  ||  <b> <span id="tot_amount_for_booking" style="color:red;font-style: italic"></span><small style="font-style: italic">&nbsp (total Due amount)</small></b></h4>



                </div>
                <div class="modal-body">


                    <form action="../controllers/mode_of_payment_cont_for_receipt.php" method="post">

                        <input type="hidden" id="order_id" name="order_id">

                        <div class="form-group row">
                          <label class="col-md-3 control-label" for="">Unpaid Amount</label>
                          <div class="col-md-8">
                            <input id="unpaid_amount" name="unpaid_amount" type="number"  class="form-control input-sm" readonly>
                          </div>
                        </div>


                        <div class="form-group row">
                          <label class="col-md-3 control-label" for="cash">Cash</label>
                          <div class="col-md-8">
                            <input id="cash" name="cash" type="number" min="0" placeholder="Amount" class="form-control input-sm" onkeyup="get_total_value(this.value);"  value="0">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 control-label" for="card">Card</label>
                          <div class="col-md-4">
                            <input id="card" name="card_amount" type="number" min="0" placeholder="Amount"class="form-control input-sm" onkeyup="get_total_value(this.value);"  value="0">
                          </div>
                          <div class="col-md-4">
                            <input id="slip_no" name="card_slip_no" type="text" placeholder="Slip No" class="form-control input-sm">
                          </div>
                        </div>
                          <div class="form-group row">
                            <label class="col-md-3 control-label" for="upi">UPI</label>
                            <div class="col-md-4">
                              <input id="upi" name="upi" type="number" min="0" placeholder="Amount" class="form-control" onkeyup="get_total_value(this.value);" value="0">
                            </div>
                            <div class="col-md-4">
                              <input id="upi_no" name="upi_no" type="text" placeholder="UPI No" class="form-control input-md">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3"></div><div class="col-md-8"><div id="message"></div>
                            </div>
                          </div>


                        <br>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-6"><button type="button" class="btn btn-secondary btn-block btn-sm"
                                    onclick="back_from_mode_of_pay()">Back</button></div>
                            <!-- <div class="col-md-4">
                                <button id="complete_btn" name="complete_btn"
                                    class="btn btn-primary btn-sm btn-block complete_btn"
                                    name="submit_not_generate_bill_">Complete </button>
                            </div> -->
                            <div class="col-md-6">
                                <button type="submit" id="rec_btn" class="btn btn-success btn-sm btn-block"
                                    name="submit_generate_bill">Received</button>
                                <!-- <span id="receive_button" class="hidden"></span> -->
                            </div>
                        </div>



                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                </div>

            </div>
        </div>
    </div>

    </div>
</body>
<script>
   $("#rec_btn").attr('disabled', true);
   
   function payment(order_id,unpaid_amount) {
    $('#myModal_payment').modal('show');
    $("#order_id").empty();
    $("#order_id").val(order_id);

    $("#unpaid_amount").empty();
    $("#unpaid_amount").val(unpaid_amount);

    $("#tot_amount_for_booking").empty();
    $("#tot_amount_for_booking").text(unpaid_amount);
   }


   function get_total_value(val) {

var cash = $("#cash").val();
var card = $("#card").val();
var upi = $("#upi").val();
var tot_val = parseFloat(cash) + parseFloat(card) + parseFloat(upi);
var total = $("#unpaid_amount").val();
var totAS=total-tot_val;
console.log(total);
if (total < tot_val) {
    // alert("");
    $("#message").empty();
    $("#message").append('<h5 style="color:red"><i>Given amount is Greater than unpaid amount</i></h5>');
    $("#rec_btn").attr('disabled', true);


} 


if (total >= tot_val){
  $("#message").empty();
  $("#message").html("<h4 style='color:red'><i>You need to pay <span style='color: #2A4747; font-weight:bold;'>" +totAS+ "</span> more</i></h4>");
  $("#rec_btn").attr('disabled', true);
}


if(totAS == 0){
    $("#rec_btn").removeAttr("disabled");
}else{
  $("#rec_btn").attr('disabled', true);
}



}

function back_from_mode_of_pay() {
        $("#myModal_payment").modal("hide");
    }



function fullfill(){ 



  swal.fire({
    title: "Are you sure?",
    text: "You Want to Close this Order!",
    // type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, close it!",
    cancelButtonText: "No, cancel plx!"
    // closeOnConfirm: false,
    // closeOnCancel: false
  }).then((result) => {
  if (result.isConfirmed) {

    var order_id_data = $("#order_id_for_this_page").val();
//  console.log(order_id);

    $.ajax({
          method: 'POST',
          url: '../controllers/ajax/order_close.php',
          data:{
            order_id_data: order_id_data
          },
          success: function (data) {
            console.log(data);
            
            swal.fire("Closed!", "Your Order  has been Closed.", "success");
          },
          error: function (data) {
            swal.fire("NOT Closed!", "Something blew up.", "error");
          }
        });

  }
})
};




</script>
</html>