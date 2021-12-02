<?php
/**@var $customer \app\models\Customer
 * @var $shopcount int
 * @var $totalprice float
 * @var $subprice float
 * @var $subprice float
 * @var $deliveryfee float
 * @var $itemcount int
 */
?>

<!-- Checkout section starts -->
<section>
    <h1 class="heading"><i class="fas fa-shopping-basket"></i> Order <span>Checkout</span></h1>
    <div class="checkout">
        <div class="container">
            <div class="container-shipping">
                <div class="column-header">Shipping Details</div>
                <div class="shipping-details">
                    <div class="details"><i class="fas fa-user"></i> Name<span><?php echo $customer->Name ?></span></div>
                    <div class="details"><i class="fas fa-phone"></i> Phone Number(default)<span><?php echo $customer->ContactNo ?></span></div>
                    <div class="details">
                        <label for="Recipient-name"><i class="fas fa-house-user"></i> Recipient Name</label>
                        <input type="text" id="Recipient-name" name="Recipient-name">
                    </div>
                    <form action="" method="post">
                    <div class="details">
                        <label for="Recipient-contact"><i class="fas fa-phone-alt"></i> Recipient Contact</label>
                        <input type="text" id="Recipient-contact" name="recipient-contact">
                    </div>
                    <div class="details">
                        <i class="fas fa-home"></i>
                        Shipping Address
                        <p>
                            <?php echo $customer->Address ?>
                        </p>
                    </div>
                    <div class="details">
                        <label for="Note"><i class="fas fa-quote-left"></i> Notes</label>
                        <textarea type="text" id="Note" name="note" cols="20" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="container-payment">
                <div class="column-header">Payment Details</div>
                <div class="payment-details">
                    <div class="details">Item count: <span><?php echo $itemcount ?></span></div>
                    <div class="details">Subtotal: <span>Rs <?php echo $subprice ?></span></div>
                    <div class="details">No of Shops: <span><?php echo $shopcount ?></span></div>
                    <div class="details">Delivery Charges: <span><?php echo $deliveryfee ?></span></div>
                    <div class="details total">Total: <span>Rs <?php echo $totalprice ?></span></div>
                </div>
                <button type="submit" class="btn checkout">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>

</section>
<!-- Checkout section ends -->

