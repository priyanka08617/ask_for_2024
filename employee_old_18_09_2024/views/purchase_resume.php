<?php
  ob_start();
  include '../includes/check.php';
  include '../includes/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Car || Admin</title>
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
    <h2 style="font-weight: bolder;">Purchase Entry Details</h2>
    <h5 style="font-weight: 500;">Please use the tabs below to create a new Purchase Entry Details or manage the ones already present in database.</h5>

	</div>
</div>
<hr>
<div class="table-responsive">
				    <table id="example1" class="table table-responsive" cellspacing="0" width="100%">
				        <thead>
				          <tr>
                            <th>#</th>
                            <th>PO NO</th>
                            <th>Distributor</th>
                            <th>Entry On</th>
                            <th>Status</th>
				          </tr>
				        </thead>
				        <tfoot>
				          <tr>
                          <tr>
                            <th>#</th>
                            <th>PO NO</th>
                            <th>Distributor</th>
                            <th>Entry On</th>
                            <th>Status</th>
				          </tr>
				          </tr>
				        </tfoot>
				        <tbody>
				          <?php 
				            $c=0;
                            $sql="SELECT * FROM purchase WHERE status='1' ORDER BY id DESC";
				            $query = mysqli_query($conn,$sql);
				            while ($row=mysqli_fetch_array($query)) {
                            $c++;
                            $id =$row['id'];
                            $distributor_id  =$row['distributor_id'];
                            $distributor= fetch_data($conn,"distributor","id",$distributor_id);
                            $date_of_entry  =dateForm($row['entry_date_time']);

                            $position_status=$row["position_status"];
				                echo "<tr>";
				              	echo "<td>".$c."</td>";
                                echo "<td>".$row["po_no"]."</td>";
                                echo "<td>".$distributor['name']."</td>";
				                echo "<td>".$date_of_entry."</td>";

                        if($position_status==0){
                          echo "<td><a href='purchase_resume_details.php?po_id=".$id."
                          '><button type='button' class='btn btn-warning'>resume</button></a></td>";
                  
                        }elseif($position_status==1){
                          echo "<td><a href='purchase_entry_details.php?po_id=".$id."
                              '><button type='button' class='btn btn-success'>Purchased Items</button></a></td>";
				              
                        }else{
                          echo "<td></td>";
                        }
                        
                              echo "</tr>";
				            }       
				          ?>
				        </tbody>
				    </table>
		    	</div>

</body>
</html>
<script type="text/javascript">
  $(document).ready(function() 
  {
    // Setup - add a text input to each footer cell
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
});


</script>