<?php
/** @var $order * */
/** @var $cart * */
/** @var $customer * */
/** @var $shopOrders * */
/** @var $shopCount * */
/** @var $shopStatus * */

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
                    <div class="number-details">New</div>
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
                    <div class="number-details"><?php if(empty($order->RecipientName)){ echo $customer->Name;}else{echo $order->RecipientName;}  ?></div>
                </div>
                <img src="https://img.icons8.com/color/48/000000/person-male.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Contact No</div>
                    <div class="number-details"><?php if(empty($order->RecipientContact)){ echo $customer->ContactNo;}else{echo $order->RecipientContact;}  ?></div>
                </div>
                <img src="https://img.icons8.com/emoji/48/000000/telephone.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Note</div>
                    <div class="number-details"><?php if(empty($order->Note)){ echo "None";}else{echo $order->Note;} ?></div>
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

            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Total Weight</div>
                    <div class="number-details">10 Kg</div>
                </div>
                <img src="https://img.icons8.com/external-itim2101-flat-itim2101/64/000000/external-scale-logistics-itim2101-flat-itim2101.png"/>
            </div>
        </div>

        <div style="height: auto" class="core">
            <div style="display: flex">
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
                        <td><a href="mailto:<?php echo $customer->Email ?>"><?php echo $customer->Email ?></a></td>
                        <td><a href="tel:<?php echo $customer->ContactNo ?>"><?php echo $customer->ContactNo ?></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <h1 class="heading">Shop <span>Status</span></h1>
                <table class="cus-details">
                    <thead>
                    <tr>
                        <th>ShopID</th>
                        <th>Shop Name</th>
                        <th>Contact Number</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    <?php foreach($shopStatus as $status){
                        echo sprintf("
                            <tr>
                                    <td>%d</td>
                                    <td>%s</td>
                                    <td><a href='tel:%s'>%s</a></td>
                                    <td>%s</td>
                            </tr>",
                        $status["ShopID"],
                        $status["ShopName"],
                        $status["ContactNo"],
                        $status["ContactNo"],
                        $status["Status"]? "Order Ready": "Order in Processing" ,
                        );
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="core">
            <div class="dynamic-map">
                <h1 class="heading">Select <span>Rider</span></h1>
                <div class="map-section">
                    <div class="inputBox map-inputBox">
                        <div id="map" data-location=<?php echo $customer->Location ?> > </div>
                        <div class="vehicle-select">
                            <span>Select Vehicle Type:</span>
                            <div class="vehicle-radio">
                                <input type="radio" id="bicycle-radio" class="vehicle-radio" name="vehicle" value="0">
                                <label for="Bicycle"><i class="fas fa-motorcycle"></i>
                                    Bicycle</label>
                            </div>
                            <div class="vehicle-radio">
                                <input type="radio" class="vehicle-radio" name="vehicle" value="1">
                                <label for="TukTuk"><i class="fas fa-truck"></i>TukTuk</label>
                            </div>
                            <a id="getRider-btn"
                               data-city="<?php echo $order->City ?>"
                               data-suburb="<?php echo $order->Suburb ?>"
                               class="refresh-map"><i class='bx bx-refresh'></i>Get Riders</a>
                        </div>
                    </div>
                    <div>
                        <h3>Available Riders:</h3>
                        <?php $form = \app\core\form\Form::begin("/dashboard/delivery/assignrider", "post", "assign-rider"); ?>
                        <input id="OrderID" name="OrderID" value="<?php echo $order->OrderID ?>" hidden>
                        <select name="RiderID" id="RiderID">
                            <option>Not Available</option>
                        </select>
                        <div id="rider-info">
                            <section id="rider-section" class="rider-info">
                            </section>
                        </div>
                        <button type="submit" class="deliver-btn">Assign to Deliver</button>
                        <?php echo $form::end() ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/js/getRiders.js"></script>
<script src="/js/order.js"></script>

