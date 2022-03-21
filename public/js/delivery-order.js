
const host = window.location.origin; //http://domainname

const newDeliveryURL = host+'/dashboard/delivery/newdelivery';
const onDeliveryURL = host+'/dashboard/delivery/onDelivery';
const pastDeliveryURL = host+'/dashboard/delivery/pastDelivery';
const deliverInfoURL = host+'/dashboard/delivery/deliveryInfo';

const newTab = document.getElementById('new-tab');
const onTab = document.getElementById('on-tab');
const pastTab = document.getElementById('past-tab');

$(document).ready(function (){
    $('#new-tab').click(function (){
        $('#newDelivery').removeClass('display-off');
        $('#onDelivery').addClass('display-off');
        $('#pastDelivery').addClass('display-off');
        $('#new-delivery-table').empty();
        $.getJSON(newDeliveryURL,function (deliveries){
            console.log(deliveries);
            deliveries.forEach(delivery=>{
                const deliveryURL = deliverInfoURL+"?OrderID="+delivery.OrderID;
                const orderRow = document.createElement('tr');
                orderRow.innerHTML = `
                        <td>${delivery.OrderID}</td>
                        <td>${delivery.OrderDate}</td>
                        <td>${delivery.RecipientName}</td>
                        <td>${delivery.Note}</td>
                        <td>${delivery.RecipientContact}</td>
                        <td>${delivery.DeliveryCost}</td>
                        <td>${delivery.TotalCost}</td>
                        <td> <a class="order-view" href=${deliveryURL}>
                        <i class="fas fa-arrow-circle-right"></i></a></td>
                `
                $('#new-delivery-table').append(orderRow);
            })
        })
    });
    $('#on-tab').click(function (){
        $('#newDelivery').addClass('display-off');
        $('#onDelivery').removeClass('display-off');
        $('#pastDelivery').addClass('display-off');
        $('#on-delivery-table').empty();

    });
    $('#past-tab').click(function (){
        $('#newDelivery').addClass('display-off');
        $('#onDelivery').addClass('display-off');
        $('#pastDelivery').removeClass('display-off');
        $('#past-delivery-table').empty();

    });
    $('#new-tab').trigger('click');


});