
let map;
let infoWindows = [];
$(function () {
    // Create the script tag, set the appropriate attributes
    let script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBpaxUjC3jwFxrFVyFaeH5t2pvFQhRoGSY&callback=initMap';
    // script.src = 'https://maps.googleapis.com/maps/api/js?key=&callback=initMap';
    script.async = true;


    window.initMap = function () {


        let infoWindow = new google.maps.InfoWindow({
            content: "Customer",
        });

        let customer = $(document.getElementById("map")).data('location');

        map = new google.maps.Map(document.getElementById("map"), {
            center: customer,
            zoom:16,
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

        const URLShopLocations = host + '/dashboard/staff/getshoplocations';
        const cartID = $('#CartID').val();
        const URLGetShopLocations = URLShopLocations.concat("?CartID=" + cartID);

        let shopicon = {
            url: host + '/img/shop_icon.png', // url
            scaledSize: new google.maps.Size(25, 25), // scaled size
            origin: new google.maps.Point(0, 0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
        let regex = /[+-]?\d+(\.\d+)?/g; //match floating points
        $.getJSON(URLGetShopLocations, function (shopLocations) {
            shopMarkers = [];
            infoWindows = [];
            shopLocations.forEach((shopLocation, i) => {

                let locationArr = shopLocation.Location.match(regex).map(function(v) { return parseFloat(v); }); //each shop location array
                shopMarkers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(locationArr[0],locationArr[1]),
                    icon: shopicon,
                });
                infoWindows[i] = new google.maps.InfoWindow({                    content: "<h4>"+shopLocation.ShopName+"</h4><p><strong>ContactNo: </strong><a href='tel:"+shopLocation.ContactNo+"'>"+shopLocation.ContactNo+"</a></p>",
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

    }


    // Append the 'script' element to 'head'
    document.head.appendChild(script);


});




