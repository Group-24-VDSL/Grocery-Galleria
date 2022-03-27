<?php
/** @var $model \app\models\Item **/
/** @var $form app\core\form\Form */
?>
<div class="core">
    <h1 class="heading">System <span>Products</span></h1>
    <div class="container-core">
        <ul id="tab=btns" class="tabs">
            <li>
                <button data-href="?Category=0" id="veg-tab-items" class="btn-tab">Vegetables</button>
            </li>
            <li>
                <button data-href="?Category=1" id="fru-tab-items" class="btn-tab">Fruits</button>
            </li>
            <li>
                <button data-href="?Category=2" id="gro-tab-items" class="btn-tab">Grocery</button>
            </li>
            <li>
                <button data-href="?Category=3" id="fish-tab-items" class="btn-tab">Fish</button>
            </li>
            <li>
                <button data-href="?Category=4" id="meat-tab-items" class="btn-tab">Meat</button>
            </li>
        </ul>
        <div class="table-header">
            <ul>
                <li>Image</li>
                <li>Name</li>
                <li>Brand</li>
                <li>Unit</li>
                <li>UnitWeight</li>
                <li>ItemPrice</li>
                <li>MaxCount</li>
                <li>Status</li>
                <li>Update</li>
            </ul>
        </div>
        <div id="item-table" class="table-details scroller"></div>
    </div>
</div>


<div class="core" id="Update">
    <h1 class="heading">Update <span>Products</span></h1>
    <div class="container-core">
        <div class="form-details register">
            <?php $form = \app\core\form\Form::begin("", "post", "", [], "multipart/form-data",); ?>
            <input type="text" id="ItemID" name="ItemID" hidden>
            <div class="inputBox">
                <label for="category">
                    <i class="fas fa-list"></i>
                    <?php echo $model->labels()['Category'] ?>
                </label>
                <?php echo $form->selectfieldonly($model, "Category", ['0' => 'Vegetables', '1' => 'Fruits', '2' => 'Grocery', '3' => 'Fish', '4' => 'Meat']); ?>
            </div>
            <div class="inputBox">
                <label for="Name">
                    <i class="fas fa-edit"></i>
                    <?php echo $model->labels()['Name'] ?>
                </label>
                <?php echo $form->fieldonly($model, "Name"); ?>
            </div>
            <div class="inputBox">
                <label for="ImgStr">
                    <i class="far fa-images"></i>
                    Current Image
                </label>
                <img id="ImgDis" class="imageBox" src="" alt="">
                <input type="text" id="ImgStr" name="ImgStr" hidden>
            </div>

            <div class="inputBox">
                <label for="Brand">
                    <i class="fas fa-edit"></i>
                    <?php echo $model->labels()['Brand'] ?>
                </label>
                <?php echo $form->fieldonly($model, "Brand"); ?>
            </div>

            <div class="inputBox">
                <label for="Unit">
                    <i class="fas fa-balance-scale"></i>
                    <?php echo $model->labels()['Unit'] ?>
                </label
                >
                <?php echo $form->selectfieldonly($model, "Unit", ['0' => 'Kg', '1' => 'Litre', '2' => 'Unit']); ?>
            </div>
            <div class="inputBox">
                <label for="ItemImage">
                    <i class="far fa-images"></i>
                    New <?php echo $model->labels()['ItemImage'] ?>
                </label>
                <?php echo $form->inputfile($model, "ItemImage") ?>
            </div>
            <div class="inputBox">
                <label for="UWeight">
                    <i class="fas fa-weight-hanging"></i>
                    <?php echo $model->labels()['UWeight'] ?>
                </label>
                <?php echo $form->numberfieldonly($model, "UWeight", 0.1, 10000, 0.01); ?>
            </div>

            <div class="inputBox">
                <label for="MaxCount">
                    <i class="fas fa-weight-hanging"></i>
                    <?php echo $model->labels()['MaxCount'] ?>
                </label
                >
                <?php echo $form->numberfieldonly($model, "MaxCount", 1, 100, 1); ?>
            </div>
            <div class="inputBox">
                <label for="MRP">
                    <i class="fas fa-coins"></i>
                    <?php echo $model->labels()['MRP'] ?>
                </label>
                <?php echo $form->numberfieldonly($model, "MRP", 1, 10000, 0.01); ?>
            </div>
            <div class="inputBox">
                <label>
                    <i class="fas fa-cog"></i>
                    <?php echo $model->labels()['Status'] ?>
                </label>
                <label for="Status" class="switch-staff">
                    <input type="checkbox" id="Status" name="Status" value="1" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="inputBox"></div>
            <div class="inputBox btn-div">
                <button type="submit" class="btn update">Update</button>
            </div>
            <?php \app\core\form\Form::end() ?>
        </div>
    </div>
</div>

<div class="core" id="productAnalytics">
    <h1 class="heading">Product <span>Report</span></h1>
    <div class="headings">
        <h1 class="heading chart-heading">Month <span>Analysis</span></h1>
        <h1 class="heading chart-heading">Week <span>Analysis</span></h1>
        <div></div>
        <div>
            <label id="SalesDateLabel" for="SalesDate">Select date:</label>
            <input type="date" id="SalesDate" name="SalesDate" min="2020-01-01" value="">

        </div>
    </div>
    <input id="storeItemID" type="hidden" value="">
    <div>
        <p class="sub-heading" id="item-data"></p>
    </div>
    <div class="chart-div-core">
        <div id="chartDiv1" class="chart-div">
            <div class="chart">
                <canvas id="myChart1"></canvas>
            </div>
        </div>
        <div id="chartDiv2" class="chart-div">
            <div class="chart">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>

</div>
<script src="/js/product-search.js" ></script>
<script src="/js/staff.js"></script>

