<link rel="stylesheet" href="/css/shopOrder.css" />
<link rel="stylesheet" href="/css/delivery-order.css" />
<link rel="stylesheet" href="/css/all.css" />
<link rel="stylesheet" href="/css/dashboardStyle.css" />
<link rel="stylesheet" href="/css/dashboardStyleStaff.css" />

<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"/>
<script src="/js/jquery.min.js"></script>
<script src="/js/shopOrder.js" defer></script>

<div class="overview-boxes">
    <div class="box">
        <div class="content">
            <div class="box-topic">Total Delivery</div>
            <div class="number">1276</div>
            <div class="indicator">
                <i class="bx bxs-up-arrow-square"></i>
                <span class="text">Up so far</span>
            </div>
        </div>
        <!-- <i class='bx bx-cart-alt cart'></i> -->
        <img src="https://img.icons8.com/external-konkapp-flat-konkapp/64/000000/external-delivery-logistic-and-delivery-konkapp-flat-konkapp.png"/>
    </div>
    <div class="box">
        <div class="content">
            <div class="box-topic">Total Revenue</div>
            <div class="number">1276</div>
            <div class="indicator">
                <i class="bx bxs-up-arrow-square"></i>
                <span class="text">Up so far</span>
            </div>
        </div>
        <img
            src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-revenue-money-and-economy-itim2101-lineal-color-itim2101.png"
        />
    </div>
    <!-- <i class='bx bx-cart-alt cart'></i> -->

    <div class="box">
        <div class="content">
            <div class="box-topic">Total Income</div>
            <div class="number">12,876</div>
            <div class="indicator">
                <i class="down bx bxs-down-arrow-square"></i>
                <span class="text">Down from today</span>
            </div>
        </div>
        <img
            src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-financial-mobile-payment-itim2101-lineal-color-itim2101.png"
        />
    </div>
    <div class="box">
        <div class="content">
            <div class="box-topic">Total Orders</div>
            <div class="number">11,086</div>
            <div class="indicator">
                <i class="down bx bxs-down-arrow-square"></i>
                <span class="text">Down From Today</span>
            </div>
        </div>
        <img
            src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-order-online-shopping-itim2101-lineal-color-itim2101.png"
        />
    </div>
</div>

<div style="height: 460px; margin-top: 0; margin-bottom: 0" class="core staff-order">
    <h1 class="heading"> <span>Orders</span></h1>
    <div class = "tabs">
        <ul class="order-tabs">
            <li data-tab-target="#new" class="active tab">New</li>
            <li data-tab-target="#ongoing" class="tab">On-Going</li>
            <li data-tab-target="#completed" class="tab">Completed</li>
        </ul>

        <div class = "tab-content">
            <div id="new" data-tab-content class="active">
                <table class="table-scroll small-first-col">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Delivery ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Customer ID</th>
                        <th>Deliver Price(LKR)</th>
                        <th>No. Of Shop</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody class="body-half-screen">
                    <tr>
                        <td>1.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td> <a href="/dashboard/delivery/viewnewdelivery"><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></a></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><a href="/dashboard/delivery/viewnewdelivery"><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></a></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><a href="/dashboard/delivery/viewnewdelivery"><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></a></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>

                    </tbody>
                </table>

            </div>
            <div id="ongoing" data-tab-content >
                <table class="table-scroll small-first-col">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Delivery ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Customer ID</th>
                        <th>Rider ID</th>
                        <th>Deliver Price(LKR)</th>
                        <th>No. Of Shop</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody class="body-half-screen">
                    <tr>
                        <td>1.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><a href="/dashboard/delivery/viewongoingdelivery"><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></a></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><a href="/dashboard/delivery/viewongoingdelivery"><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></a></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><a href="/dashboard/delivery/viewongoingdelivery"><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></a></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div id="completed" data-tab-content >
                <table class="table-scroll small-first-col">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Delivery ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Customer ID</th>
                        <th>Rider ID</th>
                        <th>Deliver Price(LKR)</th>
                        <th>No. Of Shop</th>
                        <th>Finished Time</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody class="body-half-screen">
                    <tr>
                        <td>1.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><a href="/dashboard/delivery/viewcompletedelivery"><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></a></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>D00011</td>
                        <td>21-10-2021</td>
                        <td>08.33 AM</td>
                        <td>C009894</td>
                        <td>R90466</td>
                        <td>300.00</td>
                        <td>2</td>
                        <td>4.16 PM</td>
                        <td><button class="btn-item" type="submit"><span class="order-view"><i class="bx bx-show-alt"></i></span></button></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>