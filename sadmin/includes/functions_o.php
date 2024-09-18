<?php
/////////////////////////////////////
function singleRowFromTable($conn, $sql, $col_required){

	if($row=mysqli_fetch_array(mysqli_query($conn,$sql))){
    return $row[$col_required];
  }
  else{
   return "N.A.";
  }



}

function fetch_data($conn,$table_name,$id,$condition_id)
{
  $sql = "SELECT * FROM $table_name WHERE $id='$condition_id' ";
  $query = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($query);
  return $row;
}



function sanitize_input($conn,$data){
	
  $data = mysqli_real_escape_string($conn,$data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strip_tags($data);

  return $data;
  }


  function fetchAllColumnNameFunction($conn,$tableName,$id)
  {

    $sql="SHOW COLUMNS FROM $tableName";
      $query=mysqli_query($conn,$sql);
      while($row1=mysqli_fetch_array($query)){
        $fld[]=$row1['Field'];
      }

     
      $option="";

      $sql2="SELECT * FROM $tableName WHERE status='1' AND id='$id'";
      $query2=mysqli_query($conn,$sql2);
      $row2=mysqli_fetch_array($query2);

        // $head_id=$row2['head_id'];
      

                  for($i=0;$i<count($fld);$i++){
                    if($fld[$i]!='id' && $fld[$i] !='head_id' && $fld[$i] !='status'){
                      
                     
                        $option.= $row2[$fld[$i]]." , ";
                      
                         
                    }
                  }
                
  

return $option;
  }



  function fetchAllColumnName($conn,$tableName,$head_id)
  {

    $sql="SHOW COLUMNS FROM $tableName";
      $query=mysqli_query($conn,$sql);
      while($row1=mysqli_fetch_array($query)){
        $fld[]=$row1['Field'];
      }

     
      $option="";

      $sql2="SELECT * FROM $tableName WHERE status='1' AND head_id='$head_id'";
      $query2=mysqli_query($conn,$sql2);
      while($row2=mysqli_fetch_array($query2)){

        $head_id=$row2['head_id'];
        $option.="<option value='".$head_id.",";
                  for($i=0;$i<count($fld);$i++){
                    if($fld[$i]=='id'){
                                $option.= $row2['id']; 
                                  }
                  }
                  $option.="'>";

                  for($i=0;$i<count($fld);$i++){
                    if($fld[$i]!='id' && $fld[$i] !='head_id' && $fld[$i] !='status'){
                     
                      if(empty($row2[$fld[$i]])){
                        $option.="";
                      }else{
                        $option.= $row2[$fld[$i]]." , "; 
                      }
                        
                      
                          
                    }
                  }
                  $option.="</option>";
  }
// }
//  $option.",".$head_id;
//  return array('option'=>$option,'head_id'=>$head_id);
return $option;
  }

 function fetchAllData($conn, $tableName,$column,$id)
{
  $sql = "SELECT * FROM ".$tableName." WHERE $column='$id'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);


  return $row;
}



  function fetchData($conn, $tableName,$id,$colName)
{
  $sql = "SELECT * FROM ".$tableName." WHERE id='$id'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);


  return $row[$colName];
}


function fetch_data_two_condition($conn, $tableName,$fst_clm,$fst_data,$scnd_clm,$scnd_data)
{
  $sql = "SELECT * FROM $tableName WHERE $fst_clm='$fst_data' AND $scnd_clm='$scnd_data'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);


  return $row;
}
////////////////////////////////////


function dateForm($dateStr){
  return date('d M, y h:i a', strtotime($dateStr));
}

function dateForm1($dateStr){
  return date('d M, y', strtotime($dateStr));
}


function fetch_all_header_with_data($conn,$tableName,$id)
{

  $sql="SHOW COLUMNS FROM $tableName";
    $query=mysqli_query($conn,$sql);
    while($row1=mysqli_fetch_array($query)){
      $fld[]=$row1['Field'];
    }

   
    $option="";

    $sql2="SELECT * FROM $tableName WHERE status='1' AND id='$id'";
    $query2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_array($query2);

      // $head_id=$row2['head_id'];
    

                for($i=0;$i<count($fld);$i++){
                  if($fld[$i]!='id' && $fld[$i] !='head_id' && $fld[$i] !='status'){
                        $option.="<b>".$fld[$i]."&nbsp-&nbsp</b>". $row2[$fld[$i]]." , "; 
                  }
                }
              
return $option;
}


function terms_and_condition($conn,$item_id)
{
  $sql = "SELECT * FROM item WHERE id='$item_id'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);


  $price= $row["price"];

$data='<h5 align="center"><b>COMMERCIAL TERMS & CONDITIONS</b></h5>
<br>
<ol type="a">
     <li><p>The Purchase Order to Be Placed On M/s Ask For Solutions..</p></li>
     <li><p>	Support & Services: The after sales support & services will be directly rendered by lenovo. </p></li>

     <li><p>	Payment terms: 100% advance along with Purchase Order.</p></li>

     <li><p>	Delivery: Delivery of the Notebook will be done within  <input type="text" id="working_day" name="working_day" value="7"> working days from the date of Purchase Order.</p></li>

     <li><p>	Force Majeure clauses as applicable </p></li>
     <li><p>	Offer and price is valid up to <input type="text" id="valid_upto" name="valid_upto" value="2"> days from the date of issue of the quotation.</p></li>
</ol>

<h6><b>Total Price: Rs  <input type="text" id="total_price" name="total_price" value="'.$price.'"> (INCLUSIVE OF GST)</b></h6>
<p>Thank you and assuring you of our best service and support at all times.</p>
<p>Yours sincerely,</p>
<p>For ASK-FOR SOLUTIONS<br>';
}