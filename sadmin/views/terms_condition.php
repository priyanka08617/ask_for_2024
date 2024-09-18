<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Terms Condition Details</title>
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
<h3> Terms Condition </h3><small class='text-muted'>Fill in the given below tab to create  Terms Condition and manage existing data</small><legend></legend>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li class='nav-item'> <a  class='nav-link' data-toggle='tab' href='#home'>Terms Condition Creation</a></li>

            <li class='nav-item'>
            <a class='nav-link active'  data-toggle='tab' href='#menu1'>Existing Terms Condition</a></li>
            </ul>






<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in fade'>
<form class='form-horizontal' action='../controllers/Terms_condition_add.php' method='post'>

 <!-- //  content  1 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Terms For</label></div>
<div class='col-md-6'>

            <select class='form-control' name='terms_for' id='terms_for'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM terms_condition_category WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['category'].'</option>';
                      }
            ?>
            </select>
            </div></div>

 <!-- //  content  2 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Terms</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter Terms' name='terms' id='terms'>
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
<table class='table' id='example'>
<thead>
<th>#</th>
<th>Terms_for</th>
<th>Terms</th>
<th>Edit</th>
<th>Action</th>
</thead>
<tfoot>
<th>#</th>
<th>Terms_for</th>
<th>Terms</th>
<th>Edit</th>
<th>Action</th>
</tfoot>
<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM Terms_condition WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$terms_for=$row['terms_for'];
$terms=$row['terms'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $row['terms_for'].'</td>';
 echo '<td>'. $row['terms'].'</td>';
$c++
;$edit_modal_params_string="'$id','$terms_for','$terms','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/Terms_condition_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
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

<h4 class='modal-title'>Terms_condition Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/Terms_condition_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Terms For</label>
</div>
<div class='col-md-8'>


            <select class='form-control' name='terms_for_E' id='terms_for_E'>
            <option value=''>select</option>
            <?php
 
                      $sql='SELECT * FROM terms_for WHERE status="1"';
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_array($result)){
                        $id=$row['id'];
                        echo '<option value="'.$id.'">'.$row['value'].'</option>';
                      }
            ?>
            </select>
          </div>
</div>

 <!-- //  content  2 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Terms</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Terms' name='terms_E' id='terms_E'>
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
function openModel(id,terms_for,terms,status){
$('#id_E').val(id);$('#terms_for_E').val(terms_for);
$('#terms_E').val(terms);
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