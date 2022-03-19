<?php
/** @var $model \app\models\Rider * */
/** @var $form \core\form\Form */
?>

<div class="core">
    <section class="register" id="register">
        <h1 class="heading">Registration <span>Form</span> Rider</h1>
        <div class="form-container-delivery scroller" data-name="rider-registration">

            <?php $form = \app\core\form\Form::begin("/dashboard/delivery/addrider", "post", "RiderRegistration", [], "multipart/form-data"); ?>
            <div class="inputBox">
                <label for=""><i class="fas fa-edit"></i><?php echo $model->labels()['Name'] ?></label>
                <?php echo $form->fieldonly($model, "Name"); ?>
            </div>


            <div class="inputBox">
                <label for=""><i class="fas fa-home"></i><?php echo $model->labels()['Address'] ?></label>
                <?php echo $form->fieldonly($model, "Address"); ?>
            </div>
            <div class="inputBox">
                <label for=""><i class="far fa-id-card"></i>
                    <?php echo $model->labels()['NIC'] ?>
                </label>
                <?php echo $form->fieldonly($model, "NIC"); ?>
            </div>
            <div class="inputBox">
                <label for=""><i class="fas fa-envelope"></i>
                    <?php echo $model->labels()['Email'] ?>
                </label>
                <?php echo $form->fieldonly($model, "Email")->emailField(); ?>
            </div>
            <div class="inputBox">
                <label for=""><i class="fas fa-phone"></i>
                    <?php echo $model->labels()['ContactNo'] ?></label>
                <?php echo $form->fieldonly($model, "ContactNo") ?>
            </div>
            <div class="inputBox">
                <label for=""><i class='bx bxs-truck'></i>
                    <?php echo $model->labels()['RiderType'] ?></label>
                <?php echo $form->selectfieldonly($model, 'RiderType', ['0' => 'Tuk Tuk', '1' => 'Bicycle']); ?>
            </div>

            <div class="inputBox">
                <label for=""><i class="fas fa-map-marked-alt"></i>
                    <?php echo $model->labels()['City'] ?></label>
                <?php echo $form->selectfieldonly($model, 'City'); ?>
            </div>
            <div class="inputBox">
                <label for=""><i class="fas fa-street-view"></i>
                    <?php echo $model->labels()['Suburb'] ?></label>
                <?php echo $form->selectfieldonly($model, 'Suburb'); ?>
            </div>

            <div class="inputBox fileInput">
                <label for="ProfilePic"><i class="far fa-images"></i>
                    <?php echo $model->labels()['ProfilePic']?>
                </label>
                <div>
                    <img id="output" src="/img/placeholder-150.png" />
                    <?php echo $form->inputfile($model,"ProfilePic",[],"image/jpeg,image/png");?>
                </div>
            </div>
            <div class="btn-align">
                <button id="deny" type="submit" class="btn submit deny">Deny Registration</button>
                <button id="accept" type="submit" class="btn submit">Submit Registration</button>
            </div>
            <?php echo $form->end(); ?>
        </div>

    </section>
    <script src="/js/citySuburb.js" defer></script>
</div>
