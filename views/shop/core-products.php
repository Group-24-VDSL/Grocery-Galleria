<?php
/** @var $model \app\models\ShopItem **/
/** @var $form app\core\form\Form */

use app\models\ShopOrder;

?>

<link rel="stylesheet" href="/css/shop-items.css">
<script src="/js/dashboard-shop.js" defer></script>
<script src="/js/jquery.min.js"></script>
<link rel="stylesheet" href="/css/dashboardStyle.css">
<!--<link rel="stylesheet" href="/css/dashboardStyleStaff.css">-->
<div class="content">
    <div class="update-content">
        <div style="height: 850px" class="core shop-item-table">
            <h1 class="heading">Shop <span>Products</span></h1>
            <div class="container-items">

                <table id="shop-products" class="table-item small-first-col">
                    <thead>
                    <tr>
<!--                        <th></th>-->
<!--                        <th>Item ID</th>-->
                        <th style="font-weight: 550;font-size: 11px;">Image</th>
                        <th style="font-weight: 550;font-size: 11px;">Name</th>
                        <th style="font-weight: 550;font-size: 11px;">Brand</th>
                        <th style="font-weight: 550;font-size: 11px;">System Price(LKR)</th>
                        <th style="font-weight: 550;font-size: 11px;">Unit<br>Price(LKR)</th>
                        <th style="font-weight: 550;font-size: 11px;">Unit<br>Weight</th>
                        <th style="font-weight: 550;font-size: 11px;">Min<br>Stock</th>
                        <th style="font-weight: 550;font-size: 11px;">Stock</th>
                        <th style="font-weight: 550;font-size: 11px;">Unit</th>
                        <th style="font-weight: 550;font-size: 11px;">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <?php $form = \app\core\form\Form::begin("","post",'',[""]); ?>
                    <tbody style="" id="item-table" class="item-table-body body-half-screen">


                    </tbody>
                    <?php \app\core\form\Form::end(); ?>
                </table>

            </div>
        </div>



        <div style="margin-left: 0;height: 850px ;width: 30rem" class="core" id="Update">

            <h1 class="heading">Update <span>Products</span></h1>

            <div style="border: 0" class="container-core ">
                <div style="padding: 0" class="form-details register">
                    <div id = "updateItem">

                    </div>
                    <?php $form = \app\core\form\Form::begin("","post","itemUpdate-shop",[],"multipart/form-data",);?>

                    <input id="ItemID" name="ItemID" value="" hidden>
                    <input id="ShopID" name="ShopID" value="" hidden>
                    <div class="inputBox">
                        <label class="input-text"  for="ID">
                            <i class="fas fa-sort-amount-down"></i>
                            <?php echo $model->labels()['ItemID']?>
                        </label>
                        <span class="fileds" id = "updateID"></span>
                    </div>
                    <div class="inputBox">
                        <label class="input-text"  for="Name">
                            <i class="fas fa-edit"></i>
                            <?php echo $model->labels()['Name']?>
                        </label>
                        <span class="fileds" id = "updateName"> </span>
                    </div>
                    <div class="inputBox">
                        <label class="input-text"  for="Image">
                            <i class="far fa-images"></i>
                            <?php echo $model->labels()['Image']?>
                        </label> <span class="image-box" ><img id="updateImage" ></span></div>


                    <div class="inputBox">
                        <label class="input-text"  for="Uprice">
                            <i class="fas fa-coins"></i>
                            <?php echo $model->labels()['UPrice']?>
                            <span id="uprice" class="lable-unit ">(LKR)</span>
                        </label>
                        <?php

                        echo $form->numberfieldonly($model,"UnitPrice",'','',0.01);?>
                    </div>
                    <div class="inputBox">
                        <label class="input-text"  for="Stock">
                            <i class="fas fa-boxes"></i>
                            <?php echo $model->labels()['Stock']?>
                            <span id="stock" class="lable-unit "></span>
                        </label>
                        <?php echo $form->numberfieldonly($model,"Stock",'1.00','',0.01);?>
                    </div>

                    <div class="inputBox">
                        <label class="input-text"  for="Stock">
                            <i class="fas fa-boxes"></i>
                            <?php echo $model->labels()['MinStock']?>
                            <span id="min-stock" class="lable-unit min-stock"></span>
                        </label>
                        <?php echo $form->numberfieldonly($model,"MinStock",'1','',0.01);?>
                    </div>


                    <div class="inputBox">
                        <label class="input-text"  for="Stock">
                            <i class="fas fa-calendar"></i>
                            <?php echo $model->labels()['MinLead']?>
                            <span class="lable-unit">(days)</span>
                        </label>
                        <?php echo $form->numberfieldonly($model,"MinLeadTime",'0','',0.01);?>
                    </div>

                    <div class="inputBox">
                        <label class="input-text"  for="Stock">
                            <i class="fas fa-calendar"></i>
                            <?php echo $model->labels()['MaxLead']?>
                            <span class="lable-unit">(days)</span>
                        </label>
                        <?php echo $form->numberfieldonly($model,"MaxLeadTime",'0','',1);?>
                    </div>

                    <div class="inputBox">
                        <label class="input-text"  for="Enable">
                            <i class="far fa-flag"></i>
                            <?php echo $model->labels()['Enable']?>
                        </label>

                        <div  id="bit00_3">
                            <label class="switch">
                                <input type="checkbox" id="checkbox1">
                                <div class="slider round">
                                    <span class="on">Enabled&nbsp&nbsp</span>
                                    <span class="off">&nbsp&nbspDisabled</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <?php echo $form->numberfieldonly($model,"Enabled",'','',1)->hiddenField();?>

                    <input id="Enabled" name="Enabled" hidden>

                    <div class="inputBox btn-div">
                        <button type="submit" class="btn update">Update</button>
                    </div>
                    <?php \app\core\form\Form::end()?>
                </div>
            </div>

        </div>
    </div>
</div>
