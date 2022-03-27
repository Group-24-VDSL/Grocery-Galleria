$(function(){
    $('.navigation-toggle').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $(this).toggleClass('active');
        $(this)
            .siblings('a')
            .removeClass('active');
        $(url).toggleClass('active');
        $(url)
            .siblings('.navigation-toggle')
            .removeClass('active');
        $('.navigation-back-overlay').toggleClass('active');
    });

    $('.navigation-back-overlay').on('click', function(e) {
        e.preventDefault();
        $('navigation-back-overlay').toggleClass('active');
        $('.navigation-toggle')
            .siblings('a')
            .removeClass('active');
        $('.navigation-back-overlay').toggleClass('active');
        $('#menu-mobile').toggleClass('active');

    });

    $(".order-view-button").click(function() {
        window.location = $(this).data("href");
    });



});

$(function(){
    if(window.location.pathname !== '/rider/order') {
        // Create the script tag, set the appropriate attributes
        let script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBpaxUjC3jwFxrFVyFaeH5t2pvFQhRoGSY&callback=initMap';
        // script.src = 'https://maps.googleapis.com/maps/api/js?key=&callback=initMap';
        script.async = true;

        let map;

        window.initMap = function () {

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();

            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 6.9271, lng: 79.8612},
                zoom: 8,
            });

            directionsRenderer.setMap(map);

            calculateAndDisplayRoute(directionsService, directionsRenderer, map);


        }

        // Append the 'script' element to 'head'
        document.head.appendChild(script);
    }
});

function openMaps(){
    let map = document.getElementById("map");
    let shops = $(map).data('shops');

    let regex = /[+-]?\d+(\.\d+)?/g; //match floating points
    let waypoints = [];
    shops.forEach(function (shop){
        let shopdata = $(map).data('shop'.concat(shop));
        waypoints.push(shopdata.split('|')[1].match(regex).map(function(v) { return parseFloat(v); }));
    });
    waypointstring=waypoints.join("|");

    let customer = $(map).data('customer').split('|')[1].match(regex).map(function(v) { return parseFloat(v); });
    window.open("https://www.google.com/maps/dir/?api=1&waypoints=".concat(encodeURI(waypointstring)).concat("&destination=").concat(encodeURI(customer.join())));
}

function calculateAndDisplayRoute(directionsService, directionsRenderer,map) {
    //get the rider location as origin
    var rider;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                rider=  new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                //shops
                let regex = /[+-]?\d+(\.\d+)?/g;
                let mapz = document.getElementById("map");
                let shops = $(mapz).data('shops');
                //customer
                let customer  = $(mapz).data('customer').split('|')[1].match(regex).map(function(v) { return parseFloat(v); });
                let destination = new google.maps.LatLng(customer[0], customer[1]);

                let waypointsarray = [];
                shops.forEach(function (shop){
                    let shopdata = $(mapz).data('shop'.concat(shop));
                    let shopz = shopdata.split('|')[1].match(regex).map(function(v) { return parseFloat(v); });
                    waypointsarray.push({location:new google.maps.LatLng(shopz[0], shopz[1]),stopover:true});

                });
                console.log(waypointsarray);
                directionsService
                    .route({
                        origin:rider,
                        destination:destination,
                        waypoints:waypointsarray,
                        optimizeWaypoints: true,
                        travelMode: google.maps.TravelMode.DRIVING
                    })
                    .then((response) => {
                        directionsRenderer.setDirections(response);
                    })
                    .catch((e) => console.log("Directions request failed due to " + status));
            },
            () => {
                rider = map.getCenter();
            }
        );
    } else {
        // Browser doesn't support Geolocation
        rider = map.getCenter();
    }

}