// get url parameters


const UnitTag = ["Kg", "g", "L", "ml", "Unit"];

const host = window.location.origin; //http://domainname

const URLShopAPI = host + "/api/shop";
const URLShopItemAPI = host + "/api/shopitem";
const URLFindItemAPI = host + "/api/item";

const URLAddtoCartAPI = host + "/api/addtocart";
const URLGetCartAPI = host + "/api/getcart";


const URLGetCart = URLGetCartAPI.concat('?CustomerID=').concat('2');


$.getJSON(URLGetCart, function (CartItems) {
    CartItems.forEach(CartItem => {
        if ($('#Shop'.concat(CartItem.ShopID)).length !== 0) { //store already exisontainer = document.querySelector('#Shop'.concat(CartItem.ShopID)hopinside = container.querySelector('.cart-items'tem = document.createElement('div');
            Item.classList.add('item');
            container = document.querySelector('#Shop'.concat(CartItem.ShopID));
            console.log(container);
            shopinside = container.querySelectorAll('.cart-items');
            console.log(shopinside);
            const URLItem = URLFindItemAPI.concat("?ItemID=").concat(CartItem.ItemID);
            const URLShopItem = URLShopItemAPI.concat("?ItemID=").concat(CartItem.ItemID).concat('&ShopID=').concat(CartItem.ShopID);
            $.getJSON(URLItem, function (item) {
                $.getJSON(URLShopItem, function (shopitem) {
                    Item.innerHTML = `
                        <div class="item-img"><img src="${item.ItemImage}" alt="${item.Name}"></div>
                        <div class="productname">${item.Name}</div>
                        <div class="price">${shopitem.UnitPrice}</div>
                        <div class="quantity">
                            <input class="quantity-input" type="number" id="" name="quantity" min="${item.UWeight}" max="${item.UWeight * item.MaxCount}" step="${item.UWeight}" value="${item.UWeight * CartItem.Quantity}">
                        </div>
                        <div class="total">${shopitem.UnitPrice * CartItem.Quantity}</div>
                        <div>
                            <div class="add-to-cart" data-itemid="${item.ItemID}" data-shopid="${shopitem.ShopID}"><i class="fas fa-sync"></i>Update</div>
                        </div>
                        <div>
                            <div  class="remove-from-cart remove"><i class="fas fa-times"></i>Remove</div>
                        </div>
                    </div>
                    `
                })

            });
            shopinside.appendChild(Item);
        } else {
            container = document.getElementById('container-item');
            Item = document.createElement('div');
            Item.classList.add('shop-items');
            Item.id = 'Shop'.concat(CartItem.ShopID);

            let URLShop = URLShopAPI.concat('?ShopID=').concat(CartItem.ShopID);
            const URLItem = URLFindItemAPI.concat("?ItemID=").concat(CartItem.ItemID);
            const URLShopItem = URLShopItemAPI.concat("?ItemID=").concat(CartItem.ItemID).concat('&ShopID=').concat(CartItem.ShopID);

            $.getJSON(URLShop, function (shop) {
                $.getJSON(URLItem, function (item) {
                    $.getJSON(URLShopItem, function (shopitem) {
                        Item.innerHTML = `
                        <div class="shop-name"><i class="fas fa-store"></i>${shop.ShopName}</div>
                        <div class="cart-items">
                        <div class="item">
                        <div class="item-img"><img src="${item.ItemImage}" alt="${item.Name}"></div>
                        <div class="productname">${item.Name}</div>
                        <div class="price">${shopitem.UnitPrice}</div>
                        <div class="quantity">
                            <input class="quantity-input" type="number" id="" name="quantity" min="${item.UWeight}" max="${item.UWeight * item.MaxCount}" step="${item.UWeight}" value="${item.UWeight * CartItem.Quantity}">
                        </div>
                        <div class="total">${shopitem.UnitPrice*CartItem.Quantity}</div>
                        <div>
                            <div  class="add-to-cart" data-itemid="${item.ItemID}" data-shopid="${shopitem.ShopID}" ><i class="fas fa-sync"></i>Update</div>
                        </div>
                        <div>
                            <div class="remove-from-cart" data-itemid="${item.ItemID}" data-shopid="${shopitem.ShopID}"><i class="fas fa-times"></i>Remove</div>
                        </div>
                    </div>
                </div>
            </div>
            `
                    });
                });
            });
            container.appendChild(Item);
        }

    })

});


$(document).ready(function () {

    $(".add-to-cart").on('click', function () {
        var itemidvalue = $(this).data("itemid");
        var shopidvalue = $(this).data("shopid");

        var value = $(this).parent().siblings(".quantity").find('.quantity-input').val();
        var step = $(this).parent().siblings(".quantity").find('.quantity-input').attr('step');

        var passingvalue = Math.trunc(value / step);

        var obj = {"ItemID": itemidvalue, "ShopID": shopidvalue, "Quantity": passingvalue, "CustomerID": 2}; //keys and values should be enclosed in double quotes

        $.post(URLAddtoCartAPI, JSON.stringify(obj));
    });
});





