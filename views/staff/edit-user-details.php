<?php
/** @var $model \app\models\User **/
/** @var $form \core\form\Form */
?>
<div class="main-content">
    <nav>
        <h1 class="main-header">Dashboard</h1>
    </nav>
    <div class="">
        <h3>View Rider</h3>
        <div class="frm">
            <?php $form = \app\core\form\Form::begin("","post");?>
            <div class="display-grid delivery-view">
                <div class="delivery-view-details">
                    <div><?php echo $form->field($model,"Email");?></div>
                    <div><?php echo $form->field($model,"Name");?></div>
                    <div><?php echo $form->field($model,"Role");?></div>
                </div>
                <div class="delivery-view-profile-pic">
                    <div><label>Profile Picture:</label><img src='/img/placeholder-150.png'></div>
                </div>
                <div class="submit-cancel"><button type="button" type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <?php \app\core\form\Form::end()?>
        </div>
    </div>
</div>