const host = window.location.origin; //http://domainname
const chartDiv = document.getElementsByClassName('chart');

//  let URLGetItemData = host + '/dashboard/staff/itemreport';
//     const totalRev = [];
//     $.getJSON(URLgetData, function (queryData) {
//         queryData.forEach(data => {
//             totalRev.push({x: data.Name, y: data.TotRev})
//         });
//         // myChart.destroy();
//         const ctx = document.getElementById('myChart').getContext('2d');
//         const data = {
//             datasets: [{
//                 label: 'Revenue per Item',
//                 data: totalRev,
//                 backgroundColor: [
//                     '#00bfff'
//                 ],
//                 borderColor: [
//                     'rgb(153, 102, 255)',
//
//                 ],
//                 borderWidth: 1
//             }],
//
//         };
//         const config = {
//             type: 'bar',
//             data: data,
//             options: {
//                 responsive: true,
//
//             },
//         }
//         const myChart = new Chart(ctx, config);
//     })
// });
    let URLCurYrData = host + '/dashboard/staff/salesreportcurrent';
    let totSales=0;
    let totDelivery=0;
    const totalArrC = [];
    const deliArrC = [];
    $.getJSON(URLCurYrData, function (queryData) {
        queryData.forEach(data => {
            totalArrC.push({x: data.Month, y: data.Total});
            deliArrC.push({x: data.Month, y: data.Delivery});
            totSales = totSales+ parseInt(data.Total);
            totDelivery = totDelivery+parseInt(data.Delivery);
        });
        document.getElementById('IdTL').innerHTML = totSales.toString()
        document.getElementById('IdDL').innerHTML = totDelivery.toString()
        // myChart.destroy();
        const ctx = document.getElementById('myChart1').getContext('2d');
        const labelsArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        const data = {
            labels: labelsArr,
            datasets: [{
                label: 'Total Revenue',
                data: totalArrC,
                backgroundColor: [
                    '#06D6A0'
                ],
                borderColor: [
                    'rgb(153, 102, 255)',

                ],
                borderWidth: 1
            },
                {
                    label: 'Delivery Revenue',
                    data: deliArrC,
                    backgroundColor: [
                        '#00bfff'
                    ],
                    borderColor: [
                        'rgb(153, 102, 255)',

                    ],
                    borderWidth: 1
                }],

        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Current Year Sales Report'
                    }
                }
            }
        }
        const myChart = new Chart(ctx, config);

    });
let URLLastYrData = host + '/dashboard/staff/salesreportlast';
const totalArrL = [];
const deliArrL = [];
totSales=0;
totDelivery=0;
$.getJSON(URLLastYrData, function (queryData) {
    queryData.forEach(data => {
        totalArrL.push({x: data.Month, y: data.Total});
        deliArrL.push({x: data.Month, y: data.Delivery});
        totSales = totSales+ parseInt(data.Total);
        totDelivery = totDelivery+parseInt(data.Delivery);
    });
    document.getElementById('IdTC').innerHTML = totSales.toString()
    document.getElementById('IdDC').innerHTML = totDelivery.toString()
    // myChart.destroy();
    const ctx = document.getElementById('myChart2').getContext('2d');
    const labelsArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    const data = {
        labels: labelsArr,
        datasets: [{
            label: 'Total Revenue',
            data: totalArrL,
            backgroundColor: [
                '#06D6A0'
            ],
            borderColor: [
                'rgb(153, 102, 255)',

            ],
            borderWidth: 1
        },
            {
                label: 'Delivery Revenue',
                data: deliArrL,
                backgroundColor: [
                    '#00bfff'
                ],
                borderColor: [
                    'rgb(153, 102, 255)',

                ],
                borderWidth: 1
            }],

    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Last Year Sales Report'
                }
            }
        }
    }
    const myChart = new Chart(ctx, config);

});
    // $('#tab-itemR').trigger('click');




