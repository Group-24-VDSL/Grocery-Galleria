<?php
/** @var $model \app\models\ShopItem **/
/** @var $form app\core\form\Form */
?>

<link rel="stylesheet" href="/css/shop-items.css">
<script src="/js/dashboard-shop.js" defer></script>

<div class="core">
    <h1 class="heading">Ongoing <span>Products</span></h1>
    <div class="container-items">

        <table class="table-item small-first-col">
            <thead>
            <tr>
                <th></th>
                <th>Item ID</th>
                <th>Item Image</th>
                <th>Item Name</th>
                <th>U/Weight</th>
                <th>U/Price</th>
                <th>U/Price</th>
                <th>U/Price</th>
                <th>Max Price</th>
                <th>Stock</th>
                <th>enable</th>
                <th>enable</th>
            </tr>
            </thead>
            <tbody id="item-table" class="item-table-body body-half-screen">


            </tbody>
        </table>
<!--        <div class="ongoing-items scroller">-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic915013.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Potato</li>-->
<!--                <li class="item-mrp">67</li>-->
<!---->
<!--                <li class="item-unit">Kg</li>-->
<!---->
<!--                <li class="item-uprice">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="unitprice"-->
<!--                            name="unitprice"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic914005.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Big Onion</li>-->
<!--                <li class="item-mrp">67</li>-->
<!--                <li class="item-uprice">81</li>-->
<!--                <li class="item-unit">Kg</li>-->
<!--                <li class="item-cStock">-->
<!--                    <label for="currentStock">10</label>-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic914007.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Green Chillies</li>-->
<!--                <li class="item-mrp">67</li>-->
<!--                <li class="item-uprice">81</li>-->
<!--                <li class="item-unit">Kg</li>-->
<!--                <li class="item-cStock">-->
<!--                    <label for="currentStock">10</label>-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic914015.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Garlic</li>-->
<!--                <li class="item-mrp">67</li>-->
<!--                <li class="item-uprice">81</li>-->
<!--                <li class="item-unit">Kg</li>-->
<!--                <li class="item-cStock">-->
<!--                    <label for="currentStock">10</label>-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic915016.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Tomatoe</li>-->
<!--                <li class="item-mrp">67</li>-->
<!--                <li class="item-uprice">81</li>-->
<!--                <li class="item-unit">Kg</li>-->
<!--                <li class="item-cStock">-->
<!--                    <label for="currentStock">10</label>-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic915008.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Tomatoe</li>-->
<!--                <li class="item-mrp">67</li>-->
<!--                <li class="item-uprice">81</li>-->
<!--                <li class="item-unit">Kg</li>-->
<!--                <li class="item-cStock">-->
<!--                    <label for="currentStock">10</label>-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic914039.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Pumpkin</li>-->
<!--                <li class="item-mrp">67</li>-->
<!--                <li class="item-uprice">81</li>-->
<!--                <li class="item-unit">Kg</li>-->
<!--                <li class="item-cStock">-->
<!--                    <label for="currentStock">10</label>-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul class="item">-->
<!--                <li class="item-img">-->
<!--                    <img src="/views/shop/img/Pic914012.jpg" alt="" />-->
<!--                </li>-->
<!--                <li class="item-name">Tomatoe</li>-->
<!--                <li class="item-mrp">67</li>-->
<!--                <li class="item-uprice">81</li>-->
<!--                <li class="item-unit">Kg</li>-->
<!--                <li class="item-cStock">-->
<!--                    <label for="currentStock">10</label>-->
<!--                </li>-->
<!--                <li class="item-uStock">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            min="10"-->
<!--                            max="200"-->
<!--                            value="10"-->
<!--                            id="currentStock"-->
<!--                            name="currentStock"-->
<!--                    />-->
<!--                </li>-->
<!--                <li class="item-ubutton">-->
<!--                    <button class="btn-item" type="submit">Update</button>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
</div>
