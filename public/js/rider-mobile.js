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
    // Create the script tag, set the appropriate attributes
    let script = document.createElement('script');
    // script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAwYJrYLyEaQGRUYEnh10GS5luyYnt2a5U&callback=initMap';
    script.src = 'https://maps.googleapis.com/maps/api/js?key=&callback=initMap';
    script.async = true;

    let map;

    window.initMap = function () {

        const geocoder = new google.maps.Geocoder();

        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 6.9271, lng: 79.8612 },
            zoom: 8,
        });


        let myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(6.9271, 79.8612),
            draggable: true
        });

        myMarker.setMap(map);
    }

    // Append the 'script' element to 'head'
    document.head.appendChild(script);
});