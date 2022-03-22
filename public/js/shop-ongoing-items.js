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
const  URLShopOrderAPI = host+ "/api/getshoporder" ;

const URLAddtoCartAPI = host + "/api/addtocart";
const URLGetCartAPI = host + "/api/getcart";
const URLUpdateItem = host+ "/api/updateshopitem" ;
const URLGetOrderCart = host+ "/api/getordercart" ;
const URLSafetyStock = host+ "/api/getsafetystock" ;


const URLGetCart = URLGetCartAPI.concat('?CustomerID=').concat('2');

const URLGetShop = URLShopItemsAPI.concat('?ShopID=').concat('5');

console.log(URLGetShop)

const ItemTable = document.getElementById('item-table');
const ItemUpdate = document.getElementById('updateItem');

let i = 0 ;
let itemArray = [];
// let demand= [] ;
// let leadTime = [];
// let demand = [];
let l = [];
let d = [];
let s =0 ;

$(document).ready(function () {
    $.getJSON(URLGetShop, function (Shops) {
        Shops.forEach(Shop => {
            const URLShopItems = URLFindItemAPI.concat("?ItemID=").concat(Shop.ItemID);
            $.getJSON(URLShopItems, function (Items) {
                Items.forEach(Item => {
                    if (Shop.Enabled === 1  && Shop.Stock >=5)
                    {
                        if(!Item.Brand ){
                            toString(Item.Brand ) ;
                            Item.Brand = "-";
                        }
                        let Unit =  (Item.Unit === 0)  ? "Kg" : (Item.Unit ===1) ? "gram"  : (Item.Unit ===2) ? "Litre" : "Packs";



                        const ItemRow = document.createElement('tr');
                        ItemRow.innerHTML = `
                                <td></td>
                                <td id="Name" class="row-name">${Shop.ItemID}</td>
                                <td id="ItemImage" class="row-img">
                                    <img src="${Item.ItemImage}" alt="${Item.Name}" />
                                </td>
                                <td id="Name" class="row-name">${Item.Name}</td>                                
                                <td id="Brand" class="row-brand">${Item.Brand}</td>
<!--                                <td id="Unit" class="row-unit">${Item.Unit}</td>-->
                                <td id="UWeight" class="row-minWeight">${Item.UWeight}</td>
                                <td id="MRP" class="row-mrp">${Item.MRP}</td>
                                <td id="UPrice" class="row-uprice">Rs. <input type="number" id="uPrice_${Shop.ShopID}_${Shop.ItemID}" name="uPrice${Shop.ShopID}${Shop.ItemID}" min="1" max="${Item.MRP}" value="${Shop.UnitPrice}" step="5" data-unitPrice="${Shop.UnitPrice}"></td>
                                <td id="Field_stock_${Shop.ShopID}_${Shop.ItemID}" class="row-stock"><input type="number" id="stock_${Shop.ShopID}_${Shop.ItemID}" name="stock${Shop.ShopID}${Shop.ItemID}" min="5" max="${Item.MRP}" value="${Shop.Stock}" step="5" data-stock="${Shop.Stock}"> ${Unit} </td>                                                              
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
                        itemArray['StockData'] = Shop.Stock;
                        itemArray['Enabled'] = Shop.Enabled ;
                        itemArray['MaxPrice'] = Shop.MaxPrice;

                        i = i+1 ;

                        setItemArray(itemArray);
                    }
                })

            })


        })

    }).then(function (){
        $('#ongoing-item-table').DataTable();
    })

});

function setItemArray(Item){
    itemArray.push(Item);
    safetyStock(Item);
}



function safetyStock(ShopItem){

    // new safety stock 2022 03 17

    let obj = {"ShopID":ShopItem.ShopID , "ItemID":ShopItem.ItemID} ;

    $.ajax({
        url : URLSafetyStock,
        data : JSON.stringify(obj),
        type : 'POST',
        dataType:'json',
        processData: false,
        contentType : 'application/json'
    }).done(function (data){

        if (data["SafetyStock"]=== null || data["ReOrderPoint"] === null){
            data["SafetyStock"] = "0.000" ;
            data["ReOrderPoint"] = "0.000" ;
        }

        if (data["SafetyStock"]=== "0.000" ){
            data["SafetyStock"] = "1.000" ;

        }

        if ( data["ReOrderPoint"] === "0.000"){
            data["ReOrderPoint"] = "1.000" ;
        }

        console.log(ShopItem.StockData)
        document.getElementById('Safety_stock_'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = data["SafetyStock"]+" Kg";
        document.getElementById('ReOrder_point'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = data["ReOrderPoint"]+" Kg";

        if(parseFloat(data["SafetyStock"]) <= ShopItem.StockData){
            document.getElementById('Safety_'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = "<img src=\"https://img.icons8.com/emoji/30/26e07f/check-mark-button-emoji.png\"/>";

        }
        else {
            document.getElementById('Safety_'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = "<img src=\"https://img.icons8.com/office/30/000000/high-risk.png\"/>";
        }

    });

    // 2022 03 17


    let leadTime = [];
    let demand = [];
    console.log(ShopItem.StockData)

    let i = 0;
    URLFindShopOrderItem  = URLGetOrderCart.concat("?ShopID=").concat(ShopItem.ShopID).concat("&ItemID=").concat(ShopItem.ItemID);

    $.getJSON(URLFindShopOrderItem, function (Items) {
        if (Items.length === 0){
            // document.getElementById(''.concat(ShopItem.stockID)).style.border ="solid green";
            document.getElementById('Safety_'.concat(ShopItem.ShopID).concat("_").concat(ShopItem.ItemID)).innerHTML = "<img src=\"https://img.icons8.com/emoji/30/26e07f/check-mark-button-emoji.png\"/>";
        }

        else {


            Items.forEach(Item => {
                console.log(Item);
                URLFindShopOrder = URLShopOrderAPI.concat("?ShopID=").concat(Item.ShopID).concat("&CartID=").concat(Item.CartID);
                console.log(URLFindShopOrder);

                $.getJSON(URLFindShopOrder, function (ShopOrder) {

                    if (ShopOrder.Status === 1) {

                        var todayDate = new Date();
                        var orderDate = ShopOrder.Date;
                        var completeDate = ShopOrder.CompleteDate;

                        todayDate = todayDate.getFullYear() + '-' + (todayDate.getMonth() + 1) + '-' + todayDate.getDate();


                        var date1 = new Date(todayDate);
                        // console.log(date1)
                        var date2 = new Date(orderDate);
                        // console.log(date2)

                        var date3 = new Date(completeDate);

                        var dateDifference = (date1.getTime() - date2.getTime()) / (1000 * 3600 * 24);
                        if (dateDifference <= 365) {
                            var leaddays = (date3.getTime() - date2.getTime()) / (1000 * 3600 * 24);

                            leadTime[i] = leaddays;
                            demand[i] = Item.Quantity;
                            i += 1;
                        }

                    }

                    var maxLeadDays = leadTime.reduce(function (a, b) {
                        return Math.max(a, b);
                    }, 0);

                    const averageLeadDays = leadTime.reduce((a, b) => a + b, 0) / leadTime.length;
                    const averageDemand = demand.reduce((a, b) => a + b, 0) / demand.length;


                    var maxDemand = demand.reduce(function (a, b) {
                        return Math.max(a, b);
                    }, 0);


                    s = (maxDemand * maxLeadDays) - (averageDemand * averageLeadDays); // safety stock formula


                    var sum = function (leadTime) {
                        var total = 0;
                        for (var i = 0; i < leadTime.length; i++) {
                            total += leadTime[i];
                        }
                        return total;
                    }
                })
                var sum = function (leadTime) {
                    var total = 0;
                    for (var i = 0; i < leadTime.length; i++) {
                        total += leadTime[i];
                    }
                    return total;
                }
            })
        }

    })



}

class Avg {
    constructor() {}

    static average(array) {
        var total = 0;
        var count = 0;

        jQuery.each(array, function(index, value) {
            total += value;
            count++;
        });

        return total / count;
    }
}


function updateShopItem(){

    itemArray.forEach(item=>{

        let unitprice = $('#'.concat(item.uPriceID)).val();
        let stock = $('#'.concat(item.stockID)).val();
        let oldStock = $('#'.concat(item.stockID)).attr('data-stock');
        let oldUprice = $('#'.concat(item.uPriceID)).attr('data-unitPrice');

        console.log(stock,oldStock)
        console.log(unitprice,oldUprice)

        if(oldStock!==stock || oldUprice!==unitprice){

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
                    if (JSON.parse(data)['success'] === 'ok') {

                        templateAlert('green', 'Item ' + item.ItemID + ' is updated.');
                    } else {

                        templateAlert('red', 'Item ' + item.ItemID + ' update is failed.');
                    }
                });

        }

    })

    location.reload();

}


$(document).ready( function () {
    // $('#ongoing-item-table').DataTable();
} );
