const host = window.location.origin; //http://domainname

//Api links

const URLMonthOrders = host + "/api/getshoplastmonthorders" ;
const URLMonthlyOrders = host + "/api/getshopmonthlyorders" ;


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
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
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
                    label: 'Orders in day',
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
