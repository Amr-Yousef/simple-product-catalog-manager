<?php 
require_once "../classes/DBController.php";
require_once "../classes/Product.php";
$sku = $_POST['sku'];
echo Product::checkProductSKU($sku);
?>