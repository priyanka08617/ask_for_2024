

<?php 
 include 'connection.php';
 include '../../includes/functions.php';


$uom_id=$_POST['id'];

$all_state=array();

$sql="SELECT * FROM uom WHERE status='1' AND id <> $uom_id  order by id desc";
$result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){
 $id=$row['id'];
 $uom_name=$row['uom_name'];
//  echo "<option value='$id'>".$uom_name."</option>";
 $all_state[]=array('uom_name' => $uom_name,'id' => $id);    
 }


 echo json_encode($all_state);

?>