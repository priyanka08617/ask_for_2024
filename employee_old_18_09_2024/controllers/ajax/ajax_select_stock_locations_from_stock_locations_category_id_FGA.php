<?php 
 include 'connection.php';
$stock_locations_category_id=$_GET['stock_locations_category_id'];
echo "<option value=''>---Select---</option>";
$c=0; 
 

$sql="SELECT * FROM stock_locations WHERE locations_category_id='$stock_locations_category_id'";
$result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){
 $id=$row['id'];
 $value=$row['location_name'];
echo '<option value='.$id.'>'.$value.'</option>';

}
?>