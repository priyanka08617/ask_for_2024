<?php
include 'connection.php';
include '../../includes/functions.php';


$searchTerm=$_POST['searchTerm'];
$data=array();
if($searchTerm=="customer_details"){
    $customer_details_dropdown=array();
    $customer_details_dropdown[] = "<option value=''>Choose Customer</option>";
    $sql="SELECT * FROM `customer_details` WHERE `status`='1'";
    $query=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($query)){
        $customer_details_dropdown[]="<option value='".$row['id']."'>".$row['name']."  (". $row['mobile'].")</option>";


        
 
    }
    $data=array("customer_details"=>$customer_details_dropdown); 
}elseif($searchTerm=="dp_category"){

    $dp_category=array();
    $dp_category[]="<option value=''>select</option>";
            $sql="SELECT * FROM `dp_category`  WHERE `status`='1'";
                $query=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($query)){

                $dp_category_id= $row["id"];
                $category_name= $row["category_name"];

                $selected = ($dp_category_id == 1) ? 'selected' : '';
                
                $dp_category[]="<option value='".$dp_category_id."' ".$selected.">".$category_name."</option>";

                  
                }


                $data=array("dp_category"=>$dp_category);
}elseif($searchTerm=="dp"){

    $dp_category_id=$_POST["dp_category_id"];
    $dp=array();
    $dp[]="<option value='' selected>select</option>";
            $sql="SELECT * FROM `dp`  WHERE `status`='1' AND `cat_id`='$dp_category_id'";
                $query=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($query)){

                $dp_id= $row["id"];
                $mtm= $row["mtm"];
                $dp[]="<option value='".$mtm."'>".$mtm."</option>";

                  
                }


                $data=array("dp"=>$dp);
}




echo json_encode($data);

?>