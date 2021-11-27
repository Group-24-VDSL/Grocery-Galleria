<?php
?>
<!-- Cart section start -->
<section class="cart" id="cart">
    <div class="container">
        <div class="container-item" id="container-item">
            <div class="cart-header">
                <ul>
                    <li>Product</li>
                    <li>Unit Weight</li>
                    <li>Price(Rs)</li>
                    <li>Quantity</li>
                    <li>Total(Rs)</li>
                    <li>Update</li>
                    <li>Remove</li>
                </ul>
            </div>
        </div>
        <div class="container-payment">
            <div class="details">Item count: <span id="itemCount"></span></div>
            <div class="details">Subtotal(Rs): <span id="subTotal"></span></div>
            <div class="details">No of Shops: <span id="ShopCount"></span></div>
            <div class="details">Delivery Charges(Rs): <span id="DeliveryFee"></span></div>
            <div class="details total">Total(Rs): <span id="GTotal"></span></div>
            <a href="/customer/checkout" class="btn checkout">Proceed to checkout</a>
        </div>
    </div>
</section>
<!-- Cart section ends -->
