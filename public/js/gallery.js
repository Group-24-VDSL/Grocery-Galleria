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

let host = window.location.origin; //http://domainname

//Api links
const URLShopsAPI = host + "/api/shops";

const ShopType = ["Vegetable", "Fruit", "Grocery", "Fish", "Meat"];

const ShopCategory = getUrlParameter('Category');
document.getElementById('CategoryType').innerHTML = `${ShopType[ShopCategory]}`;

const URLGetCity = host + '/api/getcity';
const URLGetCitySuburb = host + '/api/getcitysuburb';


const galleryBox = document.getElementById('gallery-box');
$.getJSON(URLGetCitySuburb, function (data) {
    $.getJSON(host+"/js/getCity.json", function (cityData) {
        let arr = cityData.filter(obj => {
            return obj.cityID===data.City;
        })

        $('#city-name').html(
            arr[0].cityName
        );

        let arr1 = arr[0].suburbs.filter(obj=> {
            return obj.cityID === data.City && obj.suburbID === data.Suburb;
        })
        $('#suburb-name').html(
            arr1[0].suburbName
        );

    })
    $('#city-name').html(data.City)
    const URLFindShops = URLShopsAPI.concat("?Category=").concat(ShopCategory).concat("&City=" + data.City + "&Suburb=" + data.Suburb);
    console.log(URLFindShops);
    $.getJSON(URLFindShops, function (Shops) {
        Shops.forEach(Shop => {
            const shopBox = document.createElement('div');
            const shopURl = "/gallery/shop?ShopID=".concat(Shop.ShopID);
            shopBox.classList.add('box');
            shopBox.innerHTML = `
        <img src="/img/welcome/logo.png" alt="">
            <h3>${Shop.ShopName}</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <div>${Shop.ShopDesc}</div>
            <a href=${shopURl} class="btn">
                <i class="fas fa-external-link-alt"></i> Visit Store</a>
        `
            galleryBox.appendChild(shopBox);
        });
    });
})
