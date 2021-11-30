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
            <?php $form = \app\core\form\Form::begin("","post","",[],"multipart/form-data");?>
                <div class="display-grid delivery-view">
                    <div class="delivery-view-details">
                        <div><?php echo $form->field($model,"Name");?></div>
                        <div><?php echo $form->field($model,"Address");?></div>
                        <div><?php echo $form->field($model,"Email")->emailField();?></div>
                        <div><?php echo $form->field($model,"ContactNo")?></div>
                        <div><?php echo $form->field($model,"NIC");?></div>
                        <div><?php echo  $form->selectfield($model,"RiderType",['0'=>'Bike','1'=>'Threewheel']);?></div>
                    </div>
                    <div class="delivey-view-profile-pic">
                        <div><label>Profile Picture:</label><img class="image-preview" src='/img/placeholder-150.png'><?php echo $form->inputfile($model,"ProfilePic",['image-input'],"image/jpeg,image/png");?></div>
                    </div>
                    <div class="submit-cancel"><button type="submit" type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            <?php \app\core\form\Form::end()?>
        </div>
    </div>
</div>