<?php ?>
<!-- Checkout section starts -->
<section>
    <h1 class="heading"><i class="fas fa-shopping-basket"></i> Order <span>Checkout</span></h1>
    <div class="checkout">
        <div class="container">
            <div class="container-shipping">
                <div class="column-header">Shipping Details</div>
                <div class="shipping-details">
                    <div class="details"><i class="fas fa-user"></i> Name<span>Dilshan Thenuka</span></div>
                    <div class="details"><i class="fas fa-phone"></i> Phone Number(default)<span>0786756451</span></div>
                    <div class="details">
                        <label for="Recipient-name"><i class="fas fa-house-user"></i> Recipient Name</label>
                        <input type="text" id="Recipient-name" name="Recipient-name">
                    </div>
                    <div class="details">
                        <label for="Recipient-contact"><i class="fas fa-phone-alt"></i> Recipient Contact</label>
                        <input type="text" id="Recipient-contact" name="Recipient-contact">
                    </div>
                    <div class="details">
                        <i class="fas fa-home"></i>
                        Shipping Address
                        <p>
                            No:22/2 Old Kesbewa,<br>
                            Gangodawila,<br>
                            Nugegoda,<br>
                            Colombo.
                        </p>
                    </div>
                    <div class="details">
                        <label for="Note"><i class="fas fa-quote-left"></i> Notes</label>
                        <textarea type="text" id="Note" name="Note" cols="20" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="container-refund">
                <div class="column-header">Refund Details</div>
                <div class="refund-details">
                    <p>Incase of some of the products are out of stock, please tell us how you wish to receive the refund</p>
                    <div class="input-box">
                        <div class="refund">
                            <input type="radio" name="refundcash" class="">
                            <label for="refundcash" id="refundcash">Refund amount by cash (Immediate Refund)</label>
                        </div>
                        <div class="refund">
                            <input type="radio" name="refundcredit" class="">
                            <label for="refundcredit" id="refundcredit">Transfer refund amount to card(Refund in 5 working days)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-payment">
                <div class="column-header">Payment Details</div>
                <div class="payment-details">
                    <div class="details">Item count: <span>12</span></div>
                    <div class="details">Subtotal: <span>Rs 1250</span></div>
                    <div class="details">No of Shops: <span>4</span></div>
                    <div class="details">Delivery Charges: <span>Rs.150</span></div>
                    <div class="details total">Total: <span>Rs 1600</span></div>
                </div>
                <a href="" class="btn checkout">Proceed to Payment</a>
            </div>
        </div>
    </div>

</section>
<!-- Checkout section ends -->

