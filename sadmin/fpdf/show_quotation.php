<?php
include '../includes/check.php';
include '../includes/functions.php';
include '../includes/header.php';
$quotation_id = sanitize_input($conn,$_GET['quotation_id']);



require('html_table.php');
class PDF extends FPDF
{

  protected $FontSpacingPt;      // current font spacing in points
  protected $FontSpacing;        // current font spacing in user units

  function SetFontSpacing($size)
  {
    if ($this->FontSpacingPt == $size)
      return;
    $this->FontSpacingPt = $size;
    $this->FontSpacing = $size / $this->k;
    if ($this->page > 0)
      $this->_out(sprintf('BT %.3f Tc ET', $size));
  }

  protected function _dounderline($x, $y, $txt)
  {
    // Underline text
    $up = $this->CurrentFont['up'];
    $ut = $this->CurrentFont['ut'];
    $w = $this->GetStringWidth($txt) + $this->ws * substr_count($txt, ' ') + (strlen($txt) - 1) * $this->FontSpacing;
    return sprintf('%.2F %.2F %.2F %.2F re f', $x * $this->k, ($this->h - ($y - $up / 1000 * $this->FontSize)) * $this->k, $w * $this->k, -$ut / 1000 * $this->FontSizePt);
  }








}





$c=0;
$sql='SELECT * FROM `quotation` WHERE `status`="1" AND `id`='.$quotation_id.' ORDER BY id DESC ';
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
  $c++;
 $id=$row['id'];
 $entry_date_time=date('d-m-Y',strtotime($row['entry_date_time']));


$customer_id=$row['customer_id'];
$item_id_concated_unserialize=unserialize($row['item_id']);
$item_description_unserialize=unserialize($row['item_description']);
$subject=$row['subject'];
$delivery_working_day=$row['delivery_working_day'];
$price_valid_day=$row['price_valid_day'];
$price_warrenty_gst_unserialize=unserialize($row['price']);
$status=$row['status'];


$director = fetch_data($conn, "users","id",2);

$total=0;




$customer_details = fetch_data($conn, "customer_details","id",$customer_id);
$customer_bill_ship_details = fetch_data($conn, "billing_shipping_address","customer_id",$customer_id);
$company = fetch_data($conn, "company_details","status",1);

$pdf = new PDF_MC_Table();
    // $pdf = new html_table();
    $year=date("Y");

    $pdf->SetTitle('Quotation');
    $pdf->AddPage('p');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Image('../img/ask_for_logo.jpg',175,3,30);
 
    //  $pdf->Cell(50, 10, $pdf->Image('../img/ask_for_logo.jpg',100,50),0,1,"C");
   
   $pdf->Cell(170, 15,"", 0,1, 'L');

   $pdf->SetFont('Times', 'B', 10);
   $pdf->Cell(170, 5,"TO ,  ", 0,1, 'L');
   $pdf->Cell(170, 5,$customer_details['display_name'], 0,1, 'L');
   $pdf->Cell(170, 5,$customer_details['mobile'], 0,1, 'L');
   $pdf->Cell(170, 5,$customer_details['email'], 0,1, 'L');
   $pdf->MultiCell(70, 4, $customer_bill_ship_details['address'], 0,"L",0);
   $pdf->Ln();
   
     $pdf->Cell(190, 0,$entry_date_time, 0,1, 'R');
$pdf->Ln();
  //  $pdf->Cell(170, 5,"", 0,1, 'L');
   $pdf->SetFont('Times', 'B', 10);
   $pdf->Cell(170, 5,"", 0,1, 'L');
   $pdf->SetFont('Times', 'U', 10);
   $pdf->Cell(170, 5,"Sub : ".$subject, 0,1, 'C');
  //  $pdf->Ln();


   $pdf->SetFont('Times', 'B', 10);
   $pdf->Cell(170, 5,"Dear Sir ,", 0,1, 'L');
   $pdf->Cell(170, 5,"As per our discussion we are pleased to submit our Quotation in
   this regard", 0,1, 'L');
   


$pdf->SetFont('Times', '', 10);

$grand_total=0;
$h=15;
$c=0;


$count=0;
foreach ($item_id_concated_unserialize as $key => $item_id_concated) {
    
    $count++;
   
$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);
$dp_ap   = check_item_or_product_data($conn,$item_id,$item_type);





$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(60.35, 6, "Model ".$count, "L R B T", 0, 'C');
$pdf->Cell(130.80, 6,$dp_ap["name"]." || ".$dp_ap["mtm"]." || ".$dp_ap["sku"], "L R B T", 1, 'C');

$pdf->SetFont('Times', '', 10);

foreach ($item_description_unserialize as $key1 => $item_description) {
  foreach ($item_description as $key2 => $item_description_data) {
if($item_description_data["item"]==$item_id_concated){




$pdf->SetWidths(array( 60.35,130.80));
$pdf->SetAligns(array('C', 'C'));
$pdf->Row(array($item_description_data["item_head_".$item_id_concated],$item_description_data["item_subhead_".$item_id_concated]));



  }
}

}

foreach ($price_warrenty_gst_unserialize as $key3 => $price_warrenty_gst_ursz) {

  if($price_warrenty_gst_ursz["item"]==$item_id_concated){





  $gst = fetch_data($conn, "hsn_rate_master","id",$price_warrenty_gst_ursz["including_gst"]);
  
  
  $price=$price_warrenty_gst_ursz["price"];
  $taxRate=$gst["rate"];
  $tax=$price*$taxRate/100;
  $total=$price+$tax;
    $gst_amount=$price*$taxRate/100;
//   $gst_amount=(($total-$price)/$price)*100;
  
  
//   $gst_amount= floatval(($price_warrenty_gst_ursz["price"])* intval($gst) / 100);
//   $total= floatval($price_warrenty_gst_ursz["price"]) + floatval($gst_amount);


  $pdf->SetFont('Times', 'B', 10);
  $pdf->Cell(60.35, 6, "Warrenty ", "L R B T", 0, 'C');
  $pdf->Cell(130.80, 6,$price_warrenty_gst_ursz['warrenty'], "L R B T", 1, 'C');


  $pdf->SetFont('Times', 'B', 10);
  $pdf->Cell(60.35, 6, "Qty ", "L R B T", 0, 'C');
  $pdf->Cell(130.80, 6,$price_warrenty_gst_ursz["qty"], "L R B T", 1, 'C');



  $pdf->SetFont('Times', 'B', 10);
  $pdf->Cell(60.35, 6, "Base Price Point", "L R B T", 0, 'C');
  $pdf->Cell(130.80, 6,$price_warrenty_gst_ursz["price"], "L R B T", 1, 'C');

  $pdf->SetFont('Times', 'B', 10);
  $pdf->Cell(60.35, 6, "Gst ".$gst["rate"]." %", "L R B T", 0, 'C');
  $pdf->Cell(130.80, 6,$gst_amount. " || Total Gst amount (".$gst_amount * $price_warrenty_gst_ursz["qty"].")" , "L R B T", 1, 'C');



 $total_amount_value= floatval($total) * ($price_warrenty_gst_ursz["qty"]);
 $grand_total+=$total_amount_value;

  $pdf->SetFont('Times', 'B', 10);
  $pdf->Cell(60.35, 6, "Total Amount ", "L R B T", 0, 'C');
  $pdf->Cell(130.80, 6,$total_amount_value, "L R B T", 1, 'C');


  }

}
$pdf->Cell(192, 10, "", 0, 1, 'C');
}




$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(170, 15,"COMMERCIAL TERMS & CONDITIONS", 0,1, 'C');


$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 5,"", 0,0, 'L R T');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(60, 5,"The Purchase Order to Be Placed On M/s ", 0,0, 'L R T');

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 5,"Ask For Solutions.. ", 0,1, 'L R T');




$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 5,"Support & Services :", 0,0, 'L R T');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(67, 5,"The after sales support & services will be directly rendered by
lenovo.", 0,1, 'L R T');





$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 5,"Payment terms :", 0,0, 'L R T');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(67, 5,"100% advance along with Purchase Order.", 0,1, 'L R T');




$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 5,"Delivery :", 0,0, 'L R T');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(67, 5,"Delivery of the Notebook will be done within", 0,0, 'L R T');
$pdf->SetFont('Times', 'B', 10);

$pdf->Cell(2, 5, $delivery_working_day, 0,0, 'L R T');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, " working days from the date of Purchase Order. ", 0,1, 'L R T');



$pdf->SetFont('Times', '', 10);
$pdf->Cell(40, 5,"", 0,0, 'L R T');
$pdf->Cell(130, 5, "Force Majeure clauses as applicable .", 0,1, 'L');



$pdf->SetFont('Times', '', 10);
$pdf->Cell(40, 5,"", 0,0, 'L R T');
$pdf->Cell(45, 5, "Offer and price is valid up to", 0,0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(5, 5, $price_valid_day, 0,0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, "days from the date of issue of the quotation.", 0,1, 'L');

$grand_total_round=round($grand_total);

$pdf->Cell(40, 10,"", 0,1, 'L R T');
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(40, 5,"Total Price : ", 0,0, 'L R T');
$pdf->Cell(45, 5, "RS. ".$grand_total_round ." (INCLUSIVE OF GST)", 0,1, 'L');
// $pdf->SetFont('Times', 'B', 10);
// $pdf->Cell(10, 5, " ", 0,1, 'L');

$grand_total_in_word= getIndianCurrency($grand_total_round);


$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 5, "", 0,0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, $grand_total_in_word, 0,1, 'L');




$pdf->Cell(180, 15, "", 0,1, 'L');

$pdf->SetFont('Times', '', 10);
$pdf->Cell(180, 5,"Thank you and assuring you of our best service and support at all times.", 0,1, 'L');
$pdf->Cell(180, 5, "Yours sincerely,", 0,1, 'L');

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(180, 5, "For ASK-FOR SOLUTIONS,", 0,1, 'L');



$pdf->Cell(180, 5, "", 0,1, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(180, 5, "Relation Desk,", 0,1, 'L');
$pdf->Cell(180, 5,"Name : ". $director["first_name"]." ".$director["last_name"], 0,1, 'L');
$pdf->Cell(180, 5, "Mobile : ".$director["phone"], 0,1, 'L');
$pdf->Cell(180, 5,"Mail : ". $company["email"], 0,1, 'L');
$pdf->Cell(180, 5, "GST  : ".$company["gst"], 0,1, 'L');
$pdf->Ln();





// $pdf->SetFont('Times', '', 10);
// $pdf->MultiCell(180, 3, $footer_massage, 0, "L");
// $pdf->Ln();


    // $pdf->Cell(20, 0, "", "", 1, 'C');
    // $pdf->Image("../img/stamp.jpeg", 42,null, 33.78);


    // $imagePath="../img/Sourav_Sign.png";
    // $pdf->RotatedImage($imagePath,null,null,45);
    
    // $pdf->SetFont('Times', '', 9);
    // $pdf->Cell(100, 5, "Authorised Signature", 0, 1, 'L');


// $imagePath="../img/Sourav_Sign.png";
// $pdf->Image($imagePath, 10, null, 33.78);
// $pdf->Image("../img/stamp.jpeg", 10,null, 33.78);

    ob_end_clean();
    $pdf->Output();


  

?>