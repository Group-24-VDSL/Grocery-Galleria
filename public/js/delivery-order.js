
const host = window.location.origin; //http://domainname

const deliverInfoURL = host+'/dashboard/delivery/deliveryInfo';
const deliveryURL = host+'/dashboard/delivery/'


$(document).ready(function (){
    $('.btn-tab').click(function (){
        $('#Delivery-info-rows').empty();
        const getDeliveryInfoURL = deliveryURL.concat($(this).data("href"));
        console.log(getDeliveryInfoURL)
        $.getJSON(getDeliveryInfoURL,function (deliveries){
            deliveries.forEach(delivery=>{
                const deliveryURL = deliverInfoURL+"?OrderID="+delivery.OrderID;
                const orderRow = document.createElement('tr');
                orderRow.innerHTML = `
                        <td>${delivery.OrderID}</td>
                        <td>${delivery.OrderDate}</td>
                        <td>${delivery.custName}</td>
                        <td>${delivery.Note}</td>
                        <td>${delivery.custContact}</td>
                        <td>${delivery.RiderID}</td>
                        <td>${delivery.RiderName}</td>
                        <td>${delivery.RiderContact}</td>
                        <td>${delivery.DeliveryCost}</td>
                        <td>${delivery.TotalCost}</td>
                        <td> <a class="order-view" href=${deliveryURL}>
                        <i class="fas fa-arrow-circle-right"></i></a></td>
                `
                $('#Delivery-info-rows').append(orderRow);
            })
        }).then(function (){
            $('#Delivery').DataTable();
        })
    });
    // $('#on-tab').click(function (){
    //     $('#newDelivery').addClass('display-off');
    //     $('#onDelivery').removeClass('display-off');
    //     $('#pastDelivery').addClass('display-off');
    //     $('#on-delivery-table').empty();
    //
    // });
    // $('#past-tab').click(function (){
    //     $('#newDelivery').addClass('display-off');
    //     $('#onDelivery').addClass('display-off');
    //     $('#pastDelivery').removeClass('display-off');
    //     $('#past-delivery-table').empty();
    //
    // });
    $('#newDel').trigger('click');


});