<?php 
 include 'connection.php';
 include '../../includes/functions.php';

 $process_action_id=$_POST['process_id'];
 $progress_bar_count=fetch_data_num_rows($conn,"process_action_details","process_action_id",$process_action_id);

 $check_data=check($conn,"process_action_details","process_action_id='$process_action_id' AND status='2'");

//  $total=100;
//  $current=20;
//  $percent=round(($current/ $total)*100,1);




 $total=$progress_bar_count;
 $current=$check_data;
 $percent=round(($current/ $total)*100,1);


//  $htmlcss = $progress_bar_count;
//  $per_skill=(100/$htmlcss);
//  $skills = ['HTML & CSS:' => $htmlcss];   //PHP 5.4 array syntax


// echo $total;
// echo "<br>";
// echo $current;
echo "<br>";
// echo $percent;
// echo "<br>";

echo "<h4 align='center'><b>Progress Bar</b></h4>";
echo "<hr/>";

if($current==0){
   echo '<div class="progress-bar bg-danger" style="height:20px;">
   <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="'.$total.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%"><p style="color:#ffffff;">Pending</p>
   
   </div>
</div>';
}else{
   echo '<div class="progress" style="height:20px">
   <div class="progress-bar bg-success" role="progressbar" aria-valuenow="$total" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
   '.$percent.' % complete
   </div>
</div>';
}
 
echo "<hr/>";





//  foreach($skills as $x => $x_value) {
//      echo <<<EOL
//      <p>$x</p>
//      <div class="progress">
//          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="$per_skill" aria-valuemin="0" aria-valuemax="100" style="width: $x_value%">
//          </div>
//      </div> 
//  EOL;
//  }






 echo '<table class="table" style="width:100%">';

 echo '<tr>
         <th>check</th>
         <th>Step</th>
         <th>Item</th>
         <th>Quantity</th>
         <th>Description</th>
         <th>Accepted On</th>
     </tr>';
     echo '<tbody>'; 

  $c=0;
  $sql="SELECT * FROM process_action_details WHERE process_action_id='$process_action_id'";
  $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result)){
      $c++;
    $id  = $row['id'];
    $item_id  = $row['item_id'];
    $item_type= $row['item_type'];
    $item_qty = $row['quantity'];
    $uom_id   = $row['uom_id'];
    
    $step_description  = $row['step_description'];
    $entry_date_time   = $row['submitted_on'];
    $status   = $row['status'];
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


     if($status==2){
        echo '<tr class="disabled_tr">';
        echo '<td><input type="checkbox" id="check" name="check" checked></td>';
        echo '<td> Step -'.$c.'</td>';
        echo '<td>'.$item_name.'</td>';
        echo '<td>'.$item_qty." ".$uom["uom_name"].'</td>';
        echo '<td>'.$step_description.'</td>';
        echo '<td>'.dateForm($entry_date_time).'</td>';
        echo '</tr>';
     }elseif($status==1){
        echo '<tr>';
        echo '<td><input type="checkbox" id="check" name="check" onclick="step_change('.$id.','.$process_action_id.')"></td>';
        echo '<td> Step -'.$c.'</td>';
        echo '<td>'.$item_name.'</td>';
        echo '<td>'.$item_qty." ".$uom["uom_name"].'</td>';
        echo '<td>'.$step_description.'</td>';
        echo '<td><p>Not submitted Yet</p></td>';
        echo '</tr>';
     }




}
    echo '</tbody>';
    echo '</table>';
 



?>