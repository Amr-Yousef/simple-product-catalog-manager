<?php 

class DVD extends Product {

    private $size;

    public function __construct($name, $SKU, $type, $price, $size) {
        parent::__construct($name, $SKU, $type, $price);
        $this->size = $size;
        $this->propertyName = "Size";
    }

    public function getSize() {
        return $this->size;
    }

    public function getPropertyValue() {
        return $this->size."MB";
    }

    public function insertToDB()
    {
        $db = new DBController;
        $db->openConnection();

        return $db->insert("INSERT INTO dvd VALUES ('$this->SKU', '$this->name', '$this->type', '$this->price', '$this->size')");
    }
}

?>