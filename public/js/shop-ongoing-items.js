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
const URLShopItemsAPI = host + "/api/shopitems";
const URLShopItemAPI = host + "/api/shopitem" ;
const URLFindItemAPI = host + "/api/items";
const URLItemAPI = host + "/api/item" ;

const URLAddtoCartAPI = host + "/api/addtocart";
const URLGetCartAPI = host + "/api/getcart";
const URLUpdateItem = host+ "/api/updateshopitem"


const URLGetCart = URLGetCartAPI.concat('?CustomerID=').concat('2');
const URLGetShop = URLShopItemsAPI.concat('?ShopID=').concat('5');

const ItemTable = document.getElementById('item-table');
const ItemUpdate = document.getElementById('updateItem');

let i = 0 ;
let itemArray = [];


$(document).ready(function () {

    $.getJSON(URLGetShop, function (Shops) {
        Shops.forEach(Shop => {
            const URLShopItems = URLFindItemAPI.concat("?ItemID=").concat(Shop.ItemID);
            $.getJSON(URLShopItems, function (Items) {
                Items.forEach(Item => {
                    if (Shop.Enabled ===0)
                    {
                        if(!Item.Brand ){
                          toString(Item.Brand ) ;
                          Item.Brand = "-";
                        }

                        const ItemRow = document.createElement('tr');
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
                                <td id="UPrice" class="row-uprice"><input type="number" id="uPrice_${Shop.ShopID}_${Shop.ItemID}" name="uPrice${Shop.ShopID}${Shop.ItemID}" min="1" max="${Item.MRP}" value="${Shop.UnitPrice}" step="5" data-unitPrice="${Shop.UnitPrice}"></td>
                                <td id="Stock" class="row-stock"><input type="number" id="stock_${Shop.ShopID}_${Shop.ItemID}" name="stock${Shop.ShopID}${Shop.ItemID}" min="5" max="${Item.MRP}" value="${Shop.Stock}" step="5" data-stock="${Shop.Stock}"></td>                                                              
                                `
                        ItemTable.appendChild(ItemRow);

                        let x  = 'uPrice_'.concat(Shop.ShopID).concat('_').concat(Shop.ItemID);
                        let y  = 'stock_'.concat(Shop.ShopID).concat('_').concat(Shop.ItemID);

                        let itemArray = {};

                        itemArray['ShopID'] = Shop.ShopID ;
                        itemArray['ItemID'] = Shop.ItemID ;
                        itemArray['uPriceID'] = x ;
                        itemArray['stockID'] = y ;

                        i = i+1 ;

                        setItemArray(itemArray);
                    }
                })

            })

        })

    })

});



