<?php 

abstract class Product {

    protected $name;
    protected $SKU;
    protected $type;
    protected $price;
    protected $propertyName;

    public function __construct($name, $SKU, $type, $price) {
        $this->name = $name;
        $this->SKU = $SKU;
        $this->type = $type;
        $this->price = $price;
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
        return new $type($name, $SKU, $type, $price, $propertyValue);  // I did not know I can instantiate classes from strings, now I do, this is amazing.
    }

    public static function deleteProduct($SKU) {
        $db = new DBController;
        $db->openConnection();

        $db->delete("DELETE FROM book WHERE sku='$SKU'");
        $db->delete("DELETE FROM dvd WHERE sku='$SKU'");
        $db->delete("DELETE FROM furniture WHERE sku='$SKU'");
    }

    public static function massDeleteProduct($skuList) {
        $db = new DBController;
        $db->openConnection();

        foreach($skuList as $sku) {
            Product::deleteProduct($sku);
        }
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

    abstract public function getPropertyValue();

    abstract public function insertToDB();  // Could've I just put the code here? Probably.

}

?>