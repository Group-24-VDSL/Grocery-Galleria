const menu = document.querySelector('#menu-bar');
const navbar = document.querySelector('.navbar');
const header = document.querySelector('.header-2');

menu.addEventListener('click', function () {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});
window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');

    if (window.scrollY > 50) {
        header.classList.add('active');
    } else {
        header.classList.remove('active');
    }

}
// get url parameters
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
};

const shopName = document.getElementById('ShopName');
const shopCity = document.getElementById('City');
const shopSuburb = document.getElementById('Suburb');
const shopAddress = document.getElementById('Address');

const UnitTag = ["Kg", "g", "L", "ml", "Unit"];

const ShopID = getUrlParameter('ShopID');

const URLShopAPI = "http://localhost/api/shop?ShopID=";
const URLShopItemAPI = "http://localhost/api/shopItems?ShopID=";

const URLFindShop = URLShopAPI.concat(ShopID);
const URLFindShopItems = URLShopItemAPI.concat(ShopID);

const URLFindItemAPI = "http://localhost/api/item?ItemID=";

$.getJSON(URLFindShop, function (Shop) {
    shopName.innerHTML = Shop.ShopName;
    shopCity.innerHTML = Shop.City;
    shopSuburb.innerHTML = Shop.Suburb;
    shopAddress.innerHTML = Shop.Address;
});

const ItemBox = document.getElementById('ItemBox');


$.getJSON(URLFindShopItems, function (ShopItems) {
    ShopItems.forEach(shopItem => {
        const Item = document.createElement('div');
        Item.classList.add('box');
        const URLShopItem = URLFindItemAPI.concat(shopItem.ItemID);
        $.getJSON(URLShopItem, function (item) {
            Item.innerHTML = `
            <img id="ItemImage" name="ItemImage" src="${item.ItemImage}" alt="">
                <h3 id="Name">${item.Name}</h3>
                <div class="price">
                    <span id="UnitPrice">${shopItem.UnitPrice}</span>
                    <span> /</span>
                    <span id="Unit">${UnitTag[item.Unit]}</span>
                    </div>
                <div class="quantity">
                    <span>quantity :</span>
                    <input type="number" name="quantity" min=${item.UWeight} max="3000" step=${item.UWeight} value=${item.UWeight}>
                </div>
                <a href="#" class="btn"><i class="fas fa-cart-plus"></i> add to cart</a>
            `
        })
        ItemBox.appendChild(Item);
    })
});


