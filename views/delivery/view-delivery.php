<!--<link rel="stylesheet" href="/css/shopOrder.css" />-->
<link rel="stylesheet" href="/css/delivery-order.css" />


<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"/>
<script src="/js/jquery.min.js"></script>
<!--<script src="/js/shopOrder.js" defer></script>-->


<!--<div style="height: 460px; margin-top: 0; margin-bottom: 0" class="core staff-order">-->
<!--    <h1 class="heading"> <span>Orders</span></h1>-->
<!--    <div class = "tabs">-->
<!--        <ul class="order-tabs">-->
<!--            <li data-tab-target="#new" class="active tab">New</li>-->
<!--            <li data-tab-target="#ongoing" class="tab">On-Going</li>-->
<!--            <li data-tab-target="#completed" class="tab">Completed</li>-->
<!--        </ul>-->
<div class="core">
    <h1 class="heading">System <span>Products</span></h1>
    <div class="container-core delivery-core ">
        <ul class="tabs">
            <li><a id="new-tab" class="btn-tab">New</a></li>
            <li><a id="on-tab" class="btn-tab">On-Going</a></li>
            <li><a id="past-tab" class="btn-tab">Past</a></li>
        </ul>
        <div class = "tab-content">
            <div id="new" data-tab-content class="active">
                <table id="newDelivery" class="table-scroll small-first-col ">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Time Stamp</th>
                        <th>Recipient Name</th>
                        <th>Note</th>
                        <th>Recipient Contact</th>
                        <th>Delivery Cost</th>
                        <th>Total</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody id="new-delivery-table" class="body-half-screen clean-table">
<!--                    <tr>-->
<!--                        <td>1</td>-->
<!--                        <td>2021-10-23 14:30:00</td>-->
<!--                        <td>Kushan</td>-->
<!--                        <td>0785674532</td>-->
<!--                        <td>140</td>-->
<!--                        <td>4760</td>-->
<!--                        <td> <a class="order-view" href="/dashboard/delivery/viewnewdelivery"><i class="fas fa-arrow-circle-right"></i></a></td>-->
<!--                    </tr><tr>-->
<!--                        <td>1</td>-->
<!--                        <td>2021-10-23 14:30:00</td>-->
<!--                        <td>Kushan</td>-->
<!--                        <td>0785674532</td>-->
<!--                        <td>140</td>-->
<!--                        <td>4760</td>-->
<!--                        <td> <a class="order-view" href="/dashboard/delivery/viewnewdelivery"><i class="fas fa-arrow-circle-right"></i></a></td>-->
<!--                    </tr><tr>-->
<!--                        <td>1</td>-->
<!--                        <td>2021-10-23 14:30:00</td>-->
<!--                        <td>Kushan</td>-->
<!--                        <td>0785674532</td>-->
<!--                        <td>140</td>-->
<!--                        <td>4760</td>-->
<!--                        <td> <a class="order-view" href="/dashboard/delivery/viewnewdelivery"><i class="fas fa-arrow-circle-right"></i></a></td>-->
<!--                    </tr>-->
                    </tbody>
                </table>

            </div>
            <div id="ongoing" data-tab-content >
                <table id="onDelivery" class="table-scroll small-first-col">
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
                    <tbody id = "on-delivery-table" class="body-half-screen clean-table">
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
                    </tbody>
                </table>
            </div>
            <div id="completed" data-tab-content >
                <table id="pastDelivery" class="table-scroll small-first-col">
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
                    <tbody id="past-delivery-table" class="body-half-screen clean-table">
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>