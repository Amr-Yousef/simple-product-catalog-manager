<?php

use function PHPSTORM_META\type;

require_once '../classes/DBController.php';

$db = new DBController();
$db->openConnection();
$productType = $_POST['productType'];

$result = $db->select('SELECT * FROM property WHERE productType = "'.$productType.'"');
$resultArray = array();

$properties = explode(",", $result[0]['properties']);
$unit = explode(",", $result[0]['unit']);
$placeholder = explode(",", $result[0]['placeholder']);
$description = explode(",", $result[0]['description']);

for($i = 0; $i < count($properties); $i++) {
    $tmp = array($properties[$i], $unit[$i], $placeholder[$i]);
    array_push($resultArray, $tmp);
}
array_push($resultArray, $description[0]);  // Description will be at the end of the array




echo json_encode($resultArray);


?>