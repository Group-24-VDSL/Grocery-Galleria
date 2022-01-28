<?php


namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\Delivery;
use app\models\Item;
use app\models\OrderCart;
use app\models\Orders;
use app\models\Rider;
use app\models\Shop;
use app\models\ShopItem;
use app\models\ShopOrder;
use app\models\TemporaryCart;
use app\models\User;

class APIController extends Controller
{
    // Item section
    public function getItem(Request $request,Response $response) // get item details from DB
    {
        $response->setContentTypeJSON();
        $item=Item::findOne(array_slice($request->getBody(),1,null,true));
        return json_encode($item->jsonSerialize());
    }
    public function getItemAll(Request $request,Response $response) // get all items from DB
    {
        $response->setContentTypeJSON();
        $items =Item::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($items);
    }


    public function getShopItem(Request $request, Response $response) // get all shop items from DB
    {
        $response->setContentTypeJSON();
        $shopItem=ShopItem::findOne(array_slice($request->getBody(),1,null,true));
        return json_encode($shopItem);
    }

    public function getShopItems(Request $request, Response $response) // get all shop items from DB
    {
        $response->setContentTypeJSON();
        $shopItem=ShopItem::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($shopItem);
    }


    // Shop section
    public function getShop(Request $request, Response $response) // get shop details from DB
    {
        $response->setContentTypeJSON();
        $shop = Shop::findOne(array_slice($request->getBody(),1,null,true));
        return json_encode($shop);
    }


    public function getAllShop(Request $request,Response $response)
    {
        $response->setContentTypeJSON();
        $shops = Shop::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($shops);

    }

    //cart

    public function getOrderCart(Request $request , Response $response)
    {
        $response->setContentTypeJSON();
        $carts = OrderCart::findAll(array_slice($request->getBody(),1,null,true));
        return json_encode($carts);
    }

    public function getShopOrders(Request $request , Response $response)
    {
        $response->setContentTypeJSON();
        $orders = ShopOrder::findAll(array_slice($request->getBody(),1,null,true));

        return json_encode($orders);
    }

    public function getShopOrder(Request $request , Response $response)
    {
        $response->setContentTypeJSON();
        $order = ShopOrder::findOne(array_slice($request->getBody(),1,null,true));

        return json_encode($order);
    }

    public function getDelivery(Request $request , Response $response)
    {
        $response->setContentTypeJSON();
        $orders = Delivery::findOne(array_slice($request->getBody(),1,null,true));

        return json_encode($orders);
    }

    public function getCart(Request $request,Response $response) // get all items from DB
    {
        $response->setContentTypeJSON();
        $items =TemporaryCart::findAll(array_slice($request->getBody(),1,null,true));

        return json_encode($items);

    }

    public function getCustomer(Request $request,Response $response) // get all items from DB
    {
        $response->setContentTypeJSON();
        $customer =Customer::findOne(array_slice($request->getBody(),1,null,true));
        return json_encode($customer);

    }


    public function getUser(Request $request, Response $response)
    {
        $response->setContentTypeJSON();
        $orders = User::findOne(array_slice($request->getBody(),1,null,true));

        return json_encode($orders);
    }


    public function getOrder(Request $request, Response $response) // get all orders from DB
    {
        $response->setContentTypeJSON();
        $order = Orders::findOne(array_slice($request->getBody(),1,null,true));

        return json_encode($order);
    }

    public function getOrders(Request $request, Response $response) // get all orders from DB
    {
        $response->setContentTypeJSON();
        $orders = Orders::findAll(array_slice($request->getBody(),1,null,true));

        return json_encode($orders);
    }
    public function getRider(Request $request,Response $response)
    {
        $response->setContentTypeJSON();
        $riders = Rider::findOne(array_slice($request->getBody(),1,null,true));

        return json_encode($riders);

    }
    public function getRiders(Request $request,Response $response)
    {
        $response->setContentTypeJSON();
        $riders = Rider::findAll(array_slice($request->getBody(),1,null,true));

        return json_encode($riders);

    }

}