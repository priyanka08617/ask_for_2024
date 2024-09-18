<?php 
include 'connection.php';
$user_module_id=$_GET['user_module_id'];
echo "<option value=''>---Select---</option>";
$c=0; 
 

$sql="SELECT * FROM user_category WHERE module_id='$user_module_id'";
$result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){
 $id=$row['id'];
 $value=$row['user_category'];
echo '<option value='.$id.'>'.$value.'</option>';

}
?>