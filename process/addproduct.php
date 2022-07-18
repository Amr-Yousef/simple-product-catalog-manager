<?php
require_once "../classes/DBController.php";
require_once "../classes/Product.php";
require_once "../classes/Book.php";
require_once "../classes/DVD.php";
require_once "../classes/Furniture.php";

$db = new DBController;
$db->openConnection();

$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$productType = $_POST['type'];
$prop = json_decode($_POST['propArr']);

if(count($prop) == 1) {  // If there is only one property, then it turns the array into a single variable
    $prop = $prop[0];
}

$product = Product::createProductObject($name, $sku, $productType, $price, $prop);

echo $product->insertToDB();

// $db->insert("INSERT INTO test VALUES ('$sku')");
?>