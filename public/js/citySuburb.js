$(document).ready(function (){
let cityData = [
    {
        "cityID": 0,
        "cityName": "Nugegoda",
        "suburbs": [
            {
                "cityID": 0,
                "suburbID": 0,
                "suburbName": "Delkanda - Nugegoda"
            },
            {
                "cityID": 0,
                "suburbID": 1,
                "suburbName": "Embuldeniya"
            },
            {
                "cityID": 0,
                "suburbID": 2,
                "suburbName": "Gangodavila"
            },
            {
                "cityID": 0,
                "suburbID": 3,
                "suburbName": "Jambugasmulla"
            },
            {
                "cityID": 0,
                "suburbID": 4,
                "suburbName": "Jubilee Kanuwa"
            },
            {
                "cityID": 0,
                "suburbID": 5,
                "suburbName": "Kattiya Junction"
            },
            {
                "cityID": 0,
                "suburbID": 6,
                "suburbName": "Mirihana"
            },
            {
                "cityID": 0,
                "suburbID": 7,
                "suburbName": "Nawala"
            },
            {
                "cityID": 0,
                "suburbID": 8,
                "suburbName": "Nugegoda"
            },
            {
                "cityID": 0,
                "suburbID": 9,
                "suburbName": "Pagoda"
            },
            {
                "cityID": 0,
                "suburbID": 10,
                "suburbName": "Pathiragoda"
            },
            {
                "cityID": 0,
                "suburbID": 11,
                "suburbName": "Udahamulla"
            },
            {
                "cityID": 0,
                "suburbID": 12,
                "suburbName": "Wijerama"
            }
        ]
    },
    {
        "cityID": 1,
        "cityName": "Sri Jayawardanapura",
        "suburbs": [
            {
                "cityID": 1,
                "suburbID": 13,
                "suburbName": "Akuragoda"
            },
            {
                "cityID": 1,
                "suburbID": 14,
                "suburbName": "Baddagana"
            },
            {
                "cityID": 1,
                "suburbID": 15,
                "suburbName": "Bandaranayakepura - Rajagiriya"
            },
            {
                "cityID": 1,
                "suburbID": 16,
                "suburbName": "Diyawanna Gardens - Pelawatta"
            },
            {
                "cityID": 1,
                "suburbID": 17,
                "suburbName": "Ethulkotte"
            },
            {
                "cityID": 1,
                "suburbID": 18,
                "suburbName": "Gamage Watta"
            },
            {
                "cityID": 1,
                "suburbID": 19,
                "suburbName": "Gothamipura - Borella"
            },
            {
                "cityID": 1,
                "suburbID": 20,
                "suburbName": "Koswatta"
            },
            {
                "cityID": 1,
                "suburbID": 21,
                "suburbName": "Kotuwegoda - Rajagiriya"
            },
            {
                "cityID": 1,
                "suburbID": 22,
                "suburbName": "Madinnagoda"
            },
            {
                "cityID": 1,
                "suburbID": 23,
                "suburbName": "Moragasmulla"
            },
            {
                "cityID": 1,
                "suburbID": 24,
                "suburbName": "Pitakotte"
            },
            {
                "cityID": 1,
                "suburbID": 25,
                "suburbName": "Rajagiriya"
            },
            {
                "cityID": 1,
                "suburbID": 26,
                "suburbName": "Royal Park - Rajagiriya"
            },
            {
                "cityID": 1,
                "suburbID": 27,
                "suburbName": "Welikada"
            }
        ]
    },
    {
        "cityID": 2,
        "cityName": "Kohuwala",
        "suburbs": [
            {
                "cityID": 2,
                "suburbID": 28,
                "suburbName": "Dutugemunu"
            },
            {
                "cityID": 2,
                "suburbID": 29,
                "suburbName": "Hathbodhiya"
            },
            {
                "cityID": 2,
                "suburbID": 30,
                "suburbName": "Kirula"
            },
            {
                "cityID": 2,
                "suburbID": 31,
                "suburbName": "Kirulapone"
            },
            {
                "cityID": 2,
                "suburbID": 32,
                "suburbName": "Kohuwala"
            },
            {
                "cityID": 2,
                "suburbID": 33,
                "suburbName": "Pamankada"
            },
            {
                "cityID": 2,
                "suburbID": 34,
                "suburbName": "Vilawala"
            }
        ]
    },
    {
        "cityID": 3,
        "cityName": "Maharagama",
        "suburbs": [
            {
                "cityID": 3,
                "suburbID": 35,
                "suburbName": "Dambahena"
            },
            {
                "cityID": 3,
                "suburbID": 36,
                "suburbName": "Egodawatta"
            },
            {
                "cityID": 3,
                "suburbID": 37,
                "suburbName": "Godigamuwa"
            },
            {
                "cityID": 3,
                "suburbID": 38,
                "suburbName": "Maharagama"
            },
            {
                "cityID": 3,
                "suburbID": 39,
                "suburbName": "Navinna - Maharagama"
            },
            {
                "cityID": 3,
                "suburbID": 40,
                "suburbName": "Nawinna"
            },
            {
                "cityID": 3,
                "suburbID": 41,
                "suburbName": "Neelammahara"
            },
            {
                "cityID": 3,
                "suburbID": 42,
                "suburbName": "Pamunuwa"
            }
        ]
    }
];
// cityData = JSON.stringify(cityData);
console.log(typeof cityData);
console.log(cityData);
const cityVal = document.getElementById('City');
const suburbVal = document.getElementById('Suburb');
Object.keys(cityData).forEach(function(i){
    let optionCity = document.createElement('option');
    optionCity.text = cityData[i].cityName;
    optionCity.value = cityData[i].cityID;
    optionCity.id = cityData[i].cityID + cityData[i].cityName;
    cityVal.add(optionCity);

    });

    $(cityVal).on('change', function (e) {
        $(suburbVal).find('option').remove().end();
        let valueSelected = this.value;
        Object.keys(cityData[valueSelected].suburbs).forEach(function (j){
            // console.log(cityData[valueSelected].suburbs[j]);
            let optionSuburb = document.createElement('option');
            optionSuburb.text = cityData[valueSelected].suburbs[j].suburbName;
            optionSuburb.value = cityData[valueSelected].suburbs[j].suburbID;
            suburbVal.add(optionSuburb);
        })
    });
    $('#0Nugegoda').trigger('change');
});

