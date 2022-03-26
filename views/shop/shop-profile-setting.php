<?php
/** @var $model \app\models\Shop **/
/** @var $loginmodel \app\models\User **/
/** @var $form app\core\form\Form  */

?>
<!-- Profile section starts -->

<link rel="stylesheet" href="/css/shopProfileSetting.css" />
<script src="/js/password-update.js"></script>
<div class="core" style="height: 800px">
    <h1 class="heading">Profile <span>Settings</span></h1>
    <div class="container-core" style="height: 420px">
        <?php $form = \app\core\form\Form::begin("","post","shopUpdate",[]);?>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-store'></i></i> Shop Name</label>
            <?php echo $form->fieldonly($model,"ShopName"); ?>
        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-category' ></i> Shop Category</label>
            <span class="fileds">
                <?php
                switch($model->Category ) {
                    case 0 :
                        $category = "Grocery";
                        break;

                    case 1 :
                        $category = "Vegetable";
                        break;

                    case 2 :
                        $category = "Meat";
                        break;
                    case  3 :
                        $category = "Fruits";
                        break;
                }
                echo $category
                ?>
            </span>
        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-user'></i></i> Owner Name</label>
            <?php echo $form->fieldonly($model,"Name"); ?>
        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-user'></i></i> Address</label>
            <span class="fileds"><?php echo $model->Address ?></span>
        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-business'></i></i> City </label>
            <span class="fileds"><?php echo $model->City?></span>
        </div>
        <div class="inputBox">
            <label for="Username"><i class='bx bxs-buildings'></i> Suburb </label>
            <span class="fileds"><?php echo $model->Suburb ?></span>
        </div>
        <div class="inputBox">
            <label for="Email"><i class="fas fa-envelope"></i>Email</label>
            <?php echo $form->fieldonly($model,"Email");?>
        </div>
        <div class="inputBox">
            <label for="contact"><i class="fas fa-phone"></i>Contact No</label>
            <?php echo $form->fieldonly($model,"ContactNo");?>
        </div>
        <div class="inputBox">
            <label for="contact"><i class='bx bxs-book-open'></i>Shop Description</label>
            <?php echo $form->textAreaOnly($model,"ShopDesc");?>
        </div>
        <div class="inputBox btn-div">
            <button type="submit" class="btn update">Update</button>
        </div>
        <?php \app\core\form\Form::end()?>

    </div>

</div>