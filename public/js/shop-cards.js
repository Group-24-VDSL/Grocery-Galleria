const hosts = window.location.origin; //http://domainname
const URLShopCards = hosts + "/api/getshopcards";
// let obj = {"ShopID":5};
$(document).ready(function () {
    $.ajax({
        url : URLShopCards,
        data : JSON.stringify(),
        type : 'GET',
        dataType:'json',
        processData: false,
        contentType : 'application/json'
    }).done(function (data){
        if(data['Total_Revenue']===null){
            data['Total_Revenue'] = '0.00' ;
        }
        else if (data['Today_Revenue']===null){
            data['Today_Revenue'] = '0.00'
        }
        document.getElementById('total-orders').innerHTML = data['Total_Orders'];
        document.getElementById('total-revenue').innerHTML = data['Total_Revenue'];
        document.getElementById('today-orders').innerHTML = data['Today_Orders'];
        document.getElementById('today-revenue').innerHTML = data['Today_Revenue'];

    });
})