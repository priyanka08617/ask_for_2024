<?php 
 include 'connection.php';
 include '../../includes/functions.php';
$product_id=$_POST['product_id'];
$c=0; 
 

$sql="SELECT * FROM product WHERE id='$product_id'";
$result=mysqli_query($conn,$sql);
 $row=mysqli_fetch_array($result);
 
    $uom_id=$row['uom_id'];

    // $uom_id=$row['uom_id'];
$uom=fetch_data($conn,"uom","id",$uom_id);
echo $uom["uom_name"]."-".$uom_id;

?>