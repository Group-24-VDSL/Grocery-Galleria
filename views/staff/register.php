<link rel="stylesheet" href="/css/all.css">
<link rel="stylesheet" href="/css/staff-register-form.css">
<link rel="stylesheet" href="/css/template.css">
<?php
/** @var $model \app\models\Staff **/
/** @var $form app\core\form\Form */
?>
<div style="height: 580px" class="core">
    <section class="register" id="register">
        <h1 class="heading">Registration <span>Form</span> Staff</h1>

        <?php $form = \app\core\form\Form::begin("","post","");?>
            <div class="inputBox">
                <label for="Name"><i class="fas fa-edit"></i>Name</label>
                <?php echo $form->fieldonly($model,'Name');?>
                <i class="iconSE fas fa-check-circle"></i>
                <i class="iconSE fas fa-exclamation-circle"></i>
                <small></small>
            </div>
            <!--        <div class="inputBox">-->
            <!--            <label for="Address"><i class="fas fa-home"></i>Address</label>-->
            <!--            <input type="text" placeholder="Eg: No:56/B Example Rd, Example" id="address">-->
            <!--            <i class="iconSE fas fa-check-circle"></i>-->
            <!--            <i class="iconSE fas fa-exclamation-circle"></i>-->
            <!--            <small></small>-->
            <!--        </div>-->
            <div class="inputBox">
                <label for="Email"><i class="fas fa-envelope"></i>Email</label>
                <?php echo $form->fieldonly($model,'Email')->emailField();?>
                <i class="iconSE fas fa-check-circle"></i>
                <i class="iconSE fas fa-exclamation-circle"></i>
                <small></small>
            </div>
            <div class="inputBox">
                <label for="contact"><i class="fas fa-phone"></i>Contact No</label>
                <?php echo $form->fieldonly($model,'ContactNo');?>
                <i class="iconSE fas fa-check-circle"></i>
                <i class="iconSE fas fa-exclamation-circle"></i>
                <small></small>
            </div>
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>Password</label>
                <?php echo $form->fieldonly($model,'Password')->passwordField();?>
                <i class="iconSE fas fa-check-circle"></i>
                <i class="iconSE fas fa-exclamation-circle"></i>
                <small></small>
            </div>
            <div class="inputBox">
                <label for="PasswordR"><i class="fas fa-key"></i>Re-enter password</label>
                <?php echo $form->fieldonly($model,'ConfirmPassword')->passwordField();?>
                <i class="iconSE fas fa-check-circle"></i>
                <i class="iconSE fas fa-exclamation-circle"></i>
                <small></small>
            </div>
            <div class="inputBox"></div>
            <div class="btn-align">
                <button id="deny" type="submit" class="btn submit deny">Deny Registration</button>
                <button id="accept" type="submit" class="btn submit">Accept Registration</button>
            </div>
        <?php echo $form::end() ?>
    </section>
</div>
