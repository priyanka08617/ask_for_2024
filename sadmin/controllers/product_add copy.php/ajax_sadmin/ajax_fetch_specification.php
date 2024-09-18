<?php 
 include 'connection.php';
 include '../../includes/functions.php';



 function fetchAllColumnName($conn,$head_id){
    $d="";
    $sql="SELECT * FROM specification_subhead WHERE specification_head_id='$head_id' AND  status='1'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){
     $head_id=$row["id"];
     $head_name=$row["subhead_name"]; 
     $d.="<div class='col-md-4'><select class='form-control' name='subhead_id[]' id='specification_data".$head_id."'>";
     $d.="<option value=''>".$head_name."</option>";
     $sql1="SELECT * FROM specification_subhead_data WHERE specification_subhead_id='$head_id' AND  status='1'";
     $query1=mysqli_query($conn,$sql1);
     while($row1=mysqli_fetch_array($query1)){
        $d.="<option value='".$row1["id"]."'>".$row1["subhead_data"]."</option>";
     }
$d.="</select></div>";
    }

    return $d;
 }


$data="";
$cat_id=$_POST['cat_id'];
// $cat_id=1;

$data.='<table class="table table-sm table-bordered">
          <thead>
              <tr>
                  <th style="width:20%">Head</th>
                  <th >Data</th>
              </tr>
          </thead>';

  $sql="SELECT * FROM specification_head WHERE status='1' AND category_id='$cat_id' ";
       $query=mysqli_query($conn,$sql);
       $num_rows=mysqli_num_rows($query);
       if($num_rows>0){
       while($row=mysqli_fetch_array($query)){
        $head_id=$row["id"];
        $tabName=$row["head_name"]; 
        $fetchClm=fetchAllColumnName($conn,$head_id);

     

     
$data.='<tbody><tr><th>'.$tabName.'</th><td><div class="row">';
$data.=$fetchClm;
$data.= "</div><script>$('#specification_data".$head_id."').select2();</script>";
$data.='</td></tr>';

}
        
$data.='</tbody></table>';
echo $data;
       }


 
?>