<?php
/** @var $model \app\models\ShopItem * */
/** @var $form app\core\form\Form */
?>

<script src="/js/AddItem.js"></script>

<div class="core sub-core">
    <h1 class="heading">Add <span>Products</span></h1>
    <div class="container-items">
        <?php $form = \app\core\form\Form::begin("", "post", "ShopItemReg", ["add-item"], "multipart/form-data",); ?>
        <div class="inputBox">
            <label for="Unit"
            ><i class="fas fa-list-ul"></i>Select product</label>
            <?php echo $form->selectfieldonly($model, "ItemID") ?>
        </div>
        <div class="inputBox lock">
            <label for="MRP"
            ><i class="fas fa-arrow-circle-up"></i>System price (LKR)</label>
            <input id="MRP" name="MRP" type="text" readonly/>
        </div>
        <div class="inputBox">
            <label for="UPrice"><i class="fas fa-coins"></i>Unit Price (LKR)</label>
            <?php echo $form->numberfieldonly($model, "UnitPrice", '0.00','','0.01','')?>
        </div>
        <div class="inputBox">
            <label for="UWeight"><i class="fas fa-weight-hanging"></i>Unit Weight </label>
            <input id="UWeight" name="UWeight" type="text" readonly/>
        </div>
        <div class="inputBox lock">
            <label for="Unit"><i class="fas fa-balance-scale"></i>Unit</label>
            <input id="Unit" name="Unit" type="text" readonly/>
        </div>

        <div class="inputBox">
            <label for="Stock"><i class="fas fa-coins"></i>Current Stock <span id="unit-tag"></span> </label>
            <?php echo $form->numberfieldonly($model, "Stock", '0','','0.5','') ?>
        </div>
        <div class="inputBox">
            <label for="MinStock"><i class="fas fa-coins"></i>Minimum Stock</label>
            <?php echo $form->numberfieldonly($model, "MinStock", '0','','1.00','') ?>
        </div>
        <div class="inputBox">
            <label for="Stock"><i class="fa fa-calendar" aria-hidden="true"></i>Maximum Lead Time (in days)</label>
            <?php echo $form->numberfieldonly($model, "MaxLeadTime", '1','','1.00','')?>
        </div>
        <div class="inputBox">
            <label for="Stock"><i class="fa fa-calendar" aria-hidden="true"></i>Minimum Lead Time (in days)</label>
            <?php echo $form->numberfieldonly($model, "MinLeadTime", '1','','1.00','') ?>
        </div>
        <div style="height: 3rem" class="inputBox">
            <p style="font-size: 12px ; color: green">Lead Time : Time taken to supply the shop items <br><br>
                * SPECIAL - Lead time sections can only be filled when particular item is added <br></p>
        </div>
        <div class="inputBox">
            <?php echo $form->fieldonly($model, "ShopID")->setValue($model->ShopID)->hiddenField();?>
        </div>
        <div class="inputBox"></div>
        <button style="margin-top: 1rem;" class="btn">Submit</button>

        <?php \app\core\form\Form::end(); ?>
    </div>
</div>