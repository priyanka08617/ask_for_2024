<?php 
 include '../includes/check.php';
include '../includes/functions.php';

$id=sanitize_input($conn,$_GET['specification_headId']);

$sql="UPDATE specification_head SET status='0' WHERE id='$id'";
$query=mysqli_query($conn,$sql);
if($query==true){
    echo 1;
}else{
    echo 0;
}

?>