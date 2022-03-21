<link rel="stylesheet" href="/css/passwordChng.css">
<?php
/** @var $model \app\models\User  * */
/** @var $form \core\form\Form */
?>
<section class="profile">
    <div class="content">
        <h1 class="heading">Set<span> Password</span></h1>
    </div>
    <div class="content">
        <h1 class="heading"><span>Info</span></h1>
        <div class="info-div" id="tabs password">
            <?php $form = \app\core\form\Form::begin("/changePwd", "post", "changePassword", []); ?>
            <input type="number" placeholder="" id="UserID" name="UserID" hidden>
                <div class="inputBox">
                    <label for=""><i class="fas fa-key"></i>
                        <?php echo $model->labels()['Password'] ?></label>
                    <?php echo $form->fieldonly($model, 'Password')->passwordField(); ?>
                </div>
                <div class="inputBox">
                    <label for=""><i class="fas fa-key"></i>
                        <?php echo $model->labels()['ConfirmPassword'] ?></label>
                    <?php echo $form->fieldonly($model, 'ConfirmPassword')->passwordField(); ?>
                </div>
                <div class="inputBox"></div>
                <button type="submit" class="btn submit">Submit</button>
            <?php echo $form->end(); ?>
        </div>
    </div>
</section>
<script src="/js/changePwd.js"></script>

