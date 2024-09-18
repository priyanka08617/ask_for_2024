<?php 
 include 'connection.php';
 include '../../includes/functions.php';


$name=$_GET['name'];
$table_name=$_GET['table_name'];
$table_col_name=$_GET['table_col_name'];

 
$sql="SELECT * FROM ".$table_name." WHERE ".$table_col_name."='$name'";

if(mysqli_num_rows(mysqli_query($conn,$sql))==0)
{
    echo 1;

}
else{
    echo 0;
}
 
?>