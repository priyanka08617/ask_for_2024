<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Branch Details</title>
<?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
             
?>
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

         
             thead tr td {

                 text-align: center;

             }

        
             </style></head>
<body>
<div class='container-fluid' style=''>
<!-- Form Name -->
<h3> Branch </h3><small class='text-muted'>Fill in the given below tab to create  Branch and manage existing data</small><legend></legend>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li class='nav-item'>

            <a   class='nav-link' data-toggle='tab' href='#home'>Branch Creation</a></li>

            <li class='nav-item'>
            <a class='nav-link active'  data-toggle='tab' href='#menu1'>Existing Branch</a></li>
            </ul>






<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in fade'>
<form class='form-horizontal' action='../controllers/branch_add.php' method='post'>

 <!-- //  content  1 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Name</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter Name' name='name' id='name'>
</div>
</div>

 <!-- //  content  4 -->
 <div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Contatct No</label></div>
<div class='col-md-6'>
<input type='number'  class='form-control' placeholder='Enter Contatct No' name='contact_no' id='contact_no'>
</div>
</div>



 <!-- //  content  5 -->
 <div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>City</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter City' name='city' id='city'>
</div>
</div>

 <!-- //  content  6 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>State</label></div>
<div class='col-md-6'>

            <select class='form-control' name='state' id='state'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM `states` WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['name'].'</option>';
                      }
            ?>
            </select>
            </div></div>



 <!-- //  content  2 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Address</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter Address' name='address' id='address'>
</div>
</div>

 <!-- //  content  3 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Gst</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter Gst' name='gst' id='gst'>
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
<br><div id='menu1' class='tab-pane in active'>
<table class='table table-sm' id='example'>
<thead>
<th>#</th>
<th>Name</th>
<th>Contact NO</th>
<th>City</th>
<th>State</th>
<th>Address</th>
<th>Gst</th>
<th>Edit</th>
<th>Action</th>
</thead>
<tfoot>
<th>#</th>
<th>Name</th>
<th>Address</th>
<th>Gst</th>
<th>contact_no</th>
<th>City</th>
<th>State</th>
<th>Edit</th>
<th>Action</th>
</tfoot>
<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM branch WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$name=$row['name'];
$address=$row['address'];
$gst=$row['gst'];
$contact_no=$row['contact_no'];
$city=$row['city'];
$state=$row['state'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
               
 echo '<td>'. $row['name'].'</td>';
 echo '<td>'. $row['contact_no'].'</td>';
 echo '<td>'. $row['city'].'</td>';
 echo '<td>'. $row['state'].'</td>';
 echo '<td>'. $row['address'].'</td>';
 echo '<td>'. $row['gst'].'</td>';
$c++
;$edit_modal_params_string="'$id','$name','$address','$gst','$contact_no','$city','$state','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><img src="../img/edit.png" width="30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'"></td>';
echo '<td><a href="../controllers/branch_del.php?id='.$id.'"><img src="../img/delete.png" width="30px"</a></td>';
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

<h4 class='modal-title'>Branch Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/branch_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Name</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Name' name='name_E' id='name_E'>
</div>
</div>

 <!-- //  content  2 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Address</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Address' name='address_E' id='address_E'>
</div>
</div>

 <!-- //  content  3 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Gst</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Gst' name='gst_E' id='gst_E'>
</div>
</div>

 <!-- //  content  4 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Contatct No</label>
</div>
<div class='col-md-8'>
<input type='number'  class='form-control' placeholder='Enter Contatct No' name='contact_no_E' id='contact_no_E'>
</div>
</div>

 <!-- //  content  5 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>City</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter City' name='city_E' id='city_E'>
</div>
</div>

 <!-- //  content  6 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>State</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='state_E' id='state_E'>
            <option value=''>select</option>
            <?php
 
 $sql='SELECT * FROM `states` WHERE status="1"';
 $result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){
   $id=$row['id'];
   echo '<option value="'.$id.'">'.$row['name'].'</option>';
 }
            ?>
            </select>
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
function openModel(id,name,address,gst,contact_no,city,state,status){
$('#id_E').val(id);$('#name_E').val(name);
$('#address_E').val(address);
$('#gst_E').val(gst);
$('#contact_no_E').val(contact_no);
$('#city_E').val(city);
$('#state_E').val(state);
}$('#example tfoot th').each(function() {

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

        'pageLength', 'copy', 'excel', 'pdf', 'print'

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

</script>