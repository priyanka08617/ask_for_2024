<?php
ob_start();
include '../includes/check.php';
include '../includes/functions.php';


$customer_id = sanitize_input($conn,$_POST["customer_id"]);
$subject = sanitize_input($conn,$_POST["subject"]);
$item_id = $_POST["item_id"];
$qty = $_POST["qty"];
$price_array = $_POST["price"];
$working_day = sanitize_input($conn,$_POST["working_day"]);
$valid_upto  = sanitize_input($conn,$_POST["valid_upto"]);
$total_price = sanitize_input($conn,$_POST["total_price"]);
$entry_date_time=date('Y-m-d h:s:a');


$c=0;
$description_array=array();
foreach ($item_id as $key => $item_value) {
  $c++;
  $item[]=$item_value;
  foreach ($_POST["head_".$item_value] as $key1 => $item_subhead_name) {

  $description_array[$item_value][] = array('item'=>$item_value,'item_head_'.$item_value=>$item_subhead_name,'item_subhead_'.$item_value=>$_POST["subhead_data_".$item_value][$key1]);

  }

  foreach ($_POST["price_".$item_value] as $key2 => $price) {
    foreach ($_POST["warrenty_".$item_value] as $key2 => $warrenty) {
      foreach ($_POST["including_gst_".$item_value] as $key2 => $including_gst) {
        foreach ($_POST["qty_".$item_value] as $key2 => $qty) {
    // $price_warrenty_gst_array[$item_value][] = array('item_'=>$item_value,'price'=>$price,'warrenty'=>$_POST["warrenty_".$item_value][$key2],'including_gst'=>$_POST["including_gst_".$item_value][$key2],'qty'=>$_POST["qty_".$item_value][$key2]);

    // $price_warrenty_gst_array[$item_value] = array('item'=>$item_value,'price'=>$price,'warrenty'=>$_POST["warrenty_".$item_value],'including_gst'=>$_POST["including_gst_".$item_value],'qty'=>$_POST["qty_".$item_value]);

    $price_warrenty_gst_array[$item_value] = array('item'=>$item_value,'price'=>$price,'warrenty'=>$warrenty,'including_gst'=>$including_gst,'qty'=>$qty);
    }

  }
    }}
    

}

echo "<pre>";
print_r($item);
echo "</pre>";
echo "<br>";

echo "<pre>";
print_r($description_array);
echo "</pre>";
echo "<br>";

echo "<pre>";
print_r($price_warrenty_gst_array);

echo "</pre>";
echo "<br>";

$description_srz=serialize($description_array);
$item_srz=serialize($item);
$price_warrenty_gst_array_srz=serialize($price_warrenty_gst_array);




$sql="INSERT INTO `quotation`(`customer_id`, `item_id`,`item_description`, `subject`, `delivery_working_day`, `price_valid_day`, `price`, `entry_date_time`, `status`) VALUES ('$customer_id','$item_srz','$description_srz','$subject','$working_day','$valid_upto','$price_warrenty_gst_array_srz','$entry_date_time','1')";

if (!mysqli_query($conn,$sql)){
  echo("Error description: " . mysqli_error($conn));
}

echo mysqli_error($conn);


header("location:../views/quotation.php");
// exit();
?>