
<?php
/** @var $model \app\models\Item **/
/** @var $form app\core\form\Form */
?>
<div class="core">
    <h1 class="heading">Add <span>Products</span></h1>
    <div class="container-core">
        <div class="form-details register">
            <?php $form = \app\core\form\Form::begin("","post","itemReg",[],"multipart/form-data",);?>
            <div class="inputBox">
                <label for="category">
                    <i class="fas fa-list"></i>
                    <?php echo $model->labels()['Category']?>
                </label>
                <?php echo $form->selectfieldonly($model,"Category",['0'=>'Vegetables','1'=>'Fruits','2'=>'Grocery','3'=>'Fish','4'=>'Meat']);?>
            </div>
            <div class="inputBox">
                <label for="Name">
                    <i class="fas fa-edit"></i>
                    <?php echo $model->labels()['Name']?>
                </label>
                <?php echo $form->fieldonly($model,"Name")->setInteraction('required');?>
            </div>
            <div class="inputBox">
                <label for="ItemImage">
                    <i class="far fa-images"></i>
                    <?php echo $model->labels()['ItemImage']?>
                </label>
                <?php echo $form->inputfile($model,"ItemImage")->setInteraction('required');?>
            </div>
            <div class="inputBox">
                <label for="Brand">
                    <i class="fas fa-edit"></i>
                    <?php echo $model->labels()['Brand']?>
                </label>
                <?php echo $form->fieldonly($model,"Brand");?>
            </div>

            <div class="inputBox">
                <label for="Unit">
                    <i class="fas fa-balance-scale"></i>
                    <?php echo $model->labels()['Unit']?>
                </label
                >
                <?php echo $form->selectfieldonly($model,"Unit",['0'=>'Kg','1'=>'Gram','2'=>'Litre','3'=>'ml','4'=>'Unit']);?>
            </div>
            <div class="inputBox">
                <label for="UWeight">
                    <i class="fas fa-weight-hanging"></i>
                    <?php echo $model->labels()['UWeight']?>
                </label>
                <?php echo $form->numberfieldonly($model,"UWeight",10,10000,10);?>
            </div>

            <div class="inputBox">
                <label for="MaxCount">
                    <i class="fas fa-weight-hanging"></i>
                    <?php echo $model->labels()['MaxCount']?>
                </label
                >
                <?php echo $form->numberfieldonly($model,"MaxCount",1,100,1);?>
            </div>
            <div class="inputBox">
                <label for="MRP">
                    <i class="fas fa-coins"></i>
                    <?php echo $model->labels()['MRP']?>
                    <small style="color: red; font-size:15px ">( Applicable only for Grocery items! )</small>
                </label>
                <?php echo $form->numberfieldonly($model,"MRP",1,10000,1);?>
            </div>
            <div class="inputBox"></div>
            <div class="inputBox btn-div">
                <button class="btn submit">Submit</button>
            </div>
            <?php \app\core\form\Form::end()?>
        </div>
    </div>
</div>

