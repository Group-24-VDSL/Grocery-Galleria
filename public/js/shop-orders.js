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
const host = window.location.origin;

//Api links

const URLShopOrders = host + "/api/getshoporders" ;
const URLOrder = host + "/api/getorder" ;
const URLDeliveryAPI = host + "/api/getdelivery";
const ShopID =  host + "/api/getshopid";


const ItemTableNew = document.getElementById('item-table-new');
const ItemTableComplete = document.getElementById('item-table-complete');

$(document).ready(function () {
    $.getJSON(ShopID, function (shopID) {

        const URLGetOrder = URLShopOrders.concat('?ShopID=').concat(shopID);
        $.getJSON(URLGetOrder, function (ShopOrders) {

            console.log(ShopOrders)

            ShopOrders.sort();

            ShopOrders.forEach(ShopOrder => {

                let URLGetSystemOrder = URLOrder.concat('?OrderID=').concat(ShopOrder.CartID);


                $.getJSON(URLGetSystemOrder, function (Order) {

                    if (ShopOrder.Status === 0) {
                        const ItemRowNew = document.createElement('tr');
                        ItemRowNew.innerHTML = `
                    <td id="ID" class="order-id">${ShopOrder.CartID}</td> 
                    <td id="Date" class="order-date">${Order.OrderDate}</td>
                    <td id="Total" class="shop-total">${ShopOrder.ShopTotal}</td>
                    <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?ShopID=${ShopOrder.ShopID}&CartID=${ShopOrder.CartID}" data-shopid = "${ShopOrder.ShopID}" data-orderid = "${ShopOrder.CartID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>     
                    `
                        ItemTableNew.appendChild(ItemRowNew);
                        // })
                        // .then(function (){$('#order-table-new').DataTable();})
                    } else if (ShopOrder.Status === 1) {

                        const ItemRowComplete = document.createElement('tr');

                        ItemRowComplete.innerHTML = `    
                    <td id="ID" class="order-id">${ShopOrder.CartID}</td>  
                    <td id="Date" class="order-date">${Order.OrderDate}</td>
                    <td id="Total" class="shop-total">${parseFloat(ShopOrder.ShopTotal,2)}</td>
                    <td id="Total" class="shop-total">${ShopOrder.CompleteDate}</td>
                    <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?ShopID=${ShopOrder.ShopID}&CartID=${ShopOrder.CartID}" data-shopid = "${ShopOrder.ShopID}" data-orderid = "${ShopOrder.CartID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>     
                     `
                        ItemTableComplete.appendChild(ItemRowComplete);
                        // })
                        // .then(function (){$('#order-table-old').DataTable();});
                    }

                    // })
                    //     .then(function (){
                    //     $('#order-table-old').DataTable();
                    // });
                })
            })
            })
        });
    }) ;

