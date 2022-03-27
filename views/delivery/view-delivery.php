<!--<link rel="stylesheet" href="/css/shopOrder.css" />-->
<link rel="stylesheet" href="/css/delivery-order.css" />
<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"/>
<script src="/js/jquery.min.js"></script>
<!--<script src="/js/shopOrder.js" defer></script>-->


<div class="core">
    <h1 class="heading">System <span>Orders</span></h1>
    <div class="container-core delivery-core ">
        <ul class="tabs">
            <li><a data-href="newdelivery" class="btn-tab" id="newDel">New</a></li>
            <li><a data-href="ondelivery" class="btn-tab" id="onDel">On-Going</a></li>
            <li><a data-href="pastdelivery" class="btn-tab" id="pastDel">Past</a></li>
        </ul>
        <div class = "tab-content">
            <div id="new" data-tab-content class="active">
                <table id="Delivery" class="">
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
                    <tbody id="Delivery-info-rows">
                    </tbody>
                </table>
            </div>

            </div>
        </div>

    </div>
<script src="/js/delivery-order.js"></script>