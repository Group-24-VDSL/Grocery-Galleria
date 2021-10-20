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
const ShopType =["Vegetable","Fruit","Grocery","Fish","Meat"];


const host = window.location.origin; //http://domainname

//Api links
const URLItemsAPI = host+"/api/items";
const ItemTable = document.getElementById('item-table');

$(document).ready(function (){
     $(".btn-tab").click(function ()
    {   $('#item-table').empty();
        let URLFindItems = URLItemsAPI.concat($(this).data("href"));
        console.log(URLFindItems);
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
                    <a  class="btn-row" type="submit">Update</a>
                </li>
                `
                    ItemTable.appendChild(itemRow);
                }
            )
        })

})
    $('#btn-vege').trigger('click');
})




