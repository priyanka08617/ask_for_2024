<?php 
 include 'connection.php';
 include '../../includes/functions.php';




 $item_id_concat=$_GET['item_id'];
 $item_id=substr( $item_id_concat,0,-1);
 $item_type=substr( $item_id_concat,-1);

 $item_name_uom=check_item_or_product_data($conn,$item_id,$item_type);
 $item_name=$item_name_uom['name'];
 $uom_id=$item_name_uom['uom_id'];
 $uom_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
// echo $item_id."<br>". $item_type."<br>";

//  $len = strlen($item_id); 
//  $split = str_split($item_id,$len-1); 


  $sql="SELECT * FROM inventory_transfer_details WHERE item_id='$item_id' AND item_type='$item_type'  GROUP BY location_id";
  // echo $sql."<br>";
  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)>0){
  $location_id_arr=array();
   while($row=mysqli_fetch_array($result)){
    $location_id_arr[]=$row['location_id'];
}
  


echo '
<div class="form-group row tohide">
<div class="col-md-1"></div>
<div class="col-md-2"><label class="control-label" for="uom">Item Details</label></div>
<div class="col-md-8">

<table class="table" id="example">';

echo '<thead><tr>
        <th>#</th>
        <th>Location</th>
        <th>Total</th>
        <th>Shift Quantity</th>
        </tr></thead>
       
<tbody>';

$in=0;
$out=0;
$total=0;
$c=0;

echo '
<input type="hidden" class="form-control" name="item_id" value="'.$item_id.'"  />
<input type="hidden" class="form-control" name="item_type" value="'.$item_type.'"/></td>
<input type="hidden" class="form-control" name="uom_id" value="'.$uom_id.'"/></td>';

foreach ($location_id_arr as $location_id) {
    $data=find_stock_quantity_from_location_id($conn, $item_id,$item_type,$location_id);
    $location_name = singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location");
    // $uom_id=singleRowFromTable($conn, "SELECT * FROM item WHERE id='$item_id'", "uom_id");
    // $uom_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");

    // $item_name_uom=check_item_or_product_data($conn,$item_id,$item_type);
    // $item_name=$item_name_uom['name'];
    // $uom_id=$item_name_uom['uom_id'];
    // $uom_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uom_id'", "uom_name");
    


    $location_category_id=singleRowFromTable($conn, "SELECT * FROM location WHERE id='$location_id'", "location_cat_id");
    $location_category=singleRowFromTable($conn, "SELECT * FROM  location_category  WHERE id='$location_category_id'", "category");


   $total_stock_qty_location= find_stock_quantity_from_location_id($conn, $item_id,$item_type, $location_id);



if($total_stock_qty_location['total']>0){

    $c++;
echo '<tr>
        <th>'.$c.'</th>
        <th class="blueText">'.$location_name.' ('.$location_category.')</th>';
        if($total_stock_qty_location['total']>0){
echo ' <td class="grText" >'.$total_stock_qty_location['total']." ".$total_stock_qty_location["uom_name"].'</td>';
        }else{
            echo ' <td class="redText">'.$total_stock_qty_location['total']." ".$total_stock_qty_location["uom_name"].'</td>';
        }
        echo '<td class="redText">
        <div class="input-group">
        <input type="number" class="form-control" name="stock_quantity[]" value="0" min="0" max="'.$total_stock_qty_location['total'].'" step="0.01" />
        
          <div class="input-group-append">
            <div class="input-group-text">
            '.$uom_name.'
            </div>
          </div> 
         
        </div>
        
        <input type="hidden" class="form-control" name="location_id[]" value="'.$location_id.'"  />';
echo '</tr>';
    $in+=$total_stock_qty_location['in'];
    $out+=$total_stock_qty_location['out'];
    $total+=$total_stock_qty_location['total'];
}


}

echo '</tbody>';

echo '</table>';
echo '


</div>
        </div>';
        
        
        
        
        echo'<div class="form-group row tohide">
        <div class="col-md-1"></div>
        <div class="col-md-2"><label class="control-label" for="uom">Transfer to Location</label></div>
        <div class="col-md-8">
        <select class="form-control" id="to_location_details" placeholder="Start Typing Location Name..."  required name="to_location_id" >
        <option value="">--Select--</option>';
        
          $sql='SELECT * FROM location WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                       while($row=mysqli_fetch_array($result)){
                       $id=$row['id'];
        
                       $location_category_id=$row['location_cat_id'];
                       $location_category=singleRowFromTable($conn, "SELECT * FROM  location_category  WHERE id='$location_category_id'", "category");
                     $locations_name=$row['location'];
        
        echo "<option value='".$id."'>".$locations_name." (".$location_category.")</option>";
        
                       }
      

        echo '
        </select>
        </div>
        </div>
        ';


        echo "
  
        <div class='form-group row tohide'>
        <div class='col-md-1'></div>
        <div class='col-md-2'></div>
        <div class='col-md-8'><button type='submit' class='btn btn-block btn-primary'>Initiate Transfer</button></div>
        </div></form>";
;
  }




  else{
    echo "<center>No Data To Show. Check Your Input</center>";
  }
?>