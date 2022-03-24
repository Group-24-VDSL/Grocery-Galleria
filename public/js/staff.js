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
        $('#item-table').empty();
        let URLFindItems = URLItemsAPI.concat($(this).data("href"));
        $.getJSON(URLFindItems, function (Items) {
            Items.forEach(Item => {
                const itemRow = document.createElement('ul');
                itemRow.classList.add('row');
                itemRow.innerHTML = `
                 <li class="row-img">
                    <img src="${Item.ItemImage}" alt="${Item.Name}" />
                </li>
                <li class="row-name">${Item.Name}</li>
                <li class="row-brand">${Item.Brand}</li>
                <li class="row-unit">${Item.Unit}</li>
                <li class="row-minWeight">${Item.UWeight}</li>
                <li class="row-mrp">${Item.MRP}</li>
                <li class="row-IncStep">${Item.MaxCount}</li>
                <li class="row-Status">${Item.Status}</li>
                <li class="row-ubutton">
                    <button id="ItemID=${Item.ItemID}" data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </li>
                `
                ItemTable.appendChild(itemRow);
            })
        }).then(function () {

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
                    Date.prototype.toDateInputValue = (function () {
                        const local = new Date(this);
                        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                        return local.toJSON().slice(0, 10);
                    });

                    $('#SalesDate').val(new Date().toDateInputValue());
                    const fireEvent = new Event('change');
                    document.getElementById('SalesDate').dispatchEvent(fireEvent);
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
                    $('#ImgStr').val(Item.ItemImage);
                    // console.log(Item.ItemImage);
                    $('#Brand').val(Item.Brand);
                    // console.log(document.getElementById('Brand').value);
                    $('#UWeight').val(Item.UWeight);
                    // console.log(document.getElementById('UWeight').value);
                    $('#MaxCount').val(Item.MaxCount);
                    // console.log(document.getElementById('MaxCount').value);
                    $('#MRP').val(Item.MRP);
                    // console.log(document.getElementById('MRP').value);
                    $('#Status').val(Item.Status);

                }).then(changeState)
            })


            const searchbox = document.getElementById("product-search");
            searchbox.addEventListener("focus", function () {
                console.log("hello")
                const itemBtn = document.getElementsByClassName('btn-row')[0];
                $(itemBtn).trigger("click");
            })
            searchbox.addEventListener("keyup", function () {
                let input = document.getElementById("product-search").value.toUpperCase();
                let table = document.getElementById("item-table");
                items = table.getElementsByClassName("row");
                Array.prototype.forEach.call(items, function (ulelement) {
                    let brand = ulelement.getElementsByClassName("row-brand")[0].textContent || ulelement.getElementsByClassName("row-brand")[0].innerText;
                    let name = ulelement.getElementsByClassName("row-name")[0].textContent || ulelement.getElementsByClassName("row-name")[0].innerText;
                    if (name.toUpperCase().indexOf(input) > -1 || brand.toUpperCase().indexOf(input) > -1) {
                        ulelement.style.display = "";
                    } else {
                        ulelement.style.display = "none";
                    }

                });
            });
        })
    })
    $('#veg-tab-items').trigger("click");
})

function changeState() {
    if ($('#Status').val() === "1") {
        console.log(document.getElementById('Status'))
        $('#Status').prop('checked', true);
    } else {
        console.log(document.getElementById('Status'))
        $('#Status').prop('checked', false);
    }

}

$('#Status').change(function () {
    if ($(this).is(':checked')) {
        $(this).val(1);
        console.log(document.getElementById('Status'))
    } else {
        $(this).val(0);
        $(this).attr('checked', false);
        console.log(document.getElementById('Status'))
    }
})












