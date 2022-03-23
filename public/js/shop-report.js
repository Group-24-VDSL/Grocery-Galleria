const host = window.location.origin;//http://domainname
const getMonthlyURL = host + '/dashboard/staff/shopsreportmonthly';
const getYearlyURL = host + '/dashboard/staff/shopsreportyearly';
const chartDiv= document.getElementById('charDiv1');
const monthTableBody = document.getElementById('month-table-body');
const yearTableBody = document.getElementById('year-table-body');

$(document).ready(function () {
    $(".btn-tab").click(function () {
        $('#month-table tbody').empty();
        $('#year-table tbody').empty();
        $('#category').empty().append('#Top10 '+$(this).data("name")+' Report');
        $('.chart-div').empty();
        const div1 = document.createElement('div');
        div1.classList.add('chart');
        const div2 = document.createElement('div');
        div2.classList.add('chart');
        const canva1 = document.createElement('canvas');
        canva1.id ='myChart1';
        const canva2 = document.createElement('canvas');
        canva2.id = 'myChart2';
        div1.appendChild(canva1);
        div2.appendChild(canva2);
        chartDiv.appendChild(div1);
        chartDiv.appendChild(div2);
        let getMonthDataURL = getMonthlyURL.concat($(this).data("href"));
        let getYearDataURL = getYearlyURL.concat($(this).data("href"));
        const shopTot=[];
        const labelsArr = [];
        $.getJSON(getMonthDataURL,function (queryData){

            queryData.forEach(data=>{
                shopTot.push({x:data.shopTot,y:data.ShopName});
                labelsArr.push(data.shopName);
                const tableRow = document.createElement('tr');
                tableRow.innerHTML=`
                <td>${data.ShopName}</td>
                <td>${data.Address}</td>
                <td>${data.ContactNo}</td>
                <td>${data.Email}</td>
                <td>${data.shopTot}</td>
                `
                monthTableBody.appendChild(tableRow);
            })
            const ctx = document.getElementById('myChart1').getContext('2d');

            const data={
                labels:labelsArr,
                datasets:[{
                    label:'Shop Revenue',
                    data:shopTot,
                    backgroundColor: [
                        '#06D6A0'
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
                    indexAxis: 'y',
                    plugins: {
                        title: {
                            display: true,
                            text: 'Top 10 Shops of this Month',
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                align: 'end',
                                text: 'Shop Name',

                            }
                        },
                        x: {
                            title: {
                                display: true,
                                align: 'end',
                                text: 'Shop Revenue',

                            }
                        },

                    }
                }
            }
            const myChart = new Chart(ctx, config);
        })
        const shopTotY=[];
        const labelsArrY = [];
        $.getJSON(getYearDataURL,function (queryData){

            queryData.forEach(data=>{
                shopTotY.push({x:data.shopTot,y:data.ShopName});
                labelsArrY.push(data.shopName);
                const tableRow = document.createElement('tr');
                tableRow.innerHTML=`
                <td>${data.ShopName}</td>
                <td>${data.Address}</td>
                <td>${data.ContactNo}</td>
                <td>${data.Email}</td>
                <td>${data.shopTot}</td>
                `
                yearTableBody.appendChild(tableRow);
            })
            const ctx = document.getElementById('myChart2').getContext('2d');

            const data={
                labels:labelsArrY,
                datasets:[{
                    label:'Shop Revenue',
                    data:shopTotY,
                    backgroundColor: [
                        '#06D6A0'
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
                    indexAxis: 'y',
                    plugins: {
                        title: {
                            display: true,
                            text: 'Top 10 Shops of the Year'
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                align: 'end',
                                text: 'Shop Name',

                            }
                        },
                        x: {
                            title: {
                                display: true,
                                align: 'end',
                                text: 'Shop Revenue',

                            }
                        },

                    }
                }
            }
            const myChart = new Chart(ctx, config);
        })


    })

$('#btn-vege').trigger('click');
})

