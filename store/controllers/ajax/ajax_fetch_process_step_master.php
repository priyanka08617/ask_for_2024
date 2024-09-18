<?php 
 include 'connection.php';
 include '../../includes/functions.php';




 $process_id=$_POST['process_id'];
 
 echo '<table class="table " style="width:100%">';

 echo '<tr>
         <th>#</th>
         <th>Item</th>
         <th>Quantity</th>
         <th>Description</th>
     </tr>';
     echo '<tbody>'; 

  $c=0;
  $sql="SELECT * FROM process_steps_master WHERE process_master_id='$process_id' AND status='1'";
  $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result)){
      $c++;

    $item_id  = $row['item_id'];

    $item_type= $row['item_type'];
    $item_qty = $row['quantity'];
    $uom_id   = $row['uom_id'];
    $step_description   = $row['step_description'];
    
    $entry_date_time   = $row['row_created_on'];


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
    echo '<td>'.$step_description.'</td>';
    echo '</tr>';



}
    echo '</tbody>';
echo '</table>';



?>