<?php
    /** @var $model \app\models\Customer **/
    /** @var $form \core\form\Form */
?>
<!-- registration section start -->

<section class="register" id="register">
    <h1 class="heading">Registration <span>Form</span> Customer</h1>
    <?php $form = \app\core\form\Form::begin("","post","CustReg");?>
        <div class="inputBox">
            <label for="Name"><i class="fas fa-edit"></i>Name</label>
            <?php echo $form->fieldonly($model,'Name');?>
<!--            <input type="text" placeholder="Name" id="name">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="Address"><i class="fas fa-home"></i>Address</label>
            <?php echo $form->fieldonly($model,'Address');?>
<!--            <input type="text" placeholder="Address" id="address">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="Email"><i class="fas fa-envelope"></i>Email</label>
            <?php echo $form->fieldonly($model,'Email')->emailField();?>

            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox" style="grid-column-start: 1">
            <label for="Password"><i class="fas fa-key"></i>Password</label>
            <?php echo $form->fieldonly($model,'Password')->passwordField();?>
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="Password"><i class="fas fa-key"></i>Re-enter password</label>
            <?php echo $form->fieldonly($model,'ConfirmPassword')->passwordField();?>
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="city"><i class="fas fa-map-marked-alt"></i>Select city</label>
            <?php echo $form->selectfieldonly($model,'City');?>
        </div>
        <div class="inputBox">
            <label for="suburb"><i class="fas fa-street-view"></i>Select suburb</label>
            <?php echo $form->selectfieldonly($model,'Suburb');?>
        </div>
        <div class="inputBox">
            <label for="contact"><i class="fas fa-phone"></i>Contact</label>
<!--            <input type="text" placeholder="Contact No" id="contact">-->
            <?php echo $form->fieldonly($model,'ContactNo');?>
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="location"><i class="fas fa-map-marker-alt"></i>Location</label>
            <?php echo $form->fieldonly($model,'Location');?>
<!--            <input type="url" placeholder="Location" id="location">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox"></div>
        <button type="submit" class="btn submit">Submit Registration</button>
    <?php \app\core\form\Form::end(); ?>
</section>
<script src="/js/citySuburb.js" defer></script>