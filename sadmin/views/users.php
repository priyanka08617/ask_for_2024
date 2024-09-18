<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Users Details</title>
<?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
include '../includes/functions.php';    
?><script>
$('.e').addClass("active");

</script>

<style>
        tfoot {
            display: table-header-group;
        }

        tfoot input {
            width: 100%;
            /* background: #868E85; */
            border: none;
            border: 1px solid #868E85;
            padding: 0px 5px;
        }

        table #example tr td {
            padding: 9px;
            font-weight: bold;
        }


        table #example2 tr td {
            padding: 9px;
            font-weight: bold;
        }


        /* thead{
        background: #2A4747;
    } */

        thead tr td {
            text-align: center;
        }
    /* 
        #disabled_tr{
        opacity: 0.3;
    } */
        </style>


</head>
<body>
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3> Users </h3><small class='text-muted'>Fill in the given below tab to create  Users and manage existing data</small><legend></legend>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li class='nav-item'>
            <a   class='nav-link ' data-toggle='tab' href='#home'>Users Creation</a></li>
<li class='nav-item'>
            <a class='nav-link active'  data-toggle='tab' href='#menu1'>Existing Users</a></li>
            </ul>









<div class='tab-content'>
<div id='home' class='tab-pane in fade'>
<br>
<form class='form-horizontal' action='../controllers/users_add.php' method='post'>





            <div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Name</label></div>
<div class='col-md-8'>
            <div class="input-group">
 
    <input type='text'  class='form-control' placeholder='First Name' name='first_name' id='first_name' required>
    <input type='text'  class='form-control' placeholder='Middle Name' name='middle_name' id='middle_name'>
    <input type='text'  class='form-control' placeholder='Last Name' name='last_name' id='last_name'>
  </div>
  </div>
</div>


 <!-- //  content  5 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Date Of Birth</label></div>
<div class='col-md-8'>
<input type='date'  class='form-control' placeholder='Enter Date Of Birth' name='date_of_birth' id='date_of_birth'>
</div>
</div>

 <!-- //  content  6 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Gender</label></div>
<div class='col-md-8'>

            <select class='form-control'  name='gender' id='gender'>
            <option value=''>select</option>
            <option value='1'>Male</option>
            <option value='2'>Female</option>
            <option value='3'>Others</option>


            
            </select>
            </div></div>

 <!-- //  content  7 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Phone</label></div>
<div class='col-md-8'>
<input type='text'  class='form-control'  placeholder='Enter Phone' name='phone' id='phone'>
</div>
</div>

 <!-- //  content  8 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Email</label></div>
<div class='col-md-8'>
<input type='text'  class='form-control'  placeholder='Enter Email' name='email' id='email'>
</div>
</div>

 <!-- //  content  9 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Address</label></div>
<div class='col-md-8'>
<textarea type='text'  class='form-control' placeholder='Enter Address' name='address' id='address'></textarea>
</div>
</div>


<!-- //  content  10 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Branch</label></div>
<div class='col-md-8'>
<select class='form-control' name='branch_id' id='branch_id' style='width:100%'>
<option value=''>select</option>
  <?php
  $sql="SELECT * FROM `branch` WHERE `status`='1'";
  $query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query)){
    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
  }
  ?>
</select>
</div>
</div>



<br>
<hr>
<br>


<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>User Type</label></div>
<div class='col-md-8'>

            <select class='form-control'  name='user_type' id='user_type' style='width:100%' required>
           
            <option value='0'>Un-assigned</option>
            <option value='1'>Assigned</option>
            
            </select>

            </div></div>  


            
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>User Category</label></div>
<div class='col-md-8'>

             <select id="user_category" name="user_category" onchange="fetch_username_prefix_and_random_username_password();" class="form-control" required>
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







<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Username</label></div>
<div class='col-md-8'>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="username-prefix"></span>
  </div>
  <input type='text'  class='form-control' placeholder='Enter Username' onkeyup="check_username_availability();" required name='username' id='username'>

  <!-- <input type='text'  class='form-control' placeholder='Enter Username' name='username' id='username'> -->
  <div class="input-group-append">
    <span class="input-group-text" id="username_check_response"></span>
  </div>
  <!-- <center><br><span id="username_check_response"><i></i></span></center> -->
</div>
</div>
</div>

<script>


function fetch_username_prefix_and_random_username_password(){


$('#username-prefix').show();
$('#username').attr('disabled', false); 
var user_category=$('#user_category').val();
$.ajax({
            type:"POST",
            dataType: 'json',
            data:{
              user_category:user_category
            },
            url:"../controllers/ajax/ajax_fetch_user_category_prefix_and_random_username_password.php",
              success:function(data){

                console.log(data);
                
            $("#username-prefix").html(data.prefix);
            $("#username").val(data.random_username);

            $("#password").val(data.random_password);
            $('#username_check_response').html("<span style='color:green;'>* Username Available<span>");


            $('#user_submit').attr('disabled', false); 



              }
          });
}






function  check_username_availability(){



  var username= $('#username').val();
var user_category_prefix=$('#username-prefix').html();
var usernameToCheck=user_category_prefix+username;
$.ajax({
            type:"POST",
            // dataType: 'json',
            data:{
              usernameToCheck:usernameToCheck
            },
            url:"../controllers/ajax/ajax_check_username_availability.php",
              success:function(data){

                if(data==0){
                  $('#username_check_response').html("<span style='color:red;'>* Username already exists.<span>");
                  $('#user_submit').attr('disabled', true); 
                }
                else{
                  $('#username_check_response').html("<span style='color:green;'>* Username Available<span>");
                  $('#user_submit').attr('disabled', false); 
                }

            //     console.log(data);
                
            // $("#username-prefix").html(data.prefix);
            // $("#username").val(data.random_username);

            // $("#password").val(data.random_password);



              }
          });
}



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



<script>

$( document ).ready(function() {
   
  //  fetch_user_module_on_document_load();
   $('#username-prefix').hide();
$('#username').attr('disabled', true); 
$('#user_submit').attr('disabled', true); 
  
    });
    </script>








 <!-- //  content  4 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Password</label></div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Password' name='password' id='password'>
</div>
</div>


<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-8'>
<div class='d-grid'>
<button type='submit' class='btn btn-secondary btn-block btn-sm' id="user_submit">Submit</button>
</div>
</div>
</div>

<br><br>
</form>
</div>
<div id='menu1' class='tab-pane in active'>
<br>
<table class='table table-sm' id='example'>
<thead>
<th>#</th>
<th>Branch</th>
<th>User Category</th>
<th>Name</th>
<th>DOB</th>
<th>Gender</th>
<th>Phone</th>
<th>Email</th>
<th>Address</th>
<th>Status</th>
<th>Username</th>
<th>Password</th>
<!-- <th>Edit</th> -->
<th>Action</th>
</thead>

<tfoot>
<th>#</th>
<th>Branch</th>
<th>User Category</th>
<th>Name</th>
<th>DOB </th>
<th>Gender</th>
<th>Phone</th>
<th>Email</th>
<th>Address</th>
<th>Status</th>
<th>Username</th>
<th>Password</th>
<!-- <th>Edit</th> -->
<th>Action</th>
</tfoot>

<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM `users` WHERE `status`="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $branch_id=$row['branch_id'];
               $branch=singleRowFromTable($conn, "SELECT * FROM `branch` WHERE `id`='$branch_id'", "name");
               $status=$row['status'];
$user_category_id=$row['user_category_id'];
$user_category=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_id'", "user_category");
$symbol=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_id'", "user_category");

$first_name=$row['first_name'];
$middle_name=$row['middle_name'];
$last_name=$row['last_name'];
$date_of_birth=$row['date_of_birth'];
$gender_id=$row['gender'];
$phone=$row['phone'];
$email=$row['email'];
$address=$row['address'];
$agent_code=$row['agent_code'];

if($row['gender']==1){
  $gender="Male";
}elseif($row['gender']==2){
  $gender="Fe-male";
}elseif($row['gender']==3){
  $gender="Others";
}else{
  $gender="";
}
$assign_status_id=$row['assign_status'];
$assign_status='';
if($assign_status_id==1){
  $assign_status="Assigned";
  $username=singleRowFromTable($conn, "SELECT * FROM `user_login` WHERE `user_id`='$id'", "username");
  $password=singleRowFromTable($conn, "SELECT * FROM `user_login` WHERE `user_id`='$id'", "password");

}elseif($assign_status_id==0){
  $assign_status="Un-assigned";
  $username='--';
$password='--';
}






  echo '<tr>';
  echo '<td>'.$c.'</td>';
  echo '<td>'. $branch.'</td>';
 echo '<td>'. $user_category.'</td>';
 echo '<td>'. $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</td>';
 echo '<td>'. $row['date_of_birth'].'</td>';
 echo '<td>'. $gender.'</td>';
 echo '<td>'. $row['phone'].'</td>';
 echo '<td>'. $row['email'].'</td>';
 echo '<td>'. $row['address'].'</td>';
 echo '<td>'. $assign_status.'</td>';
 echo '<td>'. $username.'</td>';
 echo '<td>'. $password.'</td>';

$c++
;$edit_modal_params_string="'$id','$user_category_id','$first_name','$middle_name','$last_name','$date_of_birth','$gender_id','$phone','$email','$address','$status','$username','$password','$branch_id','$assign_status_id'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'" >';
echo '<a href="../controllers/users_del.php?id='.$id.'"><img src="../img/delete.png" width="30px" ></a></td>';
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

<h4 class='modal-title'>Users Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/users_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>User Category</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='user_category_E' id='user_category_E'>
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

 <!-- //  content  2 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>First Name</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter First Name' name='first_name_E' id='first_name_E'>
</div>
</div>

 <!-- //  content  3 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Middle Name</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Middle Name' name='middle_name_E' id='middle_name_E'>
</div>
</div>

 <!-- //  content  4 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Last Name</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Last Name' name='last_name_E' id='last_name_E'>
</div>
</div>

 <!-- //  content  5 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Date Of Birth</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Date Of Birth' name='date_of_birth_E' id='date_of_birth_E'>
</div>
</div>

 <!-- //  content  6 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Gender</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='gender_E' id='gender_E'>

            <option value=' '>select</option>
            <option value='1'>Male</option>
            <option value='2'>Female</option>
            <option value='3'>Others</option>


            
            </select>
          </div>
</div>

 <!-- //  content  7 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Phone</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Phone' name='phone_E' id='phone_E'>
</div>
</div>

 <!-- //  content  8 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Email</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Email' name='email_E' id='email_E'>
</div>
</div>

 <!-- //  content  9 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Address</label>
</div>
<div class='col-md-8'>
<textarea type='text'  class='form-control' placeholder='Enter Address' name='address_E' id='address_E'></textarea>
</div>
</div>


 <!-- //  content  10 -->

<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Branch</label>
</div>
<div class='col-md-8'>


<select class='form-control' name='branch_id_E' id='branch_id_E' style='width:100%'>
<option value=''>select</option>
  <?php
  $sql="SELECT * FROM `branch` WHERE `status`='1'";
  $query=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($query)){
    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
  }
  ?>
</select>
          </div>
</div>


 <!-- //  content  10 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Staus</label>
</div>
<div class='col-md-8'>
<select class='form-control'  name='user_type_E' id='user_type_E' style='width:100%' onchange='assign_employee(this.value)' required>
           
            <option value='0'>Un-assigned</option>
            <option value='1'>Assigned</option>
            
            </select>
</div>
</div>





<div id='login_details'>
<div class='row mt-3'>
<div class='col-md-4'>
  <label class='control-label' for='uom'>Username</label>
</div>
<div class='col-md-8'>
<div class="input-group ">
  <div class="input-group-prepend">
    <span class="input-group-text" id="username_prefix_edit"></span>
  </div>
  <input type='text'  class='form-control' placeholder='Enter Username' onkeyup="check_username_availability_E();" required name='username_E' id='username_E'>

  <div class="input-group-append">
    <span class="input-group-text" id="username_check_response_E"></span>
  </div>
  <!-- <center><br><span id="username_check_response"><i></i></span></center> -->
</div>
</div>
</div>


 <!-- //  content  4 -->
 <div class='row mt-3'>
<div class='col-md-4'><label class='control-label' for='uom'>Password</label></div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Password' name='password_E' id='password_E'>
</div>
</div>


</div>

 <!-- //  content  10 -->
<!-- <div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Agent Code</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Agent Code' name='agent_code_E' id='agent_code_E'>
</div>
</div> -->
<div class='row mt-3'>
<div class='col-md-4'></div>
<div class='col-md-8'>
<button type='submit' class='btn btn-secondary btn-block btn-sm' id='user_btn_E'>Submit</button>
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
</div></div>



    
    
    
    <script>
function openModel(id,user_category,first_name,middle_name,last_name,date_of_birth,gender,phone,email,address,status,username,password,branch_id,assign_status_id){
  
  // alert(gender);
  $('#branch_id_E').val(branch_id);
  $("#branch_id_E").select2();
$('#id_E').val(id);
$('#user_category_E').val(user_category);
$('#first_name_E').val(first_name);
$('#middle_name_E').val(middle_name);
$('#last_name_E').val(last_name);
$('#date_of_birth_E').val(date_of_birth);
$('#gender_E').val(gender);
$('#phone_E').val(phone);
$('#email_E').val(email);
$('#address_E').val(address);
$('#login_details').hide();
$('#user_type_E').val(assign_status_id);

if(assign_status_id==1){
  
  $('#login_details').show();
$('#username_E').empty(username);
$('#password_E').empty(password);

$('#username_E').val(username);
$('#password_E').val(password);


}else{
  $('#login_details').hide();
$('#username_E').empty(username);
$('#password_E').empty(password);


$('#username_E').val(username);
$('#password_E').val(password);
}





$.ajax({
            type:"POST",
            dataType: 'json',
            data:{
              user_category:user_category
            },
            url:"../controllers/ajax/ajax_fetch_user_category_prefix_and_random_username_password.php",
              success:function(data){

                console.log(data);
                
            $("#username_prefix_edit").html(data.prefix);
            // $("#username_E").val(data.random_username);

            // $("#password_E").val(data.random_password);
            $('#username_check_response_E').html("<span style='color:green;'>* Username Available<span>");
              }
          });
}

$("#branch_id").select2();


$('#example tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="" placeholder="Search" />');
            });
        
            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [
                    [25, 50, -1],
                    ['25 rows', '50 rows', 'Show all']
                ],
            
                buttons: [
                    'pageLength'
                ]
            });
        
            table.columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });

     






function  check_username_availability_E(){



  var username= $('#username_E').val();
var user_category_prefix=$('#username_prefix_edit').html();
var usernameToCheck=user_category_prefix+username;
$.ajax({
            type:"POST",
            // dataType: 'json',
            data:{
              usernameToCheck:usernameToCheck
            },
            url:"../controllers/ajax/ajax_check_username_availability.php",
              success:function(data){

                if(data==0){
                  $('#username_check_response_E').html("<span style='color:red;'>* Username already exists.<span>");
                  $('#user_btn_E').attr('disabled', true); 
                }
                else{
                  $('#username_check_response_E').html("<span style='color:green;'>* Username Available<span>");
                  $('#user_btn_E').attr('disabled', false); 
                }

              }
          });
}


function assign_employee(status){
  if(status==1){
    $('#login_details').show();
  }else{

    $('#login_details').hide();
  }

}

      </script>



