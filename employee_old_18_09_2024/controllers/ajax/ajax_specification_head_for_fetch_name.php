<?php
include 'connection.php';
include '../../includes/functions.php';
$dp_category_id=sanitize_input($conn,$_POST["dp_category_id"]);
$product_name=singleRowFromTable($conn, "SELECT * FROM dp_category WHERE id='$dp_category_id'", "category_name");
echo $product_name;
    ?>