<?php
include 'connection.php';
include '../../includes/functions.php';
$data="";
$hsn_slab="";



    $item_id_concat=$_POST['id'];
	$item_id=substr( $item_id_concat,0,-1);
	$item_type=substr( $item_id_concat,-1);
	
	
	$product_uom=check_item_or_product_data($conn,$item_id,$item_type);
	$uom_id=$product_uom['uom_id'];
	$hsn_rate_id=$product_uom['hsn_rate_id'];
	

	$c=0;

	$data_fetch =  fetch_data($conn,"uom","id",$uom_id);
	$data.="<option value='".$uom_id."' selected>". $data_fetch["uom_name"]."</option>";
	
	$sql="SELECT * FROM uom_conversion_setting WHERE form_unit_source='$uom_id' OR to_unit_source='$uom_id'";
	$result=mysqli_query($conn,$sql);
	 while($row=mysqli_fetch_array($result)){
	
	  $c++;
	 
	 
	
	
	if($row["form_unit_source"]==$uom_id){
	
	
		$to_unit_source = $row["to_unit_source"];
		$data =  fetch_data($conn,"uom","id",$to_unit_source);
		  
		$data.="<option value='".$row["to_unit_source"]."'>". $data["uom_name"]."</option>";
	
	}elseif($row["to_unit_source"]==$uom_id){
	
	  $form_unit_source = $row["form_unit_source"];
	  $data =  fetch_data($conn,"uom","id",$form_unit_source);
		
	  $data.="<option value='".$row["form_unit_source"]."'>". $data["uom_name"]."</option>";
	}
	// echo $option;
	 }





		$sql2 = "SELECT * FROM hsn_rate_master WHERE id='$hsn_rate_id'";
	    $query2 = mysqli_query($conn,$sql2);
		$row2=mysqli_fetch_array($query2);
			
			$rate_id=$row2["id"];
			$hsn_rate="<option value='".$rate_id."'>".$row2["rate"]."</option>";
		

	

	echo $data."-".$hsn_rate;

?>

      

