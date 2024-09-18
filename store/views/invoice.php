<?php ob_start();
include '../includes/check.php';
include '../includes/functions.php'; 
// $today=date("Y-m-d")." 00:00:00";
// $invoices_year=invoices_year($conn);
// $invoice_no=invoices_number_generate($conn);
// $invoice="RU/QTN/".$invoices_year."/".$invoice_no;

error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Quotation Details</title>
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


    #hover_color_table:hover {
        background-color: #9BD770;
    }

    .close {
        background-color: #ffffff;
    }
    </style>
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Quotation </h3>
        <small class='text-muted'>Fill in the given below tab to create Quotation and
            manage existing data </small>
        <hr>
        </hr>
        <!-- my code start  -->
        <ul class='nav nav-tabs  nav-justified'>
            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#home'>New Invoice</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link ' data-toggle='tab' href='#menu1'>Existing Invoice</a>
            </li>
        </ul>

        <br>



        <div class='tab-content'>
            <div id='home' class='tab-pane in active container-fluid'>
                <div id="Order">
                    <form class='form-horizontal' action='../controllers/add_quotation.php'
                        method='post' enctype="multipart/form-data">


                     



                        <br><br>
                        <div id="head">


                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <select id="client_id" name="client_id" class="form-control client_id"
                                        style="width:100%" onclick="initailizeSelect2()" required> 
                                        <option value="">Select Client</option>

                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <img src="../img/add.png" width="30px" data-toggle="modal" data-target="#myModal">
                                    </div>
                                    <!-- <div class="col-sm-3"> -->
                                    <!-- <input type="hidden" name="our_ref_no" id="our_ref_no" placeholder="Our Ref. No"
                                        class="form-control" value="<?php echo $invoice;?>"> -->
                                    <!-- </div> -->
                               


                                <div class="col-sm-4">
                                    <input type="date" name="entry_date" id="entry_date" placeholder="Enter Date"
                                    value="<?php echo date("Y-m-d");?>"   class="form-control"   required>
                                </div>

                                <div class="col-sm-2">
                                   <button type="button" class="btn btn-danger" id="add_payment"  data-toggle="modal" data-target="#myModal_add_payment" >+ Add Payment</button>
                                </div>


                            </div>







                       
                                    <table class='table table-striped table-sm'>
                                        <thead>
                                            <th>#</th>
                                            <th>Item Description</th>
                                            <th>MTM</th>
                                            <th>Qty.</th>
                                            <th>Unit</th>
                                            <th>Disc</th>
                                            <th>Gst (%)</th>
                                            <th>Rate</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody id='table_block'>




                                        </tbody>
                                        <tfoot>
                                            <td colspan='6'></td>
                                            <td colspan='1'><b>Total Amount</b></td>
                                            <td colspan='2'><input type='number' class='form-control' placeholder='Grand Total'
                                                    name='grand_total' id='grand_total' min='0' step='0.01' readonly>
                                            </td>
<td id="show_button_always" colspan='1'> <span class="btn btn-success btn-block btn-sm element"    id="one_item_detail_row_add">+ Add</span></td>
                                        </tfoot>
                                    </table>

                                   




                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block form-control"
                                        id="submit" name="submit"
                                        onclick="return confirm('Are you sure , you want to submit')">Add
                                        Details</button>
                                </div>
                            </div>






                    </form>

                </div>

            </div>

        </div>
        <br>
        <div id='menu1' class='tab-pane in fade'>

        </div>


 <div class="modal" id="myModal_add_payment">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Payment Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

      <table class="table table-sm table-bordered">
        <thead>
            <th>CheckBox</th>
            <th>Mode of payment</th>
            <th>Amount</th>
            <th>Payment Type</th>
            <th>Slip No</th>
        </thead>
        <tbody>
        <?php
$sql="SELECT * FROM mode_of_payment WHERE status='1'";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){
// if($row['mode']!="Cash"){
$id=$row['id'];
?>
<tr>
    <td><input type="checkbox" id="check_box_id<?php echo $row['id'];?>"  name="check_box_id[]" value="<?php echo $id;?>" onclick="get_mode_of_payment(this.value)" ></td>
    <td> 
    <label for="vehicle2"><?php echo $row['mode'];?></label></td>
    <td><input type ="number"  value='0' name="amount[]" class="form-control" placeholder="amount" id="amount<?php echo $row['id'];?>" disabled> </td>
    <td>
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
</td>
    <td>
    <input type="text"  name="slip_no[]" class="form-control" placeholder="slip no" value='0' id="slip_no<?php echo $row['id'];?>" disabled>
    </td>
</tr>


<?php }
?>
        </tbody>
      </table>
     

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



    </div>




</body>
<script>
$("#client_id").select2({
    ajax: {
        url: "../controllers/ajax/ajax_fetch_client_list.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                searchTerm: params.term // search term
            };
        },

        processResults: function(response) {

            return {
                results: response

            };

        },
        cache: true
    }
});


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




$(document).ready(function() {

 var c = 1;
    one_item_row_detail_row_add(c);
    // alert("hello");

});


function one_item_row_detail_row_add(c) {
// alert(c);

    $.ajax({
        data: {
            c: c
        },
        method: "POST",
        dataType: 'json',
        url: "../controllers/ajax/ajax_add_more_for_invoice.php",
        success: function(data) {

            // alert(data["item_data"]);
            $("#table_block").append(data["item_data"]);

        }
    });

}











function remove_line(id) {
    var tot_rate = $("#total_rate_" + id).val();
    var grand_rate_old = $("#grand_total").val();
    $("#grand_total").empty();
    var grand_total = $("#grand_total").val(grand_rate_old - tot_rate);

    $("#final_grand_total").empty();
    $("#final_grand_total").val(grand_rate_old - tot_rate);
    var deleted_id = $("#tot_count_data" + id).val();



    $("#row_" + id).remove();
    if (deleted_id == 0) {


        $("#show_button_always").hide();
        $("#show_button_when_remove").show();

    } else {


        $.ajax({
            type: "POST",
            data: {
                deleted_id: deleted_id
            },
            url: "../controllers/ajax/remove_tender_quotation_row_from_database.php",
            success: function(data) {

                // alert(data);
            }
        });
    }


}






function get_qty_rate(c) {
    // alert(c);

    var total = 0;
    $("#total_rate_" + c).empty();
    var qty = $("#qty_" + c).val();
    var rate = $("#tender_rate_" + c).val();
    total = (parseFloat(qty)) * (parseFloat(rate));
    // alert(qty+" "+rate+" "+ c);
    console.log(qty * rate);
    $("#total_rate_" + c).val(total);
    calculateGrandTotal();

}


function calculateGrandTotal() {
    var grandTotal = 0;
    $("#Order").find('input[name^="total_rate"]').each(function() {
        grandTotal += +$(this).val();
    });
    $("#grand_total").val(grandTotal);
    $("#final_grand_total").val(grandTotal);
    $("#total_final_value").val(grandTotal)
}

function view_pdf_check(id) {

    var view_type = $("#view_id").val();
    $.ajax({
        data: {
            view_type: view_type,
            quotation_id: id
        },
        type: "GET",
        url: "../fpdf/show_quotation.php",
        success: function(data) {}
    });
}









function grand_total() {
    var product_tot = $("#grand_total").val();
    $("#total_final_value").empty();
    $("#total_final_value").val(product_tot);

}





function getUom(item_id, c) {
    console.log(item_id + " " + c);
 
    $.ajax({
        type: 'post',
        url: "../controllers/ajax/ajax_fetch_relation_of_uom.php",
        data: {
            id: item_id
        },
        success: function(uom) {
            $("#uom_id_" + c).empty();
            $("#uom_id_" + c).append(uom);
            // alert(uom);
        }
    });

    $.ajax({
        type: 'post',
        url: "../controllers/ajax/ajax_fetch_item_detail_for_item.php",
        data: {
            id: item_id
        },
        success: function(uom) {
            $("#uom_id_" + c).empty();
            $("#uom_id_" + c).append(uom);
            // alert(uom);
        }
    });

}



$(document).on('click', '#butsave', function(e) {
    var confirm_alert = confirm("Are you sure ?");
    if (confirm_alert == true) {
        var data = $("#form-add").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "../controllers/client_add_ajax.php",
            success: function(result) {
               var res= result.split('-');
                // alert(res[0]+"----"+res[1]);
                if (res[0] > 0) {
                   
                    $("#myModal").modal("hide");
                    swal({
                            type: "success",
                            title: "Client Details",
                            text: "Client Data Added Successfully!",
                            icon: "success",
                            button: "ok!"
                        });

                                 $('.client_id').append("<option value='"+res[0]+"' selected='selected'>"+res[1]+"</option>");
                   


                } else{

                    swal({
                        type: "error",
                        title: "Client Details",
                        text: "Client Data Not Added Successfully!",
                        icon: "error",
                        button: "ok!",
                    });



                    


                }

            }
        });
    } else {

    }


});



function add_data_onpage() {
    var category_id_for_add = $("#category_id_for_add").val();
    var data = $("#data").val();
    var category=$("#for_show_Category").val();


    $.ajax({
        data: {
            category_id_for_add: category_id_for_add,
            data: data
        },
        type: "post",
        url: "../controllers/add_data_for_form_subcategory.php",
        success: function(result) {


            if (result == 0) {
                swal({
                    type: "error",
                    title: category,
                    text: "Data Not Added Successfully!",
                    icon: "error",
                    button: "ok!",
                });
            } else {

                $("#myModal_add_data").modal("hide");
                $(".form_data_add")[0].reset()
                swal({
                    type: "success",
                    title: category,
                    text: "Data Added Successfully!",
                    icon: "success",
                    button: "ok!"
                })


            }

        }
    });
}


function fetch_delivery_terms(term_id){
    if(term_id==2){
        $(".freight_charges").empty();
        $(".freight_charges").append("<option value='2'>Inclusive</option>");
    }
}




    
function delete_func(id){
        swal({
  title: "Are you sure?",
  text: "You will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
 },
 function(){

    $.ajax({
                data: {
                    id: id
                },
                url: "../controllers/quotation_del.php",
                type: "GET",
                cache: false,
                success: function(data) {
                    if (data == 1) {


  swal({
                               type: "success",
                                title: "Deleted!",
                                text: "Your imaginary file has been deleted!",
                                icon: "success",
                                button: "ok!"
                            },
                            function(ok) {
                                if (ok) {
                                    location.reload(); 
                                }
                            });



                    }else{
                        swal("Deleted!", "Your imaginary file has been not  deleted.", "error"); 
                    }

                }
            })
 });
}


function  cash_manage(val){ 


        var cash = $("#cash").val();
        var card = $("#card").val();
        var upi = $("#upi").val();
        var total = $("#grand_total").val();

        if (cash == '') {
            cash = 0;
        } else {
            cash = parseFloat($("#cash").val());
        }


        if (upi == '') {
            var upi = 0;
        } else {
            upi = parseFloat($("#upi").val());
        }




        var totalAmount = parseFloat(card) + parseFloat(cash) + parseFloat(upi);

        var totalAS = parseFloat(total - totalAmount);

        if (total <= totalAmount) {
            $("#rec_btn").removeAttr("disabled");
            $("#complete_btn").removeAttr("disabled");


        } else {
            $("#rec_btn").attr('disabled', true);
            $("#complete_btn").prop('disabled', true);
        }


        if (total > totalAmount) {
            $("#message").html(
                "<h5 style='color:red'>You need to pay <span style='color: #2A4747; font-weight:bold;'>" +
                totalAS + "</span> more</h5>");
        } else if (totalAmount >= total) {
           
            var tot=totalAmount - total;
            $("#message").html(
                "<h5 style='color:red'>You have to pay back <span style='color: #2A4747; font-weight:bold;'>" +
                tot + "</span> more</h5>");
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


     
}else{
        $('#amount'+value).prop("disabled", false);
        $('#institute_name'+value).prop('disabled', false);
        $('#slip_no'+value).prop('disabled', false); 
}
}

</script>

</html>