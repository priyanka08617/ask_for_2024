<?php 
 include 'connection.php';
 include '../../includes/functions.php';        


 $c=$_GET['c'];
 $store_id=$_GET['store_id'];
 
echo '<tr id="row_'.$c.'">';
echo '<td>'.$c.'</td>'; 

echo '<td><select class="form-control" name="item_id[]" id="item_id_'.$c.'" onchange="fetch_uom(this.value,'.$c.')" style="width:100%"><option value="">Select Item</option>';

   
  // $sql="SELECT p.id as product_id, concat(p.id,'2') as concated_id,p.name as product_name FROM product p WHERE p.status='1'  UNION SELECT i.id as item_id, concat(i.id,'1') , i.item as item_name FROM item i WHERE i.status='1'";

  $sql="SELECT p.product_id as product_id, concat(p.product_id,'2') as concated_id FROM price_management p WHERE p.status='1' AND location_id='$store_id'  UNION SELECT i.id as item_id, concat(i.id,'1')  FROM item i WHERE i.status='1'";

 
$query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query)){

    $item_id_concated=$row["concated_id"];
 
$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);

     if($item_type=='1'){
        $name="(D.P)";
        $product_name= singleRowFromTable($conn, "SELECT * FROM item WHERE id='$item_id'", "item");
      }elseif($item_type=='2'){
        $name="(A.P)";
        $product_name= singleRowFromTable($conn, "SELECT * FROM product WHERE id='$item_id'", "name");
      }

      echo "<option  value='".$item_id_concated."'>".$product_name." ".$name."</option>";
   
 
  }



echo  '</select></td>';
echo '<td><input class="form-control" type="number" name="quantity[]" id="quantity_'.$c.'" placeholder="Enter Qty"/></td>';
echo '<td><select class="form-control" type="text" name="uom_id[]" id="uom_id_'.$c.'"/>
    <option value="">Select</option>
    </select></td>';
echo '<td><textarea class="form-control" name="step_description[]" id="step_description_'.$c.'" placeholder="Enter Description" rows="1" col="5"></textarea></td>';
echo '<td><span href="" class="btn btn-danger btn-block remove" onclick="remove_line('.$c.');"
id="row_rem_'.$c.'">Remove</span></td>';
echo '</tr>'; 

?>