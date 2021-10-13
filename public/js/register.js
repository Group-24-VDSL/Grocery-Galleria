$(function (listener){
    // Create the script tag, set the appropriate attributes
    let script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAwYJrYLyEaQGRUYEnh10GS5luyYnt2a5U&callback=initMap';
    script.async = true;

    let map, infoWindow;
    let locationfield = document.getElementsByName('Location')[0];
    let placefield = document.getElementsByName('PlaceID')[0];

    window.initMap = function () {

        const geocoder = new google.maps.Geocoder();

        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 6.9271, lng: 79.8612 },
            zoom: 8,
        });
        infoWindow = new google.maps.InfoWindow();

        let myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(6.9271, 79.8612),
            draggable: true
        });

        myMarker.setMap(map);

        const locationButton = document.createElement("button",);
        locationButton.setAttribute('type','button');
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
                        myMarker.setPosition(pos);
                        map.setCenter(pos);
                        locationfield.setAttribute('value',JSON.stringify(pos));
                        geocodeLatLng(geocoder,map,pos);
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

        google.maps.event.addListener(myMarker, 'dragend', function () {
            const pos = this.getPosition();
            geocodeLatLng(geocoder,map,pos);
            locationfield.setAttribute('value',JSON.stringify(pos));
        });


        window.handleLocationError = function (browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation
                    ? "Error: The Geolocation service failed."
                    : "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }

        window.geocodeLatLng = function (geocoder, map,pos) {
            console.log(pos);
            console.log("here");
            geocoder
                .geocode({ location: pos })
                .then((response) => {
                    if (response.results[0]) {
                        placefield.setAttribute('value',response.results[0].place_id);
                    } else {
                        placefield.setAttribute('value',"");
                    }
                })
                .catch((e) => window.alert("Geocoder failed due to: " + e));
        }
    }


    // Append the 'script' element to 'head'
    document.head.appendChild(script);
});