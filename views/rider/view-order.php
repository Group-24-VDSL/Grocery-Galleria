<?php
/** @var int $orderid */
/** @var int $cartid */
/** @var array $cartdetails */
/** @var array $cart */
/** @var array $customer */
/** @var array $shopdetails */
/** @var array $itemdetails */
/** @var array $uniqueshops */
/** @var array $cartitemsfinal */
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
        <div id="map" <?php echo 'data-shops=['.implode(',',$uniqueshops).']';
        foreach ($uniqueshops as $uniqueshop){
            echo sprintf(' data-shop%d="\'%s\'|\'%s\'|\'%s\'"',
            $uniqueshop,
            $shopdetails[$uniqueshop]["ShopName"],
            $shopdetails[$uniqueshop]["Location"],
            $shopdetails[$uniqueshop]["PlaceID"]
            );
        }
        echo sprintf(' data-customer="\'%s\'|\'%s\'|\'%s\'"',
            $customer["Name"],
            $customer["Location"],
            $customer["PlaceID"]
        );
        ?>></div>
        <button onclick="openMaps();" class="btn btn-primary">Open in Google Maps</button>
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
    <?php
    foreach($uniqueshops as $uniqueshop){

        echo sprintf("
        <div id='Shop%d' class='order-view-shop box-shadow margin-bottom'>
        <h3 class='header'>%s</h3>
        <div class='shop-details box-shadow'>
            <p><strong>Name:</strong>%s</p>
            <p><strong>Address:</strong>%s</p>
            <p><strong>Phone:</strong><a href='tel:%s'>%s<i class='fas fa-phone-alt'></i></a></p>
        </div>",
        $uniqueshop,
        $shopdetails[$uniqueshop]["ShopName"],
        $shopdetails[$uniqueshop]["Name"],
            $shopdetails[$uniqueshop]["Address"],
            $shopdetails[$uniqueshop]["ContactNo"],
            $shopdetails[$uniqueshop]["ContactNo"]
        );
        echo "<div>";
        echo "<table class='box-shadow margin-bottom'>";
        echo"<tr><th>Item Name</th><th>Brand</th><th>Quantity</th><th>Price</th></tr>";
        foreach ($cartitemsfinal[$uniqueshop] as $key=>$item){
            echo sprintf("
            <tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>Rs.%.2f</td>
                </tr>",
            $itemdetails[$key]["Name"],
            $itemdetails[$key]["Brand"],
            $item[0],
            $item[1]);

        }

            echo "</table>";

        echo "<div>";
    echo "<div>";
    }
    echo sprintf("
    <div class='shop-summary margin-bottom'>
                <div class='summary-box box-shadow'>
                    <div class='summary-label'>Item Count:</div>
                    <div class='summary-content'>%d</div>
                </div>
                <div class='summary-box box-shadow'>
                    <div class='summary-label'>Total Price:</div>
                    <div class='summary-content'><small>Rs.</small>%.2f</div>
                </div>
            </div>",
    array_sum(array_map('count',$cartitemsfinal)),
    $cartdetails["TotalCost"]
    );
    ?>

    <div class="order-summary">

        <button class="btn btn-primary btn-lg margin-bottom">Mark as Completed</button>
        <button class="btn btn-secondary btn-lg margin-bottom">Submit a Issue</button>
    </div>
</div>