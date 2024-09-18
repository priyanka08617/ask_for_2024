<?php 


 include 'connection.php';
 include '../../includes/functions.php';



 $product_id=$_POST['product_id'];
 $product_qty=$_POST['product_qty'];
 $product_uom_id=$_POST['product_uom_id'];
 $location_id=$_POST['location_id'];
 $need_qty="";
 $uom_id_false="";

   


 echo  '<input type="hidden" name="product_id" id="product_id" value="'.$product_id.'">';
 echo  '<input type="hidden" name="product_qty" id="product_id" value="'.$product_qty.'">';
 echo  '<input type="hidden" name="product_uom_id" id="product_uom_id" value="'.$product_uom_id.'">';
 echo  '<input type="hidden" name="location_id" id="product_id" value="'.$location_id.'">';
 


 echo '<table class="table">
        <tr>
         <th>#</th>
         <th>Item</th>
         <th>Recipe Qty</th>
         <th>Request Qty</th>
         <th>Location Stock Qty</th>
         <th>Company Stock</th>
     </tr>';
echo '<tbody>'; 

$c=0;
$sql="SELECT * FROM recipe WHERE product_id='$product_id' AND  status='1'";
$result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){
    $c++;

  $item_id  = $row['item'];
  $item_type= $row['table_name'];
  $item_qty = $row['item_qty'];
  $uom_id   = $row['uom_id'];

  $uom=fetch_data($conn,"uom","id",$uom_id);


  $product_data=check_item_or_product_data($conn,$item_id,$item_type);

  $recipe_qty = stock_interchange_uom_qty($conn, $uom_id, $item_qty, $product_data["uom_id"]);
  $req_qty = stock_interchange_uom_qty($conn, $uom_id, $item_qty*$product_qty, $product_data["uom_id"]);
  $location_qty = find_stock_quantity_from_location_id($conn, $item_id,$item_type, $location_id);
  $comp_qty=find_stock_quantity_recipe($conn, $item_id,$item_type,$need_qty,$uom_id);

if($comp_qty["uom_id"]>0){
  $com_tot=$comp_qty["total"]." ".$comp_qty["uom_name"];

}else{
  $com_tot="0 ".$product_data["uom_name"];
  echo "<script>$('#check_comp_tot".$c."').css('color','red');</script>";
}

  if($uom_id!=$product_data["uom_id"]){
    $uom_check_required_qty=  stock_interchange_uom_qty($conn, $uom_id, $item_qty*$product_qty, $product_data["uom_id"]);
  
  }
  else{
    $uom_check_required_qty=$item_qty*$product_qty;
  }



  // $need_qty=$item_qty*$product_qty;

  if($location_qty["total"]>=$uom_check_required_qty){
    $check_btn_disable[]=0;
  }else{
    $check_btn_disable[]=1;
  }



  if($uom_check_required_qty>$location_qty["total"]){
echo "<script>$('#check".$c."').css('color','red');</script>";
  }
  

    echo '<tr>';
    echo '<td>'.$c.'</td>';
    echo '<td>'.$product_data["name"].'<input type="hidden" name="item_id[]" id="item_id" value="'.$item_id.'"></td>';
    echo '<td>'.$recipe_qty." ".$product_data["uom_name"].'<input type="hidden" name="item_type[]" id="item_type" value="'.$item_type.'"></td>';
    echo '<td>'.$req_qty." ".$product_data["uom_name"].'<input type="hidden" name="need_qty[]" id="need_qty" value="'.$req_qty.'"></td>';
    echo '<td id="check'.$c.'">'.$location_qty["total"]." ".$location_qty["uom_name"].' <input type="hidden" name="need_qty_uom_id[]" id="need_qty_uom_id" value="'.$product_data["uom_id"].'"></td>';
    echo '<td id="check_comp_tot'.$c.'">'.$com_tot.'</td>';
    
    echo '<tr>';
 }
  echo '</tbody></table>'; 

  
echo"
<div class='row'>
<div class='col-md-12'>";

  if(array_sum($check_btn_disable)>0){
   echo "<div ><button type='submit' class='btn btn-danger btn-block  btn-sm' disabled>Can't Create Assembled Product.</button></div>";
 
  }else{
    echo" <div id='submit_btn'>
    <button type='submit' class='btn btn-primary btn-block btn-sm' >Create Assembled Product</button>
    </div>";
  
  }

  echo"</div></div>";

 ?>