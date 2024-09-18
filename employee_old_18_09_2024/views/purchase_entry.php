<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title>Purchase Entry || </title>
	<?php include '../includes/header.php';?>
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


    <script>
    $(document).ready(function() {
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






    });
    </script>
</head>

<body>
	<?php include '../includes/navbar.php'; ?>

	<div class="container-fluid">
    <h3><b>Purchase Entry</b></h3>
    <small class="text-muted">Fill in the given below tab to create Purchase Entry   and manage existing Purchase  Entry</small>
    <hr></hr> 




    <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#home'>Purchase Entry  Creation</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' data-toggle='tab' href='#menu1'>Existing Purchase Details </a>
            </li>
    </ul>
<br>
        <div class='tab-content'>
            <div id='home' class='tab-pane in active'>



  


    <div class="form-group row">
        <div class="col-sm-1"></div>
        <div class="col-sm-2"><p>Purchase Invoice</p></div>
        <div class="col-sm-7">
        <input id="invoice_no" name="invoice_no" class="form-control" placeholder="Enter invoice number" type="text"  required="">
    </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-1"></div>
        <div class="col-sm-2"><p>Invoice Date</p></div>
        <div class="col-sm-7">
        <input id="invoice_date" name="invoice_date" class="form-control" placeholder="Enter invoice date" type="date"  required="">
    </div>
    </div>



    <div class="form-group row">
        <div class="col-sm-1"></div>
        <div class="col-sm-2"><p>Select Distributor</p></div>
        <div class="col-sm-7">
         <select id="distributor_id" name="distributor_id" class="form-control">
         <option value="">Select</option>';
         <?php
        $query = mysqli_query($conn, "SELECT * FROM vendor WHERE status='1'");
        while ($row = mysqli_fetch_array($query)) {
         echo '<option value='. $row["id"].'>' .$row["name"]. '</option>';
			}
			 ?>
    </select>
    </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-1"></div>
        <div class="col-sm-2"><p>Remark</p></div>
        <div class="col-sm-7">
        <input id="remark" name="remark" class="form-control" placeholder="Enter Remark" type="text"  required="">
    </div>
    </div>


    <div class="form-group row" id="item_box_show_button">
        <div class="col-sm-3"></div>
        <div class="col-sm-7">
        <button type="button" class="btn btn-block btn-info btn-sm" id="add_item_boxes" class="btn btn-primary">Add  Items</button>
    </div>
    </div>



    <!-- <hr> -->
    <form action="../controllers/add_purchase_complete_entry.php" method="post">

    <input type="hidden" id="po_id" name="po_id" class="form-control">
    <div id="Order">

    <!-- <div id="purchase_box"></div> -->
<table class="table table table-striped">
    <thead>
            <!-- <th>Product Type</th> -->
            <th>#</th>
            <th>Product</th>
            <th>Serial No</th>
            <th>UoM</th>
            
            <th>Price</th>
            <th>Disc</th>
            <th>Tax (%)</th>
            <th>Total</th>
            <th>Action</th>
    </thead>
    <tbody id="box"></tbody>
</table>
<div id="serial_no" class="row"></div>
<br>
<div class="row">
         <div class="col-md-6">
            <input type="hidden" id="count" value="1">
         <button onclick="addItems();" class="btn btn-success btn-sm btn-block" type="button"><i class="fas fa-plus-circle"></i> Add More</button>    
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="grand_total" name="grand_total" style="width:100%" readonly> 
        </div>
</div>
<br>
<div class="card">
<div class="card-header"><h5>Payment Details</h5></div>
    <div class="card-body" >
 



    <div class="row">
    <div class="col-sm-6">
                 
            <div class="form-group row">
                 
                 <div class="col-sm-4">
                     <label for="name">Total Amount</label>
                 </div>
                 <div class="col-sm-7">
               <input type="text" value="" class="form-control"  id="mode_pay_total">
                  </div>

            </div> 
                            


                            <div class="row">
                                <div class="col-md-4">
                                <p>Pay Status  </p>  
                                </div>
                                <div class="col-md-8">
                                <input type="radio" id="vehicle1" name="pay_status" value="1" onclick="get_pay_status(this.value)">
                                <label for="vehicle1"> Paid</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <input type="radio" id="vehicle2" name="pay_status" value="2" onclick="get_pay_status(this.value)">
                            <label for="vehicle2"> Un- Paid</label><br>
                                </div>
                            </div>
</div>
<div class="col-md-6">
                   
            <div id="paid">
              

              <div class="row">

                                            <div class="col-md-3"><p>Mode of payment</p> </div>
                                            <div class="col-md-3"><p>Amount</p> </div>
                                            <div class="col-md-3"><p>Payment Type</p> </div>
                                            <div class="col-md-3"><p>Slip No</p> </div>
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
                                                <input type="checkbox" id="check_box_id<?php echo $row['id'];?>"  name="check_box_id[]" value="<?php echo $id;?>" onclick="get_mode_of_payment(this.value)" > 
                                                <label for="vehicle2"><?php echo $row['mode'];?></label>
                                            </div>

                                          <div class="col-md-3">
                                          <input type ="number"  value='0' name="amount[]" class="form-control" placeholder="amount" id="amount<?php echo $row['id'];?>" disabled> 
                                          </div>
                                         


                                    <div class="col-md-3">
                                      <select  name="institute_name[]" class="form-control" id="institute_name<?php echo $row['id'];?>" disabled>
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
                                      <input type="text"  name="slip_no[]" class="form-control" placeholder="slip no" value='0' id="slip_no<?php echo $row['id'];?>" disabled>
                                      </div>



                                </div>


                                <hr>
                                  <?php    } ?>
            </div>
            </div>
            </div>




    </div>
</div>

</div>
<br>
                        <div class="row">
                        <div class="col-md-12">
                                        <button id="submit" name="submit" class="btn btn-primary btn-block" type="submit">submit</button>
                                    </div>

					 </div>
                     <br><br>
 




 </form>

        </div>
        <div id='menu1' class='tab-pane in fade'>


        <table id="example" class="table table-sm">
				        <thead>
                            <th>#</th>
                            <th>Purchase Invoice NO</th>
                            <th>Purchase Invoice Date</th>
                            <th>Supplier</th>
                            <th>Payment Status</th>
                            <th>Entry On</th>
                            <th>view</th>
                            <th>Delivery Status</th>
                            <th>Approval</th>
                            <th>Action</th>
				        </thead>
				        <tfoot>
                            <th>#</th>
                            <th>Purchase Invoice NO</th>
                            <th>Purchase Invoice Date</th>
                            <th>Supplier</th>
                            <th>Payment Status</th>
                            <th>Entry On</th>
                            <th>view</th>
                            <th>Delivery Status</th>
                            <th>Action</th>
				        </tfoot>
				        <tbody>
				          <?php 
				            $c=0;
                            $sql="SELECT * FROM purchase WHERE status='1' ORDER BY id DESC";
				            $query = mysqli_query($conn,$sql);
				            while ($row=mysqli_fetch_array($query)) {
                            $c++;
                            $id =$row['id'];
                            $distributor_id  =$row['distributor_id'];
                            $distributor= fetch_data($conn,"vendor","id",$distributor_id);
                          
                            $date_of_entry  =dateForm1($row['entry_date_time']);
                            $approval=$row['approval'];
                            $recieve_status=$row['recieve_status'];

                            if($row['payment_status']==0){
                                $payment_status="Un-paid";
                            }elseif($row['payment_status']==1){
                                $payment_status="Paid";
                            }

                            $position_status=$row["position_status"];
				                echo "<tr>";
				              	echo "<td>".$c."</td>";
                                echo "<td>".$row["invoice_no"]."</td>";
                                echo "<td>".$row["invoice_date"]."</td>";
                                echo "<td>".$distributor['name']."</td>";
                                echo "<td>".$payment_status."</td>";
				                echo "<td>".$date_of_entry."</td>";

                        if($position_status==0){
                          echo "<td><a href='purchase_resume_details.php?pi_id=".$id."
                          '><button type='button' class='btn btn-warning'>resume</button></a></td>";
                  
                        }elseif($position_status==1){
                          echo "<td><a href='purchase_entry_details.php?pi_id=".$id."
                              '><button type='button' class='btn btn-success'>Purchased Items</button></a></td>";

                        }

                      

                        if($recieve_status==0){
                            echo "<td><a href='purchased_item_receive.php?pi_id=".$id."
                            '><button type='button' class='btn btn-warning'>Not Received</button></a></td>";
                    
                          }elseif($recieve_status==1){
                            $name="";
                            $recieved_by=$row["recieved_by"];
                            $recieved_datetime  =dateForm1($row['recieved_datetime']);
                            if($recieved_by==0){
                                $name="";
                            }else{
                                $received_name= fetch_data($conn,"users","id",$recieved_by);
                                $name=$received_name["first_name"];
                            }
                          
                            echo "<td><span  class='text-success'>Received by ".$name."</span><br>".$recieved_datetime."</td>";

                                
                          }

                      echo "<td></td>";
                        //   if($approval==0){
                        //     echo "<td><a href='purchase_resume_details.php?pi_id=".$id."
                        //     '><button type='button' class='btn btn-warning'>Not approve</button></a></td>";
                    
                        //   }elseif($approval==1){
                        //     echo "<td><a href='purchase_entry_details.php?pi_id=".$id."
                        //         '><button type='button' class='btn btn-success'>Purchased Items</button></a></td>";
                                
                        //   }
                          echo "<td><img src='../img/edit.png' height='30px'><img src='../img/delete.png' height='30px'></td>";
                        
                              echo "</tr>";
				            }       
				          ?>
				        </tbody>
				    </table>


            </div>

            </div>   









    </div> 
    </body>
    <script>



function check_qty(qty){
    alert(qty);
var i;
var data="";
for (i = 1; i <= qty; ++i) {
    data+= '<div class="col-md-3"><input type="text" name="sl_no[]" id="sl_no'+i+'" class="form-control" placeholder="Enter  Serial No '+i+'"></div>';
}
$("#serial_no").empty();
$("#serial_no").append(data);
$("#serial_no").show();
}









$(document).ready(function() {
    $("#Order").hide();
    $("#paid").hide();
    $("#submit").hide();
var c=$("#count").val();
get_data(c);




});


// var c=$("#count").val();
// if(c>1){
//     $("#item_box_show_button").hide();
// }else{
//     $("#item_box_show_button").show();
// }



function get_data(c){

    $.ajax({
        type:"POST",
        data:{
            id:c
        },
        url: "../controllers/ajax/ajax_purchase_entry.php",
         success: function(result){
            // alert(c);
         
                         $("#box").append(result);
                           $(document).on('click','.remove',function(){
								var button_id = $(this).attr("id");
								$("#oneBox"+button_id+"").remove();

                                
                     
							});	

                            
                        }
			});
  }



$("#add_item_boxes").click(function() {

    $("#item_box_show_button").hide();
    var invoice_no = $('#invoice_no').val();
    var invoice_date = $('#invoice_date').val();
    var remark = $('#remark').val();
    var distributor_id = $('#distributor_id').val();

// if (invoice_no == "" || invoice_date == "" || distributor_id == "") {

//     swal({
//         type: "error",
//         title: "Quotation Head",
//         text: "Please Fill all the Data of Quotation Head!",
//         icon: "error",
//         button: "ok!",
//     });

// } else {

    $("#Order").show();
    $.ajax({
        method: "POST",
        data: {
            invoice_no: invoice_no,
            invoice_date: invoice_date,
            remark: remark,
            distributor_id: distributor_id
        },
        url: "../controllers/purchase_fst_section_add.php",
        success: function(po_table_last_id) {

      $("#po_id").empty();
      $("#po_id").val(po_table_last_id);

 
      $('#invoice_no').prop('disabled', true);
      $('#invoice_date').attr("disabled", true);
      $('#remark').attr("disabled", true);
      $('#distributor_id').attr("disabled", true);
      $("#submit").show();
        }
    });
// }
});



function addItems() {
  

    var c =  $("#count").val();
    var p_id = $('#po_id').val();
    var item_id = $('#item_id'+c).val();
    var qty = $('#qty'+c).val();
    var unit_id = $('#unit_id'+c).val();
    var rate = $('#rate'+c).val();
    var discount = $('#disc'+c).val();
    var tax = $('#tax'+c).val();
    var total = $('#total'+c).val();
    // var sl_no = $('#sl_no').val();
    // var sl_no = $("input[name^='sl_no']").val();
    // var sl_no =   $("input[name='sl_no[]']").val();
//     var sl_no =[];
//     $('input[name^="sl_no"]').each(function() {
//         sl_no= $(this).val();
// });
    // var sl_no =  $('input[name^="sl_no"]').serialize();
    // alert(decodeURI(sl_no));

    var lang = [];
    $("input[name^='sl_no']").each(function(){
            lang.push(this.value);
        });
    
// if(item_id!="" && qty!="" && unit_id!="" && rate!=""  && total!=""){
	$.ajax({
		url: "../controllers/add_purchase_entry.php",
		type: "POST",
		data: {
            p_id: p_id,
            item_id: item_id,
			qty: qty,
            sl_no: lang,
			unit_id: unit_id,	
            rate: rate,
            disc:discount,
            tax:tax,	
            total: total	
		},
		cache: false,
		success: function(res){
            // alert(res); 
            $("#po_id").empty();
            $("#po_id").val(res);

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
$("#"+c).hide();
            }
        });
}





function get_uom(unit_cat_id,c){
// alert(unit_cat_id);
    $.ajax({
		url: "../controllers/ajax/get_unit_from_purchase.php",
		type: "POST",
		data: {
            id: unit_cat_id
		},
        // dataType:'json',
		cache: false,
		success: function(res){
            // alert(res);
            
            var uom_tax = res.split('-');
            // alert();
            // $("#unit_cat_id"+c).val();
            $("#unit_id"+c).empty();
            $("#unit_id"+c).append(uom_tax[0]);

            $("#tax"+c).empty();
            $("#tax"+c).append(uom_tax[1]);

            console.log(res);
            }
        });

}


function calculateGrandTotal() {
                var grandTotal = 0;
              $("#Order").find('input[name^="total"]').each(function () {
               grandTotal += +$(this).val();
                });
              $("#grand_total").val(grandTotal);

             }





    function totalPriceCal(value, status, id) {
			var total = "";
            var grand_total= "";
			// var qty = $("#qty"+ id).val();
			var mrp = $("#rate"+ id).val();
            var tax = $("#tax"+ id).val();
            var disc = $("#disc"+ id).val();


			// if (status == 1) {

			// 	if (mrp != "") {
			// 		total = parseFloat(value) * parseFloat(mrp);
			// 	} else {
			// 		total = "";
			// 	}
			// } else if (status == 2) {
			// 	if (qty != "") {
			// 		total = parseFloat(value) * parseFloat(qty);
			// 	} else {
			// 		total = "";
			// 		$("#rate" + id).val("")
			// 		alert("Please check Qty!");
			// 	}

			// }
            
        
            var p_b_t = (mrp/((tax/100)+1));
            var discount = p_b_t*(disc/100);
            var discount_price = p_b_t-discount;
            var final_price = (Math.round(((100*discount_price)+(tax*discount_price))/100));

         //   var    p_b_t = mrp -(mrp / (1 + tax) * tax);
        //    var   tax_amount=mrp-(mrp*(100/(100+tax)));
       //     var   net_price=mrp-tax_amount;

            // console.log(p_b_t+"----"+discount+"----"+discount_price+"----"+final_price);

    //  var round_total=  round(final_price);



         $("#total"+id).val(final_price);
         $("#mode_pay_total").val(final_price);  

 
                // var disc_percent= ((mrp/100)*disc);
                // var discount=mrp-disc_percent;
                // // alert(discount);
                // $("#total"+id).empty();
                // $("#total"+id).val(discount);

             
                // var tax_amount=(tax*discount)/100;
                // var net_price=(+discount)+(+tax_amount);
                // $("#total"+id).val(net_price*qty);

                   
                                                                                                                                                                                                                                                                                                                         
                    


            calculateGrandTotal();
		}






        




             
function get_pay_status(value){
    // alert(value);
if(value==1){
    $("#paid").show();
    $(':input[type="submit"]').prop('disabled', false);
}else{
  $("#paid").hide();
  $(':input[type="submit"]').prop('disabled', false);
}
}



function get_mode_of_payment(value){
  // alert(value);
if(value==1){

        $('#institute_name'+value).hide();
        $('#slip_no'+value).hide(); 

        $('#amount'+value).prop("disabled", false);
        $('#institute_name'+value).prop('disabled', false);
        $('#slip_no'+value).prop('disabled', false); 


        $('#institute_name'+value).val(0);
        $('#slip_no'+value).val(0);





        // $('#institute_name'+value).prop('disabled', true);
        // $('#slip_no'+value).prop('disabled', true); 

     
}else{
        $('#amount'+value).prop("disabled", false);
        $('#institute_name'+value).prop('disabled', false);
        $('#slip_no'+value).prop('disabled', false); 
}
}

      


       
$("#add_item_boxes").click(function() {

$("#item_box_show_button").hide();
var invoice_no = $('#invoice_no').val();
var invoice_date = $('#invoice_date').val();
var remark = $('#remark').val();
var distributor_id = $('#distributor_id').val();

if (invoice_no == "" || invoice_date == "" || distributor_id == "") {

    swal({
        type: "error",
        title: "Quotation Head",
        text: "Please Fill all the Data of Quotation Head!",
        icon: "error",
        button: "ok!",
    });

} 

})

</script>
</html>