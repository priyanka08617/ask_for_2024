<?php 


 include 'connection.php';
 include '../../includes/functions.php';

 


 $product_id=$_POST['product_id'];
 $product_qty=$_POST['product_qty'];
 $location_id=$_POST['location_id'];
 
 echo '<table class="table">';

 echo '<tr>
         <th>#</th>
         <th>Item</th>
         <th>Recipe Qty</th>
     
         <th>Request Qty</th>
      
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
    $need_qty   = $item_qty * $product_qty;
    $uom=fetch_data($conn,"uom","id",$uom_id);
    $data=find_stock_quantity_recipe_location($conn, $item_id,$item_type,$need_qty,$uom_id,$location_id);


    print_r($data);
    // $company_qty= find_stock_quantity_recipe($conn, $item_id,$item_type,$need_qty,$uom_id);

    $stock_qty_array = find_stock_quantity($conn, $item_id,$item_type);
    $company_total_stock = $stock_qty_array['total'];
    $company_total_stock_uom_name = $stock_qty_array['uom_name'];
    
    

    if($item_type==1){

       $item_data=fetch_data($conn,"item","id",$item_id);
       $item_name=$item_data["item"]."(d.p)";

    }elseif($item_type==2){
       $item_data = fetch_data($conn,"product","id",$item_id);
       $item_name=$item_data["name"]."(a.p)";
    }


    $stock_uom=fetch_data($conn,"uom","id",$uom_id);


    if($uom_id!=$item_data["uom_id"]){
      $uom_check=  stock_interchange_uom_qty($conn, $uom_id, $item_qty, $item_data["uom_id"]);
    
    }
    else{
      $uom_check=$item_qty;
    }

    $item_data_uom_name=fetch_data($conn,"uom","id",$item_data["uom_id"]);
    $item_data_uom_name= $item_data_uom_name["uom_name"];




   //  **********required qty

   if($uom_id!=$item_data["uom_id"]){
      $uom_check_required_qty=  stock_interchange_uom_qty($conn, $uom_id, $item_qty*$product_qty, $item_data["uom_id"]);
    
    }
    else{
      $uom_check_required_qty=$item_qty*$product_qty;
    }

    $item_data_uom_name=fetch_data($conn,"uom","id",$item_data["uom_id"]);
    $item_data_uom_name= $item_data_uom_name["uom_name"];


    if($data["total"]>=$uom_check_required_qty){
      $check_btn_disable[]=0;
    }else{
      $check_btn_disable[]=1;
    }
    

    echo '<tr>';
    echo '<td>'.$c.'</td>';
    echo '<td><input type="hidden" name="item_id[]" value="'.$item_id.'">'.$item_name.'<input type="hidden" name="item_type[]" value="'.$item_type.'"></td>';
    echo '<td>'.$uom_check." ".$item_data_uom_name.'</td>';
    // if($data["total"]>0){
    // echo '<td>'.$data["total"]." ".$data["uom_name"].'</td>';
    // }else{
    //   echo '<td>'.$data["total"].'</td>';
    // }
    echo '<td><input type="hidden" name="need_qty[]" value="'.$item_qty * $product_qty.'">'.$uom_check_required_qty." ".$item_data_uom_name.'<input type="hidden" name="need_qty_uom_id[]" value="'.$item_data["uom_id"].'"></td>';
    // echo '<td>'.$company_total_stock." ".$company_total_stock_uom_name.'</td>';
    
    
    echo '</tr>';



}
    echo '</tbody>';
echo '</table>';

echo"
<div class='row'>
<div class='col-md-12'>";

 
  foreach ($check_btn_disable as $key => $check_btn_disable) {

  }
  if($check_btn_disable==1){
   echo "<div class='d-grid'><button type='submit' class='btn btn-primary btn-block btn-sm' disabled>Submit</button></div>";
   echo "<script>$('#submit_btn').hide();</script>";
  }else{
     
  }

  echo" <div id='submit_btn'><div class='d-grid'>
<button type='submit' class='btn btn-primary btn-block btn-sm' >Submit</button>
</div>
</div>
</div>
</div>";



?>