<?php 

class Book extends Product {

    private $weight;

    public function __construct($name, $SKU, $type, $price, $weight) {
        parent::__construct($name, $SKU, $type, $price);
        $this->weight = $weight;
    }

    public function getWeight() {
        return $this->weight."KG";
    }

    public function getPropertyValue() {
        return $this->getWeight();
    }

    public function insertToDB()
    {
        // Function to insert DVD to DB
    }
}

?>