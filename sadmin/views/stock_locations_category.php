<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Stock Locations Category Details</title>
<?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
             
?>
</head>
<body>
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3> Stock Locations Category </h3><small class='text-muted'>Fill in the given below tab to create Stock Locations Category Details</small><hr></hr>
<!-- my code start  --> 


<ul class='nav nav-tabs nav-justified'>
<li  class='nav-item '>
            <a class='nav-link active' data-toggle='tab' href='#home'>Stock Locations Category  Creation</a></li>
<li class='nav-item'>
            <a  data-toggle='tab' class='nav-link' href='#menu1'>Existing Stock Locations Category </a></li>
</ul>




<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in active'>
<form class='form-horizontal' action='../controllers/stock_locations_category_add.php' method='post'>

 <!-- //  content  1 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Locations Category</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter locations category' name='locations_category' id='locations_category'>
</div>
</div>
<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<div class='d-grid'>
<button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
</div>
</div>
</div>
</form>
</div>
<br><div id='menu1' class='tab-pane fade'>
<table class='table table-sm table-hover' id='example'>
<thead>
<th>#</th>
<th>Locations Category</th>
<th>Edit</th>
<th>Action</th>
</thead>
<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM stock_locations_category WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$locations_category=$row['locations_category'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $row['locations_category'].'</td>';
$c++
;$edit_modal_params_string="'$id','$locations_category','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/stock_locations_category_del.php?id='.$id.'" onclick="return confirm(\'Are you sure ?\');"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
 echo '</tr>';
}
 ?>
</tbody>
 </table>
</div>
<!--// for tab-content  -->
</div>
<!--// container-fluid -->

 <!-- The Modal -->
 <div class='modal' id='myModal'>
 
<div class='modal-dialog modal-lg'>
 
<div class='modal-content'>
 
<!-- Modal Header -->
 
<div class='modal-header'> 

<h4 class='modal-title'>Stock Locations Category Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/stock_locations_category_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Locations_category</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter locations_category' name='locations_category_E' id='locations_category_E'>
</div>
</div>
<div class='row mt-3'>
<div class='col-md-4'></div>
<div class='col-md-8'>
<button type='submit' class='btn btn-primary btn-block btn-sm'>Submit</button>
</div>
</div>
</form>

</div>
 <!-- Modal footer -->
 <div class='modal-footer'>
        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
      </div>

    </div>
  </div>
</div></div><script>
function openModel(id,locations_category,status){
$('#id_E').val(id);$('#locations_category_E').val(locations_category);
}
</script>