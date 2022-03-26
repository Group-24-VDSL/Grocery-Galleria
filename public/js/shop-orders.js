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

const URLShopOrders = host + "/api/getshoporders" ;
const URLDeliveryAPI = host + "/api/getdelivery";
const ShopID =  host + "/api/getshopid";


const ItemTableNew = document.getElementById('item-table-new');
const ItemTableComplete = document.getElementById('item-table-complete');

$(document).ready(function () {
    $.getJSON(ShopID, function (shopID) {

        const URLGetOrder = URLShopOrders.concat('?ShopID=').concat(shopID);

        $.getJSON(URLGetOrder, function (ShopOrders) {
            ShopOrders.sort();
            console.log(ShopOrders)
                ShopOrders.forEach(ShopOrder => {

                    const URLFindDelivery = URLDeliveryAPI.concat("?OrderID=").concat(ShopOrder.CartID);

                    if (ShopOrder.Status === 0) {
                        $.getJSON(URLFindDelivery, function (Delivery) {

                            const ItemRowNew = document.createElement('tr');

                            ItemRowNew.innerHTML = `
    
                    <td id="ID" class="order-id">${ShopOrder.CartID}</td> 
                    <td id="Date" class="order-date">${ShopOrder.Date}</td>
                    <td id="Time" class="order-time">${ShopOrder.Time}</td>
                    <td id="Total" class="shop-total">${ShopOrder.ShopTotal}</td>
                    <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?ShopID=${ShopOrder.ShopID}&CartID=${ShopOrder.CartID}" data-shopid = "${ShopOrder.ShopID}" data-orderid = "${ShopOrder.CartID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>     
                     `
                            ItemTableNew.appendChild(ItemRowNew);
                        }).then(function (){$('#order-table-new').DataTable();})
                    }

                    else if (ShopOrder.Status === 1){
                        $.getJSON(URLFindDelivery, function (Delivery) {

                            const ItemRowComplete = document.createElement('tr');

                            ItemRowComplete.innerHTML = `    
                    <td id="ID" class="order-id">${ShopOrder.CartID}</td>  
                    <td id="Date" class="order-date">${ShopOrder.Date}</td>
                    <td id="Time" class="order-time">${ShopOrder.Time}</td>
                    <td id="Total" class="shop-total">${ShopOrder.ShopTotal}</td>
                    <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?ShopID=${ShopOrder.ShopID}&CartID=${ShopOrder.CartID}" data-shopid = "${ShopOrder.ShopID}" data-orderid = "${ShopOrder.CartID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>     
                     `
                            ItemTableComplete.appendChild(ItemRowComplete);
                        }).then(function (){$('#order-table-old').DataTable();});
                    }

                }).then(function (){$('#order-table-old').DataTable();});
            })
        })
});

