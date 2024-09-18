<?php
ob_start();
include 'connection.php';
include '../../includes/functions.php';

$item_id_concated=sanitize_input($conn,$_POST['item_id']);
$count=sanitize_input($conn,$_POST['count']);

$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);
$data="";
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
  
      $data.= "<tr>";
      // $data.= "<td>".$c."</td>";
      $data.= "<th><h5>".$specification_head."</h5></th>";
      $data.= "<td>".$subhead_data_variable."</td>";
      $data.= "</tr>";
  
  
    
  }
$data.="<tr><th><h5><b>Price</b></h5></th><td><input type='number' class='form-control' name='price[]' id='price_".$count."' onkeyup='Fetch_item_price(this.value)' placeholder='Product Price' step='00.1'></td></tr>";
$data.="<tr><th><h5><b>Including GST</b></h5></th><td><input type='text' class='form-control' name='including_gst[]' id='including_gst_".$count."' readonly></td></tr>";


}elseif($item_type==2){
  

}
$array = array('data' => $data);
echo json_encode($array);

?>