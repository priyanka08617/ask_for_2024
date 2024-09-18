<?php 
 include 'connection.php';
echo "<option value=''>---Select---</option>";
$c=0; 
 
  $sql='SELECT * FROM stock_locations_category';
  $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result)){
   $id=$row['id'];
   $value=$row['locations_category'];
echo '<option value='.$id.'>'.$value.'</option>';
}
?>