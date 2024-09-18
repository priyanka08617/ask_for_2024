<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';  
$quotation_id=sanitize_input($conn,$_GET["quotation_id"]);                       
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include '../includes/header.php'; ?>
    <title>Quotation</title>
    <style>
    #box {
        border: 1px solid gray;
        margin: 30px 190px 50px 190px;
        padding: 60px 40px 40px 60px;
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
        <p class='text-muted'>Fill in the given below tab to Quotation Creation and Manage Quotation Details</p>
        <a href="../fpdf/show_quotation.php?quotation_id=<?php echo $quotation_id;?>"><button type="button" class="btn btn-warning" style="float:right">Make Pdf</button></a>
        <hr>

        <?php
   $c=0; 
   
              $sql='SELECT * FROM `quotation` WHERE `status`="1" AND `id`='.$quotation_id.' ORDER BY `id` DESC ';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                $c++;
               $id=$row['id'];
               

              
$customer_id=$row['customer_id'];
$item_id_concated_unserialize=unserialize($row['item_id']);
$item_description_unserialize=unserialize($row['item_description']);
$subject=$row['subject'];
$delivery_working_day=$row['delivery_working_day'];
$price_valid_day=$row['price_valid_day'];
$price_warrenty_gst_unserialize=unserialize($row['price']);
$status=$row['status'];


$total=0;


// for($k=0;$k<count($price_unserialize);$k++){
//     $gst_amount= (($price_unserialize[$k]*18) / 100);
//     $total+= floatval($price_unserialize[$k]) + floatval($gst_amount);
// }



$customer_details = fetch_data($conn, "customer_details","id",$customer_id);
// $item   = fetch_data($conn, "item","id",$item_id);



               }
?>
    
                    <div id="box">
                        <h5><b>To,</b></h5>
                        <h5><b><?php echo $customer_details["display_name"]?></b></h5>
                        <h5><b><?php echo $customer_details["address"]?></b></h5>

                        <center><div class="row">
                            <div class="col-md-12"><h5><b><span>Sub :</span> <?php echo $subject;?></b></h5> </div>
                        </div> </center>

                        <!-- <br> -->
                        <p id="p_format">Dear Sir,<br> As per our discussion we are pleased to submit our Quotation in
                            this regard.</p>

                   
                            <div id="format_box">
<?php
$count=1;
foreach ($item_id_concated_unserialize as $key => $item_id_concated) {
    
  
   
$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);
$dp_ap   = check_item_or_product_data($conn,$item_id,$item_type);



?>



    <table class="table table-sm table-bordered">
        
        <thead>
        <tr><th><h5 align="center"><b>Option <?php echo $count;?></b></h5></th><th><h5 align="center"><b><?php echo $dp_ap["name"]." ".$dp_ap["mtm"];?></b></h5></th></tr>
        <tbody>
 <?php

        foreach ($item_description_unserialize as $key1 => $item_description) {
            foreach ($item_description as $key2 => $item_description_data) {
      if($item_description_data["item"]==$item_id_concated){


         echo "<tr>";
         echo "<th><center>".$item_description_data["item_head_".$item_id_concated]."</center></th>";
         echo "<td>".$item_description_data["item_subhead_".$item_id_concated]."</td>";
         echo "</tr>";
     
            }
        }

        }
         
            foreach ($price_warrenty_gst_unserialize as $key3 => $price_warrenty_gst_ursz) {

                if($price_warrenty_gst_ursz["item"]==$item_id_concated){
                            echo "<tr>";
                            echo "<th><center>Qty</center></th>";
                            echo "<td>".$price_warrenty_gst_ursz["qty"]."</td>";
                            echo "</tr>";
                
                
                            $gst = fetch_data($conn, "hsn_rate_master","id",$price_warrenty_gst_ursz["including_gst"]);
                            echo "<tr>";
                            echo "<th><center>Price</center></th>";
                            echo "<td>".$price_warrenty_gst_ursz["price"]."</td>";
                            echo "</tr>";
                
                
                            echo "<tr>";
                            echo "<th><center>Warrenty</center></th>";
                            echo "<td>".$price_warrenty_gst_ursz["warrenty"]."</td>";
                            echo "</tr>";
                
                
                            echo "<tr>";
                            echo "<th><center>Gst</center></th>";
                            echo "<td>".$gst["rate"]."  %</td>";
                            echo "</tr>";
                
                
                
                        }
                      
                    }
                
            

        // }





    ?>
      
          <!-- echo "<tr>";
          // $data.= "<td>".$c."</td>";
          echo "<th>".$specification_head."</th>";
          echo "<td>".$subhead_data_variable."</td>";
          echo "</tr>";
       -->
      
        
    
<!-- 
    echo "<tr><th><h5><b>Base Price Point</b></h5></th><td>".$price_unserialize[$key]."</td></tr>";
    echo "<tr><th><h5><b>GST 18%</b></h5></th><td>".$gst_amount."</td></tr>"; -->
    

    



        </tbody></table><br><br>








<?php
  $count++;
}


?>

                            </div>
                    

                        <br>
                       <center> <span ><b>COMMERCIAL TERMS & CONDITIONS</b></span></center><br>

                        <ol type="a">
                            <li>
                                The Purchase Order to Be Placed On M/s Ask For Solutions..
                            </li>
                            <li>
                                Support & Services: The after sales support & services will be directly rendered by
                                    lenovo.
                            </li>

                            <li>
                                 Payment terms: 100% advance along with Purchase Order.
                            </li>

                            <li>
                                 Delivery: Delivery of the Notebook will be done within <b><?php echo $delivery_working_day;?> </b>working days from the date of
                                    Purchase Order.
                            </li>

                            <li>
                                 Force Majeure clauses as applicable
                            </li>
                            <li>
                                 Offer and price is valid up to <b><?php echo $price_valid_day;?></b>  days from the date of issue of the quotation.
                            </li>
                        </ol>

                        <!--<h6><b>Total Price: Rs <?php echo $total;?> (INCLUSIVE OF-->
                        <!--        GST)</b></h6>-->

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
                     
                



            </div>
        </div>
</body>
</html>