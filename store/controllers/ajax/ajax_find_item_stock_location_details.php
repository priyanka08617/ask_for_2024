<?php 
 include 'connection.php';
 include '../../includes/functions.php';



 $item_id_concat=$_GET['item_id'];
 $item_id=substr( $item_id_concat,0,-1);
 $item_type=substr( $item_id_concat,-1);
 $product_type=singleRowFromTable($conn, "SELECT * FROM product WHERE id='$item_id' AND table_name='$item_type'", "product_type");

if($item_type==2 && $product_type==1){
  // echo "On Order Product Stock";
  echo "<center><p class='text-danger'>No Data To Show. On Order Product</p></center>";
}else{
  $sql="SELECT * FROM inventory_transfer_details WHERE item_id='$item_id' AND item_type='$item_type' GROUP BY location_id";

  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)>0){
  $location_id_arr=array();
   while($row=mysqli_fetch_array($result)){

    
    $location_id_arr[]=$row['location_id'];
   

  }


echo '<table class="table table-striped" id="example">';

echo '<thead><tr>
        <th>#</th>
        <th>Location</th>
        <th>In</th>
        <th>Out</th>
        <th>Total</th>
        </tr></thead>
        <tfoot><tr>
        <th>#</th>
        <th>Location</th>
        <th>In</th>
        <th>Out</th>
        <th>Total</th>
       </tr></tfoot>
<tbody>';

$in=0;
$out=0;
$total=0;
$c=0;
foreach ($location_id_arr as $location_id) {




    $data=find_stock_quantity_from_location_id($conn, $item_id,$item_type, $location_id);
    $location_name=singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location");


    $item_or_product_detail=check_item_or_product_data($conn,$item_id,$item_type);
  $uom_id=$item_or_product_detail["uom_id"];

    $uom_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");


    $location_category_id = singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location_cat_id");
    $location_category    = singleRowFromTable($conn, "SELECT * FROM  location_category  WHERE id='$location_category_id'", "category");




    $c++;
echo '<tr>
        <th>'.$c.'</th>
        <th class="blueText">'.$location_name.' ('.$location_category.')</th>
        <td class="grText">'.$data['in']." ".$uom_name.'</td>
        <td class="redText">'.$data['out']." ".$uom_name.'</td>';
        if($data['total']>0){
echo ' <td class="grText">'.$data['total']." ".$uom_name.'</td>';
        }else{
            echo ' <td class="redText">'.$data['total']." ".$uom_name.'</td>';
        }
       
echo '</tr>';


    $in+=$data['in'];
    $out+=$data['out'];
    $total+=$data['total'];
}




echo '</tbody>';

        echo '<tr>
        <th></th>
        <th></th>
        <th></th>
        <th>Total</th>';
        

        if($total>0){
            echo ' <th class="grText">'.$total." ".$uom_name.'</th>';
                    }else{
                        echo ' <th class="redText">'.$total." ".$uom_name.'</th>';
                    }
    echo '</tr>';
echo '</table>';

  }




  else{
    echo "<center>No Data To Show. Check Your Input</center>";
  }
}

?>