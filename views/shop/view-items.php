<?php
/** @var $model \app\models\ShopItem **/
/** @var $form app\core\form\Form */
?>

<link rel="stylesheet" href="/css/shop-items.css">
<script src="/js/shop-ongoing-items.js" defer></script>
<link rel="stylesheet" href="/css/dashboardStyle.css">
<link rel="stylesheet" href="/css/dashboardStyleStaff.css">

<div class="core" style="height: height: 580px">
    <h1 class="heading">Ongoing <span>Products</span></h1>
    <div class="container-items">
        <div class="safety-details">
            <img src="https://img.icons8.com/emoji/16/26e07f/check-mark-button-emoji.png"/>
            <span>: Stock is Safe </span>
            <br>
            <img src="https://img.icons8.com/office/16/000000/high-risk.png"/>
            <span>: Stock is not Safe </span>
        </div>

        <table class="table-item small-first-col">
            <thead>
            <tr>
                <th></th>
                <th>Item ID</th>
                <th>Item Image</th>
                <th>Item Name</th>
                <th>Brand</th>
<!--                <th>Unit</th>-->
                <th>Unit Weight</th>
                <th>MRP</th>
                <th>Unit Price</th>
                <th>Stock</th>
                <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="44">
                                    </td>
                                    <td class="text-left">Veg044</td>
                                    <td class="text-center"> <img src="https://essstr.blob.core.windows.net/essimg/350x/Small/Pic914006.jpg" alt="carrot" class="img-thumbnail"> </td>
                                    <td class="text-left">Big Onion</td>
                                    <td class="text-left">Onion</td>
                                    <td class="text-right"> <span>RS.50.00</span>
                                    </td>
                                    <td class="text-left">100 g</td>
                                    <td class="text-right"> <span class="label label-success">50 Kg</span> </td>
                                    <td class="text-left">Enabled</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="110" checked="checked">
                                    </td>
                                    <td class="text-left">Veg110</td>
                                    <td class="text-center"> <img src="https://essstr.blob.core.windows.net/essimg/350x/Small/Pic914039.jpg" alt="carrot" class="img-thumbnail"> </td>
                                    <td class="text-left">Pumpkin</td>
                                    <td class="text-left">Low-Country</td>
                                    <td class="text-right"> <span>RS.50.00</span>
                                    </td>
                                    <td class="text-left">100 g</td>
                                    <td class="text-right"> <span class="label label-success">0</span> </td>
                                    <td class="text-left">Not Enable</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="2">
                                    </td>
                                    <td class="text-left">Veg002</td>
                                    <td class="text-center"> <img src="https://essstr.blob.core.windows.net/essimg/350x/Small/Pic915013.jpg" alt="carrot" class="img-thumbnail"> </td>
                                    <td class="text-left">Potato</td>
                                    <td class="text-left">Up-Country</td>
                                    <td class="text-right"> <span>RS.100.00</span>
                                    </td>
                                    <td class="text-left">100 g</td>
                                    <td class="text-right"> <span class="label label-success">100 Kg</span> </td>
                                    <td class="text-left">Enabled</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>

            </tbody>
            <?php \app\core\form\Form::end(); ?>
        </table>

        <button type="submit" id="updateItems" class="button-item-update" onclick="updateShopItem()"><span id="status">Update Items</span></button>

    </div>
</div>
