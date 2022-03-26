const host = window.location.origin; //http://domainname

let map;
let infoWindows = [];
$(function () {
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
    const cartID = $('#CartID').val();

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
            shopMarkers[i] = new google.maps.Marker({
                position: new google.maps.LatLng(shopLocation['lat'], shopLocation['lng']),
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
});




