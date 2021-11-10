<?php
/** @var $model \app\models\Item **/
/** @var $form app\core\form\Form */
?>
<div class="core">
    <h1 class="heading">System <span>Products</span></h1>
    <div class="container-core">
        <ul id="tab=btns" class="tabs">
            <li><button data-href="?Category=0" id="btn-vege" class="btn-tab">Vegetables</button></li>
            <li><button data-href="?Category=1" class="btn-tab">Fruits</button></li>
            <li><button data-href="?Category=2" class="btn-tab">Grocery</button></li>
            <li><button data-href="?Category=3" class="btn-tab">Fish</button></li>
            <li><button data-href="?Category=4" class="btn-tab">Meat</button></li>
        </ul>
        <div class="table-header">
            <ul>
                <li>Photo</li>
                <li>Name</li>
                <li>Brand</li>
                <li>Unit</li>
                <li>UnitWeight</li>
                <li>MRP</li>
                <li>MaxCount</li>
                <li>Update</li>
            </ul>
        </div>
        <div id="item-table" class="table-details scroller">
<!--            <ul class="row">-->
<!--                <li id="ItemImage" class="row-img">-->
<!--                    <img src="/views/shop/img/Pic915013.jpg" alt="" />-->
<!--                </li>-->
<!--                <li id="Name" class="row-name">Potato</li>-->
<!--                <li id="Brand" class="row-brand">Null</li>-->
<!--                <li id="Unit" class="row-unit">Kg</li>-->
<!--                <li id="UWeight" class="row-minWeight">300</li>-->
<!--                <li id="MRP" class="row-mrp">67</li>-->
<!--                <li id="MaxCount" class="row-IncStep">7</li>-->
<!--                <li class="row-ubutton">-->
<!--                    <a  class="btn-row" type="submit">Update</a>-->
<!--                </li>-->
<!--            </ul>-->
        </div>
    </div>
</div>


<div class="core" id="Update">
    <h1 class="heading">Update <span>Products</span></h1>
    <div class="container-core">
        <div class="form-details register">
            <?php $form = \app\core\form\Form::begin("","post","itemUpdate",[],"multipart/form-data",);?>
            <input id="ItemID" name="ItemID" value="" hidden>
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
                <?php echo $form->fieldonly($model,"Name");?>
            </div>
            <div class="inputBox">
                <label for="ItemImage">
                    <i class="far fa-images"></i>
                    Current Image
                </label>
                <div>

                <img id="ImgDis" class="imageBox" src="">
                </div>
<!--                --><?php //echo $form->inputfile($model,"ItemImage")?>
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
                <label for="ItemImage">
                    <i class="far fa-images"></i>
                    New <?php echo $model->labels()['ItemImage']?>
                </label>
                <?php echo $form->inputfile($model,"ItemImage")?>
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
                </label>
                <?php echo $form->numberfieldonly($model,"MRP",1,10000,1);?>
            </div>
            <!--                <div class="inputBox"></div>-->
            <div class="inputBox div-button">
                <button type="submit" class="btn">Submit</button>
            </div>
            <?php \app\core\form\Form::end()?>
        </div>
    </div>
</div>

