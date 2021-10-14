<?php
/** @var $model \app\models\ShopItem * */
/** @var $form app\core\form\Form */
?>
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
            ><i class="fas fa-arrow-circle-up"></i>MRP</label>
            <input id="MRP" type="text" readonly/>
        </div>
        <div class="inputBox lock">
            <label for="Unit"><i class="fas fa-balance-scale"></i>Unit</label>
            <input id="Unit" type="text" readonly/>
        </div>
        <?php $form->fieldonly($model, "ShopID")->setValue(0) ?>
        <div class="inputBox">
            <label for="UWeight"><i class="fas fa-weight-hanging"></i>Unit Weight</label>
            <input id="UWeight" type="text" readonly/>
        </div>
        <div class="inputBox">
            <label for="UPrice"><i class="fas fa-coins"></i>Unit Price</label>
            <?php echo $form->fieldonly($model, "UnitPrice", '') ?>
        </div>
        <div class="inputBox">
            <label for="Stock"><i class="fas fa-coins"></i>Stock</label>
            <?php echo $form->fieldonly($model, "Stock", '') ?>
        </div>
        <button class="btn">Submit</button>
        <script src="/js/AddItem.js"></script>
        </form>
    </div>
</div>