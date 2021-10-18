<?php
/** @var $Usermodel \app\models\Customer */
/** @var $loginmodel \app\models\User */

?>
<!-- Profile section starts -->
<section class="profile">
    <div class="content">
        <h1 class="heading">My<span> Account</span></h1>
        <div class="tabs profile">
            <div>Profile Edit</div>
            <button class="tab-btn">
        <span class="right-icon">
          <i class="fas fa-chevron-right"></i>
        </span>
                <span class="down-icon">
          <i class="fas fa-chevron-down"></i>
        </span>
            </button>
        </div>
        <div class="tabs shipping">
            <div>Shipping details</div>
            <button class="tab-btn">
        <span class="right-icon">
          <i class="fas fa-chevron-right"></i>
        </span>
                <span class="down-icon">
          <i class="fas fa-chevron-down"></i>
        </span>
            </button>
        </div>
        <div class="tabs password">
            <div>Change Password</div>
            <button class="tab-btn">
        <span class="right-icon">
          <i class="fas fa-chevron-right"></i>
        </span>
                <span class="down-icon">
          <i class="fas fa-chevron-down"></i>
        </span>
            </button>
        </div>

    </div>
    <div class="content">
        <h1 class="heading"><span>Info</span></h1>
        <div class="info-div" id="tabs profile">
            <form action="">
                <div class="inputBox">
                    <label for="Name"><i class="fas fa-edit"></i>Name</label>
                    <input type="text" placeholder="Name" id="name">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox">
                    <label for="Username"><i class="fas fa-user"></i>Username</label>
                    <input type="text" placeholder="Username" id="username">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox">
                    <label for="Email"><i class="fas fa-envelope"></i>Email</label>
                    <input type="email" placeholder="Email" id="email">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox">
                    <label for="contact"><i class="fas fa-phone"></i>Contact</label>
                    <input type="text" placeholder="Contact No" id="contact">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox"></div>
                <button type="submit" class="btn submit">Update</button>
            </form>
        </div>
        <div class="info-div" id="tabs shipping">
            <form action="" >
                <div class="inputBox">
                    <label for="Address"><i class="fas fa-home"></i>Address</label>
                    <input type="text" placeholder="Address" id="address">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox">
                    <label for="location"><i class="fas fa-map-marker-alt"></i>Location</label>
                    <input type="url" placeholder="Location" id="location">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox">
                    <label for="city"><i class="fas fa-map-marked-alt"></i>Select city</label>
                    <select id="city" name="city">
                        <option value="Colombo">Colombo</option>
                        <option value="Maharagama">Maharagama</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Nawala">Nawala</option>
                    </select>
                </div>
                <div class="inputBox">
                    <label for="suburb"><i class="fas fa-street-view"></i>Select suburb</label>
                    <select id="suburb" name="suburb">
                        <option value="Colombo">Colombo</option>
                        <option value="Maharagama">Maharagama</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Nawala">Nawala</option>
                    </select>
                </div>
                <div class="inputBox"></div>
                <button type="submit" class="btn submit">Update</button>
            </form>
        </div>
        <div class="info-div" id="tabs password">
            <form action="" >
                <div class="inputBox">
                    <label for="Password"><i class="fas fa-key"></i>Password</label>
                    <input type="password" placeholder="password" id="password">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox">
                    <label for="PasswordR"><i class="fas fa-key"></i>Re-enter password</label>
                    <input type="passwordR" placeholder="Re-enter password" id="passwordR">
                    <i class="iconSE fas fa-check-circle"></i>
                    <i class="iconSE fas fa-exclamation-circle"></i>
                    <small></small>
                </div>
                <div class="inputBox"></div>
                <button type="submit" class="btn submit">Update</button>
            </form>
        </div>
    </div>
</section>
<!-- Profile section ends -->


