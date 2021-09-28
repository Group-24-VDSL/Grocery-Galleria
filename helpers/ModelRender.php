<?php

namespace app\helpers;

use app\models\Item;

class ModelRender
{
    public static function staffviewitems(Item $item)
    {

        return sprintf('<tr>
                                    <td class="text-left">%s</td>
                                    <td class="text-center"> <img src="%s" alt="%s" class="img-thumbnail"> </td>
                                    <td class="text-left">%s</td>
                                    <td class="text-left">%s</td>
                                    <td class="text-left">%s</td>
                                    <td class="text-right"><span>RS.%s</span></td>
                                    <td class="text-left">%s</td>
                                    <td class="action-button">
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-yellow" data-original-title="Edit"><i class="far fa-eye"></i></a>
                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-red" data-original-title="Edit"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>',
        $item->ItemID,
        $item->ItemImage,
        $item->Name,
        $item->Name,
            ($item->Brand==='')?'None':$item->Brand,
            ($item->Category===0)?(($item->Unit === 1) ? 'Vegetable' : (($item->Unit === 2) ? 'Meat' : 'Fruit')):'Grocery',
        $item->MRP,
            sprintf('%.2f%s',$item->UWeight,($item->Unit===0)?'Kg':(($item->Unit === 1)?'g':'liter'))
        );
    }

}