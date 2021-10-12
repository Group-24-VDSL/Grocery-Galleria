$(function (){
    // Create the script tag, set the appropriate attributes
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAwYJrYLyEaQGRUYEnh10GS5luyYnt2a5U&callback=initMap';
    script.async = true;

    // let map;
    // // Attach your callback function to the `window` object
    // window.initMap = function() {
    //     map = new google.maps.Map(document.getElementById("map"), {
    //         center: { lat: -34.397, lng: 150.644 },
    //         zoom: 8,
    //     });
    // };




    let map, infoWindow;

    window.initMap = function () {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 6.9271, lng: 79.8612 },
            zoom: 8,
        });
        infoWindow = new google.maps.InfoWindow();

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(6.9271, 79.8612),
            draggable: true
        });

        myMarker.setMap(map);

        const locationButton = document.createElement("button");

        locationButton.textContent = "Find your Location";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
        locationButton.addEventListener("click", () => {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        infoWindow.setPosition(pos);
                        infoWindow.setContent("Location found.");
                        infoWindow.open(map);
                        map.setCenter(pos);
                    },
                    () => {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        });
    }

    window.handleLocationError = function (browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }

    // Append the 'script' element to 'head'
    document.head.appendChild(script);
});