<?php
ob_start();
include '../includes/connection.php';
include '../includes/functions.php';


$specification_head_id=sanitize_input($conn,$_POST["specification_head_id"]);

$specificationName=fetch_data($conn, "specification_subhead","id",$specification_head_id);
$tableName=$specificationName['category'];


$subhead_id=$_POST["subhead_id"];
$subhead_data=$_POST["subhead_data"];

$tableName=$_POST["tableName"];
$sql="";
$subhead_idCount=count($subhead_id);
echo $subhead_idCount;
$sql.="INSERT INTO $tableName  VALUES('','$head_id','1',";
for($i=0;$i<$subhead_idCount;$i++){
    $subheadId=$subhead_id[$i];
    $subheadData=$subhead_data[$i];

    // $sql33="INSERT INTO `specification_data_master`(`head_id`, `subhead_id`, `data_master`, `status`) VALUES('$head_id','$subheadId','$subheadData','1')";
    
    // $sql.="'$subheadData',";
  if(($subhead_idCount-1)==$i){
    $sql.="'$subheadData'";
  }else{
    $sql.="'$subheadData',";
  }
   
}

$sql.=")";
$query=mysqli_query($conn,$sql);

echo $sql;
echo mysqli_error($conn);
header("location:../views/specification_subhead.php?specificationId=".$head_id."&tableName=".$tableName);
?>