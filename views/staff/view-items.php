<?php
/** @var $item \app\models\Item **/
/** @var $itemslist array */
?>

<div class="container-fluid">
    <div class= "row row-shop-dashboard">
        <div class="panel-row">
            <div class="default-panel">
                <div class="panel-heading">
                    <span class="panel-title"> <i class="fas fa-list"></i>
                      Shop Items
              </span>
                </div>
                <div class="item-table">
                    <form action="#" method="post" enctype="multipart/form-data" id="form-product">
                        <div class="table-responsive">
                            <table id="item" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td class="table-heading"> Item ID </td>
                                    <td class="table-heading"> Image </td>
                                    <td class="table-heading"> Product Name </td>
                                    <td class="table-heading"> Brand</td>
                                    <td class="table-heading"> Category</td>
                                    <td class="table-heading"> MRP</td>
                                    <td class="table-heading"> Unit Weight </td>
                                    <td class="table-heading"> Actions </td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach( $itemslist as $item ){
                                        echo app\helpers\ModelRender::staffviewitems($item);
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>