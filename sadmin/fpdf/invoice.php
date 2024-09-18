<?php
include '../includes/conndb.php';
include '../includes/functions.php';
require('fpdf.php');

$transaction_no = $_GET['transaction_no'];
$reservation_number = $_GET['reservation_number'];

$query = mysqli_query($conn, "SELECT *,SUM(pax) AS total_gust FROM reservation WHERE reservation_number='$reservation_number' GROUP BY reservation_number");
$row = mysqli_fetch_array($query);
$chack_in_date = $row['check_in_date'];
$chack_out_date = $row['check_out_date'];
$total_gust = $row['total_gust'];
$customer_details = customerDetailsfromid($conn, $row['customer_details_id']);
$customer_name = $customer_details['name'];
$customer_phone = $customer_details['mobile'];
$customer_email = $customer_details['email'];

$roomdetails = roomdetailsfromid($conn, $row['room_type_id']);
$room_type = $roomdetails['room_type'];
$rate_single = $roomdetails['rate_single'];
$rate_double = $roomdetails['rate_double'];
$rate_extra = $roomdetails['rate_extra'];

$arr_serialized_additional_services = unserialize($row['additional_services']);
$arr_serialized_additional_services_count = count($arr_serialized_additional_services);
if ($arr_serialized_additional_services_count != 0) {
    foreach ($arr_serialized_additional_services as $additional_services_value) {
        $additional_services_value_arr_count = count($additional_services_value);

        if ($additional_services_value_arr_count == 2) {

            if ($additional_services_value['optional_services_value'] == '2') {
                $chack_in_time = $additional_services_value['late_checkin_time'];
            } elseif ($additional_services_value['optional_services_value'] == '3') {
                $chack_in_time = $additional_services_value['early_checkin_time'];
            } elseif ($additional_services_value['optional_services_value'] == '7') {
                $airport_transfer = $additional_services_value['airport_transfer_time_time'];
            }
        }
    }
} else {
    $chack_in_time = "12:00";

    $airport_transfer = "N.A";
}
$chack_out_time = "11:00";

$startTimeStamp = strtotime($chack_in_date);
$endTimeStamp = strtotime($chack_out_date);


$no_of_days = $endTimeStamp - $startTimeStamp;
$days = floor($no_of_days / (60 * 60 * 24));

$query1 = mysqli_query($conn, "SELECT * FROM reservation WHERE reservation_number='$reservation_number'");

$number_of_rooms = mysqli_num_rows($query1);

$amt = 0;
$tot = 0;
$arr_amt = array();

// echo"<pre>";
// print_r($arr_amt);
// echo"</pre>";

$query2 = mysqli_query($conn, "SELECT * FROM transaction WHERE reservation_number='$reservation_number'");

$row2 = mysqli_fetch_array($query2);
$totalAmountTransaction = $row2['total_amount'];
// $number_of_rooms = mysqli_num_rows($query1);






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

$pdf = new PDF();
$pdf->AddPage();
// $pdf->Rect(10,14,150,50,'F');
// $pdf->imageCenterCell("../images/logo.png",10,10,40,50);
$pdf->SetFont('Arial', 'B', 16);

$pdf->Ln();
// $pdf->centreImage("../images/logoBlack.png");
$pdf->Cell(188, 16, $pdf->Image('../images/logoBlue.png', 102, 10, -1500), 0, 1, 'C');

$pdf->SetFont('Arial', '', 16);
$pdf->SetFontSpacing(5);
$pdf->Cell(188, 6, 'MONOTEL', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->SetFontSpacing(1.5);
$pdf->Cell(188, 4, 'Luxury Business Hotel', 0, 1, 'C');
$pdf->SetFillColor(5, 127, 146);
$pdf->SetLeftMargin(90);
$pdf->Cell(39, 0.5, '', 0, 1, 'L', 1);
$pdf->Ln();
$pdf->Cell(188, 1, '', 0, 1);
$pdf->Ln();
$pdf->SetLeftMargin(10);
$pdf->SetFont('Arial', '', 16);
$pdf->Ln();
$pdf->SetFontSpacing(2);
$pdf->MultiCell(188, 6, 'RESERVATION VOUCHER', 0, 'C');
$pdf->SetLeftMargin(65);
$pdf->Cell(90, 0.5, '', 0, 1, 'L', 1);
$pdf->Ln();

$pdf->SetLeftMargin(15);
$pdf->SetFontSpacing(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetLeftMargin(15);
$pdf->Ln();
$pdf->Cell(188, 5, 'Dear Customer,', 0, 1);
$pdf->SetFont('Arial', '', 8);
// $pdf->SetLeftMargin(12);
$pdf->Cell(188, 5, "Thank You for choosing Monotel as your preffered Hotel .It's our pleasure to confirm", 0, 1);
// $pdf->SetLeftMargin(10);
$pdf->Cell(188, 5, "your reservation as follows.", 0, 1);
$pdf->SetFontSpacing(1);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(188, 8, "GUEST DETAILS", 0, 1);
$pdf->Cell(35, 0.5, '', 0, 1, 'L', 1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(188, 2, "", 0, 1);
$pdf->SetFontSpacing(0);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Name", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(124, 5, $customer_name, 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Phone No.", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(124, 5, $customer_phone, 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Email", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(124, 5, $customer_email, 1, 0, 'C');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(188, 8, "RESERVATION DETAILS", 0, 1);
$pdf->Cell(50, 0.5, '', 0, 1, 'L', 1);
$pdf->SetFontSpacing(0);
$pdf->Ln();
$pdf->Cell(188, 2, "", 0, 1);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Reservation No.", 1, 0);
// $pdf->Ln();
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(62, 5, $reservation_number, 1, 0, 'C');
// $pdf->Ln();
$pdf->Cell(62, 5, "CONFIRMED", 1, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Arrival Date/Time", 1, 0);
// $pdf->Ln();
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(62, 5, $chack_in_date, 1, 0, 'C');
// $pdf->Ln();
$pdf->Cell(62, 5, $chack_in_time, 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Departure Date/Time", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(62, 5, $chack_out_date, 1, 0, 'C');
// $pdf->Ln();
$pdf->Cell(62, 5, $chack_out_time, 1, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "No. of Room Nights", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(62, 5, $days, 0, 0, 'C');
$pdf->Cell(62, 5, "", 1, 0, 'C');
// $pdf->Ln();

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "No of Gust", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(62, 5, $total_gust, 1, 0, 'C');
// $pdf->Ln();
$pdf->Cell(62, 5, "", 1, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 8, "Airport Transfer", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(124, 8, $airport_transfer, 1, 0);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 8, "Special Instruction", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(124, 8, "N.A", 1, 0);
// $pdf->Ln();




$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(188, 8, "ROOM DETAILS", 0, 1);
$pdf->Cell(30, 0.5, '', 0, 1, 'L', 1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(188, 2, "", 0, 1);
$pdf->SetFontSpacing(0);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Number Of Rooms", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(124, 5, $number_of_rooms, 1, 0, 'C');

// $pdf->Ln();
$c = 0;
$paxarr = array();
while ($row1 = mysqli_fetch_array($query1)) {
    $c++;
    $pax = $row1['pax'];
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(62, 5, "Pax in Room No. " . $c, 1, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(124, 5, $pax, 1, 0, 'C');
    // for ($i=1; $i <=$number_of_rooms; $i++) { 
    // $pax=$pax_per_room[$i-1];
    $paxarr[] = $pax;

    // if($pax==1){
    //     $amt=bill_value_single_room_view($conn, $row1['room_type_id'], $chack_in_date, $chack_out_date);
    //     $arr_amt[]=$amt;
    //     echo $amt;
    //     // print_r(bill_value_single_room_amount($conn, $room_type_id, $chk_in, $chk_out));
    // }
    // elseif($pax==2){
    //     $amt=bill_value_double_room_view($conn, $row1['room_type_id'], $chack_in_date, $chack_out_date);
    //     $arr_amt[]=$amt;
    //     echo $amt;
    //     // print_r(bill_value_double_room_amount($conn, $room_type_id, $chk_in, $chk_out));
    // }
    // else{
    //     $amt_a=bill_value_double_room_view($conn, $row1['room_type_id'], $chack_in_date, $chack_out_date);
    //     $amt_b=bill_value_extra_room_view($conn, $row1['room_type_id'], $chack_in_date, $chack_out_date);
    //     $amt=$amt_a+$amt_b;
    //     $arr_amt[]=$amt;
    //     echo $amt;
    // }


    // }
}



foreach ($paxarr as  $paxarrvalue) {
    // echo $paxarrvalue;
    if ($paxarrvalue == 1) {
        $amt = bill_value_single_room_amount($conn, $row['room_type_id'], $chack_in_date, $chack_out_date);
        $arr_amt[] = $amt;
        // echo $amt;
        // print_r(bill_value_single_room_amount($conn, $room_type_id, $chk_in, $chk_out));
    } elseif ($paxarrvalue == 2) {
        $amt = bill_value_double_room_amount($conn, $row['room_type_id'], $chack_in_date, $chack_out_date);
        $arr_amt[] = $amt;
        // echo $amt;
        // print_r(bill_value_double_room_amount($conn, $room_type_id, $chk_in, $chk_out));
    } else {
        $amt_a = bill_value_double_room_amount($conn, $row['room_type_id'], $chack_in_date, $chack_out_date);
        $amt_b = bill_value_extra_room_amount($conn, $row['room_type_id'], $chack_in_date, $chack_out_date);
        $amt = $amt_a + $amt_b;
        $arr_amt[] = $amt;
        // echo $amt;
    }
}
$u = 0;
$totaltax12arr = array();
$totaltax18arr = array();
$totaltax12 = 0;
$totaltax18 = 0;
foreach ($arr_amt as $value) {
    if ($value > 999) {
        $tax = taxslab($value);
        if ($tax == 12) {
            $totalAmount = $value * 1.12;
            $taxamount = $totalAmount - $value;
            $totaltax12arr[] = $taxamount;
            $tot = $tot + $totalAmount;
            $room_amount = $value . ".00";
            // echo $value."singel room<br>";
        } elseif ($tax == 18) {
            $totalAmount = $value * 1.18;
            $taxamount = $totalAmount - $value;
            $totaltax18arr[] = $taxamount;
            $tot = $tot + $totalAmount;
            $room_amount = $value . ".00";
            // echo $value."db room<br>";
        }
    } else {
        $room_amount = $value . ".00";
        $tot = $tot + $room_amount;
    }
    $u++;
    // echo "<tr>";
    // echo "<td>Include Tax Amount of Room No. ".$u."</td>";
    // echo "<td>".$totalAmount."</td>";
    // echo "</tr>";
}


$rate_single_room = single_room_amount($conn, $row['room_type_id'], $chack_in_date, $chack_out_date);
$rate_double_room = double_room_amount($conn, $row['room_type_id'], $chack_in_date, $chack_out_date);
$rate_extra_room = extra_room_amount($conn, $row['room_type_id'], $chack_in_date, $chack_out_date);
// echo"<pre>";
// print_r($arr_amt);
// echo"</pre>";

// echo"<pre>";
// print_r($paxarr);
// echo"</pre>";


$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(31, 5, "SGL Rate (Rs.) ", 1, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(31, 5, $rate_single_room, 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(31, 5, "DBL Rate (Rs.)", 1, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(31, 5, $rate_double_room, 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(31, 5, "Extra Rate (Rs.)", 1, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(31, 5, $rate_extra_room, 1, 0, 'C');



// echo"<pre>";
// print_r($totaltax12arr);
// echo"</pre>";

// echo"<pre>";
// print_r($totaltax18arr);
// echo"</pre>";


$totaltax12arrCount = count($totaltax12arr);
$totaltax18arrCount = count($totaltax18arr);
if ($totaltax12arrCount != 0) {
    foreach ($totaltax12arr as  $taxamount) {
        $totaltax12 += $taxamount;
    }

    $totaltaxAmount = $totaltax12 / 2;

    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(47, 5, "CGST(6%) ", 1, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(47, 5, round($totaltaxAmount), 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(47, 5, "SGST(6%) ", 1, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(45, 5, round($totaltaxAmount), 1, 0, 'C');
}


if ($totaltax18arrCount != 0) {
    foreach ($totaltax18arr as  $taxamount) {
        $totaltax18 += $taxamount;
    }
    $totaltaxAmount = $totaltax18 / 2;

    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(47, 5, "CGST(9%) ", 1, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(47, 5, round($totaltaxAmount), 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(47, 5, "SGST(9%) ", 1, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(45, 5, round($totaltaxAmount), 1, 0, 'C');
}

if ($totaltax12arrCount == 0 && $totaltax18arrCount == 0) {
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(47, 5, "CGST", 1, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(47, 5, 'N.A', 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(47, 5, "SGST", 1, 0);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(45, 5, 'N.A', 1, 0, 'C');
}



$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Room Type", 1, 0);
$pdf->SetFont('Arial', '', 8);
// $pdf->Ln();
$pdf->Cell(62, 5, $room_type, 1, 0, 'C');
// $pdf->Ln();
$pdf->Cell(62, 5, "**Taxes as applicable", 1, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 5, "Total Amount (Rs.)", 1, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(124, 5, $totalAmountTransaction, 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(62, 8, "Rate Inclusion", 1, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(124, 8, "Breakfast,Free Wifi internet access,two bottles of package drinking
water per day", 1, 0, 'L');


$pdf->SetFontSpacing(1);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(188, 8, "CANCELLATION POLICY", 0, 1);
$pdf->Cell(61, 0.5, '', 0, 1, 'L', 1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(188, 2, "", 0, 1);
$pdf->SetFontSpacing(0);
$pdf->Ln();

$pdf->MultiCell(188, 5, "** Our reservation team would always assist you if you have changes in your travel plan. However the information about the amendment should be given to us before 24 hours from the date of your arrival to avoid one night cancellation charges and taxes. In case you fail to turn up on the check in day and wish to checkout before to your scheduled departure date,the hotel will charge one night's room tariff and taxes. **", 0);

$pdf->Ln();


$pdf->SetFontSpacing(1);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(188, 8, "IDENTITY PROOF", 0, 1);
$pdf->Cell(61, 0.5, '', 0, 1, 'L', 1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(188, 2, "", 0, 1);
$pdf->SetFontSpacing(0);
$pdf->Ln();

$pdf->MultiCell(188, 5, "** According to Indian Government rules all Indian guest have to carry a proof a government issued identity card like Driving License,Passport,Aadhar Card or Voter's Card.In case of foreigners and non-resident Indians,Passport is mandatory. **", 0);

$pdf->Ln();

$pdf->SetFontSpacing(1);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(188, 8, "Check In / Check - out policy", 0, 1);
$pdf->Cell(61, 0.5, '', 0, 1, 'L', 1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(188, 2, "", 0, 1);
$pdf->SetFontSpacing(0);
$pdf->Ln();

$pdf->MultiCell(188, 5, "Check In & Check Out time 12:00 pm and 11:00 am. 50% rate (on availability) for arrival before 9:00 am or departure post 03:00 pm. 100 % rate(on availability) for arrival before 07:00 am or post departure 06:00 pm.
    
**Below the age of 5 years children are allowed to stay in the room without any extra charges.
**12 and above years adult will be charged Rs. 1500 and taxes additional.", 0);

$pdf->Ln();










$pdf->Output();
