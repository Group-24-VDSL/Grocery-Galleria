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

//const URLOrderAPI = host + "/api/orders";


const URLFindCartAPI = host + "/api/getordercart";
const URLShopOrders = host + "/api/getshoporders" ;
const URLShopOrder = host + "/api/getshoporder" ;
const URLDeliveryAPI = host + "/api/getdelivery";
const URLGetOrder = URLShopOrders.concat('?ShopID=').concat('1');
console.log(URLGetOrder);

const ItemTableNew = document.getElementById('item-table-new');
const ItemTableComplete = document.getElementById('item-table-complete');

$(document).ready(function () {
    $.getJSON(URLGetOrder, function (ShopOrders) {
            ShopOrders.forEach(ShopOrder => {

                const URLFindDelivery = URLDeliveryAPI.concat("?OrderID=").concat(ShopOrder.CartID);
                console.log(URLFindDelivery);
               // $.getJSON(URLFindDelivery, function (Deliveries) {
               //     Deliveries.forEach(Delivery => {
                        console.log(URLGetOrder);
                        console.log(URLFindDelivery);

                if (ShopOrder.Status === 0) {
                    $.getJSON(URLFindDelivery, function (Delivery) {

                        const ItemRowNew = document.createElement('tr');

                        ItemRowNew.innerHTML = `
                <td></td>
                <td id="ID" class="order-id">${ShopOrder.CartID}</td>            
                <td id="RiderID" class="rider-id">${Delivery.RiderID}</td>  
                <td id="Date" class="order-date">${ShopOrder.Date}</td>
                <td id="Time" class="order-time">${ShopOrder.Time}</td>
                <td id="Total" class="shop-total">${ShopOrder.ShopTotal}</td>
                <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?ShopID=${ShopOrder.ShopID}&CartID=${ShopOrder.CartID}" data-shopid = "${ShopOrder.ShopID}" data-orderid = "${ShopOrder.CartID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>     
                 `
                        ItemTableNew.appendChild(ItemRowNew);
                    })
                }

                if (ShopOrder.Status === 1){
                    $.getJSON(URLFindDelivery, function (Delivery) {

                        const ItemRowComplete = document.createElement('tr');

                        ItemRowComplete.innerHTML = `
                <td></td>
                <td id="ID" class="order-id">${ShopOrder.CartID}</td>            
                <td id="RiderID" class="rider-id">${Delivery.RiderID}</td>  
                <td id="Date" class="order-date">${ShopOrder.Date}</td>
                <td id="Time" class="order-time">${ShopOrder.Time}</td>
                <td id="Total" class="shop-total">${ShopOrder.ShopTotal}</td>
                <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?ShopID=${ShopOrder.ShopID}&CartID=${ShopOrder.CartID}" data-shopid = "${ShopOrder.ShopID}" data-orderid = "${ShopOrder.CartID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>     
                 `
                        ItemTableComplete.appendChild(ItemRowComplete);
                    })
                }


            });
        }
    );

});

const OverView = document.getElementById('order-box');

// $('#View').click(function() {
//     var href = $(this).find("a").attr("href");
//     if(href) {
//         window.location = href;
//     }
//
//     const shopId = $(this).find("a").attr("data-shopid") ;
//     const cartId = $(this).find("a").attr("data-orderid") ;
//
// });

const URlFindOrder = URLShopOrder.concat("?ShopID=").concat('1').concat("&CartID=").concat('0') ;
console.log(URlFindOrderOrder);

function abc(item){
    console.log(item);
}


$.getJSON(URlFindOrder, function (Order) {
        const Details = document.createElement('div');
        Details.innerHTML = `
                
            <div class="box">
                <div class="content">
                    <div class="box-topic">Order ID</div>
                    <div class="number-details">${Order.CartID}</div>
                </div>
                <img src="https://img.icons8.com/external-itim2101-flat-itim2101/64/000000/external-order-shopping-and-ecommerce-itim2101-flat-itim2101.png"/>
            </div>

            <div class="box">
                <div class="content">
                    <div class="box-topic">Status</div>
                    <div class="number-details">${Order.Status}</div>
                </div>
                <img src="https://img.icons8.com/external-becris-flat-becris/64/000000/external-history-literary-genres-becris-flat-becris.png"/>
            </div>

            <div class="box">
                <div class="content">
                    <div class="box-topic">Total(LKR)</div>
                    <div class="number-details">2500.00</div>
                </div>
                <img src="https://img.icons8.com/external-justicon-flat-justicon/64/000000/external-cash-gambling-justicon-flat-justicon.png"/>
            </div>

            <div class="box">
                <div class="content">
                    <div class="box-topic">Item Count</div>
                    <div class="number-details">15</div>
                </div>
                <img src="https://img.icons8.com/external-wanicon-flat-wanicon/64/000000/external-product-advertising-wanicon-flat-wanicon.png"/>
            </div>
                `
        OverView.appendChild(Details) ;
    }
);


const URlFindCart = URLFindCartAPI.concat("?CartID=").concat(ShopOrder.CartID);
console.log(URlFindCart);

$.getJSON(URlFindCart , function (Carts) {
        Carts.forEach(Cart => {

            }
        )
    }
);