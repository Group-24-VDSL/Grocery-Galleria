// get url parameters
const getUrlParameter = function getUrlParameter(sParam) {
    let sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
}

const UnitTag = ["Kg", "g", "L", "ml", "Unit"];
const ItemType = ['Vegetables', 'Fruits', 'Grocery', 'Fish', 'Meat'];

const host = window.location.origin; //http://domainname
const chartDiv1 = document.getElementById('chartDiv1');
const chartDiv2 = document.getElementById('chartDiv2');
const productSection = document.getElementById('productAnalytics');
//Api links
const URLItemsAPI = host + "/api/items";
const URLItemAPI = host + "/api/item";
const ItemTable = document.getElementById('item-table');
const URLItemReport = host + '/dashboard/staff/itemreport';
const URLItemWeekReport = host + '/dashboard/staff/getitemweekreport';

$(document).ready(function () {
    $(".btn-tab").click(function () {
        let table = $('#Items').DataTable();
        table.destroy();
        $('#Item-info-rows').empty();
        let URLFindItems = URLItemsAPI.concat($(this).data("href"));
        $.getJSON(URLFindItems, function (Items) {
            Items.forEach(Item => {
                const itemRow = document.createElement('tr');
                itemRow.innerHTML = `
                 <td class="row-img">
                    <img src="${Item.ItemImage}" alt="${Item.Name}" />
                </td>
                <td class="row-name">${Item.Name}</td>
                <td class="row-brand">${Item.Brand}</td>
                <td class="row-unit">${Item.Unit}</td>
                <td class="row-minWeight">${Item.UWeight}</td>
                <td class="row-mrp">${Item.MRP}</td>
                <td class="row-IncStep">${Item.MaxCount}</td>
                <td class="row-ubutton">
                    <button id="ItemID=${Item.ItemID}" data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </td>
                `
                $('#Item-info-rows').append(itemRow);
            })
        }).then(function () {
            $('#Items').DataTable({
                "pageLength": 5,
            });
            ////
            console.log("here")
            const itemBtns = document.getElementsByClassName('btn-row');
            $(itemBtns).click(function () {
                $('.chart-div').empty();
                const div1 = document.createElement('div');
                div1.classList.add('chart');
                const canva1 = document.createElement('canvas');
                canva1.id = 'myChart1';
                div1.appendChild(canva1);
                chartDiv1.appendChild(div1);

                const URLFindItem = URLItemAPI.concat($(this).data("href"));
                const URLGetItemReport = URLItemReport.concat($(this).data("href"));
                $("#storeItemID").val($(this).data("href"));

                // console.log(URLGetItemReport)
                // $('.chart-div').empty();
                let totQty1 = [];
                let totSales1 = []
                $.getJSON(URLGetItemReport, function (reportData) {
                    reportData.forEach(data => {
                        totSales1.push({x: data.Month, y: data.TotSales});
                        totQty1.push({x: data.Month, y: data.Qty});
                    });
                    const ctx = document.getElementById('myChart1').getContext('2d');
                    const labelsArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                        'August', 'September', 'October', 'November', 'December'];
                    const data = {
                        labels: labelsArr,
                        datasets: [{
                            label: 'Month Revenue',
                            data: totSales1,
                            backgroundColor: [
                                '#06D6A0'
                            ],
                            borderColor: [
                                'rgb(153, 102, 255)',

                            ],
                            borderWidth: 1

                        },
                            {
                                label: 'Total Qty',
                                data: totQty1,
                                backgroundColor: [
                                    '#00bfff'
                                ],
                                borderColor: [
                                    'rgb(153, 102, 255)',

                                ],
                                borderWidth: 1
                            }
                        ],
                    };
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Monthly Report of the Item'
                                }
                            }
                        }
                    }
                    const myChart = new Chart(ctx, config);
                }).then(function () {
                    document.getElementById('SalesDate').addEventListener('change', (event) => {
                        $('#chartDiv2').empty();
                        const div2 = document.createElement('div');
                        div2.classList.add('chart');
                        const canva2 = document.createElement('canvas');
                        canva2.id = 'myChart2';
                        div2.appendChild(canva2);
                        chartDiv2.appendChild(div2);
                        const itemIDParam = $('#storeItemID').val();
                        const URLGetWeekReport = URLItemWeekReport.concat(itemIDParam + '&SalesDate=' + event.target.value);
                        console.log(URLGetWeekReport)
                        let totQty2 = [];
                        let totSales2 = []
                        $.getJSON(URLGetWeekReport, function (weekData) {
                            weekData.forEach(data => {
                                totSales2.push({x: data.Day, y: data.Tot});
                                totQty2.push({x: data.Day, y: data.Qty});
                            });
                            const ctx = document.getElementById('myChart2').getContext('2d');
                            const labelsArr = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            const data = {
                                labels: labelsArr,
                                datasets: [{
                                    label: 'Week Revenue',
                                    data: totSales2,
                                    backgroundColor: [
                                        '#06D6A0'
                                    ],
                                    borderColor: [
                                        'rgb(153, 102, 255)',

                                    ],
                                    borderWidth: 1

                                },
                                    {
                                        label: 'Total Qty',
                                        data: totQty2,
                                        backgroundColor: [
                                            '#00bfff'
                                        ],
                                        borderColor: [
                                            'rgb(153, 102, 255)',

                                        ],
                                        borderWidth: 1
                                    }
                                ],
                            };
                            const config = {
                                type: 'bar',
                                data: data,
                                options: {
                                    responsive: true,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Week Report of the Item'
                                        }
                                    }
                                }
                            }
                            const myChart = new Chart(ctx, config);
                        })
                    })
                })
                // console.log(URLFindItem);
                $.getJSON(URLFindItem, function (Item) {
                    console.log(Item)
                    $('#item-data').empty().append(Item.Name + ' Report');
                    $('#ItemID').val(Item.ItemID);
                    $('#Category').val(Item.Category);
                    // console.log(document.getElementById('Category').value);
                    $('#Unit').val(Item.Unit);
                    // console.log(document.getElementById('Unit').value);
                    $('#Name').val(Item.Name);
                    // console.log(document.getElementById('Name').value);
                    $('#ImgDis').attr('src', Item.ItemImage);
                    // console.log(Item.ItemImage);
                    $('#Brand').val(Item.Brand);
                    // console.log(document.getElementById('Brand').value);
                    $('#UWeight').val(Item.UWeight);
                    // console.log(document.getElementById('UWeight').value);
                    $('#MaxCount').val(Item.MaxCount);
                    // console.log(document.getElementById('MaxCount').value);
                    $('#MRP').val(Item.MRP);
                    // console.log(document.getElementById('MRP').value);
                    $('#Status').val(Item.Status).checked();

                })
            })

        })
    })
// $('#Status').val(1);
    $('#Status').change(function () {
        if ($(this).is(':checked')) {
            $(this).val(1);
            console.log($(this).val())
            // console.log(document.getElementById('Status'))
        } else {
            $(this).val(0);
            console.log($(this).val())
            // console.log(document.getElementById('Status'))

        }
    })

    $('#veg-tab-items').trigger("click");
})










