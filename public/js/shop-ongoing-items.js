
//Api links

const URLShopAPI = host + "/api/shop";
const URLShopItemsAPI = host + "/api/shopitems";
const URLShopItemAPI = host + "/api/shopitem" ;
const URLFindItemAPI = host + "/api/items";
const URLItemAPI = host + "/api/item" ;
const  URLShopOrderAPI = host+ "/api/getshoporder" ;
const URLGetCartAPI = host + "/api/getcart";
const URLUpdateItem = host+ "/api/updateshopitem" ;
const URLGetOrderCart = host+ "/api/getordercart" ;
const URLSafetyStock = host+ "/api/getsafetystock" ;
const ShopID =  host + "/api/getshopid";

const ItemTable = document.getElementById('item-table');
const ItemUpdate = document.getElementById('updateItem');

let itemArray = [];

$(document).ready(function () {

    window.setTimeout( function() {
            window.location.reload();
        },600000) ;


    $.getJSON(ShopID, function (shopID) {

    const URLGetShop = URLShopItemsAPI.concat('?ShopID=').concat(shopID);

    $.getJSON(URLGetShop, function (Shops) {

        var table = $('#ongoing-item-table').DataTable();
        table.destroy() ;

        Shops.forEach(Shop => {
            const URLShopItems = URLFindItemAPI.concat("?ItemID=").concat(Shop.ItemID);

            $.getJSON(URLShopItems, function (Items) {


                Items.forEach(Item => {
                    Items.sort();
                    let MaxPrice
                    console.log( Shop)
                    if (Shop.Enabled == 1 && Shop.Stock*Item.UWeight >= Shop.MinStock  )
                    {
                        if(!Item.Brand ){
                            toString(Item.Brand ) ;
                            Item.Brand = "-";
                        }

                        if(Item.Category == 0) {
                            MaxPrice = Item.MRP ;
                        }
                        else {
                            MaxPrice = '' ;
                        }

                        let Unit =  (Item.Unit == 0)   ? "Kg"   : (Item.Unit ==1) ? "L" : "U";

                        let Stock = (Item.Unit == 0 || Item.Unit == 1) ? Shop.Stock * Item.UWeight : Shop.Stock  ;



                        const ItemRow = document.createElement('tr');
                        ItemRow.innerHTML = `
                                
                                <td id="Name" class="row-name">${Shop.ItemID}</td>
                                <td id="ItemImage" class="row-img"><img src="${Item.ItemImage}" alt="${Item.Name}" /></td>
                                <td id="Name" class="row-name">${Item.Name}</td>                                
                                <td id="Brand" class="row-brand">${Item.Brand}</td>
                                <td id="UWeight" class="row-minWeight">${Item.UWeight} ${Unit}</td>
                                <td id="MRP" class="row-mrp">${Item.MRP}</td>
                                <td id="UPrice" class="row-uprice">Rs. <input onchange = "errorDisplay(${Shop.ItemID},${Shop.ShopID},${Item.Category}, ${Item.MRP})" class="input-space" type="number" id="uPrice_${Shop.ShopID}_${Shop.ItemID}" name="uPrice${Shop.ShopID}${Shop.ItemID}" min="1" max="${Item.MRP}" value="${Shop.UnitPrice}" step="5" data-unitPrice="${Shop.UnitPrice}"></td>
                                <td id="Min_stock_${Shop.ShopID}_${Shop.ItemID}" class="row-stock"> ${Shop.MinStock} ${Unit}</td>                                                              
                                <td id="Field_stock_${Shop.ShopID}_${Shop.ItemID}" class="row-stock"><input class="input-space"  type="number" id="stock_${Shop.ShopID}_${Shop.ItemID}" name="stock${Shop.ShopID}${Shop.ItemID}" min="0" max="${MaxPrice}" value="${Stock}" step="5" data-stock="${Shop.Stock}"> ${Unit} </td>    
                                <td id="Safety_stock_${Shop.ShopID}_${Shop.ItemID}"></td>
                                <td id="ReOrder_point${Shop.ShopID}_${Shop.ItemID}"></td>
                                <td id="Safety_${Shop.ShopID}_${Shop.ItemID}"></td>
`
                        ItemTable.appendChild(ItemRow);

                        let u_priceID  = 'uPrice_'.concat(Shop.ShopID).concat('_').concat(Shop.ItemID);
                        let stockID  = 'stock_'.concat(Shop.ShopID).concat('_').concat(Shop.ItemID);

                        let itemArray = {};

                        itemArray['ShopID'] = Shop.ShopID ;
                        itemArray['ItemID'] = Shop.ItemID ;
                        itemArray['uPriceID'] = u_priceID ;
                        itemArray['stockID'] = stockID ;
                        itemArray['unitTag'] = Item.Unit ;
                        itemArray['unitWeight'] = Item.UWeight ;
                        itemArray['StockData'] = Shop.Stock;
                        itemArray['Enabled'] = Shop.Enabled ;
                        itemArray['MaxPrice'] = Item.MRP;

                        setItemArray(itemArray);
                    }
                })

            }).then(function (){
                // $('#ongoing-item-table').DataTable();
            })
        })
    })
    })

});

function setItemArray(Item){
    itemArray.push(Item);
    safetyStock(Item);
    $('#ongoing-item-table').DataTable();
}

function safetyStock(ShopItem){

    // new safety stock 2022 03 17
    let unit = '' ;
    switch (ShopItem.unitTag){
        case 0 : unit = "Kg" ; break ;
        case 1 : unit = "L" ; break ;
        case 2 : unit = "U" ; break ;
    }

    let obj = {"ShopID":ShopItem.ShopID , "ItemID":ShopItem.ItemID} ;
    console.log(ShopItem)

    $.ajax({
        url : URLSafetyStock,
        data : JSON.stringify(obj),
        type : 'POST',
        dataType:'json',
        processData: false,
        contentType : 'application/json'
    }).done(function (data){

        if (data["SafetyStock"]=== null || data["ReOrderPoint"] === null){
            data["SafetyStock"] = "1" ;
            data["ReOrderPoint"] = "1" ;
        }

        if (data["SafetyStock"]=== "0.000" ){
            data["SafetyStock"] = "1" ;
        }

        if ( data["ReOrderPoint"] === "0.000"){
            data["ReOrderPoint"] = "1" ;
        }

        document.getElementById('Safety_stock_'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = Math. ceil(data["SafetyStock"])+ " " + unit;
        document.getElementById('ReOrder_point'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = Math. ceil(data["ReOrderPoint"])+ " " + unit;

        let stock

        if(ShopItem.unitTag === 0 || ShopItem.unitTag === 1 ){
             stock  = ShopItem.StockData * ShopItem.unitWeight ;
        }
        else {
            stock = ShopItem.StockData ;
        }

        if(parseFloat(data["SafetyStock"]) <= stock){
            document.getElementById('Safety_'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = "<img src=\"https://img.icons8.com/emoji/30/26e07f/check-mark-button-emoji.png\"/>";
        }
        else {
            document.getElementById('Safety_'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = "<img src=\"https://img.icons8.com/office/30/000000/high-risk.png\"/>";
        }
    });

    // 2022 03 17

}

function updateShopItem(){
    const error_update = [] ;
    itemArray.forEach(item=>{

        console.log(item)

        let unitprice = $('#'.concat(item.uPriceID)).val();
        let stock = $('#'.concat(item.stockID)).val();
        let oldStock = $('#'.concat(item.stockID)).attr('data-stock');
        let oldUprice = $('#'.concat(item.uPriceID)).attr('data-unitPrice');

        if(item.unitTag == 1 || item.unitTag == 0){
            stock = stock/item.unitWeight ;
        }

        if(oldStock!==stock || oldUprice!==unitprice){

            if (item.MaxPrice < unitprice && item.Category === 2){
                error_update.push(item.ItemID) ;
            }

            else {
                let obj = {
                    "ShopID": item.ShopID,
                    "ItemID": item.ItemID,
                    "UnitPrice": unitprice,
                    "Stock": stock,
                    "Enabled": item.Enabled
                };

                safetyStock(item)

                $.ajax({
                    url: URLUpdateItem,
                    data: JSON.stringify(obj),
                    type: 'PATCH',
                    dataType: 'json',
                    processData: false,
                    contentType: 'application/json'
                }).done(function (data) {

                    console.log(data)
                    if (JSON.parse(data)['success'] === 'ok') {

                        templateAlert('green', 'Item ' + item.ItemID + ' is updated.');
                    } else {

                        templateAlert('red', 'Item ' + item.ItemID + ' update is failed.');
                    }
                });
            }

        }

    })



    error_update.forEach(item=>{
        templateAlert('red', 'Item ' + item + ' is not updated (Unit price should be less than or equal to the System Price for grocery items).');
    })

}

function errorDisplay(itemID, shopID, categoty , MRP){
    //
    // if(categoty == 0){
    //
    //     if(MRP < parseInt($('#uPrice_'.concat(shopID).concat("_").concat(itemID)).val() )){
    //         templateAlert('red', 'Unit Price Cannot be Greaterthan to the System Price');
    //     }

    // }
}
