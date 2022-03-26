const host = window.location.origin; //http://domainname

const URLViewOrder = host + '/dashboard/staff/vieworderdetails'
const URLShopList = host + '/dashboard/staff/getshoplist'
const URLShop = host + '/dashboard/staff/getordershopdetails'
const URLShopItems = host + '/dashboard/staff/getordershopitemdetails'
const category = ["Vegetable", "Fruit", "Grocery", "Fish", "Meat"]
const UnitTag = ["Kg", "g", "L", "ml", "Unit"];
const OrderState = ["New","OnGoing","Past"];
const ordersDetailsDIv = document.getElementById('orderDetails');
let map;
let shopMarkers = [];
let infoWindows = [];
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
    // Create the script tag, set the appropriate attributes
    let script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAwYJrYLyEaQGRUYEnh10GS5luyYnt2a5U&callback=initMap';
    // script.src = 'https://maps.googleapis.com/maps/api/js?key=&callback=initMap';
    script.async = true;


    window.initMap = function () {

        const geocoder = new google.maps.Geocoder();


        let infoWindow = new google.maps.InfoWindow({
            content: "Customer",
        });

        let customer = $(document.getElementById("map")).data('location');

        map = new google.maps.Map(document.getElementById("map"), {
            center: customer,
            zoom: 16,
        });
        let cus_icon = {
            url: host + '/img/human_icon.png', // url
            scaledSize: new google.maps.Size(25, 25), // scaled size
            origin: new google.maps.Point(0, 0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
        let myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(customer['lat'], customer['lng']),
            icon: cus_icon,
        });

        myMarker.setMap(map);

        myMarker.addListener("mouseover", () => {
            infoWindow.open({
                anchor: myMarker,
                map,
                shouldFocus: false,
            });
        });
        myMarker.addListener("mouseout", () => {
            infoWindow.close();
        });

    }


    // Append the 'script' element to 'head'
    document.head.appendChild(script);

    const URLShopLocations = host + '/dashboard/staff/getshoplocations';

    let shop_icon = {
        url: host + '/img/shop_icon.png', // url
        scaledSize: new google.maps.Size(25, 25), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
    };
    const URLGetShopLocations = URLShopLocations.concat("?CartID=" + cartID);
    $.getJSON(URLGetShopLocations, function (shopLocations) {
        console.log(URLGetShopLocations)
        shopMarkers.forEach(shopMarker => {
            shopMarker.setMap(null);
        })
        shopMarkers = [];
        infoWindows = [];
        shopLocations.forEach((shopLocation, i) => {
            console.log(shopLocation)
            shopMarkers[i] = new google.maps.Marker({
                position: new google.maps.LatLng(shopLocation.lat, shopLocation.lng),
                icon: shop_icon,
            });
        });

        shopMarkers[i].setMap(map);

        shopMarkers[i].addListener("mouseover", () => {
            infoWindows[i].open({
                anchor: shopMarkers[i],
                map,
                shouldFocus: false,
            });
        });
        shopMarkers[i].addListener("mouseout", () => {
            infoWindows[i].close();
        });
    });
})


