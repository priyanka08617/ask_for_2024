<?php
ob_start();
// <td>'.$c.'</td>
include 'connection.php';
include '../../includes/functions.php';
$c=$_POST["id"];
$data="";



$data.='';
$data.='<tr id="oneBox'.$c.'">';
$data.='<td>'.$c.'</td>';

$data.='<td><select id="item_id'.$c.'" name="item_id" class="form-control item_product" onchange="get_uom(this.value,'.$c.')">
<option value="">Select </option>';
												
// $query = mysqli_query($conn,"SELECT p.id as product_id, concat(p.id,2) as concated_id,p.name as product_name FROM product p WHERE p.status='1'  UNION SELECT i.id as item_id, concat(i.id,1) , i.item as item_name FROM item i WHERE i.status='1'"); 
// UNION SELECT p.id as product_id, concat(p.id,2) as concated_id,p.name as product_name FROM product p WHERE p.status='1'
$query = mysqli_query($conn,"SELECT i.id as item_id, concat(i.id,1) as concated_id, i.item as item_name FROM dp i WHERE i.status='1' "); 

while ($row = mysqli_fetch_array($query)) {

   $item_id=substr( $row['concated_id'],0,-1);
	$item_type=substr( $row['concated_id'],-1);

   if($item_type=="1"){
       $cate="(dp)";
   }elseif($item_type=="2"){
      $cate="(ap)";
   }

 $data.= '<option value="'.$row['concated_id'].'">' .$row["item_name"]." ".$cate.'</option>';

}
$data.='</select></td>';



$data.='<td><input id="qty'.$c.'" name="qty" type="number" placeholder=" Qty." class="form-control input-md" min="0" onkeyup="check_qty(this.value)"></td>

                                        <td><select id="unit_id'.$c.'" name="unit_id" class="form-control">
												<option value="">Select Unit</option>';
                                           
   
                                        $data.='</select>
                                        </td>
                                        <td>
                                            <input id="rate'.$c.'" name="rate" class="form-control" placeholder=" MRP" type="number" step="0.01" min="0"  onchange="totalPriceCal(this.value,2,'.$c.');" onkeyup="totalPriceCal(this.value,2,'.$c.');"  >
											
                                            </td>

                                            

                                            <td>
                                            <input id="disc'.$c.'" name="disc" class="form-control" placeholder="Disc" type="number" step="0.01" min="0"  onchange="totalPriceCal(this.value,2,'.$c.');" onkeyup="totalPriceCal(this.value,2,'.$c.');" >
											
                                            </td>

                                            <td>
                                           

                                            <select id="tax'.$c.'" name="tax" class="form-control" placeholder="Tax" type="number" step="0.01" min="0"  onchange="totalPriceCal(this.value,2,'.$c.');" onkeyup="totalPriceCal(this.value,2,'.$c.');"  ><option value="">select</option></select>
                                            </td>
                                            

                                        <td>
                                        <div class="input-group">
												<input id="total'.$c.'" name="total" class="form-control" placeholder="Total Price" type="number" step="0.01" min="0" required="" readonly>
											
											</div>
                                        </td>
                                        <td><button type="button" class="btn btn-danger remove" id="'.$c.'" >-</button></td></tr>';


echo $data;

// <span class="input-group-addon">.Rs</span>
?>