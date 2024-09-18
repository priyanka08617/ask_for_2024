<?php
  ob_start();
  include '../includes/check.php';
  include '../includes/functions.php';
  $pi_id=$_GET["pi_id"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Purchase Entry Detail|| sAdmin</title>
<?php
  include '../includes/header.php';
?>
<style>
  tfoot 
  {
    display: table-header-group;
  }
  tfoot input
  {
    width:100%;
  }
</style>
</head>
<body>
<?php
  include '../includes/navbar.php';
?>
<div class="container-fluid">
	<div class="pageHeader">
    <h2 style="font-weight: bolder;" align="center">Purchase Entry Details</h2>
    <center><small style="font-weight: 500;" >Please use the tabs below to create a new Purchase Entry Details or manage the ones already present in database.</small></center>
  
	</div>
  <br>

      <?php 
				            $c=0;
				            $sql="SELECT * FROM purchase WHERE id='$pi_id' AND status='1'";
				            $query = mysqli_query($conn,$sql);
				            $row=mysqli_fetch_array($query);
                    $id =$row['id'];
                    $distributor_id  =$row['distributor_id'];
                    $payment_status_id  =$row['payment_status'];
                    if($payment_status_id==1){
                      $payment_status  ="Paid";

                    }elseif($payment_status_id==0){
                      $payment_status  ="Un-Paid";
                    }
                    
                    ?>
                    <div class="card"> <div class="card-header">
                    <div class="row form-group">
                      <div class="col-md-3">
                        <div class="row">
                          <div class="col-md-6"><h5><b>Purchase Bill : </b></h5></div>
                          <div class="col-md-6"><?php echo $row["invoice_no"];?></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6"><h5><b>Bill Date  : </b></h5></div>
                          <div class="col-md-6"><?php echo $row["invoice_date"];?></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6"><h5><b>Distributor  : </b></h5></div>
                          <div class="col-md-6"><?php 
                          $distributor= fetch_data($conn,"vendor","id",$distributor_id);
                          echo $distributor['name'];?></div>
                        </div>

                      </div>
                      <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6"><h5><b>Received Store  : </b></h5></div>
                          <div class="col-md-6"><?php   echo "Ask For";?></div>
                        </div>

                      </div>

                    </div>




                    <div class="row form-group">
                      <div class="col-md-3">
                        <div class="row">
                          <div class="col-md-7"><h5><b>Payment Status : </b></h5></div>
                          <div class="col-md-5"><?php echo $payment_status;?></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6"><h5><b>Grand Total  : </b></h5></div>
                          <div class="col-md-6"><?php echo $row["grand_total"];?></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6"><h5><b>Remark  : </b></h5></div>
                          <div class="col-md-6"><?php   echo $row['remark'];?></div>
                        </div>

                      </div>

                      <div class="col-md-3">
                      <div class="row">
                          <div class="col-md-6"><h4><b>Recieved By  : </b></h4></div>
                          <div class="col-md-6"><?php  echo "Amit ";?></div>
                        </div>

                      </div>


                    </div>

                     </div></div>  <!--// CARD END -->





<hr>
        <table id="example2" class="table table-striped table-sm" cellspacing="0" width="100%">
				        <thead>
				          
				                   <th>#</th>
                            <th>Item Category</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Price</th>
                            <th>Entry Date</th>
				        </thead>
				        <tfoot>
				          
				            <th>#</th>
                    <th>Item Category</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Price</th>
                            <th>Entry Date</th>
				        </tfoot>
				        <tbody>
				          <?php 
				            $c=0;
				            $sql="SELECT * FROM `purchase_details` WHERE `po_id`='$pi_id' AND `status`='1' ORDER BY id DESC";
				            $query = mysqli_query($conn,$sql);
                    // echo $sql;
				            while ($row=mysqli_fetch_array($query)) {
                      $c++;
                               
         
                                $item_id_concated  =$row['item_id'];  
                                $item_id=substr( $item_id_concated,0,-1);
                                $item_type=substr( $item_id_concated,-1);
                                $product=check_item_or_product_data($conn,$item_id,$item_type);

                                $qty  =$row['qty'];
                                $unit_id  =$row['unit_id'];
                                $rate  =$row['rate'];
                                $price  =$row['price'];
                                $date_of_entry  =dateForm($row['date_of_entry']);
                                $unit= fetch_data($conn,"uom","id",$unit_id);

                          
                                echo "<tr>";
                                echo "<td>".$c."</td>";
				                        echo "<td>".$product["category"]."</td>";
                                echo "<td>".$product["name"]."</td>";
                                echo "<td>".$qty." ".$unit["uom_name"]."</td>";
                                echo "<td>".$rate."</td>";
                                echo "<td>".$price."</td>";
                                echo "<td>".$date_of_entry."</td>";
				                        echo "</tr>";
				            }       
				          ?>
				        </tbody>
				    </table>
		

	 


<script type="text/javascript">

        $('.edit').on('click',function()
    {
        $("#myModal").modal("show");
        $("#sId").val($(this).closest('tr').children()[1].textContent);
        $("#carName").val($(this).closest('tr').children()[2].textContent);

    });   
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example1 tfoot th').each( function () 
    {
      var title = $(this).text();
      $(this).html( '<input type="text" class="" placeholder="Search" />' );
    } );
    // DataTable
    var table = $('#example1').DataTable
    (
    {
      dom: 'Bfrtip',
      lengthMenu: [
      [ 25, 50, -1 ],
      ['25 rows', '50 rows', 'Show all' ]
      ],
      //[ -1 ],
      //['Showing all' ]
      //],
      buttons: 
      [
        'pageLength', 'copy','excel', 'pdf', 'print'
      ]
    }
    );
    // Apply the search
    table.columns().every( function () 
    {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () 
      {
        if ( that.search() !== this.value ) 
        {
          that
          .search( this.value )
          .draw();
        }
      } );
    } );

    
    $(".i" ).addClass( "active" ); 
    $("#select_all").change(function(){
	  $(".checkbox_class").prop("checked", $(this).prop("checked"));
	});




     // Setup - add a text input to each footer cell
     $('#example2 tfoot th').each( function (){
      var title = $(this).text();
      $(this).html( '<input type="text" class="" placeholder="Search" />' );
    } );
    var table = $('#example2').DataTable
    (
    {
      dom: 'Bfrtip',
      lengthMenu: [
      [ 25, 50, -1 ],
      ['25 rows', '50 rows', 'Show all' ]
      ],
      //[ -1 ],
      //['Showing all' ]
      //],
      buttons: 
      [
        'pageLength'
      ]
    }
    );
    // Apply the search
    table.columns().every( function () 
    {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () 
      {
        if ( that.search() !== this.value ) 
        {
          that
          .search( this.value )
          .draw();
        }
      } );
    } );

    
    // $(".i" ).addClass( "active" ); 
    // $("#select_all").change(function()
    // {
	//   $(".checkbox_class").prop("checked", $(this).prop("checked"));
	// });


  } );


  
</script>
</body>
</html>