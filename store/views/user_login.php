<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> User Login Details</title>
<?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
include '../includes/functions.php'; 
             
?><script>
$('.e').addClass("active");

</script>
</head>
<body>
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3> User Login </h3><small class='text-muted'>Fill in the given below tab to create  User Login and manage existing data</small><legend></legend>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li class='active'>
            <a   class='nav-link active' data-toggle='tab' href='#home'>User Login Creation</a></li>
<li>
            <a class='nav-link'  data-toggle='tab' href='#menu1'>Existing User Login</a></li>
            </ul>






<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in active'>
<form class='form-horizontal' action='../controllers/user_login_add.php' method='post'>

 
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Module</label></div>
<div class='col-md-6'>

            <select id="user_module" name="user_module" onchange="fetch_user_category_from_module();" class="form-control">
        <option value="">---Select---</option>
      </select>
            </div></div>


<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>User Category</label></div>
<div class='col-md-6'>

             <select id="user_category" name="user_category" onchange="fetch_username_prefix();" class="form-control">
        <option value="">---Select---</option>
      </select>
            </div></div> 







<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Username</label></div>
<div class='col-md-6'>
<div class="input-group ">
  <div class="input-group-prepend">
    <span class="input-group-text" id="username-prefix"></span>
  </div>
  <input type='text'  class='form-control' placeholder='Enter Username' name='username' id='username'>

</div>
</div>
</div>

<script>


function fetch_username_prefix(){


$('#username-prefix').show();
var user_category=$('#user_category').val();
$.ajax({
            type:"POST",
            data:{
              user_category:user_category
            },
            url:"../controllers/ajax/ajax_fetch_user_category_prefix.php",
              success:function(data){
                
            $("#username-prefix").html(data);

              }
          });
}



</script>






 <!-- //  content  4 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Password</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter Password' name='password' id='password'>
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
<th>Module</th>
<th>User Category</th>
<th>Username</th>
<th>Password</th>
<!-- <th>Edit</th> -->
<th>Action</th>
</thead>
<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM user_login WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$module_id=$row['module_id'];
$module_name=singleRowFromTable($conn, "SELECT * FROM user_module WHERE id='$module_id'", "module_name");

$user_category_id=$row['user_category_id'];
$user_category=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_id'", "user_category");

$username=$row['username'];
$password=$row['password'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $module_name.'</td>';
 echo '<td>'. $user_category.'</td>';
 echo '<td>'. $row['username'].'</td>';
 echo '<td>'. $row['password'].'</td>';
$c++
;$edit_modal_params_string="'$id','$module_id','$user_category_id','$username','$password','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
// echo '<td><button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/user_login_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
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

<h4 class='modal-title'>User_login Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/user_login_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>
 <div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Module Id</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='module_id_E' id='module_id_E'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM user_module WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['module_name'].'</option>';
                      }
            ?>
            </select>
          </div>
</div>

<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>User Category Id</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='user_category_id_E' id='user_category_id_E'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM user_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['user_category'].'</option>';
                      }
            ?>
            </select>
          </div>
</div> 







 <!-- //  content  3 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Username</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Username' name='username_E' id='username_E'>
</div>
</div>

 <!-- //  content  4 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Password</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Password' name='password_E' id='password_E'>
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
function openModel(id,module_id,user_category_id,username,password,status){
$('#id_E').val(id);$('#module_id_E').val(module_id);
$('#user_category_id_E').val(user_category_id);
$('#username_E').val(username);
$('#password_E').val(password);
}
</script>



<script>







function fetch_user_module_on_document_load()
  {

    $("#user_module").html("");
      $.ajax({
          url:"../controllers/ajax/ajax_get_user_module_FGA.php",
          success:function(data){
        $("#user_module").append(data);
          }
      });
  }




  $( document ).ready(function() {
   
 fetch_user_module_on_document_load();
 $('#username-prefix').hide();

  });



  </script>


<script>
    function fetch_user_category_from_module()
      {
        $('#username-prefix').hide();
        $("#user_category").html("");
        var user_module_id=$("#user_module").val();
          $.ajax({
            type:"get",
            data:{
                user_module_id:user_module_id
            },
            url:"../controllers/ajax/ajax_select_user_category_from_user_module_id_FGA.php",
              success:function(rvalue){
            $("#user_category").append(rvalue);
              }
          });
      }
      </script>
