// constant variables
const riderSelect = document.getElementById('RiderID');
const getRiderBtn = document.getElementById('getRider-btn');
const bicycleRadio = document.getElementById('bicycle-radio')
const riderDetailsDIV = document.getElementById('rider-info');

const host = window.location.origin; //http://domainname
//API urls
const RiderURL = host + '/api/getrider';
const RidersURL = host + '/api/getriders';
const RiderLocationURL = host + '/api/getriderlocation';
const RiderLocationDataURL = host + '/api/getriderlocationdata?type=';
let map;

let riderMarkers=[];
let infoWindows=[];

$(function(){
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
                scaledSize: new google.maps.Size(25,25), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            let myMarker = new google.maps.Marker({
                position: new google.maps.LatLng(customer['lat'], customer['lng']),
                icon:cus_icon,
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
    }

);
function mapUpdateRiders(){
    let type = document.querySelector('input[name="vehicle"]:checked').value;
    console.log(type)
    let rider_icon  = {
        url: host + '/img/bike_icon.png', // url
        scaledSize: new google.maps.Size(25,25), // scaled size
        origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
    };
    let tuk_icon  = {
        url: host + '/img/tuk_icon.png', // url
        scaledSize: new google.maps.Size(25,25), // scaled size
        origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
    };

    $.getJSON(RiderLocationDataURL+type,function (data){
        riderMarkers.forEach(curRider => {
            curRider.setMap(null);
        })
        riderMarkers = [];
        infoWindows=[];
        data.forEach((rider,i) => {
            if(type === 1){
                riderMarkers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(rider['LocationLat'], rider['LocationLng']),
                    icon:tuk_icon,
                });
            }else{
                riderMarkers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(rider['LocationLat'], rider['LocationLng']),
                    icon:rider_icon,
                });
            }
            infoWindows[i] = new google.maps.InfoWindow({
                content: "<h4>"+rider['Name']+"</h4><p><strong>ContactNo: </strong><a href='tel:"+rider['ContactNo']+"'>"+rider['ContactNo']+"</a></p>",
            });
            riderMarkers[i].setMap(map);

            riderMarkers[i].addListener("mouseover", () => {
                infoWindows[i].open({
                    anchor: riderMarkers[i],
                    map,
                    shouldFocus: false,
                });
            });
            riderMarkers[i].addListener("mouseout", () => {
                infoWindows[i].close();
            });

        })
    });
    return true;
}


$(document).ready(function () {

    const ridersCity = $(getRiderBtn).data('city');
    const ridersSuburb = $(getRiderBtn).data('suburb');

    $(bicycleRadio).prop('checked', true);
    let RiderType = $(bicycleRadio).val(); // default set to riderType=0;
    let setRidersURL = RidersURL + "?City=" + ridersCity + "&Suburb=" + ridersSuburb + "&Status=0" + "&RiderType=" + RiderType; // default getRidersURL set to RiderType = 0

    $(':radio').change(function () {
        RiderType = $(this).val();
        setRidersURL = RidersURL + "?City=" + ridersCity + "&Suburb=" + ridersSuburb + "&Status=0" + "&RiderType=" + RiderType;
    })

    $(riderSelect).on('change',function (){
        const setRiderURL = RiderURL+"?RiderID="+$(this).val();
        console.log(setRiderURL);
        $.getJSON(setRiderURL, function (rider) {
            console.log(rider);
            $(riderDetailsDIV).empty();
            const section = document.createElement('section');
            section.classList.add('rider-info');
            section.innerHTML = `
            <label class="labels">Name:</label>
                                <div class="rider-detail">${rider.Name}</div>
                                <label class="labels">Address:</label>
                                <div class="rider-detail">${rider.Address}</div>
                                <label class="labels">Email:</label>
                                <div class="rider-detail">${rider.Email}</div>
                                <label class="labels">Contact:</label>
                                <div class="rider-detail">${rider.ContactNo}</div>
                                <label class="labels">NIC:</label>
                                <div class="rider-detail">${rider.NIC}</div>
            `
            riderDetailsDIV.appendChild(section);

        });
    });
    $(getRiderBtn).click(function () {
        $.get(RiderLocationURL);
        $.getJSON(setRidersURL, function (riders) {
            $(riderSelect).find('option').remove().end();
            Object.keys(riders).forEach(function (i) {
                let option = document.createElement('option');
                option.text = riders[i].Name;
                option.value = riders[i].RiderID;
                option.name = riders[i].RiderID;
                option.id = riders[i].RiderID;
                riderSelect.add(option);
            });

        });
        setTimeout(mapUpdateRiders,3000); //wait 5 sec

    });



})