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
    <script src="jquery-3.6.0.min.js"></script>
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
                <input form="product_form" onclick="return submitClick();" type="Button" value="Save" class="text-lg font-medium bg-green-300 text-gray-700 py-1 px-4 mx-12 rounded-full hover:cursor-pointer">
                <a class="text-lg font-medium bg-red-400 text-gray-700 py-1 px-4 rounded-full" href="../index.php">Cancel</a>
            </div>
        </div>
    </nav>
    <form id="product_form" action="#" class="grid grid-cols-2 gap-6 items-center max-w-[80%]">
        <!-- TODO: Add icons for the input fields-->
        <div class="max-w-s m-12">
            <div class="grid gap-6">
                <label class="block">
                    <span class="font-bold text-gray-700">
                        SKU#
                    </span>
                    <span class="ml-10 text-red-500 text-xs"></span>
                    <input type="text" name="sku" id="sku" class="
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
                    <span class="ml-10 text-red-500 text-xs"></span>
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
                    <span class="ml-10 text-red-500 text-xs"></span>
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
                    <span class="ml-10 text-red-500 text-xs"></span>
                    <select name="productType" id="productType" onchange="propertyDisplay(this.value)" class="
                        block
                        w-full
                        mt-1
                        rounded-md
                        bg-gray-100
                        border-transparent
                        focus:border-gray-500 focus:bg-white focus:ring-0
                    ">
                        <option value="" selected hidden>Choose a type...</option>
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



?>