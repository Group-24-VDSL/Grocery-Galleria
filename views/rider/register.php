<?php
/**@var $model \app\models\Rider * */
/**@var $form \core\form\Form * */
?>
<!-- registration section start -->
<section class="register" id="ShopRegister">
    <h1 class="heading">Registration <span>Form</span> Rider</h1>
    <?php $form = \app\core\form\Form::begin("", "post", "ShopRegister"); ?>
    <div class="inputBox">
        <label for="Name"><i class="fas fa-edit"></i>
            <?php echo $model->labels()['Name'] ?></label>
        <?php echo $form->fieldonly($model, 'Name') ?>
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Address"><i class="fas fa-home"></i>
            <?php echo $model->labels()['Address'] ?></label>
        <?php echo $form->fieldonly($model, 'Address') ?>
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Email"><i class="fas fa-envelope"></i>
            <?php echo $model->labels()['Email'] ?>
        </label>
        <?php echo $form->fieldonly($model, 'Email')->emailField(); ?>
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="contact"><i class="fas fa-phone"></i>
            <?php echo $model->labels()['ContactNo'] ?></label>
        <?php echo $form->fieldonly($model, 'ContactNo'); ?>
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="contact"><i class="fas fa-id-card"></i>
            National Identity Card No.</label>
        <?php echo $form->fieldonly($model, 'NIC'); ?>
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="Password"><i class="fas fa-key"></i>
           Password</label>
        <?php echo $form->fieldonly($model, 'Password')->passwordField(); ?>
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="PasswordR"><i class="fas fa-key"></i>
            Confirm Password </label>
        <?php echo $form->fieldonly($model, 'ConfirmPassword')->passwordField(); ?>
        <i class="iconSE fas fa-check-circle"></i>
        <i class="iconSE fas fa-exclamation-circle"></i>
        <small></small>
    </div>
    <div class="inputBox">
        <label for="suburb"><i class="fas fa-truck"></i>
            Vehicle Type</label>
        <?php echo $form->selectfieldonly($model, 'RiderType',
            ['0' => 'Bike',
                '1' => 'Threewheel']); ?>
    </div>
    <div class="inputBox">
        <label for="city"><i class="fas fa-map-marked-alt"></i>
            City</label>
        <?php echo $form->selectfieldonly($model, 'City'); ?>
    </div>
    <div class="inputBox">
        <label for="suburb"><i class="fas fa-street-view"></i>
            Suburb</label>
        <?php echo $form->selectfieldonly($model, 'Suburb'); ?>
    </div>
    <div class="inputBox">
        <button id="accept" type="submit" class="btn button submit">Submit Registration</button>
    </div>
    <?php echo $form->end(); ?>
</section>
<script src="/js/citySuburb.js" defer></script>
