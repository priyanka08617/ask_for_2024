<?php ob_start();
include '../includes/check.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> specification Head Details</title>
    <?php include '../includes/header.php';?>
    <?php include '../includes/navbar.php';?>
    <?php include '../includes/functions.php';?>

    <style>
    #box {
        border: 1px solid gray;
        margin: 100px 100px 100px 100px;
        padding: 70px 70px 70px 70px;
    }

    #p_format {
        font-size: 20px;
    }

    .footer {
        display: disabled;
    }

    h4 {
        color: #606060;
    }

    hr {
        background-color: lightgray;
        /* border: none; */
        /* color: blue; */
        height: 1px;
    }

    .frm {
        padding: 30px 30px 30px 30px;
    }


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

    </style>

</head>

<body>
    <div class="container-fluid">

        <h3 style="font-family: Sans-serif;"><b>BRAND MODEL MASTER</b></h3>
        <p style="font-family: Sans-serif;color: #808080;">Import and Showing all existing customer details</p>
        <hr>
        </hr>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">

                <div class='form-group row'>
                <div class='col-md-2'></div>
                    <div class='col-md-1'><label class='control-label' for='uom'>Product</label></div>
                    <div class='col-md-5'>


                        <select class="form-control" name="dp_category_id" id="dp_category_id" style="width:100%" onchange="fetch_product_specification(this.value);">
                        <option value=" ">select</option>
                            <?php
     $sql="SELECT * FROM dp_category WHERE status='1' ORDER BY id DESC";
     $query=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_array($query)){
      echo "<option value='".$row['id']."'>".$row["category_name"]."</option>";
     }
     ?>
                        </select>
                    </div>

                    <div class='col-md-3'>


<button class="btn btn-info" name="show_modal_for_add_specification_head" id="show_modal_for_add_specification_head"  onclick="add_specification_head();">Add Specification Head Name</button>

</div>

                </div>


                

            </div>
            <div class="card-body"></div>
        </div>
    




    </div>


    </div>
    </div>




    <!-- The Modal -->
<div class='modal' id='myModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header'>
                <h4 class='modal-title'><b>Specification Head Creation</b></h4>
                <button type='button' class='btn-close' data-dismiss='modal'></button>
            </div>
            <!-- Modal body -->
            <!-- ../controllers/specification_head_add.php -->
            <div class='modal-body'>
                <form class='form' action='' method='POST'>
                    s
<input type="hidden" id="dp_category_id_modal">
                    <div class='form-group row'>
                            <div class='col-md-2'>
                                <label for='comment'>Product</label>
                            </div>
                            <div class='col-md-10'>
                            <input type="text" class="form-control" name="dp_category_modal" id="dp_category_modal" style="width:100%" readonly>
                            </div>
                        </div>


                   
                        <!-- //  content  1 -->
                        <div class='form-group row'>
                            <div class='col-md-2'>
                                <label for='comment'>Name</label>
                            </div>
                            <div class='col-md-10'>
                                <input type='text' class='form-control' name='specification_head_name'
                                    id='specification_head_name' placeholder="Enter Specification head name">
                            </div>
                        </div>
                   
                    <div class=' form-group row'>
                        <div class='col-md-2'></div>
                        <div class='col-md-10'>
                                <button type='button' class='btn btn-primary btn-block btn-sm' id='submit_specification_head_creation_form'>Submit</button>
                         
                        </div>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
            </div>

        </div>
    </div>
</div>



    <!-- The Modal -->
    <div class='modal' id='myModal_update'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header'>
                <h4 class='modal-title'><b>Specification Head Update</b></h4>
                <button type='button' class='btn-close' data-dismiss='modal'></button>
            </div>
            <!-- Modal body -->
            <!-- ../controllers/specification_head_add.php -->
            <div class='modal-body'>
                <form class='form-update' action='' method='POST'>
                    
<input type="hidden" id="dp_category_id_modal_for_update">
                    <div class='form-group row'>
                            <div class='col-md-2'>
                                <label for='comment'>Product</label>
                            </div>
                            <div class='col-md-10'>
                            <input type="text" class="form-control" name="dp_category_modal_for_update" id="dp_category_modal_for_update" style="width:100%" readonly>
                            </div>
                        </div>


                   
                        <!-- //  content  1 -->
                        <div class='form-group row'>
                            <div class='col-md-2'>
                                <label for='comment'>Name</label>
                            </div>
                            <div class='col-md-10'>
                                <input type='text' class='form-control' name='specification_head_name_for_update'
                                    id='specification_head_name_for_update' placeholder='Enter Specification head name'>
                            </div>
                        </div>
                   
                    <div class=' form-group row'>
                        <div class='col-md-2'></div>
                        <div class='col-md-10'>
                                <button type='button' class='btn btn-primary btn-block btn-sm' id='butUpdate'>Submit</button>
                         
                        </div>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
            </div>

        </div>
    </div>
</div>


</body>

<script>

function openModel_data(id, product_name, head_name) {
        $('#dp_category_id_modal_for_update').val(id);
        $('#dp_category_modal_for_update').val(product_name);
        $('#specification_head_name_for_update').val(head_name);
    }




$( document ).ready(function() {


$("#dp_category_id").select2();
$("#productName").select2();

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

    });


function add_specification_head(){
  var dp_category_id=  $("#dp_category_id").val();
  if(dp_category_id==" "){
    swal("Did you select   Product ?", "Product Not Seleced Please select the Product", "error"); 

//     swal(
//   'Did you selected Product ?',
//   ' Product Not Seleced Please select the Product',
//   'question'
// )


  }else{

    $.ajax({
		type: 'POST',
		data:{
			dp_category_id:dp_category_id
		},
        url: "../controllers/ajax/ajax_specification_head_for_fetch_name.php",    
		 success: function(product_name){
      $("#dp_category_modal").empty();
      $("#dp_category_id_modal").empty();
      $("#dp_category_modal").val(product_name);
      $("#dp_category_id_modal").val(dp_category_id);
      $('#myModal').modal('show');
		 }
		});


 
  }
}




function specification_head_delete(id,dp_category_id) {


swal({
title: "Are you sure?",
text: "You will not be able to recover this imaginary file!",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Yes, delete it!",
closeOnConfirm: false
},
function(){

$.ajax({
        data: {
            specification_headId: id
        },
        url: "../controllers/specification_head_del.php",
        type: "GET",
        cache: false,
        success: function(data) {
            if (data == 1) {


swal({
                       type: "success",
                        title: "Deleted!",
                        text: "Your imaginary file has been deleted!",
                        icon: "success",
                        button: "ok!"
                    },
                    function(ok) {
                        if (ok) {
                            // location.reload(); 
                            fetch_product_specification(dp_category_id)
                        }
                    });



            }else{
                swal("Deleted!", "Your imaginary file has been not  deleted.", "error"); 
            }

        }
    })
});


}



function fetch_product_specification(dp_category_id){
  $.ajax({
		type: 'POST',
		data:{
			dp_category_id:dp_category_id
		},
        url: "../controllers/ajax/ajax_specification_head.php",    
		 success: function(result){
  
			$(".card-body").empty();
			$(".card-body").append(result);
		 }
		});
}


$('#submit_specification_head_creation_form').click(function(){ 
    var dp_category_id_modal=  $("#dp_category_id_modal").val();
    var specification_head_name=  $("#specification_head_name").val();
    $.ajax({
		type: 'POST',
		data:{
			dp_category_id_modal:dp_category_id_modal,
            specification_head_name:specification_head_name
		},
        url: "../controllers/specification_head_add.php",    
		 success: function(result){
   $("#dp_category_id_modal").empty();
   $("#dp_category_modal").empty();
   $("#specification_head_name").empty();

   $('#myModal').modal('hide');
   fetch_product_specification(dp_category_id_modal);
   if(result==1){

    Swal.fire(
  'Well Done!',
  'Successfully Submitted Data!',
  'success'
)


   }else{

    Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!'
})


   }
		 }
		});

});









$(document).on('click', '#butUpdate', function(e) {
        var confirm_alert = confirm("Are you sure, You want to edit this Data ?");
        if (confirm_alert == true) {
            var data = $("#form-update").serialize();

            $('#myModal').modal('hide');


            $.ajax({
                data: data,
                type: "post",
                url: "../controllers/specification_head_update",
                success: function(data) {
                    if (data == 1) {

                        swal({
                               type: "success",
                                title: "Sale Details",
                                text: "Sale Data Updated Successfully!",
                                icon: "success",
                                button: "ok!"
                            },
                            function(ok) {
                                if (ok) {
                                    location.reload(); 
                                }
                            });

                    } else {
                        swal({
                            type: "error",
                            title: "Sale Details",
                            text: "Sale Data Not Updated Successfully!",
                            icon: "error",

                            button: "ok!",
                        });
                    };

                }
            });
        } else {

        }

    });







</script>






</html>