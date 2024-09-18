<?php 
 include 'connection.php';
 include '../../includes/functions.php';


$item_id=$_GET['product_id'];
$c=0; 
 
// $len = strlen($item_id); 
// $item_id_split=str_split($item_id,$len-1);

// $item_id_after_split=$item_id_split[0];
// $item_type_after_split=$item_id_split[1];

$item_type_after_split=substr($item_id,-1);

$item_id_after_split= substr( $item_id,0,-1);


$product_uom=check_item_or_product_data($conn,$item_id_after_split,$item_type_after_split);
$uom_id=$product_uom['uom_id'];


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
// echo $option;
 }
 
?>