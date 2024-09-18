<?php 
 include 'connection.php';
 include '../../includes/functions.php';



 $location_id=$_GET['location_id'];


 
 $sql="SELECT * FROM inventory_transfer_details WHERE location_id='$location_id' ORDER BY id DESC";

 $result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){

echo '<table class="table table-striped" id="example">';

echo '<thead>
<tr>
        <th>#</th>
        <th>Item Name</th>

        <th>Date</th>
        <th>Movement</th>
        <th>Reason</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
        <th>#</th>
        <th>Item Name</th>
     
        <th>Date</th>
        <th>Movement</th>
        <th>Reason</th>
       </tr>
       </tfoot>

<tbody>';

$in=0;
$out=0;
$total=0;
$c=0;



 while($row=mysqli_fetch_array($result)){


$item_id=$row['item_id'];
$item_type=$row['item_type'];
if($item_type==1){
    $item_ty="D.P";
 }elseif($item_type==2){
    $item_ty="A.P";
 }

$idet=check_item_or_product_data($conn,$item_id,$item_type);

$item_name=$idet['name'];


$uom_id=$row['uom_id'];
$uom_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");

$date=date("d F, Y h:i A",strtotime($row['row_created_on']));
if($row['transfer_type']==1){
    $movement="<span style='color:green; font-weight:bold;'>+".$row['quantity']." ".$uom_name."</span>";
}
else{
    $movement="<span style='color:red; font-weight:bold;'>-".$row['quantity']." ".$uom_name."</span>";
}

$it_id=$row['inventory_transfer_id'];
$it_reason=singleRowFromTable($conn, "SELECT * FROM inventory_transfer WHERE id='$it_id'", "transfer_reason");
$reason=find_stock_transfer_reason($conn, $it_reason,0);


$c++;
echo '<tr>
        <th>'.$c.'</th>
        <th class="blueText">'.$item_name.' ('.$item_ty.')</th>
        <td >'.$date.'</td>
        <td >'.$movement.'</td>
        <td >'.$reason["reason"].'</td>
        
        </tr>';

 }

}





  else{
    echo "<center>No Data To Show. Check Your Input</center>";
  }
?>