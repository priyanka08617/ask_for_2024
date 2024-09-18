<?php
include '../includes/check.php';
include '../includes/functions.php';


if(isset($_POST['submit'])){

$vendor_id          = $_POST['vendor_id'];
$credentials_set_id = $_POST['credentials_set_id'];
$credentials        = $_POST['credentials_item'];
$input_type         = $_POST['input_type'];
$text_data         = $_POST['text_data'];


$arrayName = array('vendor' => $vendor_id ,
'credentials_set_id' => $credentials_set_id , 
'credentials' => $credentials ,
'input_type' => $input_type 
);



print_r($arrayName);



$count=count($credentials);

for($i=0;$i<$count;$i++){

    $credentials_item=$credentials[$i];
    $input=$input_type[$i];
    $text=$text_data[$i];

    //
   
    // $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    if(!empty($_FILES['image']['name'][$i])){
      $file_name= $_FILES['image']['name'][$i];
      $file_tmp =$_FILES['image']['tmp_name'][$i];
      $target_dir = "../img/uploded_document/";
      $target_file = $target_dir.$file_name;
   
       move_uploaded_file($file_tmp=$_FILES["image"]["tmp_name"][$i],$target_file);
    }else{
      $target_file="N.A";
    }
   $sql="INSERT INTO vendor_credentials(`credentials_set_id`, `credentials_item_id`,`file_type`,`text`,`path`, `vendor_id`)VALUES ('$credentials_set_id','$credentials_item','$input','$text','$target_file','$vendor_id')";

   echo $sql; 
   if (!mysqli_query($conn,$sql)){
     echo("Error description: " . mysqli_error($conn));
   }

	// $indent_id=mysqli_insert_id($conn);
header ("location: ../views/vendor_credential.php");
     
}
}


?>