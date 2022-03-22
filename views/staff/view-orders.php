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
            <li><a data-name="newOrders" id="new-tab" class="btn-tab">New</a></li>
            <li><a data-name="onOrders" id="on-tab" class="btn-tab">On-Going</a></li>
            <li><a data-name="pastOrders" id="past-tab" class="btn-tab">Past</a></li>
        </ul>

        <div class="tab-content">

            <div class="container-items">
                <div class="table-header">

                    <ul style="padding-right: 20px">
                        <li>Order Id</li>
                        <li>Order Date</li>
                        <li>Order Time</li>
                        <li>Customer ID</li>
                        <li>No. of Shops</li>
                        <li>Total (LKR)</li>
                        <li>City</li>
                        <li>Suburb</li>
                        <li>View</li>
                    </ul>
                </div>
                <div style="height: 190px" class="ongoing-items scroller ">
                    <ul class="item">
                        <li class="order-id">
                            1230
                        </li>
                        <li class="order-date">27/09/2021</li>
                        <li class="order-time">08:00 AM</li>
                        <li class="customer-id">1102922</li>
                        <li class="shop-no">4</li>
                        <li class="order-total">2500.00</li>
                        <li>Colombo</li>
                        <li>Nugegoda</li>
                        <li class="ubutton">
                            <button class="btn-item" type="submit"><span class="order-view"><i
                                            class='bx bx-show-alt'></i></span></button>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="core">
    <h1 class="heading">Add <span>Complaint</span></h1>
</div>
<script src="/js/staff-order.js" defer></script>


