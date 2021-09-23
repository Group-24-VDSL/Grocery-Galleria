
<?php
/** @var $model \app\models\Item **/
/** @var $form app\core\form\Form */
?>
<div class="main-content">
    <nav>
        <h1 class="main-header">Dashboard</h1>
    </nav>
    <div class="">
        <h3>Add Item</h3>
        <div class="frm">
            <?php $form = \app\core\form\Form::begin("","post",[],"multipart/form-data");?>
            <div class="display-grid delivery-view">
                <div class="delivery-view-details">
                    <div><?php echo $form->field($model,"Name");?></div>
                    <div><?php echo $form->field($model,"Brand");?></div>
                    <div><?php echo $form->field($model,"UWeight");?></div>
                    <div><?php echo $form->selectfield($model,"Unit",['0'=>'Kg','1'=>'g','2'=>'liter']);?></div>
                    <div><?php echo $form->field($model,"MRP");?></div>
                    <div><?php echo $form->field($model,"MaxCount");?></div>
                </div>
                <div class="delivey-view-profile-pic">
                    <div><label>Profile Picture:</label><img class="image-preview" src='/img/placeholder-150.png'><?php echo $form->inputfile($model,"ItemImage",['image-input'],"image/jpeg,image/png");?></div>
                </div>
                <div class="submit-cancel"><button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <?php \app\core\form\Form::end()?>

        </div>
    </div>
</div>