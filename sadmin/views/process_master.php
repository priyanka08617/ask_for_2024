<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Process Details</title>
    <?php 
 
include '../includes/header.php'; 
include '../includes/navbar.php'; 
include '../includes/functions.php';        
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
    thead tr td {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
    <h3> Process Master </h3>
    <small class='text-muted'>Process Master Creation and Manage Process Master data </small>
        <hr></hr>

        <ul class='nav nav-tabs nav-justified'>
            <li class='nav-item'><a class='nav-link active' data-toggle='tab' href='#home'>Process Master Creation</a></li>
            <li class='nav-item'>
            <a class='nav-link'  data-toggle='tab' href='#menu1'>Existing Process Master </a>
            </li>
            </ul>
<br>


<div class='tab-content'>
<div id='home' class='tab-pane in active'>
    <form action="../controllers/add_process_master.php" method="post">


    <input type="hidden" id="store_id" value="<?php echo $store_id;?>">
<div class="form-group row">
  <label for="transfer_reason" class="col-2 col-form-label">Process Name</label> 
  <div class="col-10">
    <input type="text" id="process_name" name="process_name" class="form-control" placeholder="Enter Process Name">
  </div>
</div>


<div class="form-group row">
  <label for="transfer_reason" class="col-2 col-form-label">Description</label> 
  <div class="col-10">
    <textarea rows="3" cols="50"  id="process_description" name="process_description" class="form-control" placeholder="Enter Process Description" ></textarea>
  </div>
</div>






<div class="form-group row">
  <label for="transfer_reason" class="col-2 col-form-label">Step Details</label> 
  <div class="col-10">
  <table class='table table-sm table-hover'>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Uom</th>
                <th>Step Description</th>
                <th>Actions</th>
            </tr>
           
                <tbody id='table_block'></tbody>
                <tr>
                    <td colspan='5'></td>
                    <td> <span class="btn btn-success btn-block" onclick="add_line();">Add More Line</span></td>
                </tr>
            
           
        </table>
  </div>
</div>





      

<div class="form-group row">
<div class="col-2"></div>
  <div class="col-10">
    <button type="submit"  class="btn btn-primary btn-block">Submit</button>
  </div>
</div>

</form>
</div>

        <div id='menu1' class='tab-pane fade'>

<table class='table table-sm table-hover' id='example'>
<thead>
        <th>#</th>
        <th>Process Master Name</th>
        <th>Description</th>
        <th>Process</th>
        <th>Date of entry</th>
</thead>

<tfoot>
        <th>#</th>
        <th>Process Master Name</th>
        <th>Description</th>
        <th>Process</th>
        <th>Date of entry</th>

</tfoot>
<tbody>
 <!-- // ************************************************************  -->
<?php
   $c=0; 
 
              $sql='SELECT * FROM process_master WHERE status="1" ORDER BY id DESC';
              $result=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_array($result)){
                $c++;
               
$id = $row['id']; 
$process_name     = $row['process_name'];
$process_description = $row['process_description'];   
$row_created_on = $row['row_created_on'];




 echo '<tr>';
 echo '<td>'. $c.'</td>';
 echo '<td>'. $process_name.'</td>';
 echo '<td>'. $process_description.'</td>';
 echo '<td> <button type="button" class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#demo'.$id.'" onclick="fetch_process_step_master('.$id.')">view</button><div id="demo'.$id.'" class="collapse abc"></div></td>';
 echo '<td>'.dateForm($row_created_on).'</td>';
//  echo '<td>'.$action_status_val.'</td>';
  

// echo '<td><a href="../controllers/stock_locations_del.php?id='.$id.'"><button type="button" class="btn btn-danger" >Remove</button></a></td>';
 echo '</tr>';
}
 ?>
 </tbody>
 </table>



        </div></div>
        <script >
            var c = 1;

        $(document).ready(function() {

         var store_id=   $("#store_id").val();
            $.ajax({
                data: {
                    c: c,
                    store_id:store_id

                },
                type: "GET",
                url: "../controllers/ajax/ajax_get_lines_of_form_dynamically_process_master_FGA.php",
                success: function(data) {

                    $("#table_block").append(data);
                    $("#item_id_"+c).select2();

                }
            });


        });


        function add_line() {
            c++;
            // alert(c);
            $.ajax({
                data: {
                    c: c
                },
                type: "GET",
                url: "../controllers/ajax/ajax_get_lines_of_form_dynamically_process_master_FGA.php",
                success: function(data) {

             

                    $("#table_block").append(data);
                    $("#item_id_"+c).select2();

                }
            });

        }

        function remove_line(id) {
            $("#row_" + id).remove();
        }


   
        function fetch_uom(item_id,c){
      // $("#transfer_type").val();
    //   alert(item_id);
      $("#uom_id_"+c).empty();
      $.ajax({
            type:"POST",
            data:{
              id:item_id
            },
            url:"../controllers/ajax/ajax_fetch_relation_of_uom.php",
              success:function(val){
                // alert(val);
            // $("#uom_id").empty();
            $("#uom_id_"+c).append('<option value=" ">select</option>'+val);
              }
          });

    }


    function  fetch_process_step_master(process_id){
        // alert(item_id);
        // $("#demo"+process_id).empty();
      $.ajax({
            type:"POST",
            data:{
                process_id:process_id
            },
            url:"../controllers/ajax/ajax_fetch_process_step_master.php",
              success:function(data){
                // alert(data);
            $("#demo"+process_id).empty();
            $("#demo"+process_id).append(data);
              }
          });
    }


    
    $('#example tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" class="" placeholder="Search" />');
    });
    // DataTable
    var table = $('#example').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [25, 50, -1],
            ['25 rows', '50 rows', 'Show all']
        ],
        //[ -1 ],
        //['Showing all' ]
        //],
        buttons: [
            'pageLength'
        ]
    });
    // Apply the search
    table.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });





        </script>


</body>
</body>

</html>