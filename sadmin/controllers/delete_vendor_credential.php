<?php

include '../includes/check.php';
 include '../includes/functions.php';
 
     $id=$_GET['id'];
 
   $sql="SELECT path FROM vendor_credentials WHERE id=' $id'";
   $query=mysqli_query($conn,$sql);
   $row=mysqli_fetch_array($query);
   $path=  $row["path"];

$sql1= "DELETE FROM vendor_credentials WHERE id='$id'";
$query1=mysqli_query($conn,$sql1);
if($query1==TRUE){
    $val="N.A";
    if($path!=$val){
        unlink($path);
}
}

 
       
 
 header ("location: ../views/vendor_credential.php");
       
 

  

?>