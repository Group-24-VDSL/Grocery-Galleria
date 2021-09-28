
<?php
/** @var $model \app\models\Rider **/
?>
<div class="container-fluid">

    <div class= "row row-shop-dashboard">
        <div class="panel-row">
            <div class="default-panel">
                <div class="panel-heading">
              <span class="panel-title"> <i class="fas fa-list">
                  &nbsp Shop Items
              </span>
                </div>
                <div class="item-table">
                    <form action="#" method="post" enctype="multipart/form-data" id="form-product">
                        <div class="table-responsive">
                            <table id="item" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" checked="checked"></td>
                                    <td class="table-heading"> Item ID </td>
                                    <td class="table-heading"> Image </td>
                                    <td class="table-heading"> Product Name </td>
                                    <td class="table-heading"> Category</td>
                                    <td class="table-heading"> Unit Price</td>
                                    <td class="table-heading"> Unit Weight </td>
                                    <td class="table-heading"> Available Quantity </td>
                                    <td class="table-heading"> Status </td>
                                    <td class="table-heading"> Actions </td>

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

                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="10">
                                    </td>
                                    <td class="text-left">Veg010</td>
                                    <td class="text-center"> <img src="https://essstr.blob.core.windows.net/essimg/350x/Small/Pic915005.jpg" alt="carrot" class="img-thumbnail"> </td>
                                    <td class="text-left">Cabbage</td>
                                    <td class="text-left">Up-Country</td>
                                    <td class="text-right"> <span>RS.60.00</span>
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
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="1">
                                    </td>
                                    <td class="text-left">Veg001</td>
                                    <td class="text-center"> <img src="https://essstr.blob.core.windows.net/essimg/350x/Small/Pic915007.jpg" alt="carrot" class="img-thumbnail"> </td>
                                    <td class="text-left">Carrot</td>
                                    <td class="text-left">Up-Country</td>
                                    <td class="text-right"> <span>RS.30.00</span>
                                    </td>
                                    <td class="text-left">100 g</td>
                                    <td class="text-right"> <span class="label label-success">10 Kg</span> </td>
                                    <td class="text-left">Enabled</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>