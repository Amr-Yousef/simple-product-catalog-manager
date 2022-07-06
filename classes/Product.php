<?php 

abstract class Product {

    private $name;
    private $SKU;
    private $type;
    private $price;
    private $propertyName;

    public function __construct($name, $SKU, $type, $price) {
        $this->name = $name;
        $this->SKU = $SKU;
        $this->type = $type;
        $this->price = $price;
        $this->propertyName = $this->setProductPropertyName();
    }

    public function getSKU() {
        return $this->SKU;
    }

    public function getType() {
        return $this->type;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getName() {
        return $this->name;
    }

    public function getPropertyName() {
        return $this->propertyName;
    }

    public function setProductPropertyName() {
        $type = $this->type;

        if($type == "DVD")
            return "Size";
        else if($type == "Furniture")
            return "Dimensions";
        else if($type == "Book")
            return "Weight";
            
        else return "UNKNOWN";
    }

    public static function getAllProducts() {
        // Use usort to sort the array by SKU

        $db = new DBController;
        $db->openConnection();

        $productsArray = array();

        $arrayDVD = $db->select("SELECT * FROM dvd");
        foreach($arrayDVD as $row) {
            array_push($productsArray, new DVD($row['name'], $row['SKU'], $row['type'], $row['price'], $row['size']));
        }

        $arrayBook = $db->select("SELECT * FROM book");
        foreach($arrayBook as $row) {
            array_push($productsArray, new Book($row['name'], $row['SKU'], $row['type'], $row['price'], $row['weight']));
        }

        $arrayFurniture = $db->select("SELECT * FROM furniture");
        foreach($arrayFurniture as $row) {
            array_push($productsArray, new Furniture($row['name'], $row['SKU'], $row['type'], $row['price'], [$row['height'], $row['width'], $row['length']]));
        }

        usort($productsArray, function($a, $b) {
            return $a->getSKU() <=> $b->getSKU();
        });

        return $productsArray;
    }

    public static function createProductObject($name, $SKU, $type, $price, $propertyValue) {
        if($type == "DVD")
            return new DVD($name, $SKU, $type, $price, $propertyValue);
        else if($type == "Furniture")
            return new Furniture($name, $SKU, $type, $price, $propertyValue);
        else if($type == "Book")
            return new Book($name, $SKU, $type, $price, $propertyValue);
        else
            return -1;  // Unknown product type
    }

    // Checks. This will allow us to expand it in the future if needed.
    public static function checkProductName($name) {
        if(strlen($name) < 1)
            return 0;
        else
            return 1;
    }

    public static function checkProductSKU($SKU) {
        if(strlen($SKU) < 1)
            return 0;
        

        $db = new DBController;
        $db->openConnection();

        // Checks if the SKU is already in the database
        if(count($db->select("SELECT sku FROM book WHERE sku='$SKU' UNION SELECT sku FROM dvd WHERE sku='$SKU' UNION SELECT sku FROM furniture WHERE sku='$SKU'")) > 0)
            return -1;

        return 1;
    }

    public static function checkProductType($type) {
        if(strlen($type) < 1)
            return 0;
        else
            return $type;
    }

    public static function checkProductPrice($price) {
        if(strlen($price) < 1)
            return 0;
        else
            return 1;
    }

    public static function checkProductPropertyValue($propertyValue) {
        
        // I KNOW that this is propbably the worst thing you've ever seen, hopefully I'll remember to fix it later. I'm sorry.
        if(gettype($propertyValue) == "array"){
            $x = $propertyValue[0] == '' ? 0 : 1;
            $y = $propertyValue[1] == '' ? 0 : 1;
            $z = $propertyValue[2] == '' ? 0 : 1;
            return ($x + $y + $z) == 3 ? 1 : 0;
        }
        else if(strlen($propertyValue) < 1 or is_null($propertyValue) or $propertyValue == '')
            return 0;

        return 1;
    }



    abstract public function getPropertyValue();

    abstract public function insertToDB();  

}

?>