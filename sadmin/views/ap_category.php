<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html  lang='en'>
<head>
<title> Assemble Purchase Category Details</title>
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
<h3> Assemble Purchase Category </h3><small class='text-muted'>Fill in the given below tab to create  Assemble Purchase Category and manage existing data</small><legend></legend>
<!-- my code start  --> 
<ul class='nav nav-tabs nav-justified'>
<li class='nav-item'>

            <a   class='nav-link' data-toggle='tab' href='#home'>Ap Category Creation</a></li>

            <li class='nav-item'>
            <a class='nav-link active'  data-toggle='tab' href='#menu1'>Existing Ap Category</a></li>
            </ul>






<br><br>


<div class='tab-content'>
<div id='home' class='tab-pane in fade'>
<form class='form-horizontal' action='../controllers/ap_category_add.php' method='post'>

 <!-- //  content  1 -->
<div class='form-group row'>
<div class='col-md-1'></div><div class='col-md-2'><label class='control-label' for='uom'>Category</label></div>
<div class='col-md-6'>
<input type='text'  class='form-control' placeholder='Enter Category' name='category' id='category'>
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
<div id='menu1' class='tab-pane in active'>
<table class='table table-sm table-hover' id='example'>
<thead>
<th>#</th>
<th>Category</th>
<th>Edit</th>
<th>Action</th>
</thead>
<tfoot>
<th>#</th>
<th>Category</th>
<th>Edit</th>
<th>Action</th>
</tfoot>
<tbody>
<!--- // ************************************************************ --> 
<?php
   $c=1; 
 
              $sql='SELECT * FROM ap_category WHERE status="1"';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
               $id=$row['id'];
               $status=$row['status'];
$category=$row['category'];
echo '<tr>';
               echo '<td>'.$c.'</td>';
 echo '<td>'. $row['category'].'</td>';
$c++
;$edit_modal_params_string="'$id','$category','$status'";
$edit_modal_params='openModel('.$edit_modal_params_string.')';
echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'">Edit</button></td>';
echo '<td><a href="../controllers/ap_category_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
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

<h4 class='modal-title'>Assemble_purchase_category Edit</h4>

 <button type='button' class='close' data-dismiss='modal'>&times;</button>
</div>

<!-- Modal body -->

<div class='modal-body'>
<form class='form' action='../controllers/ap_category_update.php'  method='POST'>
<input type='hidden'  class='form-control'  name='id_E' id='id_E'>

 <!-- //  content  1 -->
<div class='row mt-3'>
<div class='col-md-4'>
<label for='comment'>Category</label>
</div>
<div class='col-md-8'>
<input type='text'  class='form-control' placeholder='Enter Category' name='category_E' id='category_E'>
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
function openModel(id,category,status){
$('#id_E').val(id);$('#category_E').val(category);
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