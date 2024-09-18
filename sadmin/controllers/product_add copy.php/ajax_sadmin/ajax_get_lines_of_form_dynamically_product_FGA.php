<?php 
 include 'connection.php';
 $c=$_GET['c'];
echo '<tr id="row_'.$c.'">';
echo '<td>'.$c.'</td>'; 
echo '<td><select class="form-control" onchange="fetch_item_uom('.$c.');" style="width:100%" required type="text" name="item[]" id="item_'.$c.'"/>
    <option value="">----------------Select-------------------</option> 
   ';
   
   
   
   $sql="SELECT p.id as product_id, concat(p.id,'2') as concated_id, p.name as product_name FROM ap p WHERE p.status='1'  
   UNION 
   SELECT i.id as item_id, concat(i.id,'1') , i.item as item_name FROM dp i WHERE i.status='1'";
   $query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query)){
    


    $item_id=$row["concated_id"];
   
     $item_id_split=substr($item_id,-1);

     if($item_id_split=='1'){
        $name="(D.P)";
      }elseif($item_id_split=='2'){
        $name="(A.P)";
      }elseif($item_id_split=='3'){
        $name="(J.W)";
      }

  echo "<option  value='".$row["concated_id"]."'>".$row["product_name"]." ".$name."</option>";
  }
   
echo '</select></td>';
echo '<td><input class="form-control" required type="number" min="0.01" step="0.01" name="item_qty[]" id="item_qty_'.$c.'"/></td>';
echo '<td><select class="form-control" required type="text" name="uom_id[]" id="uom_id_'.$c.'"/>
    <option value="">-----</option> 
   ';

  //  $sql=mysqli_query($conn,"SELECT * FROM uom WHERE status='1'");
  //  while($row=mysqli_fetch_array($sql)){
  //   echo '<option value="'.$row['id'].'">'.$row['uom_name'].'</option> ';
  //  }
   
echo'</select></td>';
echo '<td><span href="" class="btn btn-danger btn-block remove" onclick="remove_line('.$c.');"
id="row_rem_'.$c.'">Remove</span></td>';
echo '</tr>'; 

?>