<?php
/** @var $model \app\models\ShopItem **/
/** @var $form app\core\form\Form */
?>

<link rel="stylesheet" href="/css/dashboardStyle.css">
<link rel="stylesheet" href="/css/dashboardStyleStaff.css">

<div class="core" style=" height: 780px">
    <h1 class="heading">Ongoing <span>Products</span></h1>
    <div class="container-items">
        <div class="safety-details">
            <img src="https://img.icons8.com/emoji/16/26e07f/check-mark-button-emoji.png"/>
            <span>: Item stock is Safe </span>
            <br>
            <img src="https://img.icons8.com/office/16/000000/high-risk.png"/>
            <span>: Item stock is not Safe </span>
        </div>

        <table class="table-item small-first-col" id="ongoing-item-table">
            <thead>
            <tr>

                <th>Item ID</th>
                <th>Item Image</th>
                <th>Item Name</th>
                <th>Brand Name</th>
                <th>Unit Weight</th>
                <th>Max price</th>
                <th>Unit Price</th>
                <th>Stock</th>
                <th>Safety Stock</th>
                <th>Re Order Level</th>
                <th></th>
            </tr>
            </thead>

            <?php $form = \app\core\form\Form::begin("","post",'',[""]); ?>
            <tbody style="height: 20rem;" id="item-table" class="item-table-body body-half-screen">


            </tbody>
            <?php \app\core\form\Form::end(); ?>

        </table>

        <button type="submit" id="updateItems" class="button-item-update" onclick="updateShopItem()"><span id="status">Update Items</span></button>
        <p style="margin-bottom: 2rem"><br> <br>
            Safety Stock : <br>Re Order Level : </p>

    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="/css/shop-items.css">
<script src="/js/shop-ongoing-items.js" defer></script>
