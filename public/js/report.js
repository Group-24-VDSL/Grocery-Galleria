const host = window.location.origin; //http://domainname
const chartDiv = document.getElementsByClassName('chart');

const boxTotOrders = document.getElementById('totOrders');
const boxTotRevenue = document.getElementById('totRevenue');
const boxTotShops = document.getElementById('totShops');
const boxTotRiders = document.getElementById('totRiders');


const urlTotOrders = host + '/dashboard/staff/gettotalorders';
const urlTotUsers = host + '/dashboard/staff/gettotalusers';
$.getJSON(urlTotOrders, function (data) {
    boxTotOrders.innerHTML = data[0].TotOrders;
    boxTotRevenue.innerHTML = data[0].TotalRevenue;
})
$.getJSON(urlTotUsers, function (data) {
    boxTotRiders.innerHTML = data[0].roleCount;
    boxTotShops.innerHTML = data[1].roleCount;
})

let URLCurYrData = host + '/dashboard/staff/salesreportcurrent';
let totSales1 = 0;
let totDelivery1 = 0;
const totalArrC = [];
const deliArrC = [];
$.getJSON(URLCurYrData, function (queryData) {
    queryData.forEach(data => {
        totalArrC.push({x: data.Month, y: data.Total});
        deliArrC.push({x: data.Month, y: data.Delivery});
        totSales1 = totSales1 + parseInt(data.Total);
        totDelivery1 = totDelivery1 + parseInt(data.Delivery);
    });
    document.getElementById('IdTC').innerHTML = totSales1.toString()
    document.getElementById('IdDC').innerHTML = totDelivery1.toString()
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
let totSales2 = 0;
let totDelivery2 = 0;
$.getJSON(URLLastYrData, function (queryData) {
    queryData.forEach(data => {
        totalArrL.push({x: data.Month, y: data.Total});
        deliArrL.push({x: data.Month, y: data.Delivery});
        totSales2 = totSales2 + parseInt(data.Total);
        totDelivery2 = totDelivery2 + parseInt(data.Delivery);
    });

    document.getElementById('IdTL').innerHTML = totSales2.toString()
    document.getElementById('IdDL').innerHTML = totDelivery2.toString()
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
// daily analysis starts here onwards
const dateElement = document.getElementById('SalesDate2');
const divDaily = document.getElementById('dailyChart');
// const host = window.location.origin; //http://domainname
const URLDailyRev = host+'/dashboard/staff/dailyrevenue';
const URLDailyOrd = host+'/dashboard/staff/dailytotorders';

dateElement.addEventListener('change',(event)=>{
    // console.log('Hello');
    $('#dailyChart').empty();
    const div1 = document.createElement('div');
    div1.classList.add('chart');
    // div1.insertAdjacentHTML("afterbegin", '<h1 class="heading chart-heading">Revenue <span>Analysis</span></h1>')
    const canva3 = document.createElement('canvas');
    canva3.id = 'myChart3';
    div1.appendChild(canva3);
    const div2 = document.createElement('div');
    div2.classList.add('chart');
    // div1.insertAdjacentHTML("afterbegin", '<h1 class="heading chart-heading">Order <span>Analysis</span></h1>')
    const canva4 = document.createElement('canvas');
    canva4.id = 'myChart4';
    div2.appendChild(canva4);
    divDaily.appendChild(div1);
    divDaily.appendChild(div2);
    let hourlyRevenue = [];
    let hourlyOrders = [];
    const URLGetDailyRev = URLDailyRev.concat('?SalesDate='+event.target.value);
    const URLGetDailyOrd = URLDailyOrd.concat('?SalesDate='+event.target.value);
    console.log(URLGetDailyRev);
    const labelsArr = ['8-9','9-10','10-11','11-12','12-13','13-14','14-15','15-16','16-17','17-18','18-19','19-20','20-21'];
    $.getJSON(URLGetDailyRev,function (dailyRevenue){
        console.log(dailyRevenue)
        dailyRevenue.forEach(hourData=>{
            hourlyRevenue.push({x:`${hourData.timeInterval}-${parseInt(hourData.timeInterval)+1}`,y:hourData.totRevenue});
            // console.log(parseInt(hourData.timeInterval));
        });
        const ctx1 = document.getElementById('myChart3').getContext('2d');
        const data1={
            labels:labelsArr,
            datasets:[{
                label:'Hourly Revenue',
                data:hourlyRevenue,
                fill: false,
                borderColor: '#06D6A0',
                pointBackgroundColor:'blue',
                tension: 0.01
            }]
        };
        const config1={
            type:'line',
            data:data1
        }
        const myChart3 = new Chart(ctx1,config1);
    });
    $.getJSON(URLGetDailyOrd,function (dailyOrders){
        console.log(dailyOrders);
        dailyOrders.forEach(hourOrder=>{
            hourlyOrders.push({x:`${hourOrder.timeInterval}-${parseInt(hourOrder.timeInterval)+1}`,y:hourOrder.totOrders});
        });

        const ctx2 = document.getElementById('myChart4').getContext('2d');
        const data2={
            labels:labelsArr,
            datasets:[{
                label:'Hourly Orders',
                data:hourlyOrders,
                fill: false,
                borderColor: '#06D6A0',
                pointBackgroundColor:'blue',
                tension: 0.1
            }]
        };

        const config2={
            type:'line',
            data:data2
        }
        const myChart4 = new Chart(ctx2,config2);
    });




})




