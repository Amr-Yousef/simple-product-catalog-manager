<?php
require_once "../classes/DBController.php";
require_once "../classes/Product.php";
require_once "../classes/Book.php";
require_once "../classes/DVD.php";
require_once "../classes/Furniture.php";
// TODO: Move this file to the main directory (outside of the src folder)
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
                <a class="text-lg font-medium bg-green-300 text-gray-700 py-1 px-4 mx-12 rounded-full" href="#">Save</a>
                <a class="text-lg font-medium bg-red-400 text-gray-700 py-1 px-4 rounded-full" href="#">Cancel</a>
            </div>
        </div>
    </nav>
    <div class="grid grid-cols-2 gap-6 items-center max-w-[80%]">
        <!-- TODO: Add icons for the input fields-->
        <div class="max-w-s m-12">
            <div class="grid gap-6">
                <label class="block">
                    <span class="font-bold text-gray-700">SKU#</span>
                    <input type="text" class="
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
                    <input type="text" class="
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
                    <input type="text" class="
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
                    <select onchange="property(this.value)"
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
    </div>
    <script src="main.js"></script>
</body>
<!-- FEATURE: Maybe add a simple footer? -->

</html>
<?php  ?>