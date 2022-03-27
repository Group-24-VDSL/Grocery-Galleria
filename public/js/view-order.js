const host = window.location.origin; //http://domainname

const URLViewOrder = host + '/dashboard/staff/vieworderdetails'
const URLShopList = host + '/dashboard/staff/getshoplist'
const URLShop = host + '/dashboard/staff/getordershopdetails'
const URLShopItems = host + '/dashboard/staff/getordershopitemdetails'
const category = ["Vegetable", "Fruit", "Grocery", "Fish", "Meat"]
const UnitTag = ["Kg", "g", "L", "ml", "Unit"];
const OrderState = ["New","OnGoing","Past"];
const ordersDetailsDIv = document.getElementById('orderDetails');

$(document).ready(function () {
    const orderID = $('#OrderID').val();
    const cartID = $('#CartID').val();
    const Status = $('#OdStatus').val();
// console.log(orderID);
// console.log(cartID);
document.getElementById('orderStatus').innerHTML = `${OrderState[Status]}`
    const URLGetShopList = URLShopList.concat("?CartID=" + cartID);
    $.getJSON(URLGetShopList, function (shops) {
        shops.forEach(shop => {
            const URLGetShop = URLShop.concat("?ShopID=" + shop.ShopID);
            $.getJSON(URLGetShop, function (shopDetails) {
                console.log(shopDetails[0].ShopName)
                const shopDiv = document.createElement('div');
                shopDiv.classList.add('container-order-details');
                shopDiv.innerHTML = `
            <div>
                <div id="shopID${shopDetails[0].ShopID}"  class="item-list">
                    <div class="complete-section">
                        <table class="shop-details">
                            <tbody>
                            <tr>
                                <th>Shop<br>ID</th>
                                <td>: ${shopDetails[0].ShopID}</td>
                            </tr>
                            <tr>
                                <th>Shop<br>Name</th>
                                <td>: ${shopDetails[0].ShopName}</td>
                            </tr>
                            <tr>
                                <th>Shop<br>Category</th>
                                <td>: ${category[shopDetails[0].Category]}</td>
                            </tr>
                            <tr>
                                <th>Shop<br>Address</th>
                                <td>: ${shopDetails[0].Address}</td>
                            </tr>
                            <tr>
                                <th>Shop<br>Location</th>
                                <td>: <a class="location-link" href="#">Shop Location</a></p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <table id="tableShop${shopDetails[0].ShopID}" class="table-scroll small-first-col">
                        <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Image</th>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>U/Weight</th>
                            <th>U/Price(LKR)</th>
                            <th>Quantity</th>
                            <th>Price(LKR)</th>
                        </tr>
                        </thead>
                        <tbody id="tableItemsShop${shopDetails[0].ShopID}" class="body-half-screen">
                    </tbody>
                    </table>
                </div>
            </div>
                `
                ordersDetailsDIv.appendChild(shopDiv);
                const URLGetShopItems = URLShopItems.concat("?CartID=" + cartID + "&ShopID=" + shop.ShopID);
                $.getJSON(URLGetShopItems, function (shopItems) {
                    shopItems.forEach(function (shopItem){
                        console.log(shopItem)
                        const tableRow = document.createElement('tr');
                        tableRow.innerHTML=`
                        <td>${shopItem.ItemID}</td>
                            <td><img class="item-img" src="${shopItem.ItemImage}"></td>
                            <td>${shopItem.Name}</td>
                            <td>${UnitTag[shopItem.Unit]}</td>
                            <td>${shopItem.UWeight}</td>
                            <td>${shopItem.UnitPrice}</td>
                            <td>${shopItem.Quantity}</td>
                            <td>${shopItem.Total}</td>
                        `
                        document.getElementById("tableItemsShop"+shopDetails[0].ShopID).appendChild(tableRow)
                    })

                })

            })
        })
    })

})


