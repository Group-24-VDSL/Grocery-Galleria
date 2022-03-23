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
        // var table = $('#shop-products').DataTable();
        // table.destroy() ;

    $.getJSON(URLGetShop, function (Shops) {

        Shops.forEach(Shop => {
            // itemRow.classList.add('row');
            const URLShopItems = URLFindItemsAPI.concat("?ItemID=").concat(Shop.ItemID);
            console.log(URLShopItems);
            // // document.getElementById("itemUpdate-shop").style.gridAutoColumns="100px" ;
            // document.getElementById('itemUpdate-sho').setAttribute("style","gridAutoColumns:100px");

            $.getJSON(URLShopItems, function (Items) {
                    Items.forEach(Item => {
                        let UnitSymbol ;
                            switch (Item.Unit){
                        case 0 : UnitSymbol = 'Kg' ;
                            break ;
                        case 1 : UnitSymbol = 'g' ;
                            break ;
                        case 2 : UnitSymbol = 'l' ;
                            break ;
                        case 3 : UnitSymbol = 'Unit' ;
                            break ;
                        }

                        if(!Item.Brand ){
                            toString(Item.Brand ) ;
                            Item.Brand = "-";
                        }
                        if (Shop.Enabled ===0){
                            Shop.Enabled  = '<i style="color: red" class="fa fa-circle" aria-hidden="true"></i>' ;
                        }
                        else {
                            Shop.Enabled  = '<i style="color: lawngreen" class="fa fa-circle" aria-hidden="true"></i>' ;
                        }

                            const ItemRow = document.createElement('tr');

                            ItemRow.innerHTML = `



                 <td id="ItemImage" class="row-img"><img src="${Item.ItemImage}" alt="${Item.Name}" /> </td>
                <td id="Name" class="row-name">${Item.Name}</td>          
                <td id="Brand" class="row-brand">${Item.Brand}</td>
                <td id="Unit" class="row-unit">${UnitSymbol}</td>
                <td id="UWeight" class="row-minWeight">${Item.UWeight}</td>
                <td id="MRP" class="row-mrp">${Item.MRP}</td>
                <td id="UPrice" class="row-uprice">${Shop.UnitPrice}</td>
                <td id="Stock" class="row-stock">${Shop.Stock}</td>
                <td id="Enable" class="row-enable">${Shop.Enabled}</i></td>
                <td class="row-ubutton">
                    <button data-href="${Shop.ItemID}" class="btn-row" onclick="shopItemUpdate(${Shop.ItemID},${Shop.ShopID})">Update</button></a>
                </td>               
                `
                            ItemTable.appendChild(ItemRow);

                        })
                }).then(function (){
                $('#shop-products').DataTable();
            })
        })
    })
});

function  setDataTable(){
    // var table = $('#shop-products').DataTable();
    // table.destroy() ;
    // $('#shop-products').DataTable();
}

function shopItemUpdate(itemID, shopID){

    const GetShopItem = URLShopItemAPI.concat("?ItemID=").concat(itemID).concat("&ShopID=").concat(shopID);
    const GetItem =  URLFindItemAPI.concat("?ItemID=").concat(itemID);

    $.getJSON(GetItem, function (Item) {
        $.getJSON(GetShopItem, function (ShopItem) {
            console.log(ShopItem.Enabled);
            document.getElementById("updateID").textContent= ShopItem.ItemID;
            document.getElementById("updateName").textContent= Item.Name;
            $('input[id=ShopID]').val(ShopItem.ShopID);
            $('input[id=ItemID]').val(ShopItem.ItemID);
            $('img[id=updateImage]').attr('src',Item.ItemImage);
            $('input[id=Stock]').val(ShopItem.Stock);
            $('input[id=UnitPrice]').val(ShopItem.UnitPrice);

            if (ShopItem.Enabled === 1){
                document.getElementById("checkbox1").checked = true;
            }
            else {
                document.getElementById("checkbox1").checked = false;
            }

            $("#checkbox1").on('change', function(){
                if ($('#checkbox1').is(':checked')) {
                    $('input[id=Enabled]').val(1);
                    console.log("checked=1")
                }
                else {
                    $('input[id=Enabled]').val(0);
                    console.log("unchecked=0")
                }
            })

        });
    });
}

