function property(value){

    prop = document.getElementById('property');

    if(value == 'Furniture'){
        html = `
    <label class="block">
        <span class="font-bold text-gray-700">Height (CM)</span>
        <input type="text" class="
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
        <input type="text" class="
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
        <input type="text" class="
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
            propName = "Size (MB)"; propPlaceHolder = "200"; propDesc = "Provide the DVD size in megabytes";
        } else if(value == 'Book'){
            propName = "Weight (KG)"; propPlaceHolder = "2"; propDesc = "Provide the Book size in kilograms";
        }

        html = `
        <label class="block">
            <span class="font-bold text-gray-700">${propName}</span>
            <input type="text" class="
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
        btn.innerHTML = "Mass delete";
        btn.classList.remove("bg-red-400");
        btn.classList.add("bg-red-500");
    }
    else{
        var btn = document.getElementById("delete-product-btn");
        btn.innerHTML = "Delete";
        btn.classList.remove("bg-red-500");
        btn.classList.add("bg-red-400");
    }
}