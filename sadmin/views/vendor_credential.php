<?php ob_start();
include '../includes/check.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <title> Item Details</title>
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

<div class="container-fluid" style="">
<!-- Form Name -->
<h3>Supplier  Credential</h3> 
<small class="text-muted">Fill in the given below tab to create Supplier  credential and manage existing Supplier  credential</small>

<hr></hr>   

<!-- my code start  -->

<ul class="nav nav-tabs nav-justified">
<li class='nav-item'><a class='nav-link' data-toggle='tab' href='#home'>Add Supplier Credential </a></li>
<li class='nav-item'><a class='nav-link active' data-toggle='tab' href='#menu1'>Existing Supplier' Credentials</a></li>
</ul>

            <br>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane  container fade in" id="home">
                    <form method="post" action="../controllers/add_vendor_credential.php">


                        <div class="form-group row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"><label for="name">Supplier</label></div>
                            <div class="col-sm-6">
                                <select id="vendor_id" name="vendor_id" class="form-control"  style="width:100%" required>
                                    <option value="">---Select---</option>
                                    <?php
$sql="SELECT * FROM vendor WHERE status='1'";                                  
$result=mysqli_query($conn,$sql);                               
while($row=mysqli_fetch_array($result)){
$id=$row["id"];
$name=$row["name"];
// $sortname=$row["sortname"];
echo "<option value='".$id."'>".$name."</option>";

}
?>

                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"><label for="name">Credential set</label></div>
                            <div class="col-sm-6">
                                <select id="credentials_set_id" name="credentials_set_id"
                                    onchange="getCredencial(this.value)" class="form-control" style="width:100%" required>
                                    <option value="">---Select---</option>
                                    <?php
$sql="SELECT * FROM credentials_set WHERE status='1'";                                  
$result=mysqli_query($conn,$sql);                               
while($row=mysqli_fetch_array($result)){
$id=$row["id"];
$name=$row["name"];
// $sortname=$row["sortname"];

echo "<option value='".$id."'>".$name."</option>";

}
?>
                                </select>
                            </div>
                        </div>



                        
<div id="box">
<br>
<hr>
<br>
<div class="form-group row">
<label class="col-md-2 control-label" for="Indentor">Credential set Item</label>
<label class="col-md-2 control-label" for="Indentor"></label>
<label class="col-md-2 control-label" for="Indentor">Image File</label>
<label class="col-md-2 control-label" for="Indentor"></label>
<label class="col-md-2 control-label" for="Indentor">Text</label>
<label class="col-md-2 control-label" for="Indentor"></label>
</div>
<div id="box_data">

</div>
</div>








                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-block btn-primary" id="submit" name="submit">Add
                                    Supplier credential</button>
                            </div>

                        </div>


                        </form>
                </div>

            <div class="tab-pane active in" id="menu1">
               
<table class="table table-sm" id="example">
<thead>
<th>#</th>
<th>Supplier Name</th>
<th>Credentials Set</th>
<th>Credentials Item</th>
<th>Details</th>
<th>Image</th>
<th>Action</th>
</thead>
<tfoot>
<th>#</th>
<th>Supplier Name</th>
<th>Credentials Set</th>
<th>Credentials Item</th>
<th>Details</th>
<th>Image</th>
<th>Action</th>
</tfoot>
<tbody>

<?php
$c=0;
$sql="SELECT * FROM vendor_credentials WHERE status='1' ORDER BY id DESC";
// echo $sql;
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($result)){

// $vendor_id_temp=$row['vendor_id'];

$c++;

$id=$row['id'];
$credentials_set_id  = $row['credentials_set_id'];

$credentials_set  = singleRowFromTable($conn, "SELECT * FROM credentials_set WHERE id='$credentials_set_id'", "name");

$credentials_item_id = $row['credentials_item_id'];

$credentials_item  = singleRowFromTable($conn, "SELECT * FROM credentials_item WHERE id='$credentials_item_id'", "name");

$file_type = $row['file_type'];

if($row['text']==""){
    $text="N.A.";
}else{
    $text=$row['text'];
}

$path=$row['path'];
$vendor_id_db=$row['vendor_id'];
$vendor  = singleRowFromTable($conn, "SELECT * FROM vendor WHERE id='$vendor_id_db'", "name");

echo "<tr>";
echo "<td>".$c."</td>";
echo "<td>".$vendor."</td>";
echo "<td>".$credentials_set."</td>";
echo "<td>".$credentials_item."</td>";

echo "<td>".$text."</td>";
echo '<td><img src="'.$path.'" alt="N.A" width="100px" height="100px"></td>';

echo   "<td>"."<a href='../controllers/delete_vendor_credential.php?id=".$id."' onclick='return confirm(\"Are you sure you want to Delete\")'><button id='submit' name='submit'  class='btn btn-danger'>-</button></a>"."</td>";

echo "</tr>";
}
?>

</tbody>
</table>

           
<!-- table end  -->                        
</div>
</div> 
<!-- ---------------------------------------------------------------------------     -->

</div>
</body>
<script>

$( document ).ready(function() {
$("#box").hide();
$("#vendor_id").select2();
$("#credentials_set_id").select2();
});
function getCredencial(val){
//   alert(val);

$.ajax({
type: 'POST',
data:{
id:val
},
//   dataType:'json',
url: "../controllers/ajax/ajax_fetch_all_credentials_set_id.php",
success: function(result){
    $("#box").show();
$("#box_data").empty();
$("#box_data").append(result);
}
});
}




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

</script>

</html>