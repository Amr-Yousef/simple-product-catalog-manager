// TODO: REMOVE THIS LATER
$(document).ready(function(){
    $('p').hide();
});

function submitClick(){
    form = $('#product_form').serializeArray();
    console.log(form);

    $.each(form, function(i, field){
        require(field.name, field.value);
    });
    
    
    
    // $.ajax({
    //     url: "../process/addproduct.php",
    //     type: "POST",
    //     data: {
    //         sku: $("#sku").val(),
    //         name: $("#name").val(),
    //         price: $("#price").val()
    //     },
    //     success: function(){
    //         // alert("sent");
    //     }
    // });
    return false;
}

function require(fieldName, text){
    console.log(fieldName);
    console.log(text);

    let field = document.getElementById(fieldName);
    let propValues = document.getElementsByName("propertyValue");
    let fieldLabel = field.previousElementSibling;

    $.each(propValues, function(i, value){
        propValueLabel = value.previousElementSibling;
        if(value.value == ""){
            propValueLabel.innerHTML = "* This field is required";
        }
        else{
            propValueLabel.innerHTML = "";
        }
    }
    );
    
    if(text.length < 1){
        fieldLabel.innerHTML = "* This field is required";
    }
    else{
        fieldLabel.innerHTML = "";
    }

    if(fieldName == "sku"){
        $.ajax({
            url: "../process/skuCheck.php",
            type: "POST",
            data: {sku: field.value},
            success: function(res){
                if(res == -1){
                    document.getElementById(field.name).previousElementSibling.innerHTML = "* This SKU already exists";
                }
            }
        });
    }


}

function propertyDisplay(value){

    prop = document.getElementById('property');

    $.ajax({
        url: "../process/propertyDisplay.php",
        type: "POST",
        data: {productType: value},
        success: function(res){
            let properties = JSON.parse(res);
            let description = properties.pop();
            
            html = ''; 
            $.each(properties, function(i, value){
                let name = value[0].charAt(0).toUpperCase() + value[0].slice(1);    // Capitalizes the first letter of the property name
                let unit = value[1];
                let placeholder = value[2];

                html +=
                `<label class="block m-5">
                <span class="font-bold text-gray-700">${name} (${unit.toUpperCase()})</span>
                <span class="ml-10 text-red-500 text-xs"></span>
                <input type="text" id="${name}" name="propertyValue" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    bg-gray-100
                    border-transparent
                    focus:border-gray-500 focus:bg-white focus:ring-0
                    placeholder:opacity-50
                " placeholder="${placeholder}">
                </label>`

            })
            html += `
            <div class="m-5">
                <p>${description}</p>
            </div>
            `
            prop.innerHTML = html;
        }
    });
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
        // btn.innerHTML = "MASS DELETE";  // Had to remove this to for the AutoQA to work
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

