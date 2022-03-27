// // const getUrlParameter = function getUrlParameter(sParam) {
// //     let sPageURL = window.location.search.substring(1),
// //         sURLVariables = sPageURL.split('&'),
// //         sParameterName,
// //         i;
// //
// //     for (i = 0; i < sURLVariables.length; i++) {
// //         sParameterName = sURLVariables[i].split('=');
// //
// //         if (sParameterName[0] === sParam) {
// //             return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
// //         }
// //     }
// //     return false;
// // }
// // const host = window.location.origin; //http://domainname
//
// const URLOrderAPI = host + "/api/orders";
// const URlCustomerAPI = host + "/api/getcustomer";
// const URLShops = host + "/api/shops";
// const URLOrderCarts = host + "/api/getordercart"
//
// let NoShops = [];
//
//
// console.log(URLOrderAPI);
// const ItemTableNew = document.getElementById('item-table-new');
// const ItemTableOngoing = document.getElementById('item-table-ongoing');
// const ItemTableComplete = document.getElementById('item-table-complete');
//
// $(document).ready(function () {
//
//     $.getJSON(URLOrderAPI, function (Orders) {
//         console.log(URLOrderAPI)
//
//         Orders.forEach(Order => {
//             // let NoShops = 0 ;
//             const URLFindCustomer = URlCustomerAPI.concat("?CustomerID=").concat(Order.CustomerID);
//             const URLCarts = URLOrderCarts.concat("?CartID=").concat(Order.CartID);
//
//             // console.log(URLFindShops, URLFindShops.length);
//             $.getJSON(URLCarts, function (Carts) {
//                 Carts.forEach(Cart => {
//                     if (!NoShops.includes(Cart.ShopID)) {
//                         NoShops.push(Cart.ShopID);
//                     }
//                 })
//             })
//
//             // console.log(URLFindShops.length);
//             $.getJSON(URLFindCustomer, function (Customer) {
//                 // console.log(URLFindCustomer,Customer);
//                 if (Order.Status === 0) {
//                     const ItemRowNew = document.createElement('tr');
//
//                     ItemRowNew.innerHTML = `
//                 <td></td>
//                 <td id="ID" class="order-id">${Order.OrderID}</td>
//                 <td id="" class="rider-id">${Order.OrderDate}</td>
//                 <td id="Date" class="order-date">${Order.OrderTime}</td>
//                 <td id="Time" class="order-time">${Order.CustomerID}</td>
//                 <td id="noshops">${NoShops.length} </td>
//                 <td id="Total" class="shop-total">${Order.TotalCost.toFixed(2)}</td>
//                 <td>${Customer.City}</td>
//                 <td>${Customer.Suburb}</td>
//
//                 <td id="View" class="ubutton"> <a href="/dashboard/staff/vieworderdetails?OrderID=${Order.OrderID}&ShopCount=[${NoShops}]" data-shopid = "${Order.OrderID}" data-orderid = "${Order.OrderID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>
//                  `
//                     ItemTableNew.appendChild(ItemRowNew);
//
//                 } else if (Order.Status === 1) {
//                     const ItemRowOngoing = document.createElement('tr');
//
//                     ItemRowOngoing.innerHTML = `
//                 <td></td>
//                 <td id="ID" class="order-id">${Order.OrderID}</td>
//                 <td id="" class="rider-id">${Order.OrderDate}</td>
//                 <td id="Date" class="order-date">${Order.OrderTime}</td>
//                 <td id="Time" class="order-time">${Order.CustomerID}</td>
//                 <td id="noshops">${NoShops.length}</td>
//                 <td id="Total" class="shop-total">${Order.TotalCost}</td>
//                 <td>${Customer.City}</td>
//                 <td>${Customer.Suburb}</td>
//                 <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?OrderID=${Order.OrderID}" data-shopid = "${Order.OrderID}" data-orderid = "${Order.OrderID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>
//                  `
//                     ItemTableOngoing.appendChild(ItemRowOngoing);
//
//                 } else if (Order.Status === 2) {
//                     const ItemRowComplete = document.createElement('tr');
//
//                     ItemRowComplete.innerHTML = `
//                 <td></td>
//                 <td id="ID" class="order-id">${Order.OrderID}</td>
//                 <td id="" class="rider-id">${Order.OrderDate}</td>
//                 <td id="Date" class="order-date">${Order.OrderTime}</td>
//                 <td id="Time" class="order-time">${Order.CustomerID}</td>
//                 <td id="noshops">${NoShops.length}</td>
//                 <td id="Total" class="shop-total">${Order.TotalCost}</td>
//                 <td>${Customer.City}</td>
//                 <td>${Customer.Suburb}</td>
//                 <td id="View" class="ubutton"> <a href="/dashboard/shop/vieworderdetails?OrderID=${Order.OrderID}" data-shopid = "${Order.OrderID}" data-orderid = "${Order.OrderID}"><button id="button" class="btn-item" onclick="abc(this);" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a></td>
//                  `
//                     ItemTableComplete.appendChild(ItemRowComplete);
//                 }
//             })
//
//         })
//     });
//
// });