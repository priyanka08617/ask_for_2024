<?php 
include 'connection.php';
include '../../includes/functions.php';
header("Content-Type: application/json; charset=UTF-8");
$user_category_id=sanitize_input($conn,$_POST['user_category']);
// $user_category_id=1;
$user_category_prefix=singleRowFromTable($conn, "SELECT * FROM user_category WHERE id='$user_category_id'", "username_prefix");


function random_characters()
{
$charset = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
$pre = "";
for($v = 0; $v < 5; $v++)
{    
  $random_int = mt_rand();
  $pre .= $charset[$random_int % strlen($charset)];
}
return $pre;
}


$loginname_array=array();

$sql="SELECT * FROM user_login";
$res=mysqli_query($conn,$sql);

    while($r=mysqli_fetch_array($res)){
        $loginname_array[]=$r['username'];
    }
    


    $random_username="";
    $random_password=random_characters();

while(1){
    $cd=random_characters();
    $cc=$user_category_prefix.$cd;

    

// if(in_array($cc,$loginname_array)){
//     echo "<span style='color:red;'>".$cc." found in database, Can not be used</span><br>";
// }
// else{
//     echo "<span style='color:green;'>".$cc." not found in database, Can be used</span><br>";
//     break;
// }


if(!in_array($cc,$loginname_array)){
    // echo "<span style='color:red;'>".$cc." found in database, Can not be used</span><br>";
    $random_username=$cd;
    break;
}



}

// echo $user_category_prefix;


$data_array= array('prefix' => $user_category_prefix,'random_username' => $random_username,'random_password' => $random_password);


$myJSON = json_encode($data_array);

echo $myJSON;


?>