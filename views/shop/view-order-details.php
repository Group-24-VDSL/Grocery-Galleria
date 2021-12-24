<?php
/** @var $model \app\models\ShopOrder **/
/** @var $shoporder \app\models\ShopOrder **/
/** @var $shopitem \app\models\ShopItem **/
/** @var $item \app\models\Item **/
/** @var $cartitems \app\models\OrderCart **/

///** @var $model \app\models\Item **/
use app\models\Item;
use app\models\ShopItem;
?>

<!--<link rel="stylesheet" href="/css/Register.css">-->
<link rel="stylesheet" href="/css/dashboardStyle.css" />
<link rel="stylesheet" href="/css/all.css" />
<link rel="stylesheet" href="/css/shop-order-details.css" />
<script src="/js/jquery.min.js"></script>
<!--//<script src="/js/shop-orders.js" defer></script>-->
<script src="/js/shopOrderDetails.js" defer></script>


<section  class="section-home">
    <div class="home-content" >
        <div class="overview-boxes" id = "order-box" >
            <div class="box">
                <div class="content">
                    <div class="box-topic">Order ID</div>
                    <div class="number-details">
                        <?php
                            $orderid = $shoporder-> CartID;
                            echo  $orderid ;
                        ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/external-itim2101-flat-itim2101/64/000000/external-order-shopping-and-ecommerce-itim2101-flat-itim2101.png"/>
            </div>

            <div class="box">
                <div class="content">
                    <div class="box-topic">Status</div>
                    <div class="number-details">
                        <?php
                        if ($shoporder->Status == 0)
                            echo "New";
                        elseif ($shoporder->Status == 1)
                            echo "Completed";
                        ?>

                    </div>
                </div>
                <img src="https://img.icons8.com/external-becris-flat-becris/64/000000/external-history-literary-genres-becris-flat-becris.png"/>
            </div>

            <div class="box">
                <div class="content">
                    <div class="box-topic">Total(LKR)</div>
                    <div class="number-details">
                        <?php
                        $shoptotal = $shoporder -> ShopTotal ;
                        echo $shoptotal ;
                        ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/external-justicon-flat-justicon/64/000000/external-cash-gambling-justicon-flat-justicon.png"/>
            </div>

            <div class="box">
                <div class="content">
                    <div class="box-topic">Item Count</div>
                    <div class="number-details">
                        <?php
                        $itemcount = count($cartitems) ;
                        echo $itemcount ;
                        ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/external-wanicon-flat-wanicon/64/000000/external-product-advertising-wanicon-flat-wanicon.png"/>
            </div>

        </div>
        <div style="height: 450px" class="core">
            <div class="container-order-details">
                <h1 class="heading"> <span>Item List</span></h1>

                <div class="item-list">
                    <table class="table-scroll small-first-col">
                        <thead>
                            <th></th>
                            <th>Item ID</th>
                            <th>Item Image</th>
                            <th>Item Name</th>
                            <th>U/Weight</th>
                            <th>U/Price(LKR)</th>
                            <th>Quantity</th>
                            <th>Price(LKR)</th>

                        </thead>
                        <tbody class="body-half-screen">
                            <?php
                                foreach($cartitems as $cartitem){
                                    $itemid = $shopitem[$cartitem->ShopID][$cartitem->ItemID][1]->ItemID;
                                    $itemimage = $shopitem[$cartitem->ShopID][$cartitem->ItemID][1]->ItemImage;
                                    $itemname = $shopitem[$cartitem->ShopID][$cartitem->ItemID][1]->Name;
                                    $itemuweight = $shopitem[$cartitem->ShopID][$cartitem->ItemID][1]->UWeight;
                                    $itemuprice = $shopitem[$cartitem->ShopID][$cartitem->ItemID][0]->UnitPrice;
                                    $quantity = $cartitem->Quantity;
                                    $price = $quantity * $itemuprice;
                                    echo '<tr>';
                                    echo '<td></td>' ;
                                    echo '<td>'.$itemid.'</td>';
                                    echo '<td><img class="item-img" src='.$itemimage.'></td>';
                                    echo '<td>'.$itemname.'</td>';
                                    echo '<td>'.$itemuweight.'</td>';
                                    echo '<td>'.$itemuprice.'</td>';
                                    echo ' <td>'.$quantity.'</td>';
                                    echo '<td>'.$price.'</td>';
                                    echo '</tr>';
                                 }
                                ?>
                        </tbody>
                    </table>
                    <div style="gap: 2rem" class="complete-section">

                            <table style="height: 120px" class="details">
                                <tbody>
                                <tr style="height: 60px">
                                    <th>Total (LKR) :</th>
                                    <td>
                                        <?php
                                        $shoptotal = $shoporder -> ShopTotal ;
                                        echo $shoptotal ;
                                        ?>
                                    </td>
                                </tr>

                                <tr style="height: 60px">
                                    <th>Number of Items:</th>
                                    <td>
                                        <?php
                                        $itemcount = count($cartitems) ;
                                        echo $itemcount ;
                                        ?>
                                    </td>
                                </tr >
                                </tbody>
                            </table>
                        <?php $form = \app\core\form\Form::begin("","post","updateShopOrderStatus");?>
                        <?php
                        if($shoporder -> Status == 0): ?>
                            <?php

                            echo $form->fieldonly($model, "ShopID")->setValue($shoporder-> ShopID)->numberField()->hiddenField();
                            echo $form->fieldonly($model, "CartID")->setValue($shoporder-> CartID)->numberField()->hiddenField();
                            echo $form->fieldonly($model, "Status")->setValue(1)->numberField()->hiddenField();?>
                            <button type="submit" id="not-complete" class="complete-btn" value="Complete" onclick="markCompleted()"><span id = "status">Mark as Completed</span></button>
                            <div style="display: none" id="completed" class="complete-div" type="submit" value="Complete"><span id = "status">Order is Completed !!!</span><img src="https://img.icons8.com/color/48/000000/checked-2--v1.png"/></div>
                        <?php endif; ?>
                        <?php \app\core\form\Form::end()?>

                    </div>
                </div>
            </div>
        </div>
</section>
