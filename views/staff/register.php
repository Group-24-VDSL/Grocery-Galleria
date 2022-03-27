<link rel="stylesheet" href="/css/all.css">
<!--<link rel="stylesheet" href="/css/staff-register-form.css">-->
<link rel="stylesheet" href="/css/template.css">
<?php
/** @var $staff \app\models\Staff * */
/** @var $form app\core\form\Form */
/** @var $customer app\models\Customer */
/** @var $delivery app\models\DeliveryStaff */
/** @var $shop app\models\Shop */
?>
<div class="core">
    <section class="register" id="register">
        <h1 class="heading">Registration <span>Form</span> User</h1>
        <div class="select-radio">
            <span class="radio-label">
                <input id="customer-radio" class="form-radio" type="radio" name="radio" data-for="customer"/>
                <label>Customer</label>
            </span>
            <span class="radio-label">
                <input class="form-radio" type="radio" name="radio" data-for="shop"/>
                <label>Shop</label>
            </span>
            <span class="radio-label">
                <input class="form-radio" type="radio" name="radio" data-for="delivery"/>
                <label>Delivery</label>
            </span>
            <span class="radio-label">
                <input class="form-radio" type="radio" name="radio" data-for="staff"/>
                <label>Staff</label>
            </span>
        </div>
        <div class="form-container scroller" data-name="customer">
            <?php $form = \app\core\form\Form::begin("/customer/register", "post", ""); ?>
            <div class="inputBox">
                <label for="Name"><i class="fas fa-edit"></i>Name</label>
                <?php echo $form->fieldonly($customer, 'Name'); ?>
            </div>
            <div class="inputBox">
                <label for="Address"><i class="fas fa-home"></i>Address</label>
                <?php echo $form->fieldonly($customer, 'Address'); ?>
            </div>
            <div class="inputBox">
                <label for="Email"><i class="fas fa-envelope"></i>Email</label>
                <?php echo $form->fieldonly($customer, 'Email')->emailField(); ?>
            </div>
            <div class="inputBox">
                <label for="contact"><i class="fas fa-phone"></i>Contact</label>
                <?php echo $form->fieldonly($customer, 'ContactNo'); ?>
            </div>
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>Password</label>
                <?php echo $form->fieldonly($customer, 'Password')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="PasswordR"><i class="fas fa-key"></i>Re-enter password</label>
                <?php echo $form->fieldonly($customer, 'ConfirmPassword')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="city"><i class="fas fa-map-marked-alt"></i>Select city</label>
                <?php echo $form->selectfieldonly($customer, 'City'); ?>
            </div>
            <div class="inputBox">
                <label for="suburb"><i class="fas fa-street-view"></i>Select suburb</label>
                <?php echo $form->selectfieldonly($customer, 'Suburb'); ?>
            </div>
            <?php echo $form->fieldonly($customer, 'Location')->hiddenField(); ?>
            <?php echo $form->fieldonly($customer, 'PlaceID')->hiddenField(); ?>
            <div class="inputBox map-inputBox">
                <label for="location"><i class="fas fa-map-marker-alt"></i>Location</label>
                <div id="map1"></div>
            </div>
            <div class="inputBox"></div>
            <div class="btn-align">
                <button id="deny" type="submit" class="btn submit deny">Deny Registration</button>
                <button id="accept" type="submit" class="btn submit">Submit Registration</button>
            </div>
            <?php echo $form::end() ?>
        </div>
        <div class="form-container scroller" data-name="shop">

            <?php $form = \app\core\form\Form::begin("/shop/register", "post", "ShopRegister"); ?>
            <div class="inputBox">
                <label for="Name"><i class="fas fa-edit"></i>
                    <?php echo $shop->labels()['Name'] ?></label>
                <?php echo $form->fieldonly($shop, 'Name') ?>
            </div>
            <div class="inputBox">
                <label for="Username"><i class="fas fa-store"></i>
                    <?php echo $shop->labels()['ShopName'] ?></label>
                <?php echo $form->fieldonly($shop, 'ShopName') ?>
            </div>
            <div class="inputBox">
                <label for="Address"><i class="fas fa-home"></i>
                    <?php echo $shop->labels()['Address'] ?></label>
                <?php echo $form->fieldonly($shop, 'Address') ?>
            </div>
            <div class="inputBox">
                <label for="Email"><i class="fas fa-envelope"></i>
                    <?php echo $shop->labels()['Email'] ?>
                </label>
                <?php echo $form->fieldonly($shop, 'Email')->emailField(); ?>
            </div>
            <div class="inputBox">
                <label for="contact"><i class="fas fa-phone"></i>
                    <?php echo $shop->labels()['ContactNo'] ?></label>
                <?php echo $form->fieldonly($shop, 'ContactNo'); ?>
            </div>
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>
                    <?php echo $shop->labels()['Password'] ?></label>
                <?php echo $form->fieldonly($shop, 'Password')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="PasswordR"><i class="fas fa-key"></i>
                    <?php echo $shop->labels()['ConfirmPassword'] ?></label>
                <?php echo $form->fieldonly($shop, 'ConfirmPassword')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="city"><i class="fas fa-map-marked-alt"></i>
                    <?php echo $shop->labels()['City'] ?></label>
                <?php echo $form->selectfieldonly($shop, 'City'); ?>
            </div>
            <div class="inputBox">
                <label for="suburb"><i class="fas fa-street-view"></i>
                    <?php echo $shop->labels()['Suburb'] ?></label>
                <?php echo $form->selectfieldonly($shop, 'Suburb'); ?>
            </div>
            <div class="inputBox">
                <label for="description"><i class="fas fa-hashtag"></i>
                    <?php echo $shop->labels()['ShopDesc'] ?></label>
                <?php echo $form->fieldonly($shop, 'ShopDesc'); ?>
            </div>
            <?php echo $form->fieldonly($shop, 'Location')->hiddenField(); ?>
            <?php echo $form->fieldonly($shop, 'PlaceID')->hiddenField(); ?>
            <div class="inputBox map-inputBox">
                <label for="location"><i class="fas fa-map-marker-alt"></i>Location</label>
                <div id="map2"></div>
            </div>
            <div class="inputBox"></div>
            <div class="btn-align">
                <button id="deny" type="submit" class="btn submit deny">Deny Registration</button>
                <button id="accept" type="submit" class="btn submit">Submit Registration</button>
            </div>
            <?php echo $form->end(); ?>
        </div>
        <div class="form-container scroller" data-name="delivery">

            <?php $form = \app\core\form\Form::begin("/delivery/register", "post", ""); ?>
            <div class="inputBox">
                <label for="Name"><i class="fas fa-user"></i>
                    Name </label>
                <?php echo $form->fieldonly($delivery, 'Name') ?>
            </div>
            <div class="inputBox">
                <label for="Email"><i class="fas fa-envelope"></i>
                    Email
                </label>
                <?php echo $form->fieldonly($delivery, 'Email')->emailField(); ?>
            </div>
            <div class="inputBox">
                <label for="contact"><i class="fas fa-phone"></i>
                    Contact Number</label>
                <?php echo $form->fieldonly($delivery, 'ContactNo'); ?>
            </div>
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>
                   Password </label>
                <?php echo $form->fieldonly($delivery, 'Password')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="PasswordR"><i class="fas fa-key"></i>
                   Confirm Password </label>
                <?php echo $form->fieldonly($delivery, 'ConfirmPassword')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="city"><i class="fas fa-map-marked-alt"></i>
                   City </label>
                <?php echo $form->selectfieldonly($delivery, 'City'); ?>
            </div>
            <div class="inputBox">
                <label for="suburb"><i class="fas fa-street-view"></i>
                    Suburb</label>
                <?php echo $form->selectfieldonly($delivery, 'Suburb'); ?>
            </div>
            <div class="btn-align">
                <button id="deny" type="submit" class="btn submit deny">Deny Registration</button>
                <button id="accept" type="submit" class="btn submit">Submit Registration</button>
            </div>
            <?php echo $form->end(); ?>
        </div>
        <div class="form-container scroller" data-name="staff">

            <?php $form = \app\core\form\Form::begin("/staff/register", "post", "ShopRegister"); ?>
            <div class="inputBox">
                <label for="Name"><i class="fas fa-edit"></i>
                    Name </label>
                <?php echo $form->fieldonly($staff, 'Name') ?>
            </div>

            <div class="inputBox">
                <label for="Email"><i class="fas fa-envelope"></i>
                    Email
                </label>
                <?php echo $form->fieldonly($staff, 'Email')->emailField(); ?>
            </div>
            <div class="inputBox">
                <label for="contact"><i class="fas fa-phone"></i>
                    Contact Number</label>
                <?php echo $form->fieldonly($staff, 'ContactNo'); ?>
            </div>
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>
                    Password</label>
                <?php echo $form->fieldonly($staff, 'Password')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="PasswordR"><i class="fas fa-key"></i>
                    Confirm Password</label>
                <?php echo $form->fieldonly($staff, 'ConfirmPassword')->passwordField(); ?>
            </div>
            <div class="inputBox">
                <label for="city"><i class="fas fa-map-marked-alt"></i>
                    City</label>
                <?php echo $form->selectfieldonly($staff, 'City'); ?>
            </div>
            <div class="inputBox">
                <label for="suburb"><i class="fas fa-street-view"></i>
                    Suburb </label>
                <?php echo $form->selectfieldonly($staff, 'Suburb'); ?>
            </div>
            <div class="btn-align">
                <button id="deny" type="submit" class="btn submit deny">Deny Registration</button>
                <button id="accept" type="submit" class="btn submit">Submit Registration</button>
            </div>
            <?php echo $form->end(); ?>
        </div>

    </section>
</div>
<script src="/js/register.js"></script>
<script src="/js/citySuburb.js"></script>

