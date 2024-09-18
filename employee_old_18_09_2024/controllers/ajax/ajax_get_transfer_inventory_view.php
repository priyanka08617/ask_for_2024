<?php 
 include 'connection.php';
 include '../../includes/functions.php';

 
$inventory_transfer_id=$_POST['transfer_id'];
$store_id=$_POST['store_id'];
// $inventory_transfer_id=1;


$lc="";

                   $sql=mysqli_query($conn,"SELECT * FROM inventory_transfer_details WHERE  inventory_transfer_id='$inventory_transfer_id'");
                   $c=0;
                   while($row=mysqli_fetch_array($sql)){ 
                    $c++;
                    $item_id=$row['item_id'];
                    // $inventory_transfer_reason_id=singleRowFromTable($conn, "SELECT * FROM  inventory_transfer  WHERE id='$inventory_transfer_id'", "locations_category");
                    $inventory_transfer_reason_id=singleRowFromTable($conn, "SELECT * FROM  inventory_transfer  WHERE id='$inventory_transfer_id'", "transfer_reason");
                                    
$sql1="SELECT * FROM location WHERE status='1' AND id='$store_id'";
$result1=mysqli_query($conn,$sql1);
 while($row1=mysqli_fetch_array($result1)){
 $location_id=$row1['id'];

 $location_category_id=$row1['location_cat_id'];
 $location_category=singleRowFromTable($conn, "SELECT * FROM  location_category  WHERE id='$location_category_id'", "category");
$locations_name=$row1['location'];

if($row['transfer_type']==2){

     $item_base_uom_id=  check_item_or_product_data($conn,$item_id,$row['item_type']);
     
    $stock_quantity_check=find_stock_quantity_from_location_id($conn, $item_id,$row['item_type'],$location_id);
    $converted_transfer_qty=stock_interchange_uom_qty($conn, $row['uom_id'], $row['quantity'], $item_base_uom_id["uom_id"]);

    if($stock_quantity_check['total']>$converted_transfer_qty){

    $lc.= "<option value='".$location_id."'>".$locations_name." (".$location_category.")(".$stock_quantity_check['total']." ".$item_base_uom_id['uom_name'].")</option>";
    
    }elseif($inventory_transfer_reason_id==12){

        $item_base_uom_id=  check_item_or_product_data($conn,$item_id,$row['item_type']);
     
        $stock_quantity_check=find_stock_quantity_from_location_id($conn, $item_id,$row['item_type'],$location_id);
        $converted_transfer_qty=stock_interchange_uom_qty($conn, $row['uom_id'], $row['quantity'], $item_base_uom_id["uom_id"]);
    
    
            $lc.= "<option value='".$location_id."'>".$locations_name." (".$location_category.")(".$stock_quantity_check['total']." ".$item_base_uom_id['uom_name'].")</option>";


    }else{
        $lc.= "<option value='".$location_id."'>".$locations_name." (".$location_category.")</option>";
    }
}
else{

    $item_base_uom_id=  check_item_or_product_data($conn,$item_id,$row['item_type']);
     
    $stock_quantity_check=find_stock_quantity_from_location_id($conn, $item_id,$row['item_type'],$location_id);
    $converted_transfer_qty=stock_interchange_uom_qty($conn, $row['uom_id'], $row['quantity'], $item_base_uom_id["uom_id"]);


        $lc.= "<option value='".$location_id."'>".$locations_name." (".$location_category.")(".$stock_quantity_check['total']." ".$item_base_uom_id['uom_name'].")</option>";
        


   
}


 }







                    if($row['item_type']==1){
                       $item= fetch_data($conn,"item","id",$row['item_id']);
                       $item_name=$item["item"];
                    }elseif($row['item_type']==2){
                        $item= fetch_data($conn,"product","id",$row['item_id']);
                       $item_name=$item["name"];
                    }

                    echo "<tr>";
                    echo "<td>".$c."</td>";
                    echo "<td>".$item_name."</td>";
                    if($row['item_type']==1){
                        echo "<td>Direct Purchase</td>";
                    }else{
                        echo "<td>Assembled Product </td>";
                    }

                    echo "<td>".$row['quantity']."</td>";
                    $uom = fetch_data($conn,"uom","id",$row['uom_id']);
                    echo "<td>".$uom['uom_name']."</td>";

                    if($row['transfer_type']==1){
                        echo "<td>Inward Transfer</td>";
                    }else{
                        echo "<td>Outward Transfer</td>";
                    }
                    echo $row['item_id']."----".$row['item_type']."<br>";
                 $stock_data=  find_stock_quantity($conn, $row['item_id'],$row['item_type']);
               
                    echo "<td>".$stock_data['total']." ".$stock_data['uom_name']."</td>";
                    
               

                    echo "<td><select id='stock_locations' name='stock_location'  class='form-control stock_locations'>".$lc."</select></td>";
                  
                    echo "<td><select id='inventory_transfer_change_e' name='inventory_transfer_change_e' class='custom-select' required>
                    <option value=''>Select</option>
                    <option value='2'>Accept</option>
                    <option value='3'>Decline</option>
                </select></td>";





                    echo "</tr>";

                   }
                   ?>
</table>