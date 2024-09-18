<?php 
include 'connection.php';
echo "<option value=''>---Select---</option>";
$c=0; 
 
  $sql='SELECT * FROM  user_module WHERE status=1';
  $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result)){
   $id=$row['id'];
   $value=$row['module_name'];
echo '<option value='.$id.'>'.$value.'</option>';
}
?>