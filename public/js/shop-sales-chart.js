
//Api links
const URLShopItems= host + "/api/getshopitemlist" ;
const URLItemSales= host + "/api/getshopitemsales" ;

const ItemTable = document.getElementById('itemList');


function itemDropDownBtn() {
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
            }
        }
    }
}


$( document ).ready(function() {

    $.getJSON(URLShopItems, function (items) {
        items.forEach(item=>{
            const ItemRow = document.createElement('tr');
            ItemRow.onclick = function() {getchart(item[0].ItemID, item[0].ItemImage,item[0].Name)};
            ItemRow.innerHTML = `
                    <td id="ItemImage" class="row-img">
                    <img src="${item[0].ItemImage}" alt="Item Image" />
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
        let unit
        let unitTag = '';

        switch (parseInt(sales['unit'][0]['Unit'])){
            case 0 : unit = parseFloat(sales['unit'][0]['UWeight']) ; unitTag = 'Kg'; break ;
            case 1 : unit = parseFloat(sales['unit'][0]['UWeight']) ; unitTag = 'L'; break ;
            case 2 : unit = 1;  unitTag = 'Units'; break ;
            default: unit = 1 ; break ;
        }


        let xValues = [] ;
        let yValues = [] ;
        let a = Object.values(sales)[0]
        console.log(a);
        console.log(Object.keys(sales).length)
        for (let i = 0; i < Object.keys(sales).length; i++) {
            if(Object.values(sales)[i]["sales"] == null){
                yValues.push(0);
            }
            else {
                yValues.push(parseInt(Object.values(sales)[i]["sales"])*unit)
            }
        }

        xValues = Object.keys(sales);
        let average = []

        for (let i = 0; i < yValues.length; i++) {
            average.push((yValues[i]/12).toFixed(2))
        }

        const sum = yValues.reduce((a, b) => {
            return a + b;
        });

        var ctx = document.getElementById("salesChart").getContext("2d");
        document.getElementById("order-linechart-average").innerHTML = (sum/12).toFixed(2) + " "+ unitTag;
        document.getElementById("order-linechart-sum").innerHTML = parseFloat(sum,2) + " "+ unitTag;

            var data = {
                labels:xValues,
                datasets: [
                    {
                        fill:false,
                        label: "",
                        fillColor: "green",
                        strokeColor: "green",
                        pointColor: "green",
                        pointStrokeColor: "green",
                        lineTension: 0,
                        data: yValues
                    },
                    {
                        fill:false,
                        fillColor: "#90ee90",
                        strokeColor: "#90ee90",
                        lineTension: 0,
                        data: average
                    },
                ]
            };
            new Chart(ctx).Bar(data, {
                onAnimationComplete: function () {
                    var targetCtx = document.getElementById("salesChartAxis").getContext("2d");
                    targetCtx.drawImage(0,0,0);
                }
            });
    });
}