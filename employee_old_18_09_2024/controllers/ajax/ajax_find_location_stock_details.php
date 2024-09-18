<?php 
 include 'connection.php';
 include '../../includes/functions.php';




 $location_id=$_GET['location_id'];

//  echo  $location_id."<br>";
  $sql="SELECT * FROM inventory_transfer_details WHERE location_id='$location_id' GROUP BY item_id";
//   echo $sql."<br>";
  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)>0){
  $item_id_arr=array();
   while($row=mysqli_fetch_array($result)){
    // $item_id_arr[]=$row['item_id'];
    // $item_type_arr[]=$row['item_type'];

    $item_id_arr[] = array('item_id' => $row['item_id'],'item_type' => $row['item_type'] );
}

// print_r($location_id_arr);

echo '
<table class="table" id="example">';

echo '<thead><tr>
        <th>#</th>
        <th>Item</th> 
        <th>In</th>
        <th>Out</th>
        <th>Total</th>
        <th>Action</th>
    </tr></thead>';

    echo '<tfoot>
        <tr>
        <th>#</th>
        <th>Item</th>
        <th>In</th>
        <th>Out</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
    </tfoot>';

$in=0;
$out=0;
$total=0;
$c=0;
foreach ($item_id_arr as $key => $item_id) {
$c++;
    $data=find_stock_quantity_from_location_id($conn, $item_id['item_id'], $item_id['item_type'],$location_id);
   $product_item= check_item_or_product_data($conn,$item_id['item_id'],$item_id['item_type']);
   $item=$product_item["name"];
   $uom_id=$product_item["uom_id"];
    // $item=singleRowFromTable($conn, "SELECT * FROM item WHERE id='$item_id'", "item");
    // $uom_id=singleRowFromTable($conn, "SELECT * FROM item WHERE id='$item_id'", "uom_id");
    $uom_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
echo '<tr>
        <th>'.$c.'</th>
        <th class="blueText">'.$item.'</th>
        <td class="grText">'.$data['in']." ".$uom_name.'</td>
        <td class="redText">'.$data['out']." ".$uom_name.'</td>';
        if($data['total']>0){
echo ' <td class="grText">'.$data['total']." ".$uom_name.'</td>';
        }else{
            echo ' <td class="redText">'.$data['total']." ".$uom_name.'</td>';
        }
       

        echo ' <td class=""><a href="../controllers/remove_line_from_stock_transfer_location_table.php?item_id='.$item_id['item_id'].'&location_id='.$location_id.'"><span class="btn btn-danger">Remove</span></a></td>';



        echo '  </tr>';
    $in+=$data['in'];
    $out+=$data['out'];
    $total+=$data['total'];
}


echo '</table>';

  }




  else{
    echo "<center>No Data To Show. Check Your Input</center>";
  }
?>