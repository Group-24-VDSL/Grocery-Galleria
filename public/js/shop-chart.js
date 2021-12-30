const host = window.location.origin; //http://domainname

//Api links
const URLMonthlyOrders = host + "/api/getshopmonthlyorders" ;
const URLMonthOrders = host + "/api/getshoplastmonthorders" ;
const URLMonthlyRevenues = host + "/api/getshoplastmonthlyrevenues" ;
const URLMonthRevenues = host + "/api/getshoplastmonthrevenues" ;


$( document ).ready(function() {
    $.getJSON(URLMonthlyOrders, function (orderlist) {
        let xValues = [] ;
        let yValues = [] ;

        let a = Object.values(orderlist)[0]
        console.log(a["NumberOfOrders"]);
        console.log(Object.keys(orderlist).length)
        for (let i = 0; i < Object.keys(orderlist).length; i++) {
            yValues.push(parseInt(Object.values(orderlist)[i]["NumberOfOrders"]));

        }
        xValues = Object.keys(orderlist);

        const orderAverage = yValues.reduce((a, b) => a + b) / yValues.length;
        const sum = yValues.reduce((a, b) => {
            return a + b;
        });

        document.getElementById("order-barchart-average").innerHTML = orderAverage.toFixed(2);
        document.getElementById("order-barchart-sum").innerHTML = sum;

        new Chart("orderBarchart", {
            // type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    type: "bar",
                    label: 'Orders in month',
                    backgroundColor: "#55a630ff",
                    borderColor: "#55a630ff",
                    data: yValues
                },

            ]
            },
            options: {
                legend: {display: false},

                scales: {
                    yAxes: [{
                        display:true,
                        scaleLabel: {
                            display: true,
                           title: 'probability'
                        }
                    }]
                },

                plugins: {
                    title: {
                        display: true,
                        text: 'ORDERS IN LAST YEAR',
                        color: '#55a630ff',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });
    });

    $.getJSON(URLMonthOrders, function (orders) {
        let xValues = [];
        let yValues = [];

        let b = Object.values(orders)[0] ;

        console.log(b["NumberOfOrders"]);
        console.log(Object.keys(orders).length)

        for (let i = 0; i < Object.keys(orders).length; i++) {
            yValues.push(parseInt(Object.values(orders)[i]["NumberOfOrders"]))
        }

        xValues = Object.keys(orders);

        const orderAverage = yValues.reduce((a, b) => a + b) / yValues.length;
        const sum = yValues.reduce((a, b) => {
            return a + b;
        });

        document.getElementById("order-linechart-average").innerHTML = orderAverage.toFixed(2);
        document.getElementById("order-linechart-sum").innerHTML = sum;

        new Chart("orderLinechart", {
            type: "line",
            data: {
                labels: xValues.reverse(),
                datasets: [{
                    lineTension: 0.3,
                    borderWidth:1.5,
                    strokeColor: "green",
                    pointColor: "green",
                    // .points[4].fillColor =  "red":"green",
                    pointStrokeColor: "green",
                    label: 'Orders in day',
                    data: yValues.reverse(),
                    borderColor: "#55a630ff",
                    fill: true
                }]
            },
            options: {
                legend: {display: false},
                plugins: {
                    title: {
                        display: true,
                        text: 'ORDERS IN LAST MONTH',
                        color: '#55a630ff',
                        layout: {
                            padding: 5
                        },
                        font: {
                            size: 14
                        }
                    }
                }
            },
        });

    });

    $.getJSON(URLMonthlyRevenues, function (orderlist) {
        let xValues = [] ;
        let yValues = [] ;

        let a = Object.values(orderlist)[0]
        console.log(a["NumberOfOrders"]);
        console.log(Object.keys(orderlist).length)
        for (let i = 0; i < Object.keys(orderlist).length; i++) {
            if(Object.values(orderlist)[i]["Total"] == null){
                yValues.push(0);
            }
            else {
                yValues.push(parseInt(Object.values(orderlist)[i]["Total"]))
            }

        }
        xValues = Object.keys(orderlist);

        const orderAverage = yValues.reduce((a, b) => a + b) / yValues.length;
        const sum = yValues.reduce((a, b) => {
            return a + b;
        });

        document.getElementById("revenue-barchart-average").innerHTML = orderAverage.toFixed(2);
        document.getElementById("revenue-barchart-sum").innerHTML = sum.toFixed(2);

        new Chart("revenueBarchart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    fill: true,
                    backgroundColor: '#a6cee3',
                    borderColor: '#a6cee3',
                    label: 'Orders in month',
                    backgroundColor: "green",
                    borderColor: "green",
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},

                scales: {},

                plugins: {
                    title: {
                        display: true,
                        text: 'ORDERS IN LAST YEAR',
                        color: 'green',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });
    });

    $.getJSON(URLMonthRevenues, function (orders) {
        let xValues = [];
        let yValues = [];

        let b = Object.values(orders)[0] ;

        console.log(b["NumberOfOrders"]);
        console.log(Object.keys(orders).length)

        for (let i = 0; i < Object.keys(orders).length; i++) {
            if(Object.values(orders)[i]["Total"] == null){
                yValues.push(0);
            }
            else {
                yValues.push(parseInt(Object.values(orders)[i]["Total"]))
            }
        }

        xValues = Object.keys(orders);

        const orderAverage = yValues.reduce((a, b) => a + b) / yValues.length;
        const sum = yValues.reduce((a, b) => {
            return a + b;
        });

        document.getElementById("revenue-linechart-average").innerHTML = orderAverage.toFixed(2);
        document.getElementById("revenue-linechart-sum").innerHTML = sum.toFixed(2);

        new Chart("revenueLinechart", {
            type: "line",
            data: {
                labels: xValues.reverse(),
                datasets: [{
                    lineTension: 0.4,
                    borderWidth:1.5,
                    label: 'Orders in day',
                    fill: true,
                    data: yValues.reverse(),
                    borderColor: "green",
                    fill: true
                }]
            },
            options: {
                legend: {display: false},
                plugins: {
                    title: {
                        display: true,
                        text: 'ORDERS IN LAST MONTH',
                        color: 'green',
                        layout: {
                            padding: 5
                        },
                        font: {
                            size: 14
                        }
                    }
                }
            },
        });
    });
});
