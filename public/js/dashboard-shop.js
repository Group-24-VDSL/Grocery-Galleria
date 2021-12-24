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


const URLShopItemsAPI = host + "/api/shopitems";
const URLShopItemAPI = host + "/api/shopitem";
const URLFindItemsAPI = host + "/api/items";
const URLFindItemAPI = host + "/api/item";

const URLGetShop = URLShopItemsAPI.concat('?ShopID=').concat('5');

const ItemTable = document.getElementById('item-table');
// ItemTable.classList.add('item-table-body body-half-screen');

$(document).ready(function () {
    $.getJSON(URLGetShop, function (Shops) {
        Shops.forEach(Shop => {
            // itemRow.classList.add('row');
            const URLShopItems = URLFindItemsAPI.concat("?ItemID=").concat(Shop.ItemID);
            console.log(URLShopItems);

            $.getJSON(URLShopItems, function (Items) {
                    Items.forEach(Item => {

                        if(!Item.Brand ){
                            toString(Item.Brand ) ;
                            Item.Brand = "-";
                        }

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
                <td id="Enable" class="row-enable">${Shop.Enabled}</td>
                <td class="row-ubutton">
                    <button data-href="${Shop.ItemID}" class="btn-row" onclick="shopItemUpdate(${Shop.ItemID})">Update</button></a>
                </td>
                
                `
                            ItemTable.appendChild(ItemRow);
                            console.log(Item.Name)
                        }
                    )
                }
            )


        });
    }
    )
;});

function shopItemUpdate(itemID){
    console.log(itemID);
    const GetShopItem = URLShopItemAPI.concat("?ItemID=").concat(itemID);
    const GetItem =  URLFindItemAPI.concat("?ItemID=").concat(itemID);
    console.log(GetShopItem)
    console.log(GetItem)

    $.getJSON(GetItem, function (Item) {
        $.getJSON(GetShopItem, function (ShopItem) {
            document.getElementById("updateID").textContent= ShopItem.ItemID;
            document.getElementById("updateName").textContent= Item.Name;
            $('#updateImage').attr('src',Item.ItemImage);
            $('input[id=Stock]').val(ShopItem.Stock);
            $('input[id=UnitPrice]').val(ShopItem.UnitPrice);
        });
    });
    // $("#").innerHTML("jj")


}

