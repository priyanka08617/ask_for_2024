<?php
include 'connection.php';
include '../../includes/functions.php';
$data="";
$id=$_POST["id"];

$sql="SELECT * FROM credentials_set WHERE id='$id'";
$res=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($res)){
    $credentials_item=$row["credentials_item_id"];
     $name=$row["name"];
     $credentials_item_unserialize = unserialize($credentials_item); 

    $count=count($credentials_item_unserialize);


    for($i=1;$i<$count;$i++){
       $s=$credentials_item_unserialize["$i"];
       $credentials_item =singleRowFromTable($conn, "SELECT * FROM credentials_item WHERE id='$s'", "name");
       $credentials_type =singleRowFromTable($conn, "SELECT * FROM credentials_item WHERE id='$s'", "input_type");

       $data.='<input type="hidden" id="credentials_item'.$i.'" name="credentials_item[]'.$i.'" value="'.$s.'" class="form-control">';

        $data.='<div class="form-group row">';
        $data.='<div class="col-md-4"><input type="text" id="credentials_item_id'.$i.'" name="credentials_item_id[]'.$i.'" value="'.$credentials_item.'" class="form-control" readonly></div>';
        
        if($credentials_type==1 || $credentials_type==3){
            $data.='<div class="col-md-4"><input type="file" id="file_data'.$i.'" name="image[]" class="form-control" placeholder="Select image" multiple="multiple"></div>';
        }else{
            $data.='<div class="col-md-4"><input type="file" id="file_data'.$i.'" name="image[]" class="form-control" value="N.A" disabled></div>';
        }
       
        if($credentials_type==2 || $credentials_type==3){
        $data.='<div class="col-md-4"><input type="text" id="text_data'.$i.'" name="text_data[]" class="form-control" placeholder="Enter Text"></div>';
        }else{
            $data.='<div class="col-md-4"><input type="text" id="text_data'.$i.'" name="text_data[]" class="form-control" value="N.A" readonly></div>';
        }

        $data.='</div>';
   
        $data.='<input type="hidden" id="input_type'.$i.'" name="input_type[]'.$i.'" value="'.$credentials_type.'" class="form-control">';
        
      
      
    }
    // $data.=$name;

}

echo $data;

?>