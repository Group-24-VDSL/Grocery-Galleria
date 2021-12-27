<?php
/** @var $order \app\models\Orders **/
/** @var $customer \app\models\Customer **/
/** @var $shops  **/
?>
<!--<link rel="stylesheet" href="/css/Register.css">-->
<link rel="stylesheet" href="/css/dashboardStyle.css" />
<link rel="stylesheet" href="/css/all.css" />
<link rel="stylesheet" href="/css/shop-order-details.css" />


<section class="section-home">
    <div class="home-content">
        <div class="overview-boxes " id = "order-box" >

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Order ID</div>
                    <div class="number-details">11034</div>
                </div>
                <img src="https://img.icons8.com/external-itim2101-flat-itim2101/64/000000/external-order-shopping-and-ecommerce-itim2101-flat-itim2101.png"/>
            </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Status</div>
                    <div class="number-details">New</div>
                </div>
                <img src="https://img.icons8.com/external-becris-flat-becris/64/000000/external-history-literary-genres-becris-flat-becris.png"/>
            </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Total(LKR)</div>
                    <div class="number-details">2500.00</div>
                </div>
                <img src="https://img.icons8.com/external-justicon-flat-justicon/64/000000/external-cash-gambling-justicon-flat-justicon.png"/>
            </div>
            <div class="box-item-list">
                <div class="content">
                    <div style=" font-size: 18.4px" class="box-topic">Delivery Cost(LKR)</div>
                    <div class="number-details">  300.00</div>
                </div>
                <img src="https://img.icons8.com/external-konkapp-flat-konkapp/64/000000/external-delivery-logistic-and-delivery-konkapp-flat-konkapp.png"/>
            </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Shop Count</div>
                    <div class="number-details">3</div>
                </div>
                <img src="https://img.icons8.com/cute-clipart/64/000000/shop.png"/>
                </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Total Weight</div>
                    <div class="number-details">10 Kg</div>
                </div>
                <img src="https://img.icons8.com/external-itim2101-flat-itim2101/64/000000/external-scale-logistics-itim2101-flat-itim2101.png"/>
            </div>

        </div>
        <div style="height: auto" class="core">
            <divc class="customer-details">
                <h1 class="heading"> <span>Customer Details</span><span style="color: var(--text-color-light)" class="shop-id"></span></h1>
                <table class="cus-details">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact No</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    <tr>
                        <td>C00987</td>
                        <td>Sanduni Siriwardhane</td>
                        <td>No. 20 , Dhammadhinna Rd, Tangalle</td>
                        <td>0715800177</td>
                    </tr>
                    </tbody>
                </table>
            </divc>

        </div>

        <div style="height: auto" class="core">
            <div class="container-order-details">
                <h1 class="heading"> <span>Item List : </span><span style="color: var(--text-color-light)" class="shop-id">S12340</span></h1>
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
                <h1 class="heading"> <span>Item List : </span><span style="color: var(--text-color-light)" class="shop-id">S12340</span></h1>
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
                <h1 class="heading"> <span>Item List : </span><span style="color: var(--text-color-light)" class="shop-id">S12340</span></h1>
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
        </div>
</section>

