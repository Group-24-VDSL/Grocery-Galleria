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
            ><i class="fas fa-arrow-circle-up"></i>Maximum System price</label>
            <input id="MRP" name="MRP" type="text" readonly/>
        </div>
        <div class="inputBox lock">
            <label for="Unit"><i class="fas fa-balance-scale"></i>Unit</label>
            <input id="Unit" name="Unit" type="text" readonly/>
        </div>

        <div class="inputBox">
            <label for="UWeight"><i class="fas fa-weight-hanging"></i>Unit Weight</label>
            <input id="UWeight" name="UWeight" type="text" readonly/>
        </div>
        <div class="inputBox">
            <label for="UPrice"><i class="fas fa-coins"></i>Unit Price</label>
            <?php echo $form->fieldonly($model, "UnitPrice", '') ?>
        </div>
        <div class="inputBox">
            <label for="Stock"><i class="fas fa-coins"></i>Stock</label>
            <?php echo $form->fieldonly($model, "Stock", '') ?>
        </div>
        <div class="inputBox">
            <label for="Stock"><i class="fa fa-clock-o" ></i>Maximum Lead Time (in days)</label>
            <?php echo $form->fieldonly($model, "MaxLeadTime", '')?>
        </div>
        <div class="inputBox">
            <label for="Stock"><i class="fas fa-coins"></i>Minimum Lead Time (in days)</label>
            <?php echo $form->fieldonly($model, "MinLeadTime", '') ?>
        </div>
        <div class="inputBox">
            <p style="font-size: 12px ; color: #a94442">Lead Time : Time taken to supply the shop items</p>
        </div>
        <div class="inputBox">
            <?php echo $form->fieldonly($model, "ShopID")->setValue(5)->hiddenField()?>
        </div>


        <div class="inputBox"></div>
        <button class="btn">Submit</button>

        </form>
    </div>
</div>