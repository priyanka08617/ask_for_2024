<?php 
 include 'connection.php';
 include '../../includes/functions.php';



 $item_id_concat=$_GET['item_id'];
 $item_id=substr( $item_id_concat,0,-1);
 $item_type=substr( $item_id_concat,-1);


 
 $sql="SELECT * FROM inventory_transfer_details WHERE item_id='$item_id' AND item_type='$item_type' ORDER BY id DESC";

 $result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){

echo '<table class="table table-striped" id="example">';

echo '<thead>
<tr>
        <th>#</th>
        <th>Location</th>
        <th>Date</th>
        <th>Movement</th>
        <th>Reason</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
        <th>#</th>
        <th>Location</th>
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

$location_id=$row['location_id'];

$location_name=singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location");
$location_category_id=singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location_cat_id");
$location_category=singleRowFromTable($conn, "SELECT * FROM  location_category  WHERE id='$location_category_id'", "category");
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
        <th class="blueText">'.$location_name.' ('.$location_category.')</th>
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