<?php ob_start();
?>
<!DOCTYPE html>
<html  lang="en">
<head>
	<title>Terms & Condition</title>
	<?php
	  include '../includes/header.php';
	  include '../includes/navbar.php';
    include '../includes/check.php';
    include '../includes/functions.php';
	?>

</head>
<body>

<div class="container-fluid" style="">
<!-- Form Name -->
<h3> Terms & Condition <br>
  <small class="text-muted">Fill in the given below tab to create Condition and manage existing Condition</small>
</h3> 
<HR></HR>   
  
   <!-- my code start  -->
         
                <ul class="nav nav-tabs nav-justified">
                    <li  class='nav-item'><a class='nav-link' data-toggle="tab" href="#home">Terms & Condition Creation</a></li>
                    <li  class='nav-item'><a class='nav-link active' data-toggle="tab" href="#menu1">Existing Terms & Condition</a></li>
                </ul>
               <br><br>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade">
                    <form class="form-horizontal" action="../controllers/add_terms_and_condition.php" method="post">


                    <div class='form-group row'>
                    <div class='col-md-1'></div>
                    <div class='col-md-2'><label class='control-label' for='uom'>Terms For</label></div>
                    <div class='col-md-6'>

                    <select class='form-control' name='terms_for' id='terms_for'>
                    <option value=''>select</option>
                    <?php
        
                            $sql='SELECT * FROM terms_and_condition_category WHERE status="1"';
                            $result=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_array($result)){
                                $id=$row['id'];
                                echo '<option value="'.$id.'">'.$row['category'].'</option>';
                            }
                    ?>
                    </select>
                 </div></div>




                        <div class="form-group row">
                        <div class='col-md-1'></div>
                            <label class="col-md-2 control-label" for="uom">Terms & Condition</label>
                            <div class="col-md-6">
                              <textarea class="form-control" id="name" name="name[]" type="text" placeholder="Enter Terms & Condition" required></textarea>
                            </div>
                        </div>

<div id="item_box"></div>



                     

                        

<div class='form-group row'>
<div class='col-md-1'></div>
<div class='col-md-2'></div>
<div class='col-md-6'>
<button type="submit" class="btn btn-primary form-control" id="submit" name="submit">Add Terms & Condition</button> 

</div>

<div class='col-md-2'>
	<button type='button' class='btn btn-primary btn-block' id="add">+ Add</button>
</div>
</div>





                        </form>
                    </div>
                    <div id="menu1" class="tab-pane in active">
                          <!-- table start  -->
                            
                                    <table class="table table-sm table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <!-- <th>Edit</th> -->
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                
                                                <?php
                                                $c=0;
                                                    $sql="SELECT * FROM terms_and_condition WHERE status='1' ORDER BY id DESC";
                                                    // echo $sql;
                                                    $result=mysqli_query($conn,$sql);
                                                    
                                                    while($row=mysqli_fetch_array($result)){
                                                        $c++;
                                                        echo "<tr>";
                                                        $id=$row['id'];
                                                        $name=$row['name'];
                                                        $terms_for_id=$row['terms_for'];
                                                        $terms_category=singleRowFromTable($conn, "SELECT * FROM `terms_and_condition_category` WHERE `id`='$terms_for_id'", "category");

                                                        echo "<td>".$c."</td>";
                                                        echo "<td>".$terms_category."</td>";
                                                        echo "<td>".$name."</td>";

                                $edit_modal_params_string="'$id','$name'";

                                $edit_modal_params="openModel(".$edit_modal_params_string.")";

                                echo '<td><img src="../img/edit.png" style="width:30px"  data-toggle="modal" data-target="#myModal" onclick="'.$edit_modal_params.'><a href="../controllers/delete_terms_and_condition.php?id='.$id.'" onclick="return confirm(\'Are you sure you want to delete\')"><img src="../img/delete.png" style="width:30px" name="submit"  ></a></td>';

                                                        echo "</tr>";
                                                    }
                                                    ?>
                                               
                                        </tbody>
                                    </table>
                           
                                   
                          <!-- table end  -->
                    </div>
                </div> 
      <!-- ---------------------------------------------------------------------------     -->

      
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Uom Category </h4>
                    </div>
                    <div class="modal-body">
                            <form class="form-horizontal" action="../controllers/update_terms_and_condition.php" method="post">


                            <input class="form-control" id="id" name="id" type="hidden"/>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="Department">Uom Category</label>
                                        <div class="col-md-7">
                                        <input class="form-control" id="name_edit" name="name_edit" type="text" placeholder="Edit Uom Category "/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-7">
                                        <button type="submit" class="btn btn-primary form-control" id="submit" name="submit">Update</button> 
                                        </div> 
                                    </div> 

                                </form>

                        <!-- end modal body  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
                </div>

   <!-- my code end  -->
</div>
</body>
<script>
  
                    function openModel(id,a){
                        $("#id").val(id);
                        $("#name_edit").val(a);


                    }


                    

var c=0;
	         $("#add").click(function(){
c++;
				

		
			
// alert("hi");
            var data='<div id="oneBox'+c+'"><div class="form-group row"><div class="col-md-1"></div><label class="col-md-2 control-label" for="uom"></label><div class="col-md-6"><textarea class="form-control" id="name'+c+'" name="name[]" type="text" placeholder="Enter Terms & Condition" required/></textarea></div><div><button type="button" class="btn btn-danger remove" id="'+c+'">-</button></div></div></div>';


			$("#item_box").append(data);

            $(document).on('click','.remove',function(){
								var button_id = $(this).attr("id");
								$("#oneBox"+button_id+"").remove();
								
							});	
		 });

			
</script>

</html>