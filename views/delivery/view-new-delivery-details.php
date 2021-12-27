<?php
/** @var $order **/
/** @var $cart **/
/** @var $customer **/
/** @var $shopOrders **/
/** @var $shopCount **/
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
                    <div class="number-details"><?php echo $order->OrderID?></div>
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
                    <div class="number-details"><?php echo $order->RecipientName ?></div>
                </div>
                <img src="https://img.icons8.com/color/48/000000/person-male.png"/>
            </div><div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Contact No</div>
                    <div class="number-details"><?php echo $order->RecipientContact ?></div>
                </div>
                <img src="https://img.icons8.com/emoji/48/000000/telephone.png"/>
            </div><div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Note</div>
                    <div class="number-details"><?php echo $order->Note?></div>
                </div>
                <img src="https://img.icons8.com/external-icongeek26-linear-colour-icongeek26/64/000000/external-note-documents-icongeek26-linear-colour-icongeek26.png"/>
            </div>
            <div class="box-item-list sub-box-t2">
                <div class="content">
                    <div class="box-topic">Shop Count</div>
                    <div class="number-details"><?php echo $shopCount?></div>
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
                        <td><?php echo $customer->Name?></td>
                        <td><?php echo $customer->Address?></td>
                        <td><?php echo $customer->Email?></td>
                        <td><?php echo $customer->ContactNo?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div style="height: auto" class="core">
            <div class="container-order-details">
                <h1 class="heading">Item <span>List</span></h1>
                <div>
                    <div class="item-list">
                        <div class="complete-section">
                            <table class="shop-details">
                                <tbody>
                                <tr>
                                    <th>Shop<br>ID</th>
                                    <td>: S12340</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Name</th>
                                    <td>: Samarasekara Stores</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Category</th>
                                    <td>: Grocery</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Address</th>
                                    <td>: No. 23/30, Bambalapitiya Dr, Colombo 03</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Location</th>
                                    <td>: <a class="location-link" href="#">Shop Location</a></p></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <table class="table-scroll small-first-col">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Item ID</th>
                                <th>Item Image</th>
                                <th>Item Name</th>
                                <th>U/Weight</th>
                                <th>U/Price(LKR)</th>
                                <th>Quantity</th>
                                <th>Price(LKR)</th>
                            </tr>
                            </thead>
                            <tbody class="body-half-screen">
                            <tr>
                                <td>1.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>10.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>

                            </tbody>
                        </table>
                        <div class="complete-section">

                            <table class="staff-details">
                                <tbody>
                                <tr>
                                    <th>Shop Total (LKR) :</th>
                                    <td>2500.00</td>
                                </tr>
                                <tr>
                                    <th>Shop Weight :</th>
                                    <td>5 Kg</td>
                                </tr>
                                <tr>
                                    <th>Number of Items:</th>
                                    <td>15</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container-order-details">
                <h1 class="heading"><span>Item List : </span><span style="color: var(--text-color-light)"
                                                                   class="shop-id">S12340</span></h1>
                <div>
                    <div class="item-list">
                        <div class="complete-section">

                            <table class="shop-details">
                                <tbody>
                                <tr>
                                    <th>Shop ID</th>
                                    <td>: S12340</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>name</th>
                                    <td>: Samarasekara Stores</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Category</th>
                                    <td>: Grocery</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Address</th>
                                    <td>: No. 23/30, Bambalapitiya Dr, Colombo 03</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Location</th>
                                    <td>: <a class="location-link" href="#">Shop Location</a></p></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <table class="table-scroll small-first-col">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Item ID</th>
                                <th>Item Image</th>
                                <th>Item Name</th>
                                <th>U/Weight</th>
                                <th>U/Price(LKR)</th>
                                <th>Quantity</th>
                                <th>Price(LKR)</th>
                            </tr>
                            </thead>
                            <tbody class="body-half-screen">
                            <tr>
                                <td>1.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>10.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>

                            </tbody>
                        </table>
                        <div class="complete-section">

                            <table class="staff-details">
                                <tbody>
                                <tr>
                                    <th>Shop Total (LKR) :</th>
                                    <td>2500.00</td>
                                </tr>
                                <tr>
                                    <th>Shop Weight :</th>
                                    <td>5 Kg</td>
                                </tr>
                                <tr>
                                    <th>Number of Items:</th>
                                    <td>15</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container-order-details">
                <h1 class="heading"><span>Item List : </span><span style="color: var(--text-color-light)"
                                                                   class="shop-id">S12340</span></h1>
                <div>
                    <div class="item-list">
                        <div class="complete-section">

                            <table class="shop-details">
                                <tbody>
                                <tr>
                                    <th>Shop ID</th>
                                    <td>: S12340</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>name</th>
                                    <td>: Samarasekara Stores</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Category</th>
                                    <td>: Grocery</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Address</th>
                                    <td>: No. 23/30, Bambalapitiya Dr, Colombo 03</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Location</th>
                                    <td>: <a class="location-link" href="#">Shop Location</a></p></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <table class="table-scroll small-first-col">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Item ID</th>
                                <th>Item Image</th>
                                <th>Item Name</th>
                                <th>U/Weight</th>
                                <th>U/Price(LKR)</th>
                                <th>Quantity</th>
                                <th>Price(LKR)</th>
                            </tr>
                            </thead>
                            <tbody class="body-half-screen">
                            <tr>
                                <td>1.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>
                            <tr>
                                <td>10.</td>
                                <td>V00011</td>
                                <td><img class="item-img" src="img/Pic914006.jpg"></td>
                                <td>Big Onion</td>
                                <td>500g</td>
                                <td>80.00</td>
                                <td>2</td>
                                <td>320.00</td>
                            </tr>

                            </tbody>
                        </table>
                        <div class="complete-section">

                            <table class="staff-details">
                                <tbody>
                                <tr>
                                    <th>Shop Total (LKR) :</th>
                                    <td>2500.00</td>
                                </tr>
                                <tr>
                                    <th>Shop Weight :</th>
                                    <td>5 Kg</td>
                                </tr>
                                <tr>
                                    <th>Number of Items:</th>
                                    <td>15</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="core">
                <div class="dynamic-map">
                    <h1 class="heading">Select <span>Rider</span></h1>
                    <div class="map-section">
                        <div class="inputBox map-inputBox">
                            <div id="map"></div>
                    <a id="getRider-btn"
                       data-city = "<?php echo $customer->City?>"
                       data-suburb = "<?php echo $customer->Suburb?>"
                       class="refresh-map"><i class='bx bx-refresh'></i>Get Riders</a>
                        </div>
                        <button style="margin-top: auto" class="complete-btn" type="submit" value="Complete">Assign Rider
                        </button>
                    </div>
                </div>
            </div>
    </div>
</section>
<script src="/js/delivery-assign.js"></script>
<script src="/js/getRiders.js"></script>
<script src="/js/order.js"></script>

