<?php 
require_once "../classes/DBController.php";
require_once "../classes/Product.php";
require_once "../classes/Book.php";
require_once "../classes/DVD.php";
require_once "../classes/Furniture.php";

$db = new DBController;
$db->openConnection();
$sku = $_POST['sku'];
//$db->insert("INSERT INTO test VALUES ('$sku')");
?>