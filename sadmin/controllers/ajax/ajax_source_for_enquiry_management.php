<?php
include 'connection.php';
include '../../includes/functions.php';



$source_id=sanitize_input($conn,$_POST["source_id"]);
// $store_id=sanitize_input($conn,$_POST["store_id"]);



$data="";
if($source_id=="walking"){
   
   
   
    $data.="<select class='form-control' name='source_data_id' id='source_data_id'>";
    
   
    $sql="SELECT * FROM `branch` WHERE `status`='1'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){
        $id=$row["id"];
        $store_name=$row["name"];
        
    $data.="<option value='".$id."'>".$store_name."</option>";
    }
    $data.="</select>";

}elseif($source_id=="lead"){
$data="<input type='text' class='form-control' name='source_data_id' id='source_data_id' placeholder='Lead From'>";
}
elseif($source_id=="referral"){

    $data.="<select class='form-control' name='source_data_id' id='source_data_id'>";
    $sql="SELECT * FROM `customer_details` WHERE `status`='1'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){
        $customer_id=$row["id"];
        $display_name=$row["display_name"];
$data.="<option value='".$customer_id."'>".$display_name."</option>";
    }
    $data.="</select>";
}
elseif($source_id=="social_media"){
    $data="";
    $data.="<select class='form-control' name='source_data_id' id='source_data_id'>";
    $data.="<option value='Facebook'>Facebook</option>";
    $data.="<option value='Youtube'>Youtube</option>";
    $data.="<option value='Instagram'>Instagram</option></select>";

}
elseif($source_id=="Lenovo"){
    $data="<input type='text' class='form-control' name='source_data_id' id='source_data_id' value='Lenovo'>";
}
elseif($source_id=="Google"){
    $data="<input type='text' class='form-control' name='source_data_id' id='source_data_id' value='Google'>";
}
elseif($source_id=="print_media"){
    $data="<input type='text' class='form-control' name='source_data_id' id='source_data_id' value='Print Media'>"; 
}


echo $data;

  ?>