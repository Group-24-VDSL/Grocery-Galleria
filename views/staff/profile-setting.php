<?php
/** @var $model \app\models\Staff **/
/** @var $loginmodel \app\models\User **/
/** @var $form app\core\form\Form  */

?>
<!-- Profile section starts -->
<div class="core">
    <h1 class="heading">Profile <span>Settings</span></h1>
    <div class="container-core">
        <?php $form = \app\core\form\Form::begin("/dashboard/staff/profilesettings","post","staffUpdate",[],"multipart/form-data",);?>
            <div class="inputBox">
                <label for="Username"><i class="fas fa-user"></i>Name</label>
                <?php echo $form->fieldonly($model,"Name");?>
            </div>
            <div class="inputBox">
                <label for="Email"><i class="fas fa-envelope"></i>Email</label>
                <?php echo $form->fieldonly($model,"Email");?>
            </div>
            <div class="inputBox">
                <label for="contact"><i class="fas fa-phone"></i>Contact</label>
                <?php echo $form->fieldonly($model,"ContactNo");?>
            </div>
            <div class="inputBox btn-div">
                <button type="submit" class="btn update">Update</button>
            </div>
        <?php \app\core\form\Form::end()?>

    </div>
    <h1 class="heading">Change <span>Password</span></h1>
    <div class="container-core">
        <?php $form = \app\core\form\Form::begin("/profileupdate","post","userUpdate",[],"multipart/form-data",);?>
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>Current Password</label>
                <?php echo $form->fieldonly($loginmodel,"Password")->passwordField();?>
            </div>
            <div class="inputBox">
                <label for="NewPwd"><i class="fas fa-key"></i>Password</label>
                <input type="password" placeholder="" id="NewPwd" name="NewPwd" />
            </div>
            <div class="inputBox">
                <label for="ConfirmPwd"><i class="fas fa-key"></i>Confirm password</label>
                <input type="password" placeholder="" id="ConfirmPwd" name="ConfirmPwd" />
            </div>

            <div class="inputBox btn-div">
                <button type="submit" class="btn update">Update</button>
            </div>
        <?php \app\core\form\Form::end()?>
    </div>
</div>
<!-- Profile section ends -->




