<?php

namespace app\helpers;

use app\models\Item;
use app\models\Complaint;
use app\models\ShopItem;

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

    public static function shopviewitems(ShopItem $item)
    {

        return sprintf('<tr>
                                    <td class="text-left">%s</td>
                                    <td class="text-center"> <img src="%s" alt="%s" class="img-thumbnail"> </td>
                                    <td class="text-left">%s</td>
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

    public static function staffviewcomplaints(Complaint $com)
    {
        return sprintf('
                            <tr>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>
                                  <button class="btn-description" type="submit" id="desc-button"><span class="" ><i class="bx bx-show-alt"></i></span></button> 
                                  <div id="" class="description">
                                    <div class="description-content">
                                    <div class="close-bar">
                                        <span class="complaint-id">Complaint ID: %s</span>
                                        <span class="close"> &times; </span>
                                    </div>
                                    <div class="description-header">
                                      <h5>Nature of the Complaint</h5>
                                    </div>
                                    <div class="description-body">
                                      <span class="desc-text">%s</span>
                                    </div>
                                      <div class="description-header">
                                        <h5>Specific details of the complaint</h5>
                                      </div>
                                      <div class="description-body">
                                        <span>%s</span>
                                      </div>
                                    </div>
                                </div>                
                                </td>
                            </tr>',

        $com->ComplaintID  ,
        $com->ComplaintDate , 
        $com->OrderID ,
        $com->OrderDate ,
            ($com->Regarding === 0)?'Shop': 'Delivery',
            ($com->Priority === 0)?'High': 'Low',
            ($com->Status === 0)?'New': 'Attended',
        $com->ComplaintID  ,
        $com->Nature  ,
        $com->SpecialDetails  ,
          );
    }

}