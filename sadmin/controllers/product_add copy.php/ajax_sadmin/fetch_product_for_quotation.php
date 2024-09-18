<?php
include 'connection.php';
include '../../includes/functions.php';


// $count_total=1;
$count_total=sanitize_input($conn,$_POST["count"]);
$data="";
$data.='
<center>
    <table class="table table-bordered table-sm">
        <thead>
        <tr><th><h5 id="p_format_'.$count_total.'"><b>OPTION '.$count_total.'</b></h5></th><th><img src="../img/delete.png" width="30px" style="float:right"></th></tr>
        <tr>
            <th>
                <h5>Choose Product</h5>
            </th>
            <th><select class="form-control" id="item_id_'.$count_total.'" name="item_id[]"
                    onchange="get_item_detail(this.value,'.$count_total.')" required >
                    <option value=" ">Select</option>';
           


$sql="SELECT p.id as product_id, concat(p.id,'2') as concated_id FROM ap p WHERE p.status='1'   UNION SELECT i.id as item_id, concat(i.id,'1') as concated_id  FROM dp i WHERE i.status='1'";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){

$item_id_concated=$row["concated_id"];
$item_id=substr( $item_id_concated,0,-1);
$item_type=substr( $item_id_concated,-1);

if($item_type=='1'){
$name="(D.P)";
$product_name= singleRowFromTable($conn, "SELECT * FROM dp WHERE id='$item_id'", "item");
}elseif($item_type=='2'){
$name="(A.P)";
$product_name= singleRowFromTable($conn, "SELECT * FROM ap WHERE id='$item_id'", "name");
}

$data.= "<option  value='".$item_id_concated."'>".$product_name." ".$name."</option>";


}

$data.='</select></th></tr></thead><tbody id="p_format_body_'.$count_total.'"></tbody></table></center>';
$data_array=array("data"=>$data);
echo json_encode($data_array);
// print_r($data_array["data"]);

  ?>