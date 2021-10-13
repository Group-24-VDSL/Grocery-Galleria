<?php
    /** @var $model \app\models\Customer **/
    /** @var $form app\core\form\Form */
?>
<!-- registration section start -->

<section class="register" id="register">
    <h1 class="heading">Registration <span>Form</span> Customer</h1>
    <?php $form = \app\core\form\Form::begin("","post","CustReg");?>
        <div class="inputBox">
            <label for="Name"><i class="fas fa-edit"></i>Name</label>
            <?php echo $form->fieldonly($model,'Name');?>
        </div>
        <div class="inputBox">
            <label for="Address"><i class="fas fa-home"></i>Address</label>
            <?php echo $form->fieldonly($model,'Address');?>
        </div>
        <div class="inputBox">
            <label for="Email"><i class="fas fa-envelope"></i>Email</label>
            <?php echo $form->fieldonly($model,'Email')->emailField();?>
        </div>
        <div class="inputBox">
            <label for="contact"><i class="fas fa-phone"></i>Contact</label>
            <?php echo $form->fieldonly($model,'ContactNo');?>
        </div>
        <div class="inputBox" >
            <label for="Password"><i class="fas fa-key"></i>Password</label>
            <?php echo $form->fieldonly($model,'Password')->passwordField();?>
        </div>
        <div class="inputBox">
            <label for="PasswordR"><i class="fas fa-key"></i>Re-enter password</label>
            <?php echo $form->fieldonly($model,'ConfirmPassword')->passwordField();?>
        </div>
        <div class="inputBox">
            <label for="city"><i class="fas fa-map-marked-alt"></i>Select city</label>
            <?php echo $form->selectfieldonly($model,'City',['Colombo'=>'Colombo','Maharagama'=>'Maharagama','Gampaha'=>'Gampaha','Nawala'=>'Nawala']);?>
        </div>
        <div class="inputBox">
            <label for="suburb"><i class="fas fa-street-view"></i>Select suburb</label>
            <?php echo $form->selectfieldonly($model,'Suburb',['Colombo'=>'Colombo','Maharagama'=>'Maharagama','Gampaha'=>'Gampaha','Nawala'=>'Nawala']);?>
        </div>

        <div class="inputBox" >
            <?php echo $form->fieldonly($model,'Location')->hiddenField();?>
            <?php echo $form->fieldonly($model,'PlaceID')->hiddenField();?>
        </div>
        <div class="inputBox map-inputBox"><label for="location"><i class="fas fa-map-marker-alt"></i>Location</label><div id="map"></div></div>
        <div class="inputBox"><button type="submit" class="btn submit" >Submit Registration</button></div>
        <div class="inputBox"><button type="reset" class="btn" >Cancel</button></div>
    <?php echo $form::end() ?>
</section>
