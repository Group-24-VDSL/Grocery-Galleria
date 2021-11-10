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

const host = window.location.origin; //http://domainname

//Api links

const URLShopAPI = host + "/api/shop";
const URLShopItemAPI = host + "/api/shopitems";
const URLFindItemAPI = host + "/api/items";

const URLAddtoCartAPI = host + "/api/addtocart";
const URLGetCartAPI = host + "/api/getcart";


const URLGetCart = URLGetCartAPI.concat('?CustomerID=').concat('2');
const URLGetShop = URLShopItemAPI.concat('?ShopID=').concat('5');

const ItemTable = document.getElementById('item-table');
// ItemTable.classList.add('item-table-body body-half-screen');

$(document).ready(function () {
    $.getJSON(URLGetShop, function (Shops) {
        Shops.forEach(Shop => {
            // itemRow.classList.add('row');
            const URLShopItems = URLFindItemAPI.concat("?ItemID=").concat(Shop.ItemID);
            console.log(URLShopItems);

            $.getJSON(URLShopItems, function (Items) {
                    Items.forEach(Item => {

                            const ItemRow = document.createElement('tr');
                            // itemRow.classList.add('tr');
                            ItemRow.innerHTML = `
                 <td></td>
                 <td id="Name" class="row-name">${Shop.ItemID}</td>
                 <td id="ItemImage" class="row-img">
                    <img src="${Item.ItemImage}" alt="${Item.Name}" />
                </td>
                <td id="Name" class="row-name">${Item.Name}</td>
                <td id="Brand" class="row-brand">${Item.Brand}</td>
                <td id="Unit" class="row-unit">${Item.Unit}</td>
                <td id="UWeight" class="row-minWeight">${Item.UWeight}</td>
                <td id="MRP" class="row-mrp">${Item.MRP}</td>
                <td id="UPrice" class="row-uprice">${Shop.UnitPrice}</td>
                <td id="Stock" class="row-stock">${Shop.Stock}</td>
                <td id="Enable" class="row-enable">${Shop.Enable}</td>
                <td class="row-ubutton">
                    <a  class="btn-row" type="submit">Update</a>
                </td>
                
                `
                            ItemTable.appendChild(ItemRow);
                        }
                    )
                }
            )


        });
    }
    )
;});


