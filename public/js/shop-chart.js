$( document ).ready(function() {
    var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 150];
    var barColors = "red";

    new Chart("myChart1", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: "green",
                data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "World Wine Production 2018"
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Orders Per Month',
                    color: 'green'
                }
            }
        }
    });

    var xValues = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];

    new Chart("myChart2", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
                borderColor: "green",
                fill: true
            }]
        },
        options: {
            legend: {display: false},
            plugins: {
                title: {
                    display: true,
                    text: 'Orders Per Day',
                    color: 'green'
                }
            }
        },

    });
});