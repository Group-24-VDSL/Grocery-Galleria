<?php
/** @var $model \app\models\Shop **/
/** @var $loginmodel \app\models\User **/
/** @var $form app\core\form\Form  */

?>
<!-- Profile section starts -->

<link rel="stylesheet" href="/css/shopProfileSetting.css" />
<link rel="stylesheet" href="/css/password.css" />
<script src="/js/password-update.js"></script>


<div class="core" style="height: 800px">
    <h1 class="heading">Profile <span>Settings</span></h1>

    <h1 class="heading">Change <span>Password</span></h1>
    <div class="container-core">
<!--        --><?php //$form = \app\core\form\Form::begin("","","",[]);?>
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>Current Password</label>
                <input type="password" placeholder="" id="OldPwd" class="OldPwd" name="OldPwd" />
                <small style="color: red" id="currentError"></small>
            </div>
            <div class="inputBox">
                <label for="NewPwd"><i class="fas fa-key"></i>New Password</label>
                <input type="password" placeholder="" id="NewPwd" class="NewPwd" name="NewPwd" />
                <small style="color: red" id="newError"></small>
            </div>
            <div class="inputBox">
                <label for="ConfirmPwd"><i class="fas fa-key"></i>Confirm password</label>
                <input type="password" placeholder="" id="ConfirmPwd" class="ConfirmPwd" name="ConfirmPwd" />
                <small style="color: red" id="confirmError"></small>
            </div>

            <div class="inputBox btn-div">
                <button   class="btn update" onclick="updatePassword()">Update</button>
            </div>
<!--        --><?php //\app\core\form\Form::end()?>
    </div>
    </form>
</div>