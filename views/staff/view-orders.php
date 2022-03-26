<link rel="stylesheet" href="/css/shopOrder.css"/>
<link rel="stylesheet" href="/css/all.css"/>
<link rel="stylesheet" href="/css/dashboardStyle.css"/>
<link rel="stylesheet" href="/css/dashboardStyleStaff.css"/>

<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"/>
<script src="/js/jquery.min.js"></script>
<script src="/js/shopOrder.js" defer></script>
<div style="height: 430px; margin-top: 0" class="core staff-order">
    <h1 class="heading">System <span>Orders</span></h1>
    <div class="tabs">
        <ul class="order-tabs">
            <li><a data-href="neworders" id="new-tab" class="btn-tab">New</a></li>
            <li><a data-href="onorders" id="on-tab" class="btn-tab">On-Going</a></li>
            <li><a data-href="pastorders" id="past-tab" class="btn-tab">Past</a></li>
        </ul>
        <div class="tab-content">
            <div id="new" data-tab-content class="active">
                <table id="Orders" class="">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date Time</th>
                        <th>Customer Name</th>
                        <th>Note</th>
                        <th>Customer Contact</th>
                        <th>Rider Id</th>
                        <th>Rider Name</th>
                        <th>Rider Contact</th>
                        <th>Delivery Cost</th>
                        <th>Total</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody id="Order-info-rows">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="/js/staff-order.js"></script>


