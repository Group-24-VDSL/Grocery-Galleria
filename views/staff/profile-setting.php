<?php
/** @var $Usermodel \app\models\Staff */
/** @var $loginmodel \app\models\User */

?>
<!-- Profile section starts -->
<div class="core">
    <h1 class="heading">Profile <span>Settings</span></h1>
    <div class="container-core">
        <form action="">
            <div class="inputBox">
                <label for="Username"><i class="fas fa-user"></i>Name</label>
                <input type="text" placeholder="" id="Name" />
            </div>
            <div class="inputBox">
                <label for="Email"><i class="fas fa-envelope"></i>Email</label>
                <input type="email" placeholder="" id="Email" />
            </div>
            <div class="inputBox">
                <label for="contact"><i class="fas fa-phone"></i>Contact</label>
                <input type="text" placeholder="" id="ContactNo" />
            </div>
            <div class="inputBox">
                <label for="Address"><i class="fas fa-home"></i>Address</label>
                <input type="text" placeholder="" id="Address" />
            </div>
            <div class="inputBox"></div>
            <div class="inputBox btn-div">
                <button type="submit" class="btn update">Update</button>
            </div>
        </form>
    </div>
    <h1 class="heading">Change <span>Password</span></h1>
    <div class="container-core">
        <form action="">
            <div class="inputBox">
                <label for="Password"><i class="fas fa-key"></i>Password</label>
                <input type="password" placeholder="" id="password" />
            </div>
            <div class="inputBox">
                <label for="PasswordR"
                ><i class="fas fa-key"></i>Re-enter password</label
                >
                <input type="passwordR" placeholder="" id="passwordR" />
            </div>
            <div class="inputBox"></div>
            <div class="inputBox btn-div">
                <button type="submit" class="btn update">Update</button>
            </div>
        </form>
    </div>
</div>
<!-- Profile section ends -->




