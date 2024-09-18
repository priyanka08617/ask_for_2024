<?php 
 include 'connection.php';
 include '../../includes/functions.php';


$data="";

// $data1="";
$cat_id=$_POST['cat_id'];
$sql="SELECT * FROM dp_subcategory WHERE dp_category_id='$cat_id' AND status='1'";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){

    $id=$row["id"];
    $sub_cat=$row["dp_subcategory"];

    $data.="<option value='".$id."'>".$sub_cat."</option>";
}




// $data1.='<div class="row"><div class="col-md-1"></div>';

// $sql1 = "SELECT * FROM specification_head WHERE category_id='$cat_id' AND status='1'";
// $result = mysqli_query($conn,$sql1);
// while($row_subhead = mysqli_fetch_array($result)){

// $subhead_id=$row_subhead['id'];
// $subhead_name=$row_subhead["subhead_name"];

// $data1.='<div class="col-md-3">'.$subhead_name.'</div>';




// }


echo $data;
 
?>