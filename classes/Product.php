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

    abstract public function getPropertyValue();

    abstract public function insertToDB();  

}

?>