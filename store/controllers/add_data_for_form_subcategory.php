<?php

include '../includes/check.php';
include '../includes/functions.php';

$category_id_for_add=$_POST["category_id_for_add"];
$data=$_POST["data"];
$sql_insert=  "INSERT INTO `form_subcategory`(`category_id`, `data`, `status`) VALUES ('$category_id_for_add','$data','1')";
if(mysqli_query($conn,$sql_insert)==true){
    echo mysqli_insert_id($conn)
;
}else{
    echo 0;
}

?>