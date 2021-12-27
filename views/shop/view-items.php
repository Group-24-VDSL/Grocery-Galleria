<?php
/** @var $model \app\models\ShopItem **/
/** @var $form app\core\form\Form */
?>

<link rel="stylesheet" href="/css/shop-items.css">
<script src="/js/shop-ongoing-items.js" defer></script>
<link rel="stylesheet" href="/css/dashboardStyle.css">
<link rel="stylesheet" href="/css/dashboardStyleStaff.css">

<div class="core" style="height: height: 580px">
    <h1 class="heading">Ongoing <span>Products</span></h1>
    <div class="container-items">
        <div class="safety-details">
            <img src="https://img.icons8.com/emoji/16/26e07f/check-mark-button-emoji.png"/>
            <span>: Stock is Safe </span>
            <br>
            <img src="https://img.icons8.com/office/16/000000/high-risk.png"/>
            <span>: Stock is not Safe </span>
        </div>

        <table class="table-item small-first-col">
            <thead>
            <tr>
                <th></th>
                <th>Item ID</th>
                <th>Item Image</th>
                <th>Item Name</th>
                <th>Brand</th>
                <!--                <th>Unit</th>-->
                <th>Unit Weight</th>
                <th>MRP</th>
                <th>Unit Price</th>
                <th>Stock</th>
                <th></th>

            </tr>
            </thead>
            <?php $form = \app\core\form\Form::begin("","post",'',[""]); ?>
            <tbody id="item-table" class="item-table-body body-half-screen">


            </tbody>
            <?php \app\core\form\Form::end(); ?>
        </table>

        <button type="submit" id="updateItems" class="button-item-update" onclick="updateShopItem()"><span id="status">Update Items</span></button>

    </div>
</div>
