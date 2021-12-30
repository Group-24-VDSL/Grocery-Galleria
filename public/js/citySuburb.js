$(document).ready(function (){
let cityData = [
    {
       "cityID": 1,
        "cityName": "Nugegoda",
        "suburbs": [
            {
               "cityID": 1,
                "suburbID": 1,
                "suburbName": "Delkanda - Nugegoda"
            },
            {
               "cityID": 1,
                "suburbID": 2,
                "suburbName": "Embuldeniya"
            },
            {
               "cityID": 1,
                "suburbID": 3,
                "suburbName": "Gangodavila"
            },
            {
               "cityID": 1,
                "suburbID": 4,
                "suburbName": "Jambugasmulla"
            },
            {
               "cityID": 1,
                "suburbID": 5,
                "suburbName": "Jubilee Kanuwa"
            },
            {
               "cityID": 1,
                "suburbID": 6,
                "suburbName": "Kattiya Junction"
            },
            {
               "cityID": 1,
                "suburbID": 7,
                "suburbName": "Mirihana"
            },
            {
               "cityID": 1,
                "suburbID": 8,
                "suburbName": "Nawala"
            },
            {
               "cityID": 1,
                "suburbID": 9,
                "suburbName": "Nugegoda"
            },
            {
               "cityID": 1,
                "suburbID": 10,
                "suburbName": "Pagoda"
            },
            {
               "cityID": 1,
                "suburbID": 11,
                "suburbName": "Pathiragoda"
            },
            {
               "cityID": 1,
                "suburbID": 12,
                "suburbName": "Udahamulla"
            },
            {
               "cityID": 1,
                "suburbID": 13,
                "suburbName": "Wijerama"
            }
        ]
    },
    {
       "cityID": 2,
        "cityName": "Sri Jayawardanapura",
        "suburbs": [
            {
               "cityID": 2,
                "suburbID": 14,
                "suburbName": "Akuragoda"
            },
            {
               "cityID": 2,
                "suburbID": 15,
                "suburbName": "Baddagana"
            },
            {
               "cityID": 2,
                "suburbID": 16,
                "suburbName": "Bandaranayakepura - Rajagiriya"
            },
            {
               "cityID": 2,
                "suburbID": 17,
                "suburbName": "Diyawanna Gardens - Pelawatta"
            },
            {
               "cityID": 2,
                "suburbID": 18,
                "suburbName": "Ethulkotte"
            },
            {
               "cityID": 2,
                "suburbID": 19,
                "suburbName": "Gamage Watta"
            },
            {
               "cityID": 2,
                "suburbID": 20,
                "suburbName": "Gothamipura - Borella"
            },
            {
               "cityID": 2,
                "suburbID": 21,
                "suburbName": "Koswatta"
            },
            {
               "cityID": 2,
                "suburbID": 22,
                "suburbName": "Kotuwegoda - Rajagiriya"
            },
            {
               "cityID": 2,
                "suburbID": 23,
                "suburbName": "Madinnagoda"
            },
            {
               "cityID": 2,
                "suburbID": 24,
                "suburbName": "Moragasmulla"
            },
            {
               "cityID": 2,
                "suburbID": 25,
                "suburbName": "Pitakotte"
            },
            {
               "cityID": 2,
                "suburbID": 26,
                "suburbName": "Rajagiriya"
            },
            {
               "cityID": 2,
                "suburbID": 27,
                "suburbName": "Royal Park - Rajagiriya"
            },
            {
               "cityID": 2,
                "suburbID": 28,
                "suburbName": "Welikada"
            }
        ]
    },
    {
       "cityID": 3,
        "cityName": "Kohuwala",
        "suburbs": [
            {
               "cityID": 3,
                "suburbID": 29,
                "suburbName": "Dutugemunu"
            },
            {
               "cityID": 3,
                "suburbID": 30,
                "suburbName": "Hathbodhiya"
            },
            {
               "cityID": 3,
                "suburbID": 31,
                "suburbName": "Kirula"
            },
            {
               "cityID": 3,
                "suburbID": 32,
                "suburbName": "Kirulapone"
            },
            {
               "cityID": 3,
                "suburbID": 33,
                "suburbName": "Kohuwala"
            },
            {
               "cityID": 3,
                "suburbID": 34,
                "suburbName": "Pamankada"
            },
            {
               "cityID": 3,
                "suburbID": 35,
                "suburbName": "Vilawala"
            }
        ]
    },
    {
       "cityID": 4,
        "cityName": "Maharagama",
        "suburbs": [
            {
               "cityID": 4,
                "suburbID": 36,
                "suburbName": "Dambahena"
            },
            {
               "cityID": 4,
                "suburbID": 37,
                "suburbName": "Egodawatta"
            },
            {
               "cityID": 4,
                "suburbID": 38,
                "suburbName": "Godigamuwa"
            },
            {
               "cityID": 4,
                "suburbID": 39,
                "suburbName": "Maharagama"
            },
            {
               "cityID": 4,
                "suburbID": 40,
                "suburbName": "Navinna - Maharagama"
            },
            {
               "cityID": 4,
                "suburbID": 41,
                "suburbName": "Nawinna"
            },
            {
               "cityID": 4,
                "suburbID": 42,
                "suburbName": "Neelammahara"
            },
            {
               "cityID": 4,
                "suburbID": 43,
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
    console.log(optionCity);
    cityVal.add(optionCity);
    });

    $(cityVal).on('change', function (e) {
        $(suburbVal).find('option').remove().end();
        let valueSelected = this.value -1;
        Object.keys(cityData[valueSelected].suburbs).forEach(function (j){
            // console.log(cityData[valueSelected].suburbs[j]);
            let optionSuburb = document.createElement('option');
            optionSuburb.text = cityData[valueSelected].suburbs[j].suburbName;
            optionSuburb.value = cityData[valueSelected].suburbs[j].suburbID;
            suburbVal.add(optionSuburb);
        })
    });
    $('#1Nugegoda').trigger('change');
});

