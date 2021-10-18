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

const ShopID = getUrlParameter('ShopID');
const URLShopAPI = "http://localhost/api/shop?ShopID=";
const URLFindShop = URLShopAPI.concat(ShopID);


$.getJSON(URLFindShop, function (Shop) {
    shopName.innerHTML = Shop.ShopName;
    shopCity.innerHTML = Shop.City;
    shopSuburb.innerHTML = Shop.Suburb;
    shopAddress.innerHTML = Shop.Address;
});


