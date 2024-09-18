<?php ob_start();
include '../includes/connection.php';
include '../includes/functions.php';
$dp_id=$_GET["dp_id"];
?>

<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Ready Product Details</title>
<?php include '../includes/header.php';?>
<?php include '../includes/navbar.php';?></head>
<body>
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3>  Ready Product Details </h3><small class='text-muted'><b>Fill in the given below tab to create  item and manage existing  item </b></small><hr></hr>

<h3 align="center"><b>PRODUCT DETAILS</b></h3><hr></hr>
</div>
<div class='container' style=''>

<?php
   $c=0; 

              $sql="SELECT * FROM dp WHERE id='$dp_id'";
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                   $c++;
               $id=$row['id'];
               
              $cat_id=$row['cat_id'];
              $cat=singleRowFromTable($conn, "SELECT * FROM dp_category WHERE id='$cat_id'", "category_name");
              $subcategory_id= $row["sub_cat_id"];
              $sub_cat=singleRowFromTable($conn, "SELECT * FROM dp_subcategory WHERE id='$subcategory_id'", "dp_subcategory");


             
              $mtm= $row["mtm"];
              $dp_name= $row["name"];
              $sku= $row["sku"];
              $short_code= $row["short_code"];
               }
            ?>

<table class='table table-bordered' id='example'>
<tbody>
<!-- style="width:10px" -->
<tr><th style="width:265px">Product</th><td><?php echo $cat;?></td><th>Subcategory</th><td><?php echo $sub_cat;?></td></tr>
<tr><th>Name</th><td><?php echo $dp_name;?></td><th>Short Code</th><td><?php echo $short_code;?></td></tr>
<tr><th>MTM</th><td><?php echo $mtm;?></td><th>SKU</th><td><?php echo $sku;?></td></tr>
<tr></tr>
</tbody>
</table>
<!-- <br> -->
<table class='table table-striped table-bordered' id='example'>
<thead>
<th>#</th>

<!-- <th>Brand</th>
<th>Series</th>
<th>Model No</th> -->
<th style="width:265px">Specification</th>
<th>Specification Details</th>
<!-- <th>status</th> -->
<!-- <th>Edit</th>
<th>Action</th> -->
</thead>
<tbody>
<?php
   $c=0; 

              $sql="SELECT * FROM dp_details WHERE dp_id='$dp_id' AND status='1' GROUP BY specification_head_id";
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                   $c++;
               $id=$row['id'];
               $specification_head_id=$row['specification_head_id'];
               $head_name= singleRowFromTable($conn, "SELECT * FROM specification_head WHERE id='$specification_head_id'", "head_name");

               $data_making="";
               $sql1="SELECT * FROM dp_details WHERE dp_id='$dp_id' AND status='1'  AND specification_head_id='$specification_head_id'";
               $result1=mysqli_query($conn,$sql1);
                while($row1=mysqli_fetch_array($result1)){


                $specification_subhead_id=$row1['specification_subhead_id'];
                $subhead_name= singleRowFromTable($conn, "SELECT * FROM specification_subhead WHERE id='$specification_subhead_id'", "subhead_name");
                $specification_subhead_data_id=$row1['specification_subhead_data_id'];
                $subhead_data_name= singleRowFromTable($conn, "SELECT * FROM specification_subhead_data WHERE id='$specification_subhead_data_id'", "subhead_data");

                $data_making.="<b>".$subhead_name."</b>  - &nbsp".$subhead_data_name.", &nbsp";

                }
                $status=$row['status'];

echo '<tr>';
 echo '<td>'.$c.'</td>';
 echo '<td><b>'. $head_name.'</b></td>';
 echo '<td>'. $data_making.'</td>';
//  echo '<td>'. $status.'</td>';
// $edit_modal_params_string="'$id','$brand_id','$series_id','$model_no','$specification_master_id',$data_id";
// $edit_modal_params='openModel('.$edit_modal_params_string.')';
// echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
// echo '<td><a href="test_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >remove</button></a></td>';
 echo '</tr>';
}
 ?>
</tbody>
 </table>
</div>
</body>
</html>