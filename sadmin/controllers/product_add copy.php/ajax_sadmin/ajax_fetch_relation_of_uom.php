<?php 
 include 'connection.php';
 include '../../includes/functions.php';



$item_id_concat=$_POST['id'];
// $len = strlen($item_id); 
// $item_id_split=str_split($item_id,$len-1);

$item_id=substr( $item_id_concat,0,-1);
$item_type=substr( $item_id_concat,-1);


$product_uom=check_item_or_product_data($conn,$item_id,$item_type);
$uom_id=$product_uom['uom_id'];

$c=0;

$data =  fetch_data($conn,"uom","id",$uom_id);
echo "<option value='".$uom_id."' selected>". $data["uom_name"]."</option>";

$sql="SELECT * FROM uom_conversion_setting WHERE form_unit_source='$uom_id' OR to_unit_source='$uom_id'";
$result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){

  $c++;
 
 


if($row["form_unit_source"]==$uom_id){


    $to_unit_source = $row["to_unit_source"];
    $data =  fetch_data($conn,"uom","id",$to_unit_source);
      
    echo "<option value='".$row["to_unit_source"]."'>". $data["uom_name"]."</option>";

}elseif($row["to_unit_source"]==$uom_id){

  $form_unit_source = $row["form_unit_source"];
  $data =  fetch_data($conn,"uom","id",$form_unit_source);
    
    echo "<option value='".$row["form_unit_source"]."'>". $data["uom_name"]."</option>";
}
 }
 
?>