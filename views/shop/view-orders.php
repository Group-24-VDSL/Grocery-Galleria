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
<script src="/js/shop-orders.js" defer></script>

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
                        <tbody id="item-table-new" class="item-table-body body-half-screen">

                        </tbody>
                        <?php \app\core\form\Form::end(); ?>
                    </table>
                </div>
                <div id="completed" data-tab-content >
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
                        <tbody id="item-table-complete" class="item-table-body body-half-screen" onload="document.refresh();">

                        </tbody>
                        <?php \app\core\form\Form::end(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>