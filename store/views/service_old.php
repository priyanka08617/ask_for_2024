
<?php
 ob_start();
include '../includes/check.php';


if(isset($_GET['delete_id']))
{
 $sql_query="DELETE FROM service WHERE id=".$_GET['delete_id'];
 mysqli_query($conn,$sql_query);
 header("Location: $_SERVER[PHP_SELF]");
}
if(isset($_GET['changestatus_id']))
{
 $sql_query="UPDATE service SET `status`='".$_GET['status']."' WHERE id=".$_GET['changestatus_id'];
 mysqli_query($conn,$sql_query);
 header("Location: $_SERVER[PHP_SELF]");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title> specification Head Details</title>
    <?php include '../includes/header.php';?>
    <?php include '../includes/navbar.php';?>
    <?php include '../includes/functions.php';?>


<script type="text/javascript">
function edt_id(id)
{
  window.location.href='edit_service.php?edit_id='+id;
}
function view_id(id)
{
  window.location.href='view_service.php?view_id='+id;
}
function delete_id(id)
{
 if(confirm('Sure to Delete ?'))
 {
  window.location.href='indexservice.php?delete_id='+id;
 }
}
function changestatus_id(id,status)
{
  window.location.href='indexservice.php?changestatus_id='+id+'&status='+status;
}
</script>
</head>
<body>
<!-- <center> -->

<div class="container-fluid">

        <h3 style="font-family: Sans-serif;"><b>Service Book</b></h3>
        <p style="font-family: Sans-serif;color: #808080;">Import and Showing all existing customer details</p>
        <hr>
        </hr>
    </div>

<div id="container">
 <div id="table-responsive">
 
    <table  class="table table-striped" > 
    <tr>
    <th colspan="5"><a href="add_service.php">add service.</a></th>
    </tr>
    <th>SL NO</th>
    <th>name</th>
    <th colspan="3">Actions</th>
    </tr>
    <?php
 $sql_query="SELECT * FROM service";
 $result_set=mysqli_query($conn,$sql_query);
 $i=1;
 while($row=mysqli_fetch_row($result_set))
 {
  ?>
        <tr>
        <td align="center" ><?php echo $i; ?></td>
        <td align="center" > <a href="javascript:view_id('<?php echo $row[0]; ?>')"> <?php echo $row[1]; ?> </a> </td>
        <?php if($row[count($row)-1]==1) { ?>
        <td align="center"><a href="javascript:changestatus_id('<?php echo $row[0]; ?>',0)">Deactivate</a></td>
        <?php } else { ?>
        <td align="center"><a href="javascript:changestatus_id('<?php echo $row[0]; ?>',1)">Activate</a></td>
        <?php } ?>
  <td align="center"><a href="javascript:edt_id('<?php echo $row[0]; ?>')">Edit</a></td>
        <td align="center"><a href="javascript:delete_id('<?php echo $row[0]; ?>')">Delete</a></td>
        </tr>
        <?php
       $i++;  
 }
 ?>
    </table>
    </div>
</div>

<!-- </center> -->
</body>
</html>





