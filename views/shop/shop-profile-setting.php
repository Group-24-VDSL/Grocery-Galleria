<?php
/** @var $model \app\models\Shop **/
/** @var $loginmodel \app\models\User **/
/** @var $form app\core\form\Form  */
?>
<!-- Profile section starts -->

<link rel="stylesheet" href="/css/shopProfileSetting.css" />
<div class="core">
    <h1 class="heading">Profile <span>Settings</span></h1>
    <div class="container-core" style="height: 420px">

        <div class="inputBox">
            <label for="Username"><i class='bx bxs-store'></i></i> Shop Name</label>

        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-category' ></i> Shop Category</label>

            <span class="fileds">

            </span>
        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-user'></i></i> Owner Name</label>

        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-user'></i></i> Address</label>
        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-business'></i></i> City </label>

        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-buildings'></i> Suburb </label>

        </div>
        <div class="inputBox">
            <label for="Email"><i class="fas fa-envelope"></i>Email</label>

        </div>
        <div class="inputBox">
            <label for="contact"><i class="fas fa-phone"></i>Contact No</label>

        </div>
        <div class="inputBox">
            <label for="contact"><i class='bx bxs-book-open'></i>Description</label>

        </div>
        <div class="inputBox btn-div">
            <button type="submit" class="btn update">Update</button>
        </div>
    </div>

    <h1 class="heading">Change <span>Password</span></h1>
    <div class="container-core">
        <div class="inputBox">
            <label for="Password"><i class="fas fa-key"></i>Current Password</label>

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

    </div>
</div>