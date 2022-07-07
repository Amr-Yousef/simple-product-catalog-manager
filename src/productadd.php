<?php

require_once "../classes/DBController.php";
require_once "../classes/Product.php";
require_once "../classes/Book.php";
require_once "../classes/DVD.php";
require_once "../classes/Furniture.php";
// TODO: Move this file to the main directory (outside of the src folder)

ob_start(); // I have absolutely no idea why this works, but it does. I mean it makes a little bit of sense but I still don't get it.
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Products Add</title>
</head>

<body>
    <!-- Top bar -->
    <nav class="bg-white drop-shadow-lg px-6 py-4">
        <!-- Container div -->
        <div class="container flex flex-wrap justify-between items-center">
            <!-- Name -->
            <a class="font-sans font-medium text-2xl">Product Add</a>

            <!-- FEATURE: Add search bar here -->

            <!-- Buttons -->
            <div>
                <!-- <iframe name="foo" style="display:none;"></iframe> -->
                <input target="foo" form="product_form" type="submit" value="Save" class="text-lg font-medium bg-green-300 text-gray-700 py-1 px-4 mx-12 rounded-full hover:cursor-pointer">
                <a class="text-lg font-medium bg-red-400 text-gray-700 py-1 px-4 rounded-full" href="../index.php">Cancel</a>
            </div>
        </div>
    </nav>
    <form id="product_form" action="#" method="post" class="grid grid-cols-2 gap-6 items-center max-w-[80%]">
        <!-- TODO: Add icons for the input fields-->
        <div class="max-w-s m-12">
            <div class="grid gap-6">
                <label class="block">
                    <span class="font-bold text-gray-700">
                        SKU#      
                    </span>
                    <input type="text" name="SKU" id="sku" class="
                        mt-1
                        block
                        w-full
                        rounded-md
                        bg-gray-100
                        border-transparent
                        focus:border-gray-500 focus:bg-white focus:ring-0
                        placeholder:opacity-50
                    " placeholder="ABC12345">
                </label>
                <label class="block">
                    <span class="font-bold text-gray-700">Name</span>
                    <input type="text" name="name" id="name" class="
                        mt-1
                        block
                        w-full
                        rounded-md
                        bg-gray-100
                        border-transparent
                        focus:border-gray-500 focus:bg-white focus:ring-0
                        placeholder:opacity-50
                    " placeholder="Chair">
                </label>
                <label class="block">
                    <span class="font-bold text-gray-700">Price</span>
                    <input type="text" name="price" id="price" class="
                        mt-1
                        block
                        w-full
                        rounded-md
                        bg-gray-100
                        border-transparent
                        focus:border-gray-500 focus:bg-white focus:ring-0
                        placeholder:opacity-50
                    " placeholder="10.00">
                </label>
                <label>
                    <span class="font-bold text-gray-700">Product Type</span>
                    <select name="productType" id="productType" onchange="property(this.value)"
                    class="
                        block
                        w-full
                        mt-1
                        rounded-md
                        bg-gray-100
                        border-transparent
                        focus:border-gray-500 focus:bg-white focus:ring-0
                    ">
                        <option value="" disabled selected hidden>Choose a type...</option>
                        <option>DVD</option>
                        <option>Furniture</option>
                        <option>Book</option>
                    </select>
                </label>
            </div>
        </div>
        <div id="property" class="max-w-xs m-12">
            
        </div>
    </form>
    <script src="main.js"></script>
</body>
<!-- FEATURE: Maybe add a simple footer? -->

</html>
<?php 

if(isset($_POST["SKU"]) || isset($_POST["name"]) || isset($_POST["price"]) || isset($_POST["productType"])){
    // TODO: Add these cheecks into the Product class. This will allow us later on to add more checks.
    // When making a product object make sure you are using the values of the $_POST and not the values you are using for checks.

    $sku = Product::checkProductSKU($_POST["SKU"]);
    $name = Product::checkProductName($_POST["name"]);
    $price = Product::checkProductPrice($_POST["price"]);
    // $productType = Product::checkProductType($_POST["productType"]);
    // $propertyValue = Product::checkProductPropertyValue($_POST["propertyValue"]);

    // I don't know why the previous 2 lines won't work, but this seems to fix it. Looks ugly though maybe I should refactor this, later.
    if(isset($_POST["productType"]) && isset($_POST["propertyValue"])){
        $productType = Product::checkProductType($_POST["productType"]);
        $propertyValue = Product::checkProductPropertyValue($_POST["propertyValue"]);
    } else {
        $productType = 0;
        $propertyValue = 0;
    }

    // This is to basically print out error messages. Could've I used PHP for this and made it simpler? Probably. 
echo '
<script type="text/javascript">
verifyFields('.$sku.', '.$name.', '.$price.', "'.$productType.'", '.$propertyValue.');
</script>
';


    $productType = strlen($productType) > 1 ? 1 : 0; // This is to set a boolean value for the product type. 

    if($sku == 1 && $name == 1 && $price == 1 && $productType == 1 && $propertyValue == 1){
        $sku = $_POST["SKU"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $productType = $_POST["productType"];
        $propertyValue = $_POST["propertyValue"];

        $newProduct = Product::createProductObject($name, $sku, $productType, $price, $propertyValue);
        if(isset($newProduct)){
            if($newProduct->insertToDB()){
                header("Location: ../index.php");
            } else {
                echo "If this message appears then I have no idea what happened and I'll probably attempt to fix it for a long time.";
            }
        }
    }
}

?>