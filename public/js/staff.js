// get url parameters
const getUrlParameter = function getUrlParameter(sParam) {
    let sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
}

const UnitTag = ["Kg", "g", "L", "ml", "Unit"];
// const ShopType =["Vegetable","Fruit","Grocery","Fish","Meat"];
const ItemType = ['Vegetables', 'Fruits', 'Grocery', 'Fish', 'Meat'];

const host = window.location.origin; //http://domainname

//Api links
const URLItemsAPI = host + "/api/items";
const URLItemAPI = host + "/api/item";
const ItemTable = document.getElementById('item-table');

$(document).ready(function () {
    $(".btn-tab").click(function () {
        $('#item-table').empty();
        let URLFindItems = URLItemsAPI.concat($(this).data("href"));
        $.getJSON(URLFindItems, function (Items) {
            Items.forEach(Item => {
                    const itemRow = document.createElement('ul');
                    itemRow.classList.add('row');
                    itemRow.innerHTML = `
                 <li id="ItemImage" class="row-img">
                    <img src="${Item.ItemImage}" alt="" />
                </li>
                <li id="Name" class="row-name">${Item.Name}</li>
                <li id="Brand" class="row-brand">${Item.Brand}</li>
                <li id="Unit" class="row-unit">${Item.Unit}</li>
                <li id="UWeight" class="row-minWeight">${Item.UWeight}</li>
                <li id="MRP" class="row-mrp">${Item.MRP}</li>
                <li id="MaxCount" class="row-IncStep">${Item.MaxCount}</li>
                <li class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </li>
                `
                    ItemTable.appendChild(itemRow);
                }
            )
        })
    })
    $('#btn-vege').trigger('click');
})

// const Category = document.getElementById('Category');
// const Name = document.getElementById('Name');
// const ItemImage = document.getElementById('ItemImage');
// const Brand = document.getElementById('Brand');
// const Unit = document.getElementById('Unit');
// const UWeight = document.getElementById('UWeight');
// const MaxCount = document.getElementById('MaxCount');
// const MRP = document.getElementById('MRP');

const itemBtns = document.getElementsByClassName('btn-row');
// console.log(itemBtns);
$(itemBtns).click(function () {
    console.log(this);
    const URLFindItem = URLItemAPI.concat($(this).data("href"));
    console.log(URLFindItem);
    $.getJSON(URLFindItem, function (Item) {
        console.log(Item);
        $('#Category').val(Item.Category);
        console.log(document.getElementById('Category').value);
        $('#Unit').val(Item.Unit);
        console.log(document.getElementById('Unit').value);
        $("#Name").val(Item.Name);
        console.log(document.getElementById('Name'));
        $('#ItemImage').val(Item.ItemImage);
        console.log(document.getElementById('ItemImage'));
        $('#Brand').val(Item.Brand);
        console.log(document.getElementById('Brand').value);
        $('#UWeight').val(Item.UWeight);
        console.log(document.getElementById('UWeight').value);
        $('#MaxCount').val(Item.MaxCount);
        console.log(document.getElementById('MaxCount').value);
        $('#MRP').val(Item.MRP);
        console.log(document.getElementById('MRP').value);
    })
});









