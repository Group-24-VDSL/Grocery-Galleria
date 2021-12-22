<?php
/** @var int $orderid */
/** @var int $cartid */
/** @var array $cartitems */
/** @var array $cartdetails */
/** @var array $cart */
/** @var array $customer */
?>

<div class="main-content">
    <div>
        <h2 class="header margin-bottom">Order Details</h2>
    </div>
    <div class="order-view box-shadow margin-bottom">
        <table>
            <tr>
                <th>OrderID</th>
                <th>Destination</th>
                <th>Price</th>
                <th>Delivery Fee</th>
            </tr>
            <tr>
                <?php
                echo sprintf("<td>%d</td><td>%s</td><td>Rs.%.2f</td><td>Rs.%.2f</td>",$orderid,$cart["Address"],$cartdetails["TotalCost"],$cartdetails["DeliveryCost"]);
                ?>
            </tr>
        </table>
    </div>

    <div class="order-view-map box-shadow margin-bottom">
        <div id="map"></div>
        <a href="#"><button class="btn btn-primary">Open in Google Maps</button></a>
    </div>

    <div class="order-view-customer box-shadow margin-bottom">
        <h4>Destination</h4>
        <div class="order-view-customer-details">
            <?php
            echo sprintf("<p><strong>Name:</strong>%s</p>
            <p><strong>Address:</strong>%s</p>
            <p><strong>Phone:</strong><a href='tel:%s'>%s<i class='fas fa-phone-alt'></i></a></p>
            <p><strong>Note:</strong>%s</p>",
                $cartdetails["RecipientName"]?$cartdetails["RecipientName"]:$customer["Name"],
            $cart["Address"],
            $cartdetails["RecipientContact"]?$cartdetails["RecipientContact"]:$customer["ContactNo"],
            $cartdetails["RecipientContact"]?$cartdetails["RecipientContact"]:$customer["ContactNo"],
            $cartdetails["Note"]?$cartdetails["Note"]:"None"
            );
            ?>
        </div>
        <label></label>

    </div>
    <div class="items-divider box-shadow margin-bottom">
        <h4>Items</h4>
    </div>
    <div class="order-view-shop box-shadow margin-bottom">
        <h3 class="header">Shop 1</h3>
        <div class="shop-details box-shadow">
            <p><strong>Name:</strong>Kasun Rajakaruna</p>
            <p><strong>Address:</strong>Kasun Rajakaruna</p>
            <p><strong>Phone:</strong><a href="tel:0223311324">0223311324<i class="fas fa-phone-alt"></i></a></p>
        </div>
        <div>
            <table class="box-shadow margin-bottom">
                <tr>
                    <th>Item Name</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>Potato</td>
                    <td>None</td>
                    <td>120g</td>
                    <td>Rs.1440</td>
                </tr>
                <tr>
                    <td>Potato</td>
                    <td>None</td>
                    <td>120g</td>
                    <td>Rs.1440</td>
                </tr>
                <tr>
                    <td>Potato</td>
                    <td>None</td>
                    <td>120g</td>
                    <td>Rs.1440</td>
                </tr>
                <tr>
                    <td>Potato</td>
                    <td>None</td>
                    <td>120g</td>
                    <td>Rs.1440</td>
                </tr>
                <tr>
                    <td>Potato</td>
                    <td>None</td>
                    <td>120g</td>
                    <td>Rs.1440</td>
                </tr>
            </table>
            <div class="shop-summary margin-bottom">
                <div class="summary-box box-shadow">
                    <div class="summary-label">Item Count:</div>
                    <div class="summary-content">21</div>
                </div>
                <div class="summary-box box-shadow">
                    <div class="summary-label">Total Price:</div>
                    <div class="summary-content"><small>Rs.</small>2338.00</div>
                </div>
            </div>
        </div>
    </div>
    <div class="order-summary">
        <button class="btn btn-primary btn-lg margin-bottom">Mark as Completed</button>
        <button class="btn btn-secondary btn-lg margin-bottom">Submit a Issue</button>
    </div>
</div>