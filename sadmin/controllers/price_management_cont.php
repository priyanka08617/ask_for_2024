<?php
include '../includes/check.php';
include '../includes/functions.php';

$product_id=$_POST['product_id'];
$product_price=$_POST['product_price'];
$now=date("Y-m-d H:i:s");

$location_id_array = $_POST['check_box_id'];
$price_array  = $_POST['check_price'];

$total_amount=0;
    for($i=0;$i<count($location_id_array);$i++){
        if(empty($location_id_array[$i])){

        }else{
            $location_id= $location_id_array[$i];
            $price= $price_array[$i];
            
            $sql="SELECT * FROM price_management WHERE location_id='$location_id' AND product_id='$product_id' AND status='1'";
            $result=mysqli_query($conn,$sql);
            $num_rows=mysqli_num_rows($result);
            if($num_rows==0){
                $sql="INSERT INTO `price_management`(`product_type`, `product_id`, `location_id`, `price`, `status`, `row_created_on`)  VALUES ('2','$product_id','$location_id','$price','1','$now')";
                mysqli_query($conn,$sql);
                echo mysqli_error($conn);
            }

    

        }
      

    }

    header("location:../views/price_management.php");

?>