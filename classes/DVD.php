<?php 

class DVD extends Product {

    private $size;

    public function __construct($name, $SKU, $type, $price, $size) {
        parent::__construct($name, $SKU, $type, $price);
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }

    public function getPropertyValue() {
        return $this->size."MB";
    }

    public function insertToDB()
    {
        // Function to insert DVD to DB
    }
}

?>