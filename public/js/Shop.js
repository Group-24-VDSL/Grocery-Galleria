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


const UnitTag = ["Kg", "g", "L", "ml", "Unit"];

const host = window.location.origin; //http://domainname

const URLShopAPI = host+"/api/shop";
const URLShopItemAPI = host+"/api/shopItems";
const URLFindItemAPI = host+"/api/item";

const URLAddtoCartAPI = host+"/api/addtocart";

const shopName = document.getElementById('ShopName');
const shopCity = document.getElementById('City');
const shopSuburb = document.getElementById('Suburb');
const shopAddress = document.getElementById('Address');

const ShopID = getUrlParameter('ShopID');

const URLFindShop = URLShopAPI.concat("?ShopID=").concat(ShopID);
const URLFindShopItems = URLShopItemAPI.concat("?ShopID=").concat(ShopID);

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
        const URLShopItem = URLFindItemAPI.concat("?ItemID=").concat(shopItem.ItemID);
        $.getJSON(URLShopItem, function (item) {
            Item.innerHTML = `
            <img id="ItemImage" alt="ItemImage" src="${item.ItemImage}" >
                <h3 id="Name">${item.Name}</h3>
                <div class="price">
                    <span id="UnitPrice">${shopItem.UnitPrice}</span>
                    <span> /</span>
                    <span id="Unit">${UnitTag[item.Unit]}</span>
                    </div>
                    <div class="quantity">
                        <span>quantity :</span>
                        <input class="quantity-input" type="number" name="quantity" min=${item.UWeight} max="${item.UWeight * item.MaxCount}" step=${item.UWeight} value=${item.UWeight}>
                    </div>
                    <div  class="btn add-to-cart" data-itemid="${item.ItemID}" data-shopid="${shopItem.ShopID}" ><i class="fas fa-cart-plus"></i> add to cart</div>
            `
        })
        ItemBox.appendChild(Item);
    })

});

$(document).ready(function () {
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

    $(".add-to-cart").on('click',function () {
        let itemidvalue = $(this).data("itemid");
        let shopidvalue = $(this).data("shopid");
        let value = $(this).siblings(".quantity").find(".quantity-input").val();
        let step = $(this).siblings(".quantity").find(".quantity-input").attr('step');

        let passingvalue = Math.trunc(value / step);

        var obj = {"ItemID": itemidvalue, "ShopID": shopidvalue, "Quantity": passingvalue, "CustomerID": 2}; //keys and values should be enclosed in double quotes

        $.post(URLAddtoCartAPI, JSON.stringify(obj));
    });
});





