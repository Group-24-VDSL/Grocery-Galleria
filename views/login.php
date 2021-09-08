<?php
/** @var $model \app\models\LoginForm **/
/** @var $form \core\form\Form */
?>


<div class="container">
    <div class="subcontainer">
        <img class="main-img" src="./img/login-background.png" alt="">
    </div>
    <div class="subcontainer">
        <?php $form = \app\core\form\Form::begin("","post"); ?>
            <img class="user" src="./img/user.svg" alt="">
            <h2>Welcome</h2>
            <div class="input-div one">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5>Username</h5>
                    <?php echo $form->fieldonly($model,'Email',["input"])->emailField(); ?>
                </div>
            </div>
            <div class="input-div two">
                <div class="icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h5>Password</h5>
                    <?php echo $form->fieldonly($model,'Password',["input"])->passwordField(); ?>
                </div>
            </div>
            <a href="#">Forgot Password</a>
        <button class="btn" type="submit" name="" id="">Login</button>
        <?php \app\core\form\Form::end(); ?>
    </div>
</div>



