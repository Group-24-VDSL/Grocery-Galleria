<?php
/**@var $model \app\models\Shop **/
/**@var $form \core\form\Form **/
?>
<!-- registration section start -->
<section class="register" id="ShopRegister">
    <h1 class="heading">Registration <span>Form</span> Shop</h1>
    <?php $form = \app\core\form\Form::begin("","post", "ShopRegister");?>
        <div class="inputBox">
            <label for="Name"><i class="fas fa-edit"></i>
            <?php echo $model->labels()['Name']?></label>
            <?php echo $form->fieldonly($model,'Name')?>
<!--            <input type="text" placeholder="Name" id="Name">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="Username"><i class="fas fa-store"></i>
                <?php echo $model->labels()['ShopName']?></label>
            <?php echo $form->fieldonly($model,'ShopName')?>
<!--            <input type="text" placeholder="Username" id="ShopName">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="Address"><i class="fas fa-home"></i>
                <?php echo $model->labels()['Address']?></label>
            <?php echo $form->fieldonly($model,'Address')?>
<!--            <input type="text" placeholder="Eg: No:56/B Example Rd, Example" id="Address">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="Email"><i class="fas fa-envelope"></i>
                <?php echo $model->labels()['Email']?>
                </label>
            <?php echo $form->fieldonly($model,'Email')->emailField();?>
<!--            <input type="email" placeholder="example@mail.com" id="Email">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="Password"><i class="fas fa-key"></i>
                <?php echo $model->labels()['Password']?></label>
            <?php echo $form->fieldonly($model,'Password')->passwordField();?>
<!--            <input type="password" placeholder="password" id="password">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="PasswordR"><i class="fas fa-key"></i>
                <?php echo $model->labels()['ConfirmPassword']?></label>
            <?php echo $form->fieldonly($model,'ConfirmPassword')->passwordField();?>
<!--            <input type="passwordR" placeholder="Re-enter password" id="passwordR">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="city"><i class="fas fa-map-marked-alt"></i>
                <?php echo $model->labels()['City']?></label>
            <?php echo $form->selectfieldonly($model,'City',
                ['Colombo'=>'Colombo',
                    'Maharagama'=>'Maharagama',
                    'Gampaha'=>'Gampaha',
                    'Nawala'=>'Nawala']);?>
<!--            <select id="city" name="city">-->
<!--                <option value="Colombo">Colombo</option>-->
<!--                <option value="Maharagama">Maharagama</option>-->
<!--                <option value="Gampaha">Gampaha</option>-->
<!--                <option value="Nawala">Nawala</option>-->
<!--            </select>-->
        </div>
        <div class="inputBox">
            <label for="suburb"><i class="fas fa-street-view"></i>
                <?php echo $model->labels()['Suburb']?></label>
            <?php echo $form->selectfieldonly($model,'Suburb',
                ['Colombo'=>'Colombo',
                    'Maharagama'=>'Maharagama',
                    'Gampaha'=>'Gampaha',
                    'Nawala'=>'Nawala']);?>
<!--            <select id="suburb" name="suburb">-->
<!--                <option value="Colombo">Colombo</option>-->
<!--                <option value="Maharagama">Maharagama</option>-->
<!--                <option value="Gampaha">Gampaha</option>-->
<!--                <option value="Nawala">Nawala</option>-->
<!--            </select>-->
        </div>
        <div class="inputBox">
            <label for="contact"><i class="fas fa-phone"></i>
                <?php echo $model->labels()['ContactNo']?></label>
            <?php echo $form->fieldonly($model,'ContactNo');?>
<!--            <input type="text" placeholder="011 2567890" id="contact">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="location"><i class="fas fa-map-marker-alt"></i>
                <?php echo $model->labels()['Location']?></label>
            <?php echo $form->fieldonly($model,'Location');?>
<!--            <input type="url" placeholder="Enter Google location URL here" id="location">-->
            <i class="iconSE fas fa-check-circle"></i>
            <i class="iconSE fas fa-exclamation-circle"></i>
            <small></small>
        </div>
        <div class="inputBox">
            <label for="description"><i class="fas fa-hashtag"></i>
                <?php echo $model->labels()['ShopDesc']?></label>
            <?php echo $form->fieldonly($model,'ShopDesc');?>
<!--            <input type="text" placeholder="eg: Farm Fresh" id="description">-->
        </div>
<!--        <div class="inputBox banner">-->
<!--            <label for="ShopBanner"><i class="fas fa-images"></i>-->
<!--                --><?php //echo $model->labels()['ShopBanner']?><!--</label>-->
<!--            --><?php //echo $form->inputfile($model,'ShopBanner');?>
<!--           <input type="file" id="ShopBanner" name="ShopBanner">-->
<!--            <i class="iconSE fas fa-check-circle"></i>-->
<!--            <i class="iconSE fas fa-exclamation-circle"></i>-->
<!--            <small></small>-->
<!--        </div>-->
        <div class="inputBox"></div>
        <div class="btn-align">
            <button id="deny" type="submit" class="btn submit deny">Deny Registration</button>
            <button id="accept" type="submit" class="btn submit">Accept Registration</button>
        </div>
    <?php echo $form->end();?>
</section>
