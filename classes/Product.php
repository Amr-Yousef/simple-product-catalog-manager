<?php 

abstract class Product {
    
    private $SKU;
    private $type;
    private $price;

    public function __construct($SKU, $type, $price) {
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

    public function setSKU($SKU) {
        $this->SKU = $SKU;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    abstract public function insertToDB();

}

?>