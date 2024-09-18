<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> User Module</title>
<?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
             
?><script>
$('.e').addClass("active");

</script>
</head>
<body>
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3> User Module </h3><small class='text-muted'>Fill in the given below tab to create  User Module and manage existing  data </small><legend></legend>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li class='active'>
            <a   class='nav-link active' data-toggle='tab' href='#home'>User Module Creation</a></li>
<li>
            <a class='nav-link'  data-toggle='tab' href='#menu1'>Existing User Module</a></li>
            </ul>






<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in active'>
<form class='form-horizontal' action='../controllers/user_module_add.php' method='post'>

 <!-- //  content  1 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Module Name</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter module name' name='module_name' id='module_name'>
</div>
</div>
<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<div class='d-grid'>
<button type='submit' class='btn btn-secondary btn-block btn-sm'>Submit</button>
</div>
</div>
</div>
</form>
</div>
<br><div id='menu1' class='tab-pane fade'>
<table class='table' id='example'>
<thead>
<th>#</th>
<th>Module Name</th>
<th>Edit</th>
<th>Action</th>
</thead>
<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM user_module WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$module_name=$row['module_name'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $row['module_name'].'</td>';
$c++
;$edit_modal_params_string="'$id','$module_name','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/user_module_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
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

<h4 class='modal-title'>User Module Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/user_module_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Module Name</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter module name' name='module_name_E' id='module_name_E'>
</div>
</div>
<div class='row mt-3'>
<div class='col-md-4'></div>
<div class='col-md-8'>
<button type='submit' class='btn btn-secondary btn-block btn-sm'>Submit</button>
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
function openModel(id,module_name,status){
$('#id_E').val(id);$('#module_name_E').val(module_name);
}
</script>

