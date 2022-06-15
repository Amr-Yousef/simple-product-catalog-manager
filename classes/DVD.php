<?php 

class DVD extends Product {

    private $size;

    public function __construct($SKU, $type, $price, $size) {
        parent::__construct($SKU, $type, $price);
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }

    public function insertToDB()
    {
        // Function to insert DVD to DB
    }
}

?>