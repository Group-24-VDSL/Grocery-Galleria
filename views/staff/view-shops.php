<?php
/** @var $model \app\models\User **/
?>
<div class="container-fluid">
    <div class= "row row-shop-dashboard">
        <div class="panel-row">
            <div class="default-panel">
                <div class="panel-heading">
              <span class="panel-title"> <i class="fas fa-list"></i></i>
                  &nbsp Shop Items
              </span>
                </div>
                <div class="item-table">
                    <form action="#" method="post" enctype="multipart/form-data" id="form-product">
                        <div class="table-responsive">
                            <table id="item"class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" checked="checked"></td>
                                    <td class="table-heading"> User ID </td>
                                    <td class="table-heading"> Name </td>
                                    <td class="table-heading"> Role </td>
                                    <td class="table-heading"> Actions </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="44">
                                    </td>
                                    <td class="text-left">3</td>
                                    <td class="text-left">Kamal</td>
                                    <td class="text-left">Shop</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="44">
                                    </td>
                                    <td class="text-left">11</td>
                                    <td class="text-left">Samantha</td>
                                    <td class="text-left">Shop</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="44">
                                    </td>
                                    <td class="text-left">21</td>
                                    <td class="text-left">Nimal</td>
                                    <td class="text-left">Shop</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="44">
                                    </td>
                                    <td class="text-left">1</td>
                                    <td class="text-left">Nimal</td>
                                    <td class="text-left">Shop</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"> <input type="checkbox" name="selected[]" value="44">
                                    </td>
                                    <td class="text-left">12</td>
                                    <td class="text-left">Nimal</td>
                                    <td class="text-left">Shop</td>
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