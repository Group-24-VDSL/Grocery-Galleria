// const dateElement = document.getElementById('SalesDate2');
// const divDaily = document.getElementById('dailyChart');
// const host = window.location.origin; //http://domainname
// const URLDailyRev = host+'/dashboard/staff/dailyrevenue';
// const URLDailyOrd = host+'/dashboard/staff/dailytotorders';
//
// dateElement.addEventListener('change',(event)=>{
//     // console.log('Hello');
//     $('#dailyChart').empty();
//     const div1 = document.createElement('div');
//     div1.classList.add('chart');
//     // div1.insertAdjacentHTML("afterbegin", '<h1 class="heading chart-heading">Revenue <span>Analysis</span></h1>')
//     const canva3 = document.createElement('canvas');
//     canva3.id = 'myChart3';
//     div1.appendChild(canva3);
//     const div2 = document.createElement('div');
//     div2.classList.add('chart');
//     // div1.insertAdjacentHTML("afterbegin", '<h1 class="heading chart-heading">Order <span>Analysis</span></h1>')
//     const canva4 = document.createElement('canvas');
//     canva4.id = 'myChart4';
//     div2.appendChild(canva4);
//     divDaily.appendChild(div1);
//     divDaily.appendChild(div2);
//     let hourlyRevenue = [];
//     let hourlyOrders = [];
//     const URLGetDailyRev = URLDailyRev.concat('?SalesDate='+event.target.value);
//     const URLGetDailyOrd = URLDailyOrd.concat('?SalesDate='+event.target.value);
//     console.log(URLGetDailyRev);
//     const labelsArr = ['8-9','9-10','10-11','11-12','12-13','13-14','14-15','15-16','16-17','17-18','18-19','19-20','20-21'];
//     $.getJSON(URLGetDailyRev,function (dailyRevenue){
//         console.log(dailyRevenue)
//         dailyRevenue.forEach(hourData=>{
//             hourlyRevenue.push({x:`${hourData.timeInterval}-${parseInt(hourData.timeInterval)+1}`,y:hourData.totRevenue});
//             // console.log(parseInt(hourData.timeInterval));
//         });
//     const ctx1 = document.getElementById('myChart3').getContext('2d');
//     const data1={
//         labels:labelsArr,
//         datasets:[{
//             label:'Hourly Revenue',
//             data:hourlyRevenue,
//             fill: false,
//             borderColor: '#06D6A0',
//             pointBackgroundColor:'blue',
//             tension: 0.01
//         }]
//     };
//     const config1={
//         type:'line',
//         data:data1
//     }
//     const myChart3 = new Chart(ctx1,config1);
//     });
//     $.getJSON(URLGetDailyOrd,function (dailyOrders){
//         console.log(dailyOrders);
//         dailyOrders.forEach(hourOrder=>{
//             hourlyOrders.push({x:`${hourOrder.timeInterval}-${parseInt(hourOrder.timeInterval)+1}`,y:hourOrder.totOrders});
//         });
//
//     const ctx2 = document.getElementById('myChart4').getContext('2d');
//     const data2={
//         labels:labelsArr,
//         datasets:[{
//             label:'Hourly Orders',
//             data:hourlyOrders,
//             fill: false,
//             borderColor: '#06D6A0',
//             pointBackgroundColor:'blue',
//             tension: 0.1
//         }]
//     };
//
//     const config2={
//         type:'line',
//         data:data2
//     }
//     const myChart4 = new Chart(ctx2,config2);
//     });
//
//
//
//
// })