// constant variables
const riderSelect = document.getElementById('RiderID');
const getRiderBtn = document.getElementById('getRider-btn');
const bicycleRadio = document.getElementById('bicycle-radio')
const riderDetailsDIV = document.getElementById('rider-info');

const host = window.location.origin; //http://domainname
//API urls
const RiderURL = host + '/api/getrider';
const RidersURL = host + '/api/getriders';

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

    });



})