<?php
    /** @var $model \app\models\User **/
?>
<h1>Register</h1>
<?php $form = \app\core\form\Form::begin("","post");?>
<?php echo $form->field($model,'email')->emailField(); ?>
<?php echo $form->field($model,'password')->passwordField(); ?>
<?php echo $form->field($model,'confirmPassword')->passwordField(); ?>
<button type="submit">Submit</button>
<?php \app\core\form\Form::end(); ?>


<!--<form action="" method="post">-->
<!--    <div >-->
<!--        <label >Email address</label>-->
<!--        <input type="email" name="email">-->
<!--    </div>-->
<!--    <div>-->
<!--        <label>Password</label>-->
<!--        <input type="password" name="password">-->
<!--    </div>-->
<!--    <div>-->
<!--        <label>Confirm Password</label>-->
<!--        <input type="password" name="confirmPassword" style="--><?php //echo $model->hasError('confirmPassword') ? "border: 1px solid red;" : '' ?><!--"> <!-- if there is an error on the attribute, display that -->
<!--    </div>-->
<!--    <button type="submit">Submit</button>-->
<!--</form>-->
