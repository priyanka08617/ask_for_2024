<?php
function singleRowFromTable($conn, $sql, $col_required){

	if($row=mysqli_fetch_array(mysqli_query($conn,$sql))){
    return $row[$col_required];
  }
  else{
   return "N.A.";
  }



}





function sanitize_input($conn,$data){
	
  $data = mysqli_real_escape_string($conn,$data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strip_tags($data);
  return $data;
  }



function fetch_data($conn,$table_name,$id,$condition_id)
{
  $sql = "SELECT * FROM $table_name WHERE $id='$condition_id'";
  $query = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($query);
  return $row;
}


function dateForm($dateStr){
	return date('d M, y h:i a', strtotime($dateStr));
  }
  
  function dateForm1($dateStr){
	return date('d M, y', strtotime($dateStr));
  }
  
  function TimeForm($dateStr){
    return date('h:i a', strtotime($dateStr));
    }


function find_stock_transfer_reason($conn, $transfer_reason_id, $transfer_reason_supporting_id)
{
  $reason="";
  $supporting_document="";

  if($transfer_reason_id==1){
    $reason="Sale";
    // query to find sale reason
    $supporting_document="Stock reduced via Sale";
  }
  elseif ($transfer_reason_id==2){
    $reason="Sale Return";
    // query to find sale return reason
    $supporting_document="Sale Return via Issued credit Note No. - YYY";
  }
  elseif ($transfer_reason_id==3){
    $reason="Purchase";
    // query to find purchase reason
    $purchase=fetch_data($conn,"purchase_details","id",$transfer_reason_supporting_id);

    $supporting_document="Purchase via Purchase Order No. - ".$purchase["po_no"];
  }
  elseif ($transfer_reason_id==4){
    $reason="Purchase Return";
    // query to find purchase return reason
    $supporting_document="Purchase Return via Issued debit Note No. -AAA ";
  }
  elseif ($transfer_reason_id==5){
    $reason="Items Scrapped";
    // query to find scrapped reason
    $supporting_document="N.A.";
  }
  elseif ($transfer_reason_id==6){
    $reason="Items Damaged";
    // query to find scrapped reason
    $supporting_document="N.A.";
  }
  elseif ($transfer_reason_id==7){
    $reason="Lost-in-transit";
    // query to find scrapped reason
    $supporting_document="N.A.";
  }
  elseif ($transfer_reason_id==8){
    $reason="Fraud";
    // query to find scrapped reason
    $supporting_document="N.A.";
  }
  elseif ($transfer_reason_id==9){
    $reason="Assembly";
    // query to find assembly details and its details
    $supporting_document="Assembly";
  }



  elseif ($transfer_reason_id==10){
    $reason="Opening Stock";
    // query to find assembly details and its details
    $supporting_document="Opening Stock Entry";
  }

  elseif ($transfer_reason_id==11){
    $reason="Stock Shifting";
    // query to find assembly details and its details
    $supporting_document="Stock Shifting";
  }


  return array('reason'=>$reason, 'support'=>$supporting_document);
}



function find_stock_quantity($conn, $item_id,$item_type)
{

$in=0;
$out=0;

$sql="SELECT * FROM stock_transfer_location WHERE item_id='$item_id' AND item_type='$item_type'";
$result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){
  
 
  $inventory_transfer_id=$row['inventory_transfer_id'];
  if($item_type==1){
    $table_name="item";
  }elseif($item_type==2){
      $table_name="product";
  }

 $base_uom_id_original= fetch_data($conn,$table_name,"id",$item_id);

  $stock_uom_id=$row["uom_id"];

if($stock_uom_id!=$base_uom_id_original["uom_id"]){
$uom_check=  stock_interchange_uom_qty($conn, $stock_uom_id, $row['quantity'], $base_uom_id_original["uom_id"]);
}
else{
$uom_check=$row['quantity'];
$uom_name="";
}




if($row['transfer_type']==1){
  $in+=$uom_check ;
}
elseif($row['transfer_type']==2){
  $out+=$uom_check;
}

$uom_name=fetch_data($conn,"uom","id",$base_uom_id_original['uom_id']);
$uom=$uom_name["uom_name"];

}
$stock= ($in-$out);

if($stock>0){
$uom_data_check=$uom;
}else{
  $uom_base_of_item=check_item_or_product_data($conn,$item_id,$item_type);

  $uom_data_check=$uom_base_of_item["uom_name"];
}


$data_array=array('in'=>$in, 'out'=>$out,'total'=>$stock,'uom_name'=>$uom_data_check);
// echo serialize($data_array);
return $data_array;



}






function find_stock_quantity_from_location_id($conn, $item_id,$item_type, $location_id){

  $in=0;
  $out=0;

  $sql="SELECT * FROM stock_transfer_location WHERE item_id='$item_id' AND item_type='$item_type' AND location_id='$location_id'";
  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)>0){
   while($row=mysqli_fetch_array($result)){
    
   
    $inventory_transfer_id=$row['inventory_transfer_id'];
    if($item_type==1){
      $table_name="item";
    }elseif($item_type==2){
        $table_name="product";
    }

   $base_uom_id_original= fetch_data($conn,$table_name,"id",$item_id);

    $stock_uom_id=$row["uom_id"];

if($stock_uom_id!=$base_uom_id_original["uom_id"]){
  $uom_check=  stock_interchange_uom_qty($conn, $stock_uom_id, $row['quantity'], $base_uom_id_original["uom_id"]);
}
else{
  $uom_check=$row['quantity'];
  $uom_name="";
}
 $uom_name=fetch_data($conn,"uom","id",$base_uom_id_original['uom_id']);
 $uom=$uom_name["uom_name"];



  if($row['transfer_type']==1){
    $in+=$uom_check ;
  }
  elseif($row['transfer_type']==2){
    $out+=$uom_check;
    
  }

}
$stock= ($in-$out);
$data_array=array('in'=>$in, 'out'=>$out,'total'=>$stock,'uom_name'=>$uom);

  }

  else{

    $product= check_item_or_product_data($conn,$item_id,$item_type);


    $data_array=array('in'=>'0', 'out'=>'0','total'=>'0','uom_name'=>$product['uom_name']);
  }
return $data_array;


}


function uom($conn,$uomId,$t){
  $val="";
$sqlBaseSame=mysqli_query($conn,"SELECT * FROM `uom_conversion_setting` WHERE form_unit_source='$uomId' OR to_unit_source='$uomId'");

while($rowOp=mysqli_fetch_array($sqlBaseSame)){

    $unitName=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$uomId'", "uom_name");


    if($rowOp['form_unit_source']==$uomId){

        $to_unit_id=$rowOp['to_unit_source'];
        $to_unit_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$to_unit_id'", "uom_name");
        $to_unit_value=$rowOp['to_unit_value'];

        $from_unit_value=$rowOp['form_unit_value'];
        $val=  $to_unit_value*$t." ".$to_unit_name;

    }


    if($rowOp['to_unit_source']==$uomId){

        $from_unit_id=$rowOp['form_unit_source'];
        $from_unit_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$from_unit_id'", "uom_name");
        $from_unit_value=$rowOp['form_unit_value'];

        $to_unit_value=$rowOp['to_unit_value'];
        $val= $from_unit_value*$t." ".$from_unit_name;

    }
}

return $val; 
}



function find_item_base_uom($conn, $item_id, $item_type){
  if($item_type==1){
    $table_name="dp";
    $sql="SELECT * FROM dp WHERE id='$item_id'";
  }elseif($item_type==2){
      $table_name="ap";
      $sql="SELECT * FROM ap WHERE id='$item_id'";
  }

  $rs=mysqli_query($conn,$sql);

  if(mysqli_num_rows($rs)>0){
    $row=mysqli_fetch_array($sql);
    $uom_id=$row["uom_id"];
    $base_uom_name_original= fetch_data($conn,"uom","id",$uom_id);
    // $base_uom_name_original["uom_name"];
    return array( $uom_id, $base_uom_name_original["uom_name"]);
    
  }else{
    return array("0", "0");
  }

  
 }






function findConversionSetting($conn, $source_uom_id, $target_uom_id){


  $retStr="";
  $conoption1=mysqli_query($conn,"SELECT * FROM uom_conversion_setting WHERE form_unit_source='$source_uom_id' AND to_unit_source='$target_uom_id'");

  if(mysqli_num_rows($conoption1)==1){
      $rowOp=mysqli_fetch_array($conoption1);

      $from_unit_id=$rowOp['form_unit_source'];
      $from_unit_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$from_unit_id'", "uom_name");

      $to_unit_id=$rowOp['to_unit_source'];
      $to_unit_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$to_unit_id'", "uom_name");
      $retStr=$rowOp['form_unit_value']."-".$from_unit_id."-".$rowOp['to_unit_value']."-".$to_unit_id;
  }


  $conoption2=mysqli_query($conn,"SELECT * FROM uom_conversion_setting WHERE form_unit_source='$target_uom_id' AND to_unit_source='$source_uom_id'");

  if(mysqli_num_rows($conoption2)==1){
      $rowOp=mysqli_fetch_array($conoption2);

      $from_unit_id=$rowOp['form_unit_source'];
      $from_unit_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$from_unit_id'", "uom_name");

      $to_unit_id=$rowOp['to_unit_source'];
      $to_unit_name=singleRowFromTable($conn, "SELECT * FROM uom WHERE id='$to_unit_id'", "uom_name");

      $retStr=$rowOp['to_unit_value']."-".$to_unit_id."-".$rowOp['form_unit_value']."-".$from_unit_id;
  }

return $retStr;

}




function stock_interchange_uom_qty($conn, $base_stock_uom_id, $base_quantity, $target_stock_uom_id){


  if($base_stock_uom_id!=$target_stock_uom_id){

    $conversionSettingStr=findConversionSetting($conn, $base_stock_uom_id, $target_stock_uom_id);

    $conversionSettingArray=explode("-",$conversionSettingStr);

    $source_uom_id=$conversionSettingArray[1];
    $source_uom_val=$conversionSettingArray[0];
    $target_uom_id=$conversionSettingArray[3];
    $target_uom_val=$conversionSettingArray[2];
  

  $valueOfSingleBaseUnitToTaget=$target_uom_val/$source_uom_val;
  $data= $valueOfSingleBaseUnitToTaget*$base_quantity;

  }else{
    $data= $base_quantity;
  }
  
  return  $data;
  
  }
  



  

function find_stock_quantity_recipe($conn, $item_id,$item_type,$need_qty,$uom_id){
    
  $in=0;
  $out=0;

  $sql="SELECT * FROM stock_transfer_location WHERE item_id='$item_id' AND item_type='$item_type'";
  $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result)){
    
   
    $inventory_transfer_id=$row['inventory_transfer_id'];
    if($item_type==1){
      $table_name="item";
    }elseif($item_type==2){
        $table_name="product";
    }

   $base_uom_id_original= fetch_data($conn,$table_name,"id",$item_id);

    $stock_uom_id=$row["uom_id"];

if($stock_uom_id!=$base_uom_id_original["uom_id"]){
  $uom_check=  stock_interchange_uom_qty($conn, $stock_uom_id, $row['quantity'], $base_uom_id_original["uom_id"]);
}
else{
  $uom_check=$row['quantity'];
  $uom_name="";
}
 $uom_name=fetch_data($conn,"uom","id",$base_uom_id_original["uom_id"]);
 $uom=$uom_name["uom_name"];



  if($row['transfer_type']==1){
    $in+=$uom_check ;
  }
  elseif($row['transfer_type']==2){
    $out+=$uom_check;
    
  }

}
$stock= ($in-$out);
$data_array=array('in'=>$in, 'out'=>$out,'total'=>$stock,'uom_name'=>$uom);
return $data_array;
}




// function stock_transfer_item_type_fetch_from_inventory_transfer_detail($conn,$item_id,$inventory_transfer_id)
// {
//   $sql = "SELECT * FROM inventory_transfer_details WHERE $inventory_transfer_id='$inventory_transfer_id' AND $item_id='$item_id' AND status='2'";
//   $query = mysqli_query($conn,$sql);
//   $row = mysqli_fetch_array($query);

//   $data = array('item_type' => $row["item_type"],
//                 'uom_id' => $row["uom_id"], 
//                 'qty' => $row["quantity"], 
//                 'transfer_type' => $row["transfer_type"], 
//                 'row_created_on' => $row["row_created_on"]);
//   return $data;
// }











function find_stock_quantity_recipe_location($conn, $item_id,$item_type,$need_qty,$uom_id,$location_id){
    
  $in=0;
  $out=0;

  $sql="SELECT * FROM stock_transfer_location WHERE item_id='$item_id' AND item_type='$item_type' AND location_id='$location_id'";
  $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result)){
    
   
    $inventory_transfer_id=$row['inventory_transfer_id'];
    if($item_type==1){
      $table_name="item";
    }elseif($item_type==2){
        $table_name="product";
    }

   $base_uom_id_original= fetch_data($conn,$table_name,"id",$item_id);
    $stock_uom_id=$row["uom_id"];

if($stock_uom_id!=$base_uom_id_original["uom_id"]){
  $uom_check=  stock_interchange_uom_qty($conn, $stock_uom_id, $row['quantity'], $base_uom_id_original["uom_id"]);
}
else{
  $uom_check=$row['quantity'];
  $uom_name="";
}

 $uom_name=fetch_data($conn,"uom","id",$base_uom_id_original["uom_id"]);
 $uom=$uom_name["uom_name"];



  if($row['transfer_type']==1){
    $in+=$uom_check ;
  }
  elseif($row['transfer_type']==2){
    $out+=$uom_check;
    
  }

}
$stock= ($in-$out);
$data_array=array('in'=>$in, 'out'=>$out,'total'=>$stock,'uom_name'=>$uom,'uom_id'=>$base_uom_id_original["uom_id"]);
return $data_array;
}




function inventory_transfer_status($conn,$status){
   if($status==1){
     $status_remark="<button type='button' class='btn btn-warning btn-block'>Pending</button>";
   }elseif($status==2){
    $status_remark="<button type='button' class='btn btn-success btn-block'>Accepted</button>";
   }elseif($status==3){
    $status_remark="<button type='button' class='btn btn-danger btn-block'>Discarded</button>";
   }
  return $status_remark;
}







function check_item_or_product_data($conn,$item_id,$item_type){

  if($item_type==1 ||  $item_type=='i'){
    $sql = "SELECT * FROM dp WHERE id='$item_id'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);

    $cat_id=$row["cat_id"];
    $category=fetch_data($conn,"dp_category","id",$cat_id);
    $uom_id=$row["uom_id"];
    $hsn_table_id=$row["hsn_table_id"];
    $hsn_rate_id=$row["hsn_rate_id"];
    
    $hsn_table=fetch_data($conn,"hsn_table","id",$hsn_table_id);
    $uom_details_array=fetch_data($conn,"uom","id",$uom_id);
    $data = array('category' => $category["category_name"],'mtm' => $row["mtm"],'sku' => $row["sku"],'name' => $row["name"],'uom_id' => $row["uom_id"], 'uom_name' => $uom_details_array["uom_name"],'hsn_code' => $hsn_table["code"],'hsn_rate_id' => $hsn_rate_id);
  
  
  }elseif($item_type==2 ||  $item_type=='p'){

    $sql = "SELECT * FROM ap WHERE id='$item_id'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);

    $cat_id=$row["category_id"];
    $category=fetch_data($conn,"ap_category","id",$cat_id);
     $uom_id=$row["uom_id"];
    $uom_details_array=fetch_data($conn,"uom","id",$uom_id);
    $hsn_table_id=$row["hsn_table_id"];
    $hsn_table=fetch_data($conn,"hsn_table","id",$hsn_table_id);

    $hsn_rate_id=$row["hsn_rate_id"];

    $data = array('category' => $category["category"],'mtm' => $row["mtm"],'name' => $row["name"],'uom_id' => $row["uom_id"], 'uom_name' => $uom_details_array["uom_name"],'hsn_code' => $hsn_table["code"],'hsn_rate_id' => $hsn_rate_id);
  
  }

  return $data;
}





function fetch_data_two_condition($conn, $tableName,$fst_clm,$fst_data,$scnd_clm,$scnd_data)
{
  $sql = "SELECT * FROM $tableName WHERE $fst_clm='$fst_data' AND $scnd_clm='$scnd_data'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);


  return $row;
}

function uom_relation_data($conn,$uom_id){
$c=0;
$data_uom="";
$sql="SELECT * FROM uom_conversion_setting WHERE form_unit_source='$uom_id' OR to_unit_source='$uom_id'";
$result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result)){

  $c++;
 
  $data =  fetch_data($conn,"uom","id",$uom_id);

  $data_uom.= "<option value='".$uom_id."' selected>". $data["uom_name"]."</option>";


if($row["form_unit_source"]==$uom_id){


    $to_unit_source = $row["to_unit_source"];
    $data =  fetch_data($conn,"uom","id",$to_unit_source);
      
    $data_uom.="<option value='".$row["to_unit_source"]."'>". $data["uom_name"]."</option>";

}elseif($row["to_unit_source"]==$uom_id){

  $form_unit_source = $row["form_unit_source"];
  $data =  fetch_data($conn,"uom","id",$form_unit_source);
    
    $data_uom.= "<option value='".$row["form_unit_source"]."'>". $data["uom_name"]."</option>";
}

}

return $data_uom;
 }





 
function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}




function invoices_year($conn)
{
    $now_date = date("y");
    $new_year = $now_date+1;
    $invoices_year = $now_date."-".$new_year;
    return $invoices_year;

}

function calculateFiscalYearForDate($conn){
    $date = date("n/j/y",time());
    // $date = "12/3/20";
    $newdate = strtotime($date);
    $inputyear = date('%y',$newdate);
 
    // $fystartdate = strtotime($fyStart.$inputyear);
    // $fyenddate = strtotime($fyEnd.$inputyear);
    $fyStart="4/1";
    $fyEnd="3/31";

    $fystartdate = strtotime($fyStart.'/'.$inputyear);
    $fyenddate = strtotime($fyEnd.'/'.$inputyear);
 
    if($newdate <= $fyenddate){
        $fy = intval($inputyear);
    }
    else{
        $fy = intval(intval($inputyear) + 1);
    }
    return $inputyear;
    // return $fy;
 
}


function generate_numbers($conn) {
   $sql = "SELECT * FROM quotation  ORDER BY id DESC ";
   $query = mysqli_query($conn,$sql);
  //  $num_row=mysqli_num_rows($query);
   $invoices_row = mysqli_num_rows($query);

  
  
   
   if ($invoices_row > 0) {

    $row = mysqli_fetch_array($query);
    $invoices_number = $row['our_ref_no'];
   
      $date=calculateFiscalYearForDate($conn);
    $date2 = intval($date)+1;
    $date3 = $date.$date2;
    $invoice = substr($invoices_number,13);
    $invoice2 = substr($invoices_number,-15,4);



   		

   		if ($invoice2 >= $date3) {
   			$add_invoice = $invoice+1;
 
          $result = str_pad($add_invoice, 1, "0", STR_PAD_LEFT);
   		}
   		else{
   			$num=1;
   		  $result = str_pad($num, 1, "0", STR_PAD_LEFT);
   			
   		}
   }
   else{
        for ($n = 1; $n <= 1; $n++) {
 
          $result = str_pad($n, 1, "0", STR_PAD_LEFT);
     
       }
   }

   return $result;

  }



// function invoices_number_generate($conn){
//     $date = date("n/j/y",time());
//     $newdate = strtotime($date);
//     $inputyear = strftime('%Y',$newdate);
 
//     // $fystartdate = strtotime($fyStart.$inputyear);
//     // $fyenddate = strtotime($fyEnd.$inputyear);


//     $fyStart="4/1";
//     $fyEnd="3/31";

//     $fystartdate = strtotime($fyStart.'/'.$inputyear);
//     $fyenddate = strtotime($fyEnd.'/'.$inputyear);
 
//     if($newdate <= $fyenddate){
//         // $fy = intval($inputyear);
//         $fy= generate_numbers($conn);


//     }
//     else{
//        $fy = generate_numbers($conn);
      
//     }
 
//     return $fy;
 
// }





?>