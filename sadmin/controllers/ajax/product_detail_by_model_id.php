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
$c=0;
$sql="SELECT * FROM `dp_details` WHERE `dp_id`='$item_id' AND `status`='1' GROUP BY `specification_head_id`";
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

      
      $specification_subhead=singleRowFromTable($conn, "SELECT * FROM `specification_subhead` WHERE `id`='$specification_subhead_id'", "subhead_name");
      $subhead_data_name=singleRowFromTable($conn, "SELECT * FROM `specification_subhead_data` WHERE `id`='$specification_subhead_data_id'", "subhead_data");

      $subhead_data_variable.=$specification_subhead." - ".$subhead_data_name.",";
    
    }
  
      $data.= "<tr id='item_".$item_id_concated."_".$c."'>";
      // $data.= "<td>".$c."</td>";
      $data.= "<td><input type='hidden' name='head_".$item_id_concated."[]' value='".$specification_head."'><p>".$specification_head."</p></td>";
      $data.= "<td><input type='text' class='form-control' value='".$subhead_data_variable."' name='subhead_data_".$item_id_concated."[]'></td>";
      $data.= "<td><img src='../img/cancel.png' width='30px' width='30px' onclick='remove_item_subsection(".$c.",".$item_id_concated.")'></td>";
      $data.= "</tr>";
  
  
    
  }

  $data.="<tr>
<th>Qty</th>
<td><input type='number' class='form-control' name='qty_".$item_id_concated."[]' id='qty_".$count."' onkeyup='Fetch_item_qty(this.value)' placeholder='Product Qty' step='0.01'></td>
</tr>";


$data.="<tr>
<th>Price</th>
<td><input type='number' class='form-control' name='price_".$item_id_concated."[]' id='price_".$count."' onkeyup='Fetch_item_price(this.value)' placeholder='Product Price' step='0.01'></td>
</tr>";

$data.="<tr>
<th>Warrenty</th>
<td><input type='text' class='form-control' name='warrenty_".$item_id_concated."[]' id='warrenty_".$count."' placeholder='Product warrenty'></td>

</tr>";



$data.="<tr><th>Including GST</th>
<td><select  class='form-control including_gst' name='including_gst_".$item_id_concated."[]' id='including_gst_".$count."' placeholder='Gst Amount' style='width:100%'>";
$data.="<option value=''>Select</option>";
$sql="SELECT * FROM `hsn_rate_master` WHERE `status`='1'";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){
  $data.="<option value='".$row["id"]."'>".$row["rate"]."</option>";
}

$data.="</select></td></tr>";


}elseif($item_type==2){
  

}
$array = array('data' => $data);
echo json_encode($array);

?>