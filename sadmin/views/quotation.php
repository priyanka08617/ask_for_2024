<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';   
include '../includes/header.php';                      
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Quotation</title>
    <style>
    #box {
        border: 1px solid gray;
        margin: 30px 150px 50px 150px;
        padding: 70px 70px 70px 70px;
    }

    #p_format {
        font-size: 16px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .footer {
        display: disabled;
    }
    </style>
</head>

<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container-fluid">

        <h3>Quotation Creation</h3>
        <p class='text-muted'>Fill in the given below tab to Quotation Creation and Manage Quotation Details.</p>
        <hr>


        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'>
                <a class='nav-link active' data-toggle='tab' href='#home'>Quotation Creation</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' data-toggle='tab' href='#menu1'>Existing Quotation</a>
            </li>
        </ul>

        <div class='tab-content'>
            <!--../controllers/quotation_add.php-->
            <div id='home' class='tab-pane in active'>
                <form class='form-horizontal quotation_form_submit' action='' method='post'>
                    <!-- my code start  -->
                    <div id="box">
                        <div class="card">
                            <div class="card-body">
                                <h5><b>To,</b></h5>

                                <div class="row form-group">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <select id="customer_id" name="customer_id" style="width:100%"
                                            class="form-control" required>
                                            <option value=" ">Select</option>
                                            <?php
                        $sql="SELECT * FROM `customer_details` WHERE `status`='1'";
                        $query=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($query)){
                            echo "<option value='".$row['id']."'>".$row['name']."  (". $row['mobile'].")</option>";
                        }
                    ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2"><span><img src='../img/add.png' width='30px' height='30px'
                                                data-toggle="modal" data-target="#myModal"></span></div>
                                </div>


                                <div class="row form-group">
                                    <!-- <div class="col-md-1"></div> -->
                                    <div class="col-md-1">
                                        <h5><b>SUB :</b></h5>
                                    </div>
                                    <div class="col-md-8">

                                        <input type="text" class="form-control" id="subject" name="subject"
                                            value="Quotation for Supply of Lenovo Laptop" style="width:90%">

                                    </div>
                                </div>

                                <br>
                                <p id="p_format">Dear Sir,<br> As per our discussion we are pleased to submit our
                                    Quotation in
                                    this regard.</p>
                                <input type="hidden" id="count" value="1">

                            </div>
                        </div>

                        <div id="format_box"></div>

                        <button type="button" class="btn btn-info btn-block btn-sm" id="add_more"
                            onclick="add_more_function();">+Add More</button>

                        <br> <br>
                        <div class="card">
                            <div class="card-header">
                                <h5 align="center"><b>COMMERCIAL TERMS & CONDITIONS</b></h5><br>
                            </div>
                            <div class="card-body">
                                <ol type="i">
                                    <li>
                                        <p>The Purchase Order to Be Placed On M/s Ask For Solutions..</p>
                                    </li>
                                    <li>
                                        <p> Support & Services: The after sales support & services will be directly
                                            rendered by
                                            lenovo. </p>
                                    </li>

                                    <li>
                                        <p> Payment terms: 100% advance along with Purchase Order.</p>
                                    </li>

                                    <li>
                                        <p> Delivery: Delivery of the Notebook will be done within <input type="text"
                                                id="working_day" name="working_day" value="7"> working days from the
                                            date of
                                            Purchase Order.</p>
                                    </li>

                                    <li>
                                        <p> Force Majeure clauses as applicable </p>
                                    </li>
                                    <li>
                                        <p> Offer and price is valid up to <input type="text" id="valid_upto"
                                                name="valid_upto" value="2"> days from the date of issue of the
                                            quotation.</p>
                                    </li>
                                </ol>

                                <!--<h6><b>Total Price: Rs <input type="text" id="total_price" name="total_price">-->
                                <!--        (INCLUSIVE OF-->
                                <!--        GST)</b></h6>-->
                                <br><br>
                                <span>Thank you and assuring you of our best service and support at all
                                    times.</span><br>
                                <span>Yours sincerely,</span><br>
                                <span>For ASK-FOR SOLUTIONS</span><br>
                            </div>
                        </div>

                        <!-- <small>
                            Relation Desk<br>
                            Ajay Singh(9831033178)<br>
                            mail: sales.ho@askforworld.co.in<br>
                            Date: 15-12-2021<br>
                            GSTIN/UIN : 19ATCPS8492F1Z3<br>
                            VAT. NO.- 19414902014 ;PAN-ACTPS8492F<br>
                            Bank Details: ICICI Bank A/C-037205000204 ; Sarat Bose Branch<br>
                            RTGS/NEFT IFSC Code: ICIC0000372<br>
                        </small>
                        <br> -->

                        <button type="button" class="btn btn-primary btn-block submit_qutation">submit</button>
                    </div>

                </form>


                <p class="disabled" align="center" disabled="true"><b>ASK-FOR </b> Solutions:1, Indra Roy Road,Kolkata -
                    700025</p>
            </div>
            <div id='menu1' class='tab-pane fade in'>

                <table class='table table-sm table-hover' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Item</th>
                         <th>Qty</th>
                        <th>Price</th>
                        <th>Warrenty</th>
                        <!-- <th>Gst</th> -->
                        <!-- <th>Subject</th> -->
                        <th>Delivery Working Day</th>
                        <th>Validity</th>
                        <th>Quote</th>
                        <th>Action</th>
                    </thead>

                    <!-- <tfoot>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Item</th>
                         <th>Qty</th>
                        <th>Price</th>
                        <th>Warrenty</th>
                     <th>Gst</th> -->
                        <!-- <th>Subject</th>
                        <th>Delivery Working Day</th>
                        <th>Validity</th>
                        <th>Quote</th>
                        <th>Action</th>
                    </tfoot> -->


                    <tbody>
                        <?php
   $c=0; 

              $sql='SELECT * FROM `quotation` WHERE `status`="1"  ORDER BY `id` DESC ';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                $c++;
               $id=$row['id'];
               

              
$customer_id=$row['customer_id'];
$item_id_concated_unz=unserialize($row['item_id']);
$subject=$row['subject'];
$delivery_working_day=$row['delivery_working_day'];
$price_valid_day=$row['price_valid_day'];
$price_unsrz=unserialize($row['price']);
$status=$row['status'];




if($customer_id==0){
    $name="--";
}else{
    $customer_details = fetch_data($conn, "customer_details","id",$customer_id);
     $name=$customer_details['name'].'<br>'.$customer_details['mobile'].'<br>'.$customer_details['email'];
}

$item_name="";
foreach ($item_id_concated_unz as $key => $item_id_concated) {


$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);

$dp_ap   = check_item_or_product_data($conn,$item_id,$item_type);
$item_name.=$dp_ap['name']."<br>".$dp_ap['mtm']."<br>";

               }

$price="";
$qty="";
$warrenty="";
$including_gst="";

foreach ($price_unsrz as $key => $price_unsrz) {

    $qty.=$price_unsrz["qty"].'<br>';
    $price.=$price_unsrz["price"].'<br>';
    $warrenty.=$price_unsrz["warrenty"].'<br>';

    $gst = fetch_data($conn, "hsn_rate_master","id",$price_unsrz["including_gst"]);
    $including_gst.=$gst["rate"]. ' %<br>';
                   }

            //    print_r($price_unsrz);

 echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'.$name.'</td>';
 echo '<td>'. $item_name.'</td>';

 echo '<td>'. $qty.'</td>';
 echo '<td>'. $price.'</td>';
 echo '<td>'. $warrenty.'</td>';
//  echo '<td>'. $including_gst.'</td>';

//  echo '<td>'. $subject.'</td>';
 echo '<td>'. $delivery_working_day.'</td>';
 echo '<td>'. $price_valid_day.'</td>';

//  echo '<td><a href="quotation_view.php?quotation_id='.$id.'"><button type="button" class="btn btn-secondary">view</button></a></td>';
 echo '<td><a href="../fpdf/show_quotation.php?quotation_id='.$id.'" target="_blank"><button type="button" class="btn btn-secondary">view</button></a></td>';
// $edit_modal_params_string="'$id','$product_id','$brand_id','$series_name',$status";
// $edit_modal_params='openModel('.$edit_modal_params_string.')';
// echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="quotation_edit.php?quotation_id='.$id.'"><img src="../img/edit.png" style="width:30px" ></a><a href="test_del.php?id='.$id.'"><img src="../img/delete.png" style="width:30px" ></a></td>';
 echo '</tr>';
}
 ?>
                    </tbody>
                </table>



            </div>
        </div>



        <!-- The Modal -->
        <div class='modal' id='myModal'>

            <div class='modal-dialog modal-xl'>

                <div class='modal-content'>

                    <!-- Modal Header -->

                    <div class='modal-header'>

                        <h4 class='modal-title'><b>Add New Customer || </b> <img src='../img/icon/customer.png'
                                width='60px' height='60px'></h4>

                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body enctype="multipart/form-data"-->

                    <div class='modal-body'>

                        <form class="form-horizontal myForm" action="" method="post">
                            <!-- <center> -->

                            <div class="form-group row">

                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:600px">

                                        <input type="radio" id="html" name="customer_type" value="2">&nbsp &nbsp
                                        <label for="css">Business</label>&nbsp &nbsp
                                        <input type="radio" id="css" name="customer_type" value="1" checked>&nbsp &nbsp
                                        <label for="css">Indivisual</label><br>

                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:500px">


                                        <span class="input-group-text">Mobile</span>
                                        <input type="number" class="form-control" placeholder="enter your contact no "
                                            id="phone" name="phone" onkeyup='GetMobile_no(this.value)'
                                            onclick='GetMobile_no(this.value)' required><br>



                                        <span id="mobile_error"></span>
                                    </div>


                                </div>


                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:500px">
                                        <span class="input-group-text">Attention</span>
                                        <input type="text" class="form-control" placeholder="" id="attention"
                                            name="attention">
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:500px">
                                        <span class="input-group-text">Name</span>
                                        <input type="text" class="form-control" placeholder="enter your name " id="name"
                                            name="name">
                                    </div>



                                </div>

                                <div class="col-md-6">

                                    <div class="input-group mb-3" style="width:500px">



                                        <select class="form-control" name="state_id" id="state_id" style="width:100%">
                                            <option value="">select state</option>
                                            <?php
                $sql="SELECT * FROM `states` WHERE `status`='1'";
                $query=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($query)){
                  echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
                ?>
                                        </select>


                                    </div>






                                </div>
                            </div>



                            <div class="row">

                                <div class="col-md-6">

                                    <div class="input-group mb-3" style="width:500px">
                                        <span class="input-group-text">Email</span>
                                        <input type="email" class="form-control" placeholder="enter your mail address"
                                            id="email" name="email">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:500px">
                                        <span class="input-group-text">City</span>
                                        <input type="text" class="form-control" placeholder="enter your city " id="city"
                                            name="city">
                                    </div>

                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:500px">
                                        <span class="input-group-text">Display Name</span>
                                        <input type="text" class="form-control" placeholder="enter your display name"
                                            id="display_name" name="display_name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:500px">
                                        <span class="input-group-text">Zip Code</span>
                                        <input type="text" class="form-control" placeholder="zip code" id="zip_code"
                                            name="zip_code">

                                    </div>

                                </div>
                            </div>





                            <div class="row">

                                <div class="col-md-6">

                                    <div class="input-group mb-3" style="width:500px">
                                        <span class="input-group-text">GST</span>
                                        <input type="text" class="form-control" placeholder="Enter gst (if)" id="gst"
                                            name="gst">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3" style="width:500px">


                                        <span class="input-group-text">Address</span>
                                        <textarea type="text" class="form-control"
                                            placeholder=" enter your full address" id="address"
                                            name="address"></textarea>



                                    </div>
                                </div>

                            </div>

                            <!-- <div class="input-group mb-3" style="width:1070px">
                    <button type="submit" class="btn btn-primary btn-block">+ Add </button>
                </div> -->

                            <div id="disable_button">
                                <button type='button' id='submit_button' class='btn btn-danger btn-block disabled'>+
                                    Add</button>
                            </div>
                            <div id="active_button">
                                <button type='button' id='submit_button'
                                    class='btn btn-primary btn-block add_customer'>+ Add</button>
                            </div>

                            <!-- </center> -->


                        </form>


                    </div>
                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                    </div>

                </div>
            </div>
        </div>


    </div> <!-- for container-->



</body>
<script>
$(document).ready(function() {
    $("#customer_id").select2();
    $("#state_id").select2();
    $("#including_gst").select2();
    $("#disable_button").hide();

    
    add_more_function();



});

    $('#example tfoot th').each(function() {

var title = $(this).text();

$(this).html('<input type="text" class="" placeholder="Search" />');

});
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


table.columns().every(function() {

var that = this;


$('input', this.footer()).on('keyup change', function() {

    if (that.search() !== this.value) {

        that.search(this.value).draw();

    }

});

});



function Fetch_item_price(price) {
    $("#total_price").val(price);
}

function add_more_function() {
    var c = $("#count").val();

    // alert(c);
    $.ajax({
        type: 'POST',
        data: {
            count: c
        },
        url: "../controllers/ajax/fetch_product_for_quotation.php",
        dataType: "JSON",
        success: function(result) {
            console.log(result['data']);
            $("#format_box").append(result['data']);
            $("#item_id_" + c).select2();
            c++;
            $("#count").empty();
            $("#count").val(c);

        }
    });

}


function get_item_detail(item_id, c) {
    // alert(item_id+" "+c);
    // var c = $("#count").val();
    $.ajax({
        type: 'POST',
        data: {
            item_id: item_id,
            count: c
        },
        url: "../controllers/ajax/product_detail_by_model_id.php",
        dataType: "JSON",
        success: function(result) {
            // alert(result['data']);
            console.log(result['data']);

            $("#p_format_body_" + c).empty();
            $("#p_format_body_" + c).append(result['data']);

            $(".including_gst").select2();
        }
    });
}


function remove_item_subsection(row_id, item_id_concated) {
    $("#item_" + item_id_concated + "_" + row_id).remove();
}





function remove_item(c) {
    $("#box_" + c).remove();
}

function GetMobile_no(phone_no) {
    if ((phone_no.length) == 10) {
        $.ajax({
            type: "POST",
            data: {
                name: phone_no,
                table_name: 'customer_details',
                table_col_name: 'mobile',

            },
            url: "../controllers/ajax/ajax_check_duplicate.php",
            success: function(data) {
                // alert(data);
                if (data == 1) {

                    // alert("You Can't Proceed ,this 'Tender NO' is already available");

                    $("#phone").css('border-color', 'red');

                    // $("#mobile_error").remove();
                    // $("#phone").after("<span id='mobile_error' class='text-danger'>This mobile no. is already Exist</span>");

                    $("#disable_button").show();
                    $("#active_button").hide();

                    swal({
                        type: "error",
                        title: "Customer Details || " + phone_no,
                        text: "This mobile no. is already Exist!",
                        icon: "error",

                        button: "ok!",
                    });



                }
                if (data == 0) {
                    // $("#mobile_error").remove();
                    $("#phone").css('border-color', '');

                    $("#active_button").show();
                    $("#disable_button").hide();
                }
            }
        });
    } else {
        $("#disable_button").show();
        $("#active_button").hide();
    }



}





$('.add_customer').click(function() {
    // alert("hello");
    // console.log("hello");
  var form=  $('.myForm').serialize();
//   alert(form);
    $.ajax({
       type: "POST",
       data: form,
       url: "../controllers/customer_cont.php",
        beforeSend: function() {

            swal("Customer Details", "Loading response...!", "success");


        },
        success: function(res) {
            // console.log(res);
            // alert(res);
            $('#myModal').modal('hide');
            $('.myForm').trigger("reset");
            $("#customer_id").append(res);
        }
    });
});


       

// $('.submit_qutation').click(function() {
//     swal({
//             title: "Confirm?",
//             text: "Are you sure?",
//             type: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#DD6B55",
//             confirmButtonText: "Confirm",
//             cancelButtonText: "Back"
//         },
//         function(isConfirm) {
//             if (isConfirm) {
//                 $.ajax({
//                     url: "../controllers/quotation_add.php",
//                     method: "POST",
//                     data: $('.quotation_form_submit').serialize(),
//                     beforeSend: function() {

//                         swal("Quotation Details", "Loading response...!", "success");


//                     },
//                     success: function(data) {

//                         swal({
//                             type: "success",
//                             title: "Quotation Details ||",
//                             text: "Quotation submitted successfully .",
//                             icon: "success",
//                         }, function(value) {
//                             window.location.reload();
//                         });

//                     }
//                 });
//             }
//         });

// });





$('.submit_qutation').click(function() {
swal({
        title: "Confirm?",
        text: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Confirm!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "../controllers/quotation_add.php",
                method: "POST",
                data: $('.quotation_form_submit').serialize(),
                beforeSend: function() {

                    swal("Quotation Details", "Loading response...!", "success");


                },
                success: function(data) {
// alert(data);
                    swal({
                        type: "success",
                        title: "Quotation Details ||",
                        text: "Quotation submitted successfully .",
                        icon: "success",
                    }, function(value) {
                        window.location.reload();
                    });

                }
            });
        } 
    });

});
</script>

</html>