<?php
include 'connection.php';
include '../../includes/functions.php';


error_reporting(E_ALL);
ini_set('display_errors', 'On');


$dp_category_id=sanitize_input($conn,$_POST["dp_category_id"]);

echo '<table class="table table-bordered" id="example">
    <thead>
      <tr>
      <th>Serial No</th>
      <th>Specification Head</th>
      <th>Product Details</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>';
      $c=0;
       $sql="SELECT * FROM `specification_head` WHERE status='1' AND category_id='$dp_category_id'";
       $query=mysqli_query($conn,$sql);
       while($row=mysqli_fetch_array($query)){
         $c++;

         $id=$row["id"];
         $category_id=$row["category_id"];
         $head_name=$row["head_name"];
        $product_name= singleRowFromTable($conn,"SELECT * FROM dp_category WHERE id='$category_id'", "category_name");
 
       echo "<tr>";
       echo "<td>".$c."</td>";
      //  echo "<td>".$product_name."</td>";
       echo "<td>".$row["head_name"]."</td>";
       echo "<td><a href='specification_subhead.php?specification_head_id=".$id."'><button type='button' class='btn btn-secondary'>+</button></a></td>";


       $edit_modal_params_string="'$id','$product_name','$head_name'";
$edit_modal_params='openModel_data('.$edit_modal_params_string.')';


       echo "<td><img src='../img/edit.png' height='30px' data-toggle='modal' data-target='#myModal_update' onclick='".$edit_modal_params."'><img src='../img/delete.png' height='30px' onclick='specification_head_delete(".$id.",".$dp_category_id.")'></td>";
       echo "</tr>";
       }
  
    
    echo '</tbody>
  </table>';

  ?>