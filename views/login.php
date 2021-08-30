<?php
/** @var $model \app\models\User **/
?>

<h1>Login</h1>

<?php $form = \app\core\form\Form::begin("","post");?>
<?php echo $form->field($model,'email')->emailField(); ?>
<?php echo $form->field($model,'password')->passwordField(); ?>
<button type="submit">Submit</button>
<?php \app\core\form\Form::end(); ?>
<!--<form action="" method="post">-->
<!--    <div >-->
<!--        <label >Email address</label>-->
<!--        <input type="email" name="username">-->
<!--    </div>-->
<!--    <div>-->
<!--        <label>Password</label>-->
<!--        <input type="password" name="password">-->
<!--    </div>-->
<!--    <button type="submit">Submit</button>-->
<!--</form>-->