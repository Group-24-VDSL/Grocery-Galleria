<?php
/** @var $model \app\models\ShopOrder **/
/** @var $form app\core\form\Form */
?>

<link rel="stylesheet" href="/css/shopOrder.css" />
<link rel="stylesheet" href="/css/all.css" />
<link rel="stylesheet" href="/css/dashboardStyle.css" />
<link rel="stylesheet" href="/css/dashboardStyleStaff.css" />
<link rel="stylesheet" href="/css/shop-items.css" />
<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"/>
<script src="/js/jquery.min.js"></script>
<script src="/js/shopOrder.js" defer></script>
<script src="/js/system-orders.js" defer></script>

<div class="home-content">

    <div style="" class="core-order">
        <h1 class="heading"> <span>Orders</span></h1>
        <div class = "tabs">
            <ul class="order-tabs">
                <li data-tab-target="#new" class="active tab">New</li>
                <li data-tab-target="#completed" class="tab">Completed</li>
            </ul>

            <div class = "tab-content">
                <div id="new" data-tab-content class="active">
                    <table class="table-item small-first-col">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Order ID</th>
                            <th>Rider ID</th>
                            <th>Order Date</th>
                            <th>Order Time</th>
                            <th>Total (LKR)</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <?php $form = \app\core\form\Form::begin("","post",'',[""]); ?>
                        <tbody id="item-table" class="item-table-body body-half-screen">

                        </tbody>
                        <?php \app\core\form\Form::end(); ?>
                    </table>
                </div>
                <div id="completed" data-tab-content >
                    <div class="container-items">
                        <div class="table-header">
                            <ul class="complete-order-table-header">
                                <li>Order Id</li>
                                <li>Rider Id</li>
                                <li>Date</li>
                                <li>Time</li>
                                <li>Total<br>(LKR)</li>
                                <li>View</li>
                            </ul>
                        </div>
                        <div class="ongoing-items scroller .scroller-order">
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <a href="/dashboard/shop/viewcompleteorder"><button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button></a>

                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                            <ul class="item">
                                <li class="order-id">
                                    1230
                                </li>
                                <li class="rider-id">R00114</li>
                                <li class="order-date">27/09/2021</li>
                                <li class="order-time">08:00 AM</li>
                                <li class="order-total">2500.00</li>
                                <li class="ubutton">
                                    <button class="btn-item" type="submit"><span class = "order-view"><i class='bx bx-show-alt'></i></span></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>