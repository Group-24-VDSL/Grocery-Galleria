
<?php
/** @var $model \app\models\Rider **/
/** @var $form \core\form\Form */
?>
<div class="main-content">
    <nav>
        <h1 class="main-header">Dashboard</h1>
    </nav>
    <div class="">
        <h3>Add Rider</h3>
        <div class="frm">
            <?php $form = \app\core\form\Form::begin("","post");?>
            <div class="display-grid delivery-view">
                <div class="delivery-view-details">
                    ItemID 	 	 	 	UWeight
                    <div><?php echo $form->field($model,"Name");?></div>
                    <div><?php echo $form->field($model,"ItemImage");?></div>
                    <div><?php echo $form->field($model,"Brand");?></div>
                    <div><?php echo $form->field($model,"UWeight");?></div>
                    <div><?php echo $form->selectfield($model,"Unit",['kg'=>'Kg','g'=>'g','l'=>'liter'])?></div>
                    <div><?php echo $form->field($model,"MRP");?></div>

                </div   >
                <div class="delivey-view-profile-pic">
                    <div><label>Profile Picture:</label><img src='/img/placeholder-150.png'><input type=text name="" value="image.png" style="" class=""></div>
                </div>
                <div class="submit-cancel"><button type="button" type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <?php \app\core\form\Form::end()?>

        </div>
    </div>
</div>