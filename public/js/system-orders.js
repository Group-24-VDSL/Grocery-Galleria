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

const URLOrderAPI = host + "/api/orders";


const URLFindCartAPI = host + "/api/getordercart";
const URLShopOrder = host + "/api/getshoporders" ;
const URLGetOrder = URLShopOrder.concat('?ShopID=').concat('1');
console.log(URLGetOrder);

const ItemTable = document.getElementById('item-table');

$(document).ready(function () {
    $.getJSON(URLGetOrder, function (ShopOrders) {
            ShopOrders.forEach(ShopOrder => {
                // itemRow.classList.add('row');
                    const URlFindCart = URLFindCartAPI.concat("?CartID=").concat(ShopOrder.CartID);
                    console.log(URlFindCart);

                    $.getJSON(URlFindCart , function (Carts) {
                            Carts.forEach(Cart => {
                                    const ItemRow = document.createElement('tr');
                                    // itemRow.classList.add('tr');
                                    ItemRow.innerHTML = `
                 <td></td>
                 <td id="ID" class="order-id">${ShopOrder.CartID}</td>            
                <td id="RiderID" class="rider-id"></td>
                <td id="Date" class="order-date">${ShopOrder.Date}</td>
                <td id="Time" class="order-time">${ShopOrder.Date}</td>
                <td id="View" class="shop-total">${ShopOrder.ShopTotal}</td>
                <td id="Total" class="ubutton"> <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></td>
               
                
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