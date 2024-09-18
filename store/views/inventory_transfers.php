<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Inventory Transfers</title>
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

    /* thead{
    background: #2A4747;
  } */

    thead tr td {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class='container-fluid' style=''>
        <!-- Form Name -->
        <h3> Transfers </h3><small class='text-muted'>Manage the
        Inventory Transfers data </small>
        <hr></hr>
      

        <ul class='nav nav-tabs nav-justified'>
<li class='nav-item'>
            <a   class='nav-link active' data-toggle='tab' href='#home'>Transfers</a></li>
     <li class='nav-item'>
            <a class='nav-link'  data-toggle='tab' href='#menu1'>Manual Stock Transfer </a></li>
            </ul>










            <div class='tab-content'>
<div id='home' class='tab-pane in active'>

<br><br>
        <table class='table table-sm table-hover' id='example'>
            <thead>
                <th>#</th>
                <th>Transfer Date </th>
                <th>Transfered By </th>
                <th>Transfer Reason </th>
                <th>Item Details</th>
                <th>Action</th>
             
            </thead>

            <tfoot>
                <th>#</th>
                <th>Transfer Date </th>
                <th>Transfered By </th>
                <th>Transfer Reason </th>
                <th>Item Details</th>
                <th>Action</th>
            </tfoot>
            <tbody>
                <!--- // ************************************************************ -->
                <?php
                $c=1; 
                // WHERE location_id='$store_id'
 
                $sql="SELECT * FROM `inventory_transfer`  ORDER BY id DESC";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($result)){
                $id=$row['id'];
                $status=$row['status'];
                $transfer_initiated_by_id=$row['transfer_initiated_by'];
                // $edit_modal_params_string="'$id','$rail_zone','$status'";
                // $edit_modal_params='openModel('.$edit_modal_params_string.')';
               $transfer_by=singleRowFromTable($conn, "SELECT * FROM users WHERE id='$transfer_initiated_by_id'", "first_name");
                $reason_arr=find_stock_transfer_reason($conn, $row['transfer_reason'], $row['transfer_reason_supporting_id']);
                $str="";
                
          $str="<b>".$reason_arr['reason']."</b> <br><small>(".$reason_arr['support'].")</small>";



$status_btn="";

if($row['status']==1){
    $status_btn=' <div class="dropdown">
    <button class="btn btn-secondary btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Pending
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="#" onclick="transfer_change('.$row['id'].',2,'.$store_id.')">Accept</a>
      <a class="dropdown-item" href="#" onclick="transfer_change('.$row['id'].',3,'.$store_id.')"  >Decline</a>
    </div>
  </div>';

  // data-toggle="modal" data-target="#myModal2"
}
else{
    if($row['status']==2){
      $status_btn=' <a class="mb-2 btn btn-danger btn-block" href="../controllers/revert_inventory_transfer.php?it_id='.$row['id'].'" onclick="return confirm(\'Are you sure ?\')">Revert Movement</a>'.'<b style="color:green">Transfer Applied</b> - '.$row['status_remarks'];
    }
    elseif($row['status']==3){
        $status_btn='<b style="color:red">Transfer Declined</b> - '.$row['status_remarks'];
    }
    
}

                    
      
                
        echo '<tr>';
        echo '<td>'.$c.'</td>';
        echo '<td>'. date("d F, Y h:i A",strtotime($row['date_of_change'])).'</td>';
        echo '<td>'. $transfer_by.'</td>';
        echo '<td>'.$str.'</td>';
        echo '<td><a class="btn btn-success btn-block" href="inventory_transfer_details.php?inventory_transfer_id='.$id.'">View</a></td>';
        // echo '<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick=""> Item Details </button></td>';
        echo '<td style="text-align:center;">'.$status_btn.'</td>';
        echo '</tr>';
        $c++;
}
 ?>
            </tbody>
        </table>

        
        </div>
        <div id='menu1' class='tab-pane fade'>


<div class="container-fluid">

<br><br>
<form action="../controllers/manual_stock_transfer_cont.php" method="post">

  <div class="form-group row">
    <label for="transfer_reason" class="col-4 col-form-label">Transfer Reason</label> 
    <div class="col-8">
      <select id="transfer_reason" name="transfer_reason" class="custom-select">
       <option value="" >select</option>
        <option value="10">Opening Stock Entry</option>
        <option value="1">Sale</option>
        <!-- <option value="12">Opening Stock Discard</option> -->
      </select>
    </div>
  </div>


  



  <div class="form-group row">
    <label for="item" class="col-4 col-form-label">Item</label> 
    <div class="col-8">
      <select id="item" name="item" type="text" class="form-control" style="width:100%" onchange="fetch_uom(this.value)">
        <option value="" >select</option>
       

<?php
  $sql="SELECT p.id as item_id, concat(p.id,'2') as concated_id,p.name as product_name FROM ap p WHERE p.status='1' UNION SELECT i.id as item_id, concat(i.id,'1') , i.item as item_name FROM dp i WHERE i.status='1'";

  


  // i.item as mtm, i.sku as item_name
  // $sql="SELECT p.product_id as product_id, concat(p.product_id,'2') as concated_id FROM price_management p WHERE p.status='1' AND location_id='$store_id'  UNION SELECT i.id as item_id, concat(i.id,'1')  FROM item i WHERE i.status='1' AND location_id='$store_id'";


 
$query=mysqli_query($conn,$sql);
echo mysqli_error($conn);
  while($row=mysqli_fetch_array($query)){

    $item_concated_id=$row["concated_id"];
    // $len = strlen($item_id); 
    // $item_id_split=str_split($item_id,$len-1);

    $item_id=substr( $item_concated_id,0,-1);
    $item_type=substr( $item_concated_id,-1);



     if($item_type=='1'){
        $name="(D.P)";
       $product_name= singleRowFromTable($conn, "SELECT * FROM dp WHERE id='$item_id'", "item");
      
      }elseif($item_type=='2'){
        $name="(A.P)";
        $product_name= singleRowFromTable($conn, "SELECT * FROM ap WHERE id='$item_id'", "name");
      
      }
    //  $total_qty=  find_stock_quantity_from_location_id($conn, $item_id,$item_type,$store_id);

    //  if($total_qty["total"]>0){
      // echo "<option  value='".$row["concated_id"]."'>".$product_name." ".$name."(".$total_qty["total"]." ".$total_qty["uom_name"].")</option>";

      echo "<option  value='".$row["concated_id"]."'>".$product_name." ".$name."</option>";

    //  }
    //  else{
    //   echo "<option  value='".$row["concated_id"]."'>".$product_name." ".$name."</option>";
    //  }
 
  }
  ?>




      </select>
    </div>
  </div>



  <div class="form-group row">
    <label for="transfer_type" class="col-4 col-form-label">Transfer Type</label> 
    <div class="col-8">
      <select id="transfer_type" name="transfer_type" class="custom-select" >
      <option value="" >select</option>
        <option value="1">Inward</option>
        <option value="2">Outward</option>
      </select>
    </div>
  </div>
  <!-- check_stock_tansfer_allowance -->



  <div class="form-group row">
    <label for="quantity" class="col-4 col-form-label">Quantity</label> 
    <div class="col-4">
      <input id="quantity" name="quantity" type="number" min="0.01" step="0.01" class="form-control" placeholder="Enter Qty">
    </div>
    <div class="col-4">
      <select id="uom_id" name="uom_id" type="number" class="form-control"></select> 
    </div>
  </div> 

  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
  </div>

</form>


</div>


















        <!-- second tab -->
    </div>

</div>
    <!--// container-fluid -->




    <!-- The Modal -->
    <div class='modal' id='myModal' >

        <div class='modal-dialog modal-xl' style='width:1850px'>

            <div class='modal-content'>

                <!-- Modal Header -->

                <div class='modal-header'>

                    <h4 class='modal-title'>Transfer Change Status Acceptance</h4>

                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                </div>
                <!-- Modal body -->
                <div class='modal-body'>

                <form action="../controllers/transfer_status_change.php" method="POST">
                        <input type="hidden" name="inventory_transfer_id_e" id="inventory_transfer_id_e"/>

                <table class='table'>
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Item Type</th>
                        <th>Quantity</th>
                        <th>Uom</th>
                        <th>Movement</th>
                        <th>Total Stock</th>
                      
                          
                          <th>Location</th>
                          <th>Action</th>
                    </tr>
                    </thead>
                   <tbody id="box"></tbody></table><hr>
                   <span id="temp"></span>
                    
   <div class="form-group row">
    <!-- <label for="textarea" class="col-1 col-form-label">Remarks</label>  -->
    <div class="col-12">
      <textarea id="textarea" name="inventory_transfer_remarks_e" cols="40" rows="3" class="form-control" placeholder="Enter remarks"></textarea>
    </div>
  </div>



                        <div class="form-group row">
                            <div class="offset-0 col-12">
                                <button name="submit" type="submit" class="btn btn-primary btn-block">Submit</button>
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
    </div>






<!-- model2 -->



    <!-- The Modal -->
    <div class='modal' id='myModal2' >

        <div class='modal-dialog modal-xl' style='width:1850px'>

            <div class='modal-content'>

                <!-- Modal Header -->

                <div class='modal-header'>

                    <h4 class='modal-title'>Transfer Change Status Declined - <span class="text-danger">Mention Decline Reason</span></h4>

                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                </div>
                <!-- Modal body -->
                <div class='modal-body'>

                <form action="../controllers/transfer_status_change.php" method="POST">
                        <input type="hidden" name="inventory_transfer_id_e" id="inventory_transfer_id_model2" value="3"/>
                        <input type="hidden" name="inventory_transfer_change_e" id="inventory_transfer_change_model2" value="3"/>
                    
                            <div class="form-group row">
                              <!-- <label for="textarea" class="col-1 col-form-label">Remarks</label>  -->
                              <div class="col-12">
                                <textarea id="textarea" name="inventory_transfer_remarks_e" cols="40" rows="3" class="form-control" placeholder="Enter remarks"></textarea>
                              </div>
                            </div>



                        <div class="form-group row">
                            <div class="offset-0 col-12">
                                <button name="submit" type="submit" class="btn btn-primary btn-block">Submit</button>
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
    </div>











    </div>


    <script>







function fetch_stock_locations_category_on_document_load()
  {

    $("#stock_locations_category").html("");
      $.ajax({
          url:"../controllers/ajax/ajax_get_stock_locations_category_FGA.php",
          success:function(data){
            // alert(data);
        $("#stock_locations_category").append(data);
          }
      });
  }




  $( document ).ready(function() {
   $("#item").select2();
 fetch_stock_locations_category_on_document_load();

  });



    function fetch_location_from_loc_cat()
      {
    
        $("#stock_locations").html("");
       var tr_id = $("#temp").html();
        var stock_locations_category_id=$("#stock_locations_category").val();
          $.ajax({
            type:"get",
            data:{
                stock_locations_category_id:stock_locations_category_id,
                tr_id:tr_id
            },
            url:"../controllers/ajax/ajax_select_stock_locations_from_stock_locations_category_id_FGA.php",
              success:function(rvalue){
            $("#stock_locations").append(rvalue);
          
              }
          });
      }
      </script>


    <script>


function transfer_change(tr_id,change,store_id){
// alert(tr_id+" "+change);

if(change==2){
$('#myModal').modal('show');

$.ajax({
            type:"POST",
            data:{
                transfer_id:tr_id,
                store_id:store_id
            },
            url:"../controllers/ajax/ajax_get_transfer_inventory_view.php",
              success:function(rvalue){
            $("#box").empty();
            $("#box").append(rvalue);
            // $('#temp').html(tr_id);
              }
          });


    $('#inventory_transfer_id_e').val(tr_id);
    $('#inventory_transfer_change_e').val(change);

    // $('#inventory_transfer_id_e').empty();
    // $('#inventory_transfer_change_e').empty();
        }

    if(change==3){
        // $('#myModal').hide();
        $('#myModal2').modal('show');
        $('#inventory_transfer_id_model2').val(tr_id);
        $('#inventory_transfer_change_model2').val(change);
    }

}




    function openModel(id, rail_zone, status) {
        $('#id_E').val(id);
        $('#rail_zone_E').val(rail_zone);
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
            'pageLength', 'copy', 'excel', 'pdf', 'print'
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



    function fetch_uom(item_id){
      $("#uom_id").empty();
      $.ajax({
            type:"POST",
            data:{
              id:item_id
            },
            url:"../controllers/ajax/ajax_fetch_relation_of_uom.php",
              success:function(val){
                // alert(val);
            // $("#uom_id").empty();
            $("#uom_id").append('<option value="">select</option>'+val);

              }
          });

    }
    </script>