<?php
/** @var $model \app\models\Item **/
/** @var $form app\core\form\Form */
?>
<div class="core">
    <h1 class="heading">System <span>Products</span></h1>
    <div class="container-core">
        <ul class="tabs">
            <li><button class="btn-tab">Vegetables</button></li>
            <li><button class="btn-tab">Fruits</button></li>
            <li><button class="btn-tab">Grocery</button></li>
            <li><button class="btn-tab">Fish</button></li>
            <li><button class="btn-tab">Meat</button></li>
        </ul>
        <div class="table-header">
            <ul>
                <li>Photo</li>
                <li>Name</li>
                <li>Brand</li>
                <li>Unit</li>
                <li>MRP</li>
                <li>UnitWeight</li>
                <li>MaxCount</li>
                <li>Update</li>
            </ul>
        </div>
        <div class="table-details scroller">
            <ul class="column">
                <li class="column-img">
                    <img src="/views/shop/img/Pic915013.jpg" alt="" />
                </li>
                <li class="column-name">Potato</li>
                <li class="column-brand">Null</li>
                <li class="column-unit">Kg</li>
                <li class="column-mrp"><input type="text" /></li>
                <li class="column-minWeight">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="minWeight"
                        name="minWeight"
                    />
                </li>
                <li class="column-IncStep">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="IncStep"
                        name="IncStep"
                    />
                </li>
                 
                <li class="column-ubutton">
                    <button class="btn-column" type="submit">Update</button>
                </li>
            </ul>
            <ul class="column">
                <li class="column-img">
                    <img src="/views/shop/img/Pic914005.jpg" alt="" />
                </li>
                <li class="column-name">Big Onion</li>
                <li class="column-brand">Null</li>
                <li class="column-unit">Kg</li>
                <li class="column-mrp"><input type="text" /></li>
                <li class="column-minWeight">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="minWeight"
                        name="minWeight"
                    />
                </li>
                <li class="column-IncStep">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="IncStep"
                        name="IncStep"
                    />
                </li>
                 
                <li class="column-ubutton">
                    <button class="btn-column" type="submit">Update</button>
                </li>
            </ul>
            <ul class="column">
                <li class="column-img">
                    <img src="/views/shop/img/Pic914015.jpg" alt="" />
                </li>
                <li class="column-name">Garlic</li>
                <li class="column-brand">Null</li>
                <li class="column-unit">Kg</li>
                <li class="column-mrp"><input type="text" /></li>
                <li class="column-minWeight">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="minWeight"
                        name="minWeight"
                    />
                </li>
                <li class="column-IncStep">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="IncStep"
                        name="IncStep"
                    />
                </li>
                 
                <li class="column-ubutton">
                    <button class="btn-column" type="submit">Update</button>
                </li>
            </ul>
            <ul class="column">
                <li class="column-img">
                    <img src="/views/shop/img/Pic915016.jpg" alt="" />
                </li>
                <li class="column-name">Tomatoe</li>
                <li class="column-brand">Null</li>
                <li class="column-unit">Kg</li>
                <li class="column-mrp"><input type="text" /></li>
                <li class="column-minWeight">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="minWeight"
                        name="minWeight"
                    />
                </li>
                <li class="column-IncStep">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="IncStep"
                        name="IncStep"
                    />
                </li>
                 
                <li class="column-ubutton">
                    <button class="btn-column" type="submit">Update</button>
                </li>
            </ul>
            <ul class="column">
                <li class="column-img">
                    <img src="/views/shop/img/Pic915008.jpg" alt="" />
                </li>
                <li class="column-name">Tomatoe</li>
                <li class="column-brand">Null</li>
                <li class="column-unit">Kg</li>
                <li class="column-mrp">
                    <input type="text" />
                </li>
                <li class="column-minWeight">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="minWeight"
                        name="minWeight"
                    />
                </li>
                <li class="column-IncStep">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="IncStep"
                        name="IncStep"
                    />
                </li>
                 
                <li class="column-ubutton">
                    <button class="btn-column" type="submit">Update</button>
                </li>
            </ul>
            <ul class="column">
                <li class="column-img">
                    <img src="/views/shop/img/Pic914039.jpg" alt="" />
                </li>
                <li class="column-name">Pumpkin</li>
                <li class="column-brand">Null</li>
                <li class="column-unit">Kg</li>
                <li class="column-mrp"><input type="text" /></li>
                <li class="column-minWeight">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="minWeight"
                        name="minWeight"
                    />
                </li>
                <li class="column-IncStep">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="IncStep"
                        name="IncStep"
                    />
                </li>
                 
                <li class="column-ubutton">
                    <button class="btn-column" type="submit">Update</button>
                </li>
            </ul>
            <ul class="column">
                <li class="column-img">
                    <img src="/views/shop/img/Pic914012.jpg" alt="" />
                </li>
                <li class="column-name">Tomatoe</li>
                <li class="column-brand">Null</li>
                <li class="column-unit">Kg</li>
                <li class="column-mrp"><input type="text" /></li>
                <li class="column-minWeight">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="minWeight"
                        name="minWeight"
                    />
                </li>
                <li class="column-IncStep">
                    <input
                        type="number"
                        min="0.1"
                        max="5"
                        value="0.1"
                        step="0.1"
                        id="IncStep"
                        name="IncStep"
                    />
                </li>
                 
                <li class="column-ubutton">
                    <button class="btn-column" type="submit">Update</button>
                </li>
            </ul>
        </div>
    </div>
</div>
