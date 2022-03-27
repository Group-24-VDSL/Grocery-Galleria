<?php
/**@var $model \app\models\Shop * */
/**@var $form \core\form\Form * */
?>
<!-- registration section start -->
<section class="register" id="ShopRegister">
    <h1 class="heading">Registration <span>Form</span> Shop</h1>
    <?php $form = \app\core\form\Form::begin("", "post", "ShopRegister"); ?>
    <div class="inputBox">
        <label for="Name"><i class="fas fa-edit"></i>
            <?php echo $model->labels()['Category'] ?></label>
        <?php echo $form->selectfieldonly($model, "Category", ['0' => 'Vegetables', '1' => 'Fruits', '2' => 'Grocery', '3' => 'Fish', '4' => 'Meat']); ?>
        <!--            <input type="text" placeholder="Name" id="Name">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Name"><i class="fas fa-edit"></i>
            <?php echo $model->labels()['Name'] ?></label>
        <?php echo $form->fieldonly($model, 'Name') ?>
        <!--            <input type="text" placeholder="Name" id="Name">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Username"><i class="fas fa-store"></i>
            <?php echo $model->labels()['ShopName'] ?></label>
        <?php echo $form->fieldonly($model, 'ShopName') ?>
        <!--            <input type="text" placeholder="Username" id="ShopName">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Address"><i class="fas fa-home"></i>
            <?php echo $model->labels()['Address'] ?></label>
        <?php echo $form->fieldonly($model, 'Address') ?>
        <!--            <input type="text" placeholder="Eg: No:56/B Example Rd, Example" id="Address">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Email"><i class="fas fa-envelope"></i>
            <?php echo $model->labels()['Email'] ?>
        </label>
        <?php echo $form->fieldonly($model, 'Email')->emailField(); ?>
        <!--            <input type="email" placeholder="example@mail.com" id="Email">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="contact"><i class="fas fa-phone"></i>
            <?php echo $model->labels()['ContactNo'] ?></label>
        <?php echo $form->fieldonly($model, 'ContactNo'); ?>
        <!--            <input type="text" placeholder="011 2567890" id="contact">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Password"><i class="fas fa-key"></i>
            <?php echo $model->labels()['Password'] ?></label>
        <?php echo $form->fieldonly($model, 'Password')->passwordField(); ?>
        <!--            <input type="password" placeholder="password" id="password">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="PasswordR"><i class="fas fa-key"></i>
            <?php echo $model->labels()['ConfirmPassword'] ?></label>
        <?php echo $form->fieldonly($model, 'ConfirmPassword')->passwordField(); ?>
        <!--            <input type="passwordR" placeholder="Re-enter password" id="passwordR">-->
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="city"><i class="fas fa-map-marked-alt"></i>
            <?php echo $model->labels()['City'] ?></label>
        <?php echo $form->selectfieldonly($model, 'City'); ?>
    </div>
    <div class="inputBox">
        <label for="suburb"><i class="fas fa-street-view"></i>
            <?php echo $model->labels()['Suburb'] ?></label>
        <?php echo $form->selectfieldonly($model, 'Suburb'); ?>
    </div>
    <div class="inputBox">
        <label for="description"><i class="fas fa-hashtag"></i>
            <?php echo $model->labels()['ShopDesc'] ?></label>
        <?php echo $form->fieldonly($model, 'ShopDesc'); ?>
    </div>
    <?php echo $form->fieldonly($model, 'Location')->hiddenField(); ?>
    <?php echo $form->fieldonly($model, 'PlaceID')->hiddenField(); ?>
    <div class="inputBox map-inputBox">
        <label for="location"><i class="fas fa-map-marker-alt"></i>Location</label>
        <div id="map"></div>
    </div>
    <div class="inputBox"></div>
    <div class="inputBox">
        <button id="accept" type="submit" class="btn button submit">Submit Registration</button>
    </div>
    <?php echo $form->end(); ?>
</section>
<script src="/js/citySuburb.js" defer></script>