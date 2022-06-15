<?php 

class Book extends Product {

    private $name;

    public function __construct($SKU, $type, $price, $name) {
        parent::__construct($SKU, $type, $price);
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function insertToDB()
    {
        // Function to insert DVD to DB
    }
}

?>