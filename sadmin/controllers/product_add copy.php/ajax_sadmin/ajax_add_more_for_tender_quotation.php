
<?php 
 include 'connection.php';
 include '../../includes/functions.php';

 $co=date('Y-m-d H:i:s');
 $c=sanitize_input($conn,$_POST['c']);
//  $c=1;
//  $total_count=total_count_table($conn,"tender_quotation_detail_for_client");

$data='';
$data.='<tr id="row_'.$c.'">';
$data.="<td>".$c."</td>"; 


 

$data.='<td><select class="form-control item"  name="item_id" id="item_id'.$c.'"   onchange="getUom(this.value,'.$c.');" style="width:100%">';
$data.='<option value=""> --  Select Item data --</option></select></td>';



$data.='<td><input class="form-control" type="number" name="qty" id="qty_'.$c.'" placeholder="Enter Qty"   onkeyup="get_qty_rate('.$c.')" step="0.01"></td>';

$data.='<td><select class="form-control" name="uom_id" id="uom_id_'.$c.'" ><option value="">select</option></select></td>';


$data.="<td><input type='number' class='form-control' placeholder='Our Rate'
        name='tender_rate' id='tender_rate_".$c."'  min='0' step='0.01' onkeyup='get_qty_rate(".$c.")'></td>";



$data.="<td> <input type='number' class='form-control' placeholder='Total Rate'
name='total_rate' id='total_rate_".$c."' min='0' step='0.01' readonly></td>";

$data.='<td><input type="hidden" id="tot_count_data'.$c.'" value="0"><span href="" class="btn btn-danger btn-block remove" onclick="remove_line('.$c.');"
id="row_rem_'.$c.'">-</span></td>';
$data.='</tr>'; 




$data.='<script>  $(".item").select2({
        ajax: { 
         url: "../controllers/ajax/ajax_fetch_ap_dp.php",
         type: "post",
         dataType: "json",
         delay: 250,
         data: function (params) {
          return {
            searchTerm: params.term 
          };
         },
         processResults: function (response) {
           return {
              results: response
           };
         },
         cache: true
        }
       });</script>';

// ,'last_id'=>$last_id
$data_array = array('item_data' => $data,'c_id'=>$c);
echo json_encode($data_array);
?>