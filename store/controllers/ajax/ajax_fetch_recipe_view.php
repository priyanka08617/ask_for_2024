<?php 
 include 'connection.php';
 include '../../includes/functions.php';




 $product_id=$_POST['product_id'];
 
 echo '<br><table class="table " style="width:100%">';

 echo '<tr>
         <th>#</th>
         <th>Item Utilized</th>
         <th>Quantity Used</th>
     </tr>';
     echo '<tbody>'; 

  $c=0;
  $sql="SELECT * FROM assembled_product_history WHERE product_id='$product_id'";
  $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result)){
      $c++;

    $item_id  = $row['item_id'];

    $item_type= $row['item_type'];
    $item_qty = $row['qty'];
    $uom_id   = $row['uom_id'];
    $entry_date_time   = $row['entry_date_time'];


    $uom=fetch_data($conn,"uom","id",$uom_id);

    

    if($item_type==1){

       $item_data=fetch_data($conn,"item","id",$item_id);
       $item_name=$item_data["item"]."(D.P)";

    }elseif($item_type==2){
       $item_data = fetch_data($conn,"product","id",$item_id);
       $item_name=$item_data["name"]."(A.P)";
    }elseif($item_type==3){
        $item_data = fetch_data($conn,"job_work","id",$item_id);
        $item_name=$item_data["item"]."(J.W)";
     }


    echo '<tr>';
    echo '<td>'.$c.'</td>';
    echo '<td>'.$item_name.'</td>';
    echo '<td>'.$item_qty." ".$uom["uom_name"].'</td>';
    echo '</tr>';



}
    echo '</tbody>';
echo '</table>';



?>