<?php
/** @var $order * */
/** @var $cart * */
/** @var $customer * */
/** @var $shopOrders * */
/** @var $shopCount * */
//echo '<pre>'; print_r($order); echo '</pre>';
//echo '<pre>'; print_r($cart); echo '</pre>';
//echo '<pre>'; print_r($customer); echo '</pre>';
//echo '<pre>'; print_r($shopCount); echo '</pre>';
//echo '<pre>'; print_r($shopOrders); echo '</pre>';
// <?php echo
?>
<link rel="stylesheet" href="/css/shop-order-details.css"/>
<link rel="stylesheet" href="/css/order-details.css"/>


<section class="section-home">
    <div class="home-content order-content">
        <input type="hidden" id="OrderID" name="OrderID" value="<?php echo $order->OrderID ?>">
        <input type="hidden" id="CartID" name="CartID" value="<?php echo $order->CartID ?>">
        <input type="hidden" id="OdStatus" name="OdStatus" value="<?php echo $order->Status ?>">
        <div class="overview-boxes boxes-t2" id="">
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Order ID</div>
                    <div class="number-details"><?php echo $order->OrderID ?></div>
                </div>
                <img src="https://img.icons8.com/external-wanicon-flat-wanicon/64/000000/external-delivery-supermarket-wanicon-flat-wanicon.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Status</div>
                    <div id="orderStatus" class="number-details">New</div>
                </div>
                <img src="https://img.icons8.com/color/48/000000/unknown-status.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Date</div>
                    <div class="number-details"><?php echo $order->OrderDate ?></div>
                </div>
                <img src="https://img.icons8.com/external-icongeek26-linear-colour-icongeek26/64/000000/external-date-ecommerce-icongeek26-linear-colour-icongeek26.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Total</div>
                    <div class="number-details"><?php echo $order->TotalCost ?></div>
                </div>
                <img src="https://img.icons8.com/external-justicon-flat-justicon/64/000000/external-cash-gambling-justicon-flat-justicon.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div style=" font-size: 18.4px" class="box-topic">Delivery Charge</div>
                    <div class="number-details"><?php echo $order->DeliveryCost ?></div>
                </div>
                <img src="https://img.icons8.com/external-konkapp-flat-konkapp/64/000000/external-delivery-logistic-and-delivery-konkapp-flat-konkapp.png"/>
            </div>

        </div>
        <div class="overview-boxes boxes-t2">
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Recipient Name</div>
                    <div class="number-details"><?php if (empty($order->RecipientName)) {
                            echo $customer->Name;
                        } else {
                            echo $order->RecipientName;
                        } ?></div>
                </div>
                <img src="https://img.icons8.com/color/48/000000/person-male.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Contact No</div>
                    <div class="number-details"><?php if (empty($order->RecipientContact)) {
                            echo $customer->ContactNo;
                        } else {
                            echo $order->RecipientContact;
                        } ?></div>
                </div>
                <img src="https://img.icons8.com/emoji/48/000000/telephone.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Note</div>
                    <div class="number-details"><?php if (empty($order->Note)) {
                            echo "None";
                        } else {
                            echo $order->Note;
                        } ?></div>
                </div>
                <img src="https://img.icons8.com/external-icongeek26-linear-colour-icongeek26/64/000000/external-note-documents-icongeek26-linear-colour-icongeek26.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Shop Count</div>
                    <div class="number-details"><?php echo $shopCount ?></div>
                </div>
                <img src="https://img.icons8.com/color/48/000000/shop.png"/>
            </div>
        </div>

        <div style="height: auto" class="core">
            <div class="customer-details">
                <h1 class="heading">Customer <span>Details</span></h1>
                <table class="cus-details">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact No</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    <tr>
                        <td><?php echo $customer->Name ?></td>
                        <td><?php echo $customer->Address ?></td>
                        <td><?php echo $customer->Email ?></td>
                        <td><?php echo $customer->ContactNo ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="core">
            <div class="dynamic-map">
                <h1 class="heading">Customer & <span>Shop Locations</span></h1>
                <div class="map-section">
                    <div class="inputBox map-inputBox">
                        <div id="map" data-location=<?php echo $customer->Location ?>></div>

                </div>
            </div>
        </div>
    </div>
    <div style="height: auto" class="core" id="orderDetails">
        <h1 class="heading">Order<span> Details</span></h1>
    </div>
</section>
<script src="/js/view-order.js"></script>
<script src="/js/order-map.js"></script>

