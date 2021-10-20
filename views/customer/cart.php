<?php
?>
<!-- Cart section start -->
<section class="cart" id="cart">
    <!-- <h1 class="subheading"><i class="fas fa-leaf"></i>Shop name</h1> -->
    <div class="container">
        <div class="container-item">
            <div class="cart-header">
                <ul>
                    <li>Product</li>
                    <li>Name</li>
                    <li>Price(Rs)</li>
                    <li>Qty</li>
                    <li>Total(Rs)</li>
                    <li>Update</li>
                    <li>Remove</li>
                </ul>
            </div>
            <div class="shop-items">
                <div class="shop-name"><i class="fas fa-store"></i>Store 1</div>
                <div class="cart-items">
                    <div class="item">
                        <div class="item-img"><img src="/img/product-imgs/9500000.jpg" alt=""></div>
                        <div class="productname">Potato</div>
                        <div class="price">67.00</div>
                        <div class="quantity">
                            <input type="number" id="quantity" name="quantity" min="0.5" max="10" step="0.5" value="0.5">
                        </div>
                        <div class="total">98</div>
                        <div>
                            <a href="#" class=""><i class="fas fa-sync"></i>Update</a>
                        </div>
                        <div>
                            <a href="#" class="remove"><i class="fas fa-times"></i>Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-items">
                <div class="shop-name"><i class="fas fa-store"></i>Store 2</div>
                <div class="cart-items">
                    <div class="item">
                        <div class="item-img"><img src="/img/product-imgs/9500000.jpg" alt=""></div>
                        <div class="productname">Potato</div>
                        <div class="price">67.00</div>
                        <div class="quantity">
                            <input type="number" id="quantity" name="quantity" min="0.5" max="10" step="0.5" value="0.5">
                        </div>
                        <div class="total">98</div>
                        <div>
                            <a href="#" class=""><i class="fas fa-sync"></i>Update</a>
                        </div>
                        <div>
                            <a href="#" class="remove"><i class="fas fa-times"></i>Remove</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img"><img src="/img/product-imgs/9500000.jpg" alt=""></div>
                        <div class="productname">Potato</div>
                        <div class="price">67.00</div>
                        <div class="quantity">
                            <input type="number" id="quantity" name="quantity" min="0.5" max="10" step="0.5" value="0.5">
                        </div>
                        <div class="total">98</div>
                        <div>
                            <a href="#" class=""><i class="fas fa-sync"></i>Update</a>
                        </div>
                        <div>
                            <a href="#" class="remove"><i class="fas fa-times"></i>Remove</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img"><img src="/img/product-imgs/9500000.jpg" alt=""></div>
                        <div class="productname">Potato</div>
                        <div class="price">67.00</div>
                        <div class="quantity">
                            <input type="number" id="quantity" name="quantity" min="0.5" max="10" step="0.5" value="0.5">
                        </div>
                        <div class="total">98</div>
                        <div>
                            <a href="#" class=""><i class="fas fa-sync"></i>Update</a>
                        </div>
                        <div>
                            <a href="#" class="remove"><i class="fas fa-times"></i>Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-payment">
            <div class="details">Item count: <span>12</span></div>
            <div class="details">Subtotal: <span>Rs 1250</span></div>
            <div class="details">No of Shops: <span>4</span></div>
            <div class="details">Delivery Charges: <span>Rs.150</span></div>
            <div class="details total">Total: <span>Rs 1600</span></div>
            <a href="/customer/checkout" class="btn checkout">Proceed to checkout</a>
        </div>
    </div>
</section>
<!-- Cart section ends -->
