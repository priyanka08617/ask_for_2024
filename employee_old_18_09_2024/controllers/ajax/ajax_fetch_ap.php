<?php 
 include 'connection.php';
 include '../../includes/functions.php';



$cat_id=$_POST['cat_id'];

$sql="SELECT * FROM ap_subcategory WHERE category_id='$cat_id' AND  status='1'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
  $id=$row['id'];
  echo '<option value="'.$id.'">'.$row['sub_category'].'</option>';
}
 
?>