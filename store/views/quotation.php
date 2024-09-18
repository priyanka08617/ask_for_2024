<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';                         
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include '../includes/header.php'; ?>
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

        <h3><b>Quotation Creation</b></h3>
        <p class='text-muted'><b>Fill in the given below tab to Quotation Creation and Manage Quotation Details </b></p>
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
            <div id='home' class='tab-pane in active'>
                <form class='form-horizontal' action='../controllers/quotation_add.php' method='post'>
                    <!-- my code start  -->
                    <div id="box">
                        <h5><b>To,</b></h5>

                        <div class="row form-group">
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <select id="customer_id" name="customer_id" style="width:100%" class="form-control"
                                    required>
                                    <option value=" ">Select</option>
                                    <?php
                        $sql="SELECT * FROM `customer_details`";
                        $query=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($query)){
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                        }
                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="row form-group">
                            <!-- <div class="col-md-1"></div> -->
                            <div class="col-md-1">
                                <h5><b>SUB :</b></h5>
                            </div>
                            <div class="col-md-8">

                                <input type="text" id="subject" name="subject"
                                    value="“Quotation for Supply of Lenovo Laptop”" style="width:90%">

                            </div>
                        </div>

                        <br>
                        <p id="p_format">Dear Sir,<br> As per our discussion we are pleased to submit our Quotation in
                            this regard.</p>
                            <input type="hidden" id="count" value="1" >

                    <div id="format_box"></div>

                        <button type="button" class="btn btn-info btn-block btn-sm" id="add_more"
                            onclick="add_more_function();">+Add More</button>

                        <br>
                        <h5 align="center"><b>COMMERCIAL TERMS & CONDITIONS</b></h5><br>

                        <ol type="i">
                            <li>
                                <p>The Purchase Order to Be Placed On M/s Ask For Solutions..</p>
                            </li>
                            <li>
                                <p> Support & Services: The after sales support & services will be directly rendered by
                                    lenovo. </p>
                            </li>

                            <li>
                                <p> Payment terms: 100% advance along with Purchase Order.</p>
                            </li>

                            <li>
                                <p> Delivery: Delivery of the Notebook will be done within <input type="text"
                                        id="working_day" name="working_day" value="7"> working days from the date of
                                    Purchase Order.</p>
                            </li>

                            <li>
                                <p> Force Majeure clauses as applicable </p>
                            </li>
                            <li>
                                <p> Offer and price is valid up to <input type="text" id="valid_upto" name="valid_upto"
                                        value="2"> days from the date of issue of the quotation.</p>
                            </li>
                        </ol>

                        <h6><b>Total Price: Rs <input type="text" id="total_price" name="total_price"> (INCLUSIVE OF
                                GST)</b></h6>

                        <p>Thank you and assuring you of our best service and support at all times.</p>
                        <p>Yours sincerely,</p>
                        <p>For ASK-FOR SOLUTIONS</p><br>



                        <small>
                            Relation Desk<br>
                            Ajay Singh(9831033178)<br>
                            mail: sales.ho@askforworld.co.in<br>
                            Date: 15-12-2021<br>
                            GSTIN/UIN : 19ATCPS8492F1Z3<br>
                            VAT. NO.- 19414902014 ;PAN-ACTPS8492F<br>
                            Bank Details: ICICI Bank A/C-037205000204 ; Sarat Bose Branch<br>
                            RTGS/NEFT IFSC Code: ICIC0000372<br>
                        </small>
                        <br>
                        <p class="disabled" align="center" disabled="true"><b>ASK-FOR </b> Solutions:1, Indra Roy
                            Road,Kolkata - 700025</p>
                        <button type="submit" class="btn btn-primary btn-block">submit</button>
                    </div>

                </form>
            </div>
            <div id='menu1' class='tab-pane fade in'>

                <table class='table' id='example'>
                    <thead>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Subject</th>
                        <th>Delivery Working Day</th>
                        <th>Price Valid Day</th>
                        
                        <th>Quote</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <!--- // ************************************************************ -->
                        <?php
   $c=0; 
//    
              $sql='SELECT * FROM quotation WHERE status="1" GROUP BY customer_id ORDER BY id DESC ';
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





$customer_details = fetch_data($conn, "customer_details","id",$customer_id);
$item_name="";
foreach ($item_id_concated_unz as $key => $item_id_concated) {


$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);

$dp_ap   = check_item_or_product_data($conn,$item_id,$item_type);
$item_name.=$dp_ap['name']."<br>";

               }

               $price="";
foreach ($price_unsrz as $key => $price_unsrz) {

$price.=$price_unsrz."<br>";

               }


 echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td>'. $customer_details['name'].'</td>';
 echo '<td>'. $item_name.'</td>';
 echo '<td>'. $price.'</td>';
 echo '<td>'. $subject.'</td>';
 echo '<td>'. $delivery_working_day.'</td>';
 echo '<td>'. $price_valid_day.'</td>';

 echo '<td><a href="quotation_view.php?customer_id='.$customer_id.'"><button type="button" class="btn btn-secondary">view</button></a></td>';
 
// $edit_modal_params_string="'$id','$product_id','$brand_id','$series_name',$status";
// $edit_modal_params='openModel('.$edit_modal_params_string.')';
// echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="test_del.php?id='.$id.'"><img src="../img/delete.png" style="width:30px" ></a></td>';
 echo '</tr>';
}
 ?>
                    </tbody>
                </table>



            </div>
        </div>
</body>
<script>

$(document).ready(function() {
    $("#customer_id").select2();
    add_more_function();
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
            $("#item_id_"+c).select2();
            c++;
            $("#count").empty();
            $("#count").val(c);

        }
    });

}


function get_item_detail(item_id,c) {
    // alert(item_id+" "+c);
    // var c = $("#count").val();
    $.ajax({
        type: 'POST',
        data: {
            item_id: item_id,
            count:c
        },
        url: "../controllers/ajax/product_detail_by_model_id.php",
        dataType: "JSON",
        success: function(result) {
            // alert(result['data']);
            console.log(result['data']);

            $("#p_format_body_"+c).empty();
            $("#p_format_body_"+c).append(result['data']);
        }
    });
}


</script>

</html>