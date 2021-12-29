const host = window.location.origin; //http://domainname

//Api links
const URLShopItems= host + "/api/getshopitemlist" ;
const URLItemSales= host + "/api/getshopitemsales" ;

const ItemTable = document.getElementById('itemList');


function myFunction() {
    document.getElementById("itemDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn-item')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");

        document.getElementsByClassName("dropbtn-item");

        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                // openDropdown.classList.remove('show');

            }
        }
    }
}



$( document ).ready(function() {

    $.getJSON(URLShopItems, function (items) {

items.forEach(item=>{
    console.log(item[0].ItemID)

    const ItemRow = document.createElement('tr');
     ItemRow.onclick = function() {getchart(item[0].ItemID, item[0].ItemImage,item[0].Name)};
    ItemRow.innerHTML = `
                    <td id="ItemImage" class="row-img">
                     <img src="${item[0].ItemImage}" alt="" />
                  <td id="Name" class="row-name">${item[0].Name}</td></button>

                
                
                `
    ItemTable.appendChild(ItemRow);
})

    });
});



function getchart(ItemID,ItemImage,ItemName){
    document.getElementById("chart-image").src = ItemImage;
    document.getElementById("chart-item-name").innerHTML= ItemName;
    const URLGetItemSales = URLItemSales.concat("?ItemID=").concat(ItemID) ;
    console.log(URLGetItemSales);
    $.getJSON(URLGetItemSales, function (sales) {

        let xValues = [] ;
        let yValues = [] ;

        console.log(yValues)

        let a = Object.values(sales)[0]
        console.log(a["sales"]);
        console.log(Object.keys(sales).length)
        for (let i = 0; i < Object.keys(sales).length; i++) {
            if(Object.values(sales)[i]["sales"] == null){
                yValues.push(0);
            }
            else {
                yValues.push(parseInt(Object.values(sales)[i]["sales"]))
            }

        }
        xValues = Object.keys(sales);

        let average = []
        for (let i = 0; i < yValues.length; i++) {
            average.push((yValues[i]/12).toFixed(2))
        }



        const sum = yValues.reduce((a, b) => {var ctx = document.getElementById("myChart").getContext("2d");

            var data = {
                labels:xValues,
                datasets: [
                    {
                        // borderColor : green,
                        fill:false,
                        label: "My First dataset",
                        fillColor: "green",
                        strokeColor: "green",
                        pointColor: "green",
                        pointStrokeColor: "green",
                        lineTension: 0,
                        // pointHighlightFill: "#fff",
                        // pointHighlightStroke: "rgba(220,220,220,1)",
                        data: yValues
                    },
                    {
                        fill:false,
                        // label: "My First dataset",
                        fillColor: "#51ac37",
                        strokeColor: "#51ac37",
                        lineTension: 0,
                        // pointHighlightFill: "#fff",
                        // pointHighlightStroke: "rgba(220,220,220,1)",
                        data: average
                    }
                ]

            };

            var data2 = {
                labels:xValues,
                datasets: [
                    {
                        fill:false,
                        // label: "My First dataset",
                        fillColor: "rgba(220,220,220,0)",
                        strokeColor: "green",
                        pointColor: "green",
                        pointStrokeColor: "green",
                        lineTension: 0,
                        // pointHighlightFill: "#fff",
                        // pointHighlightStroke: "rgba(220,220,220,1)",
                        data: yValues
                    },




                ]

            };

            new Chart(ctx).Bar(data, {
                onAnimationComplete: function () {
                    // var sourceCanvas = this.chart.ctx.canvas;
                    // var copyWidth = this.scale.xScalePaddingLeft - 4;
                    // var copyHeight = this.scale.endPoint + 15;
                    var targetCtx = document.getElementById("myChartAxis").getContext("2d");
                    // targetCtx.canvas.width = copyWidth;
                    targetCtx.drawImage(0,0,0);


                }
            });
            return a + b;
        });



        // var ctx = document.getElementById("myChart").getContext("2d");
        //
        //  new Chart(ctx, {
        //     // type: "bar",
        //     data: {
        //         labels: xValues,
        //         datasets: [{
        //             type: "bar",
        //             label: 'Orders in month',
        //             backgroundColor: "#55a630ff",
        //             borderColor: "#55a630ff",
        //             data: yValues
        //         },{
        //             type: "line",
        //             label: 'Orders in month',
        //             backgroundColor: "#55a630ff",
        //             borderColor: "#55a630ff",
        //             data: yValues
        //         }
        //
        //         ]
        //     },
        //     options: {
        //         legend: {display: false},
        //
        //         scales: {
        //             yAxes: [{
        //                 scaleLabel: {
        //                     display: true,
        //                     labelString: 'probability'
        //                 }
        //             }]
        //         },
        //
        //         plugins: {
        //             title: {
        //                 display: true,
        //                 text: 'ORDERS IN LAST YEAR',
        //                 color: '#55a630ff',
        //                 font: {
        //                     size: 14
        //                 }
        //             }
        //         }
        //     }
        // });


    });
}