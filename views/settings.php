<?php
/** @var $loginmodel \app\models\User **/

?>
<!-- Profile section starts -->
<div class="core">
    <h1 class="heading">Change <span>Password</span></h1>
    <div class="container-core">
        <?php $form = \app\core\form\Form::begin("","post","",[]);?>
        <div class="inputBox">
            <label for="currentPWD"><i class="fas fa-key"></i>Current Password</label>
            <input type="password" placeholder="" id="currentPWD" name="currentPWD" />
        </div>
        <div class="inputBox">
            <label for="Password"><i class="fas fa-key"></i>Password</label>
            <?php echo $form->fieldonly($loginmodel,'Password')->passwordField();?>
        </div>
        <div class="inputBox">
            <label for="ConfirmPassword"><i class="fas fa-key"></i>Confirm password</label>
            <?php echo $form->fieldonly($loginmodel,'ConfirmPassword')->passwordField();?>
        </div>

        <div class="inputBox btn-div">
            <button type="submit" class="btn update">Update</button>
        </div>
        <?php \app\core\form\Form::end()?>
    </div>
</div>
<!-- Profile section ends -->




