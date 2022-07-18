<?php 
require_once "classes/DBController.php";
require_once "classes/Product.php";
require_once "classes/Book.php";
require_once "classes/DVD.php";
require_once "classes/Furniture.php";
// TODO: Move this file to the main directory (outside of the src folder)

ob_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="dist/output.css" rel="stylesheet">
  <title>Products List</title>
  <script src="./src/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="bg-white drop-shadow-lg px-6 py-4">
        <!-- Container div -->
        <div class="container flex flex-wrap justify-between items-center">
            <!-- Name -->
            <a class="font-sans font-medium text-2xl">Products list</a>
            
            <!-- FEATURE: Add search bar here -->

            <!-- Buttons -->
            <div class="grid grid-cols-2">
                <a class="text-lg font-medium bg-green-300 text-gray-900 py-1 px-4 mx-12 rounded-full" href="src/productadd.php">ADD</a>
                <form action="index.php" method="post" class="flex justify-around">
                    <button type="submit" value="Delete" class="text-lg font-medium bg-red-400 text-gray-900 py-1 px-4 rounded-full hover:cursor-pointer" href="#" id="delete-product-btn" name="delete-product-btn">MASS DELETE</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Card div -->
    <div class="grid grid-cols-4">
        <?php 
            $productsArray = Product::getAllProducts();  // I could probably use Ajax for this too now that I know more about it. 
            foreach ($productsArray as $product) { 
                echo '
                <label id="'.$product->getSKU().'" class="rounded-3xl bg-white shadow-lg w-80 h-80 m-12 p-7 ease-in-out duration-500  hover:scale-110 hover:bg-red-400 hover:shadow-red-600 hover:shadow-2xl hover:cursor-pointer ">
                <!-- Main list -->
                <div class="grid grid-cols-1 grid-rows-4 gap-5">
                    <div class="grid grid-cols-2 grid-rows-1">
                        <div>
                            <div class="text-lg font-medium opacity-50 mb-[-0.5rem]">
                                SKU
                            </div>
                            <div class="text-xl font-bold">
                                '.$product->getSKU().'
                            </div>
                        </div>
                        <div>
                            <input type="checkbox" class="rounded float-right checked:bg-red-800" onclick="checkItem(\''.$product->getSKU().'\')" id="'.$product->getSKU().'-checkbox">
                        </div>
                    </div>
                    <div>
                        <div class="text-lg font-medium opacity-50 mb-[-0.5rem]">
                            NAME
                        </div>
                        <div class="text-xl font-bold">
                            '.$product->getName().'
                        </div>
                    </div>
                    <div class="grid grid-cols-2 grid-rows-1">
                        <div>
                            <div class="text-lg font-medium opacity-50 mb-[-0.5rem]">
                                TYPE
                            </div>
                            <div class="text-xl font-bold">
                                '.$product->getType().'
                            </div>
                        </div>
                        <div class="flex flex-col content-center items-center">
                            <div class="text-lg font-medium opacity-50 mb-[-0.5rem]">
                                PRICE
                            </div>
                            <div class="text-xl font-bold">
                                $'.$product->getPrice().' 
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-lg font-medium opacity-50 mb-[-0.5rem]">
                            '.$product->getPropertyName().'
                        </div>
                        <div class="text-xl font-bold">
                            '.$product->getPropertyValue().'
                        </div>
                    </div>
                </div>
            </label>
                ';
            }
        ?>
    </div>
    <script type="module" src="src/main.js"></script>
</body>
<!-- FEATURE: Maybe add a simple footer? -->
</html>
<?php

if(isset($_POST["delete-product-btn"])){

    $arr = explode(",", $_COOKIE["checkedList"]);
    
    Product::massDeleteProduct($arr);

    header("Location: index.php");
}

?>