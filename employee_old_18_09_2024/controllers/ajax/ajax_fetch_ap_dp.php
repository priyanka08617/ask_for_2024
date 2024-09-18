<?php
 include 'connection.php';
 include '../../includes/functions.php';

if(!isset($_POST['searchTerm'])){ 
  $fetchData = mysqli_query($conn,"SELECT p.id as product_id, concat(p.id,'2') as concated_id,p.name as product_name FROM ap p WHERE p.status='1'  UNION SELECT i.id as item_id, concat(i.id,'1') as concated_id, i.item as item_name FROM dp i WHERE i.status='1'");


}else{ 
  $search = $_POST['searchTerm']; 

  $fetchData = mysqli_query($conn,"(SELECT p.id as product_id, concat(p.id,'2') as concated_id,p.name as product_name FROM ap p WHERE p.status='1' AND p.name like '%".$search."%'  )UNION( SELECT i.id as item_id, concat(i.id,'1') as concated_id, i.item as item_name FROM dp i WHERE i.status='1' AND i.item like '%".$search."%')");
} 


$data = array();
while ($row = mysqli_fetch_array($fetchData)) {    

  $item_id_concated=$row["concated_id"];


  $item_id=substr( $item_id_concated,0,-1);
  $item_type=substr( $item_id_concated,-1);


  $product_name=$row["product_name"];
if($item_type==1){
  $type="( d.p )";

$description="";
$description="";
$sql1="SELECT * FROM `dp_details` WHERE dp_id='$item_id'";
$query1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_array($query1)){
$subhead_id=$row1["specification_subhead_id"];
$subhead_name=fetch_data($conn,"specification_subhead","id",$subhead_id);
$subhead_data_id=$row1["specification_subhead_data_id"];
$subhead_data_name=fetch_data($conn,"specification_subhead_data","id",$subhead_data_id);

$description.=$subhead_name["subhead_name"]."-".$subhead_data_name["subhead_data"].";";
}
// $description="</small>";



}
elseif($item_type==2){
  $type="( a.p )";
  $description="";
}

  $data[] = array("id"=>$item_id_concated, "text"=>$product_name.$type." ".$description);
}
echo json_encode($data);
?>
