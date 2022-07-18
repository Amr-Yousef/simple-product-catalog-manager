
function isNumeric(str) {
    if (typeof str != "string")
        return false;

    return !isNaN(str) && !isNaN(parseFloat(str));
}

function submitClick(){
    form = $('#product_form').serializeArray();

    // There should be a better way to do this but I will need to revisit it later because I can't think of a better way currently
    let sendFlag = false;
    let counter = 0;
    $.each(form, function(i, field){
        if(require(field.name, field.value))
            counter++;
        
        if(counter == form.length)
            sendFlag = true;
    });

    if(sendFlag){
        let propertiesArr = JSON.stringify(propertiesArray());
    
        $.ajax({
            url: "../process/addproduct.php",
            type: "POST",
            data: {
                sku: $("#sku").val(),
                name: $("#name").val(),
                price: $("#price").val(),
                type: $("#productType").val(),
                propArr: propertiesArr
            },
            success: function(res){
                window.location.replace("../index.php");
            }
        });
    }    
    return false;
}

function require(fieldName, text){
    // Something about the multiple returns I have is making me think I am missing something
    // TODO: Take a look at this after being done with everything else

    let field = document.getElementById(fieldName);
    let fieldLabel;
    if(field != null){
        fieldLabel = field.previousElementSibling;

        if(text.length < 1){
            fieldLabel.innerHTML = "* This field is required";
            return false;
        }
        else{
            fieldLabel.innerHTML = "";
        }
    }

    if(fieldLabel == null){  // The more property fields we have, the more this check happens, it's definitely a bug that needs fixing, later, however.
        let propValues = document.getElementsByName("propertyValue");
        
        for(let i = 0; i < propValues.length; i++){
            let propValueLabel = propValues[i].previousElementSibling;
            let propValue = propValues[i].value;
            
            if(propValue.length < 1){
                propValueLabel.innerHTML = "* This field is required";
                return false;
            }
            else if (!isNumeric(propValue)){
                propValueLabel.innerHTML = "* This field must be a number";
                return false;
            } else {
                propValueLabel.innerHTML = "";
            }
            
        }
    }
    
    // Checks if SKU is already in the database
    if(fieldName == "sku"){
        skuFlag = true;
        $.ajax({
            url: "../process/skuCheck.php",
            type: "POST",
            data: {sku: text},
            async: false,
            success: function(res){
                if(res == -1){
                    document.getElementById(field.name).previousElementSibling.innerHTML = "* This SKU already exists";
                    skuFlag = false;
                }
            }
        });
        return skuFlag;
    }

    if(fieldName == "price" && text != ""){
        if(!isNumeric(text)){
            document.getElementById(field.name).previousElementSibling.innerHTML = "* This field must be a number";
            return false;
        }
    }

    return true;
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

function propertiesArray(){
    arr = [];
    $.each(document.getElementsByName("propertyValue"), function(i, field){
        arr.push(field.value);
    }
    );
    return arr;
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