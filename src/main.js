import $ from '../node_modules/jquery';

function property(value){

    prop = document.getElementById('property');

    if(value == 'Furniture'){
        html = `
    <label class="block">
        <span class="font-bold text-gray-700">Height (CM)</span>
        <input type="text" id="height" name="propertyValue[]" class="
            mt-1
            block
            w-full
            rounded-md
            bg-gray-100
            border-transparent
            focus:border-gray-500 focus:bg-white focus:ring-0
            placeholder:opacity-50
        " placeholder="15">
    </label>
    <label class="block mt-5 mb-5">
        <span class="font-bold text-gray-700">Width (CM)</span>
        <input type="text" id="width" name="propertyValue[]" class="
            mt-1
            block
            w-full
            rounded-md
            bg-gray-100
            border-transparent
            focus:border-gray-500 focus:bg-white focus:ring-0
            placeholder:opacity-50
        " placeholder="3">
    </label>
    <label class="block">
        <span class="font-bold text-gray-700">Length (CM)</span>
        <input type="text" id="length" name="propertyValue[]" class="
            mt-1
            block
            w-full
            rounded-md
            bg-gray-100
            border-transparent
            focus:border-gray-500 focus:bg-white focus:ring-0
            placeholder:opacity-50
        " placeholder="25">
    </label>
    <div class="mt-5">
        <p>Provide the furniture dimensions</p>
    </div>`
    }

    // default property field
    else{
        var propName; var propPlaceHolder; var propDesc;
        if(value == 'DVD'){
            propName = "Size (MB)"; propPlaceHolder = "200"; propDesc = "Provide the DVD size in megabytes"; propID = "size";
        } else if(value == 'Book'){
            propName = "Weight (KG)"; propPlaceHolder = "2"; propDesc = "Provide the Book size in kilograms"; propID = "weight";
        }

        html = `
        <label class="block">
            <span class="font-bold text-gray-700">${propName}</span>
            <input type="text" id=${propID} name="propertyValue" class="
                mt-1
                block
                w-full
                rounded-md
                bg-gray-100
                border-transparent
                focus:border-gray-500 focus:bg-white focus:ring-0
                placeholder:opacity-50
            " placeholder="${propPlaceHolder}">
        </label>
        <div class="mt-5">
            <p>${propDesc}</p>
        </div>
        `;
    }

    prop.innerHTML = html;
}

var finalCheckedList = [];  // Global list of the checked items

function checkItem(SKU){
    var item = document.getElementById(SKU);
    var checkBox = document.getElementById(SKU + '-checkbox');

    if(checkBox.checked){
        item.classList.add("bg-red-400");
        item.setAttribute("name","checked");
    }
    else{
        finalCheckedList.splice(finalCheckedList.indexOf(SKU),1);  // Removes the element from the array

        // Resets the item attributes to the defaults
        item.removeAttribute("name");
        item.classList.remove("bg-red-400");
        item.classList.add("bg-white");
    }


    // Updates the finalCheckedList
    var checkedList = document.getElementsByName("checked");

    checkedList.forEach(
        function(currentValue) {
          finalCheckedList.push(currentValue.id);
          finalCheckedList = [...new Set(finalCheckedList)];
        }
      );

    if(finalCheckedList.length > 1){
        var btn = document.getElementById("delete-product-btn");
        // btn.setAttribute("value","Mass Delete");
        //btn.innerHTML = "MASS DELETE";  // Had to remove this to for the AutoQA to work
        btn.classList.remove("bg-red-400");
        btn.classList.add("bg-red-500");
    }
    else{
        var btn = document.getElementById("delete-product-btn");
        //btn.innerHTML = "Delete";
        btn.classList.remove("bg-red-500");
        btn.classList.add("bg-red-400");
    }

    document.cookie = "checkedList=" + finalCheckedList;
}

function checkedArray(){
    return finalCheckedList;
}

// SKU: 0, empty | 1, OK | -1, duplicate
// name: 0, empty | 1, OK
// price: 0, empty | 1, OK
// type: 0, empty | DVD | Furniture | Book
// property: 0, empty | 1, OK
function verifyFields(SKU, name, price, type, property){
    var skuElementLabel = document.getElementById("sku").previousElementSibling;
    var nameElementLabel = document.getElementById("name").previousElementSibling;
    var priceElementLabel = document.getElementById("price").previousElementSibling;
    var propertyType = document.getElementById("productType").previousElementSibling;
    var propertyElement = document.getElementById("property");
    
    console.log(type);
    console.log(property);

    if(SKU == 0){
        skuElementLabel.insertAdjacentHTML("beforeend", `<span class="ml-10 text-red-500 text-xs ">* SKU number is required</span>`);
    }

    if(name == 0){
        nameElementLabel.insertAdjacentHTML("beforeend", `<span class="ml-10 text-red-500 text-xs ">* Name is required</span>`);
    }

    if(price == 0){
        priceElementLabel.insertAdjacentHTML("beforeend", `<span class="ml-10 text-red-500 text-xs ">* Price is required</span>`);
    }

    if(type == 0){
        propertyType.insertAdjacentHTML("beforeend", `<span class="ml-10 text-red-500 text-xs ">* Type is required</span>`);
    }


    if(type == "Furniture" && property == 0){
        propertyElement.innerHTML = `<span class="ml-10 text-red-500 text-xs ">* All Furniture dimensions are required, please enter them again.</span>`
    }
    else if(type == "DVD" && property == 0){
        propertyElement.innerHTML = `<span class="ml-10 text-red-500 text-xs ">* DVD size is required, please enter it again.</span>`
    }
    else if(type == "Book" && property == 0){
        propertyElement.innerHTML = `<span class="ml-10 text-red-500 text-xs ">* Book weight is required, please enter it again.</span>`
    }

}

