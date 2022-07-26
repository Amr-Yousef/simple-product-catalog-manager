<?php 

class Book extends Product {

    private $weight;

    public function __construct($name, $SKU, $type, $price, $weight) {
        parent::__construct($name, $SKU, $type, $price);
        $this->weight = $weight;
        $this->propertyName = "Weight";
    }

    public function getWeight() {
        return $this->weight."KG";
    }

    public function getPropertyValue() {
        return $this->getWeight();
    }

    public function insertToDB()
    {
        $db = new DBController;
        $db->openConnection();

        return $db->insert("INSERT INTO book VALUES ('$this->SKU', '$this->name', '$this->type', '$this->price', '$this->weight')");
    }
}

?>