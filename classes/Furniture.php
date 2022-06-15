<?php 

class Furniture extends Product {

    private $furnitureType;
    private $height;
    private $width;
    private $length;

    public function __construct($SKU, $type, $price, $furnitureType, $height, $width, $length) {
        parent::__construct($SKU, $type, $price);
        $this->furnitureType = $furnitureType;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getFurnitureType() {
        return $this->furnitureType;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getLength() {
        return $this->length;
    }

    public function insertToDB()
    {
        // Function to insert DVD to DB
    }
}

?>