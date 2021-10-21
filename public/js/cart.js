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
        let URLShop = URLShopAPI.concat('?ShopID=').concat(CartItem.ShopID);
        const URLItem = URLFindItemAPI.concat("?ItemID=").concat(CartItem.ItemID);
        const URLShopItem = URLShopItemAPI.concat("?ItemID=").concat(CartItem.ItemID).concat('&ShopID=').concat(CartItem.ShopID);
        if ($('#Shop'.concat(CartItem.ShopID)).length === 0) { //store already exists
            let container = document.getElementById('container-item');

            let Item = document.createElement('div');
            Item.classList.add('shop-items');
            Item.id = 'Shop'.concat(CartItem.ShopID);

            $.getJSON(URLShop, function (shop) {
                $.getJSON(URLItem, function (item) {
                    $.getJSON(URLShopItem, function (shopitem) {

                        Item.innerHTML = `
                        <div class="shop-name"><i class="fas fa-store"></i>${shop.ShopName}</div>
                        <div class="cart-items Shop${shop.ShopID}" id="shopitem${shop.ShopID}">
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
            
            `
                    });
                });
            });
            container.appendChild(Item);

        } else {

            let Item2 = document.createElement("div");
            Item2.classList.add('item');

            $.getJSON(URLItem, function (item) {
                $.getJSON(URLShopItem, function (shopitem) {
                    Item2.innerHTML =  `
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

                });


            });
            let container = document.getElementById('container-item');
            console.log(container);
            console.dir(container);

            let all = container.getElementsByTagName("*");
            console.log(all);
            console.dir(all);

            let some = container.getElementsByClassName('Shop'.concat(CartItem.ShopID));
            console.dir(some);

            let result;
            for (let i = 0, len = all.length; i < len; i++) {
                // console.log(all[i]);
                if (all[i].id === 'shopitem'.concat(5)) {
                    result = all[i];
                    console.log(result);
                    console.log("inside");
                    break;
                }
            }
            console.log(result);
            console.log("outside");
            console.log(Item2);
            result.appendChild(Item2);

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





