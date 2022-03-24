
const host = window.location.origin; //http://domainname

const orderInfoURL = host+'/dashboard/staff/vieworder';
const orderURL = host+'/dashboard/staff/'


$(document).ready(function (){
    $('.btn-tab').click(function (){
        $('#Order-info-rows').empty();
        const getOrderInfoURL = orderURL.concat($(this).data("href"));
        console.log(getOrderInfoURL)
        $.getJSON(getOrderInfoURL,function (orders){
            orders.forEach(order=>{
                const orderViewURL = orderInfoURL+"?OrderID="+order.OrderID;
                const orderRow = document.createElement('tr');
                orderRow.innerHTML = `
                        <td>${order.OrderID}</td>
                        <td>${order.OrderDate}</td>
                        <td>${order.custName}</td>
                        <td>${order.Note}</td>
                        <td>${order.custContact}</td>
                        <td>${order.RiderID}</td>
                        <td>${order.RiderName}</td>
                        <td>${order.RiderContact}</td>
                        <td>${order.DeliveryCost}</td>
                        <td>${order.TotalCost}</td>
                        <td> <a class="order-view" href=${orderViewURL}>
                        <i class="fas fa-arrow-circle-right"></i></a></td>
                `
                $('#Order-info-rows').append(orderRow);
            })
        }).then(function (){
            $('#Orders').DataTable();
        })
    });
    // $('#on-tab').click(function (){
    //     $('#newDelivery').addClass('display-off');
    //     $('#onDelivery').removeClass('display-off');
    //     $('#pastDelivery').addClass('display-off');
    //     $('#on-order-table').empty();
    //
    // });
    // $('#past-tab').click(function (){
    //     $('#newDelivery').addClass('display-off');
    //     $('#onDelivery').addClass('display-off');
    //     $('#pastDelivery').removeClass('display-off');
    //     $('#past-order-table').empty();
    //
    // });
    $('#new-tab').trigger('click');


});