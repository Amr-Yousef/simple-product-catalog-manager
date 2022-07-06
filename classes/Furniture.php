<?php 

class Furniture extends Product {

    private $height;
    private $width;
    private $length;

    public function __construct($name, $SKU, $type, $price, $dimensions) {
        parent::__construct($name, $SKU, $type, $price);
        $this->height = $dimensions[0];
        $this->width = $dimensions[1];
        $this->length = $dimensions[2];
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

    public function getDimensions() {
        return $this->height."x".$this->width."x".$this->length;
    }

    public function getPropertyValue()
    {
        return $this->getDimensions();
    }

    public function insertToDB()
    {
        $db = new DBController;
        $db->openConnection();

        return $db->insert("INSERT INTO furniture VALUES ('$this->SKU', '$this->name', '$this->type', '$this->price', '$this->height', '$this->width', '$this->length')");
    }
}

?>