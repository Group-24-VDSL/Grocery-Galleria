<?php
/** @var $order \app\models\Orders **/
/** @var $customer \app\models\Customer **/
/** @var $shops array **/
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
                    <div class="number-details">
                        <?php echo $order->OrderID ; ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/external-itim2101-flat-itim2101/64/000000/external-order-shopping-and-ecommerce-itim2101-flat-itim2101.png"/>
            </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Status</div>
                    <div class="number-details">
                        <?php
                        if ($order->Status == 0)
                            echo "New";
                        elseif ($order->Status == 1)
                            echo "On-Going";
                        elseif ($order->Status == 2)
                            echo "Completed";
                        ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/external-becris-flat-becris/64/000000/external-history-literary-genres-becris-flat-becris.png"/>
            </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Total(LKR)</div>
                    <div class="number-details">
                        <?php echo sprintf('%.2f', $order->TotalCost) ; ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/external-justicon-flat-justicon/64/000000/external-cash-gambling-justicon-flat-justicon.png"/>
            </div>
            <div class="box-item-list">
                <div class="content">
                    <div style=" font-size: 18.4px" class="box-topic">Delivery Cost(LKR)</div>
                    <div class="number-details">
                        <?php echo sprintf('%.2f', $order->DeliveryCost) ; ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/external-konkapp-flat-konkapp/64/000000/external-delivery-logistic-and-delivery-konkapp-flat-konkapp.png"/>
            </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Shop Count</div>
                    <div class="number-details">
                        <?php echo count($shops); ?>
                    </div>
                </div>
                <img src="https://img.icons8.com/cute-clipart/64/000000/shop.png"/>
            </div>

            <div class="box-item-list">
                <div class="content">
                    <div class="box-topic">Total Weight</div>
                    <div class="number-details">
                        <?php
                        $TotalWeight  = 0 ;
                        foreach ($shops as $shop){
                            $TotalWeight += $shop["shopWeight"];
                        }
                        echo $TotalWeight ;
                        ?>
                        KG
                    </div>
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
                        <td><?php echo $customer->CustomerID ; ?></td>
                        <td><?php echo $customer->Name ; ?></td>
                        <td><?php echo $customer->Address ; ?></td>
                        <td><?php echo $customer->ContactNo ; ?></td>
                    </tr>
                    </tbody>
                </table>
            </divc>

        </div>

        <div style="height: auto" class="core">

            <?php
            foreach ($shops as $shop){

                $ShopID = $shop["shop"]->ShopID ;
                $ItemList = $shops[$ShopID]["itemList"] ;
                $ItemCount = count($ItemList[0]);

                if ($shop["shop"]->Category === 0){
                    $category = "Grocery" ;
                }
                elseif ($shop["shop"]->Category === 1){
                    $category = "Vegetable" ;
                }
                elseif ($shop["shop"]->Category === 2){
                    $category = "Meat" ;
                }
                elseif ($shop["shop"]->Category === 3){
                    $category = "Fruit" ;
                }

                echo
                    '<div class="container-order-details">
                    <h1 class="heading"> <span>Item List : </span><span style="color: var(--text-color-light)" class="shop-id">'.$shop["shop"]->ShopID.'</span></h1>
                     <div>
                    <div class="item-list">
                        <div class="complete-section">

                            <table class="shop-details">
                                <tbody>
                                <tr>
                                    <th>Shop ID</th>
                                    <td>: '.$shop["shop"]->ShopID.'</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>name</th>
                                    <td>: '.$shop["shop"]->Name.'</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Category</th>
                                    <td>: '. $category.'</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Address</th>
                                    <td>: Address</td>
                                </tr>
                                <tr>
                                    <th>Shop<br>Location</th>
                                    <td>: <a class="location-link" href="'.$shop["shop"]->Location.'">Shop Location</a></p></td>
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
                            <tbody class="body-half-screen">';

                foreach ($ItemList  as $Items){
                    foreach ($Items as $Item){
                        echo
                            '<tr>
                                    <td></td>
                                    <td>'.$Item["shopItem"]->ItemID.'</td>
                                    <td><img class="item-img" src="'.$Item["systemItem"]->ItemImage.'"></td>
                                    <td>'.$Item["systemItem"]->Name.'</td>
                                    <td>'.$Item["systemItem"]->UWeight.'</td>
                                    <td>'.$Item["shopItem"]->UnitPrice.'</td>
                                    <td>'.$Item["quantity"].'</td>
                                    <td>'.sprintf('%.2f', ($Item["quantity"]*$Item["shopItem"]->UnitPrice)).'</td>
                                    </tr>';
                    }

                }
                if($shop["shopOrder"]->Status == 0){
                    $Status = "New" ;
                }
                else if($shop["shopOrder"]->Status == 1){
                    $Status = "Completed" ;
                }


                echo '</tbody>
                        </table>
                        <div class="complete-section">

                            <table class="staff-details">
                                <tbody>
                                <tr>
                                    <th>Shop Total (LKR) :</th>
                                    <td>'.$shop["shopOrder"]->ShopTotal.'</td>
                                </tr>
                                <tr>
                                    <th>Shop Weight :</th>
                                    <td>'.$shop["shopWeight"].'Kg</td>
                                </tr>
                                <tr>
                                    <th>Number of Items:</th>
                                    <td>'.$ItemCount.'</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>'.$Status.'</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                </div>';
            }
            ?>

</section>

