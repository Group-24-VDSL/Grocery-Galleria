<?php
/** @var $model \app\models\Item **/
/** @var $form app\core\form\Form */
?>
<div class="core">
    <h1 class="heading">System <span>Products</span></h1>
    <div class="container-core">
        <ul id="tab=btns" class="tabs">
            <li><button data-href="?Category=0" id="btn-vege" class="btn-tab">Vegetables</button></li>
            <li><button data-href="?Category=1" class="btn-tab">Fruits</button></li>
            <li><button data-href="?Category=2" class="btn-tab">Grocery</button></li>
            <li><button data-href="?Category=3" class="btn-tab">Fish</button></li>
            <li><button data-href="?Category=4" class="btn-tab">Meat</button></li>
        </ul>
        <div class="table-header">
            <ul>
                <li>Photo</li>
                <li>Name</li>
                <li>Brand</li>
                <li>Unit</li>
                <li>MRP</li>
                <li>UnitWeight</li>
                <li>MaxCount</li>
                <li>Update</li>
            </ul>
        </div>
        <div id="item-table" class="table-details scroller">
<!--            <ul class="row">-->
<!--                <li id="ItemImage" class="row-img">-->
<!--                    <img src="/views/shop/img/Pic915013.jpg" alt="" />-->
<!--                </li>-->
<!--                <li id="Name" class="row-name">Potato</li>-->
<!--                <li id="Brand" class="row-brand">Null</li>-->
<!--                <li id="Unit" class="row-unit">Kg</li>-->
<!--                <li id="UWeight" class="row-minWeight">300</li>-->
<!--                <li id="MRP" class="row-mrp">67</li>-->
<!--                <li id="MaxCount" class="row-IncStep">7</li>-->
<!--                <li class="row-ubutton">-->
<!--                    <a  class="btn-row" type="submit">Update</a>-->
<!--                </li>-->
<!--            </ul>-->
        </div>
    </div>
</div>
