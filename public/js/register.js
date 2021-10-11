$(function (){
    // Create the script tag, set the appropriate attributes
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAwYJrYLyEaQGRUYEnh10GS5luyYnt2a5U&callback=initMap';
    script.async = true;

    let map;
    // Attach your callback function to the `window` object
    window.initMap = function() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });
    };

    // Append the 'script' element to 'head'
    document.head.appendChild(script);



});