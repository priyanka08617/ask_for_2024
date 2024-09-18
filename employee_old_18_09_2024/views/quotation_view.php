<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';  
$customer_id=sanitize_input($conn,$_GET["customer_id"]);                       
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include '../includes/header.php'; ?>
    <title>Quotation</title>
    <style>
    #box {
        border: 1px solid gray;
        margin: 30px 100px 50px 150px;
        padding: 70px 50px 50px 70px;
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

        <?php
   $c=0; 
   
              $sql='SELECT * FROM quotation WHERE status="1" AND customer_id='.$customer_id.' ORDER BY id DESC ';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                $c++;
               $id=$row['id'];
               

              
$customer_id=$row['customer_id'];
$item_id_concated_unserialize=unserialize($row['item_id']);
$subject=$row['subject'];
$delivery_working_day=$row['delivery_working_day'];
$price_valid_day=$row['price_valid_day'];
$price_unserialize=unserialize($row['price']);
$status=$row['status'];





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
$count=0;
foreach ($item_id_concated_unserialize as $key => $item_id_concated) {
    
    $count++;
   
$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);
$dp_ap   = check_item_or_product_data($conn,$item_id,$item_type);



?>

<h5><b>Option <?php echo $count;?></b></h5>

    <table class="table table-sm table-bordered">
        <thead><tr><th><h5 align="center">Model</h5></th><th><h5 align="center"><?php echo $dp_ap["name"]?></h5></th></tr></thead>
        <tbody>
 <?php
if($item_type==1){
    $c=1;
    $sql="SELECT * FROM dp_details WHERE dp_id='$item_id' AND status='1' GROUP BY specification_head_id";
      $query=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_array($query)){
        $c++;
        $specification_head_id = $row["specification_head_id"];
     
    
    
        $specification_head=singleRowFromTable($conn, "SELECT * FROM `specification_head` WHERE id='$specification_head_id'", "head_name");
    
        $subhead_data_variable="";
    
        $sql1="SELECT * FROM `dp_details` WHERE   `dp_id`='$item_id' AND `specification_head_id`='$specification_head_id' AND status='1' ";
        $query1=mysqli_query($conn,$sql1);
        while($row1=mysqli_fetch_array($query1)){
          
          $specification_subhead_data_id = $row1["specification_subhead_data_id"];
          $specification_subhead_id= $row1["specification_subhead_id"];
    
          
          $specification_subhead=singleRowFromTable($conn, "SELECT * FROM specification_subhead WHERE id='$specification_subhead_id'", "subhead_name");
          $subhead_data_name=singleRowFromTable($conn, "SELECT * FROM specification_subhead_data WHERE id='$specification_subhead_data_id'", "subhead_data");
    
          $subhead_data_variable.=$specification_subhead." - ".$subhead_data_name.",";
        
        }
      
          echo "<tr>";
          // $data.= "<td>".$c."</td>";
          echo "<th>".$specification_head."</th>";
          echo "<td>".$subhead_data_variable."</td>";
          echo "</tr>";
      
      
        
      }
   
    
    }elseif($item_type==2){
      
    
    }

   $gst_amount= (($price_unserialize[$key]*18) / 100);
   

    echo "<tr><th><h5><b>Base Price Point</b></h5></th><td>".$price_unserialize[$key]."</td></tr>";
    echo "<tr><th><h5><b>GST 18%</b></h5></th><td>".$gst_amount."</td></tr>";
    

    
?> 



        </tbody></table>








<?php

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
                                 Delivery: Delivery of the Notebook will be done within <input type="text"
                                        id="working_day" name="working_day" value="7"> working days from the date of
                                    Purchase Order.
                            </li>

                            <li>
                                 Force Majeure clauses as applicable
                            </li>
                            <li>
                                 Offer and price is valid up to <input type="text" id="valid_upto" name="valid_upto"
                                        value="2"> days from the date of issue of the quotation.
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
                     
                



            </div>
        </div>
</body>
</html>