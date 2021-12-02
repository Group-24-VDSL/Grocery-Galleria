<?php
/** @var $model \app\models\ShopItem **/
/** @var $form app\core\form\Form */
?>

<link rel="stylesheet" href="/css/shop-items.css">
<script src="/js/dashboard-shop.js" defer></script>
<link rel="stylesheet" href="/css/dashboardStyle.css">
<link rel="stylesheet" href="/css/dashboardStyleStaff.css">

<div class="core" style="height: height: 580px">
    <h1 class="heading">Ongoing <span>Products</span></h1>
    <div class="container-items">

        <table class="table-item small-first-col">
            <thead>
            <tr>
                <th></th>
                <th>Item ID</th>
                <th>Item Image</th>
                <th>Item Name</th>
                <th>Brand</th>
                <th>U/Weight</th>
                <th>Max Price</th>
                <th>U/Price</th>
                <th>Unit Price</th>
                <th>Stock</th>
                <th>enable</th>
                <th></th>
            </tr>
            </thead>
            <?php $form = \app\core\form\Form::begin("","post",'',[""]); ?>
            <tbody id="item-table" class="item-table-body body-half-screen">


            </tbody>
            <?php \app\core\form\Form::end(); ?>
        </table>

    </div>
</div>

<a name = "update">
    <div class="core" id="Update">
    <h1 class="heading">Update <span>Products</span></h1>

    <div class="container-core">

        <div class="form-details register">
            <div id = "updateItem">

            </div>
            <?php $form = \app\core\form\Form::begin("","post","itemUpdate",[],"multipart/form-data",);?>

            <input id="ItemID" name="ItemID" value="" hidden>
            <div class="inputBox">
                <label for="ID">
                    <i class="fas fa-sort-amount-down"></i>
                    <?php echo $model->labels()['ItemID']?>
                </label>

                <span class="fileds" id = "updateID">

                </span>
            </div>
            <div class="inputBox">
                <label for="Name">
                    <i class="fas fa-edit"></i>
                    <?php echo $model->labels()['Name']?>
                </label>

                <span class="fileds" id = "updateName">

                </span>

            </div>
            <div class="inputBox">
                <label for="Image">
                    <i class="far fa-images"></i>
                    <?php echo $model->labels()['Image']?>
                </label>

                <span class="image-box" >
                    <img id="updateImage" >
                </span>

            </div>
            <div class="inputBox">
                <label for="Stock">
                   <i class="fas fa-boxes"></i>
                    <?php echo $model->labels()['Stock']?>
                </label>
                <?php echo $form->numberfieldonly($model,"Stock",10,10000,10);?>
            </div>

            <div class="inputBox">
                <label for="Uprice">
                    <i class="fas fa-coins"></i>
                    <?php echo $model->labels()['UPrice']?>
                </label>
                <?php echo $form->numberfieldonly($model,"UnitPrice",10,10000,10);?>
            </div>

            <div class="inputBox">
                <label for="Enable">
                    <i class="far fa-flag"></i>
                    <?php echo $model->labels()['Enable']?>
                </label>

                <div  id="bit00_3">
                    <label class="switch">
                        <input type="checkbox" id="checkbox1">
                        <div class="slider round">
                            <span class="on">Enable&nbsp&nbsp</span>
                            <span class="off">&nbsp&nbspDisable</span>
                        </div>
                    </label>
                </div>

<!--                --><?php //echo $form->numberfieldonly($model,"Enabled",0,1,1);?>
<!--                <span style="color: #003d2e">Enable --><?php //echo $form->fieldonly($model,"Enabled")->radioField()->setValue(1); ?><!--</span>-->
<!---->
<!--                <span style="color: red">Disable --><?php //echo $form->fieldonly($model,"Enabled")->radioField()->setValue(0); ?><!--</span>-->

            </div>
            <?php echo $form->fieldonly($model,"ShopID")->hiddenField();?>
            <?php echo $form->fieldonly($model,"Enabled")->hiddenField();?>

            <!--                <div class="inputBox"></div>-->
            <div class="inputBox btn-div">
                <button type="submit" class="btn update">Update</button>
            </div>
            <?php \app\core\form\Form::end()?>
        </div>
    </div>
</div>

</a>

