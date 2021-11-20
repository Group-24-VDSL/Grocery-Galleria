// const UnitTag = ["Kg", "g", "L", "ml", "Unit"];

const host = window.location.origin; //http://domainname

const URLShopAPI = host + "/api/shop";
const URLShopItemAPI = host + "/api/shopitem";
const URLFindItemAPI = host + "/api/item";

const URLAddtoCartAPI = host + "/api/addtocart";
const URLGetCartAPI = host + "/api/getcart";


const URLGetCart = URLGetCartAPI.concat('?CustomerID=').concat('2');


$.getJSON(URLGetCart, function (CartItems) {
    CartItems.items.sort((a, b) => parseFloat(a.ShopID) - parseFloat(b.ShopID));
    const containerItem = document.getElementById('container-item');


    $('#itemCount').text(CartItems.items.length);
    $('#subTotal').text(CartItems.total.toFixed(2));

    let shopcount = [...new Set(CartItems.items.map(item => item.ShopID))].length;
    $('#ShopCount').text(shopcount);

    let $baseDeli = 120;

    for (let i = 1; i < 5 && i < shopcount; i++) {
        $baseDeli += 30;
    }

    $('#DeliveryFee').text($baseDeli.toFixed(2));
    $('#GTotal').text(($baseDeli + CartItems.total).toFixed(2));

    CartItems.items.forEach(CartItem => {
        let URLShop = URLShopAPI.concat('?ShopID=').concat(CartItem.ShopID);
        const URLItem = URLFindItemAPI.concat("?ItemID=").concat(CartItem.ItemID);
        const URLShopItem = URLShopItemAPI.concat("?ItemID=").concat(CartItem.ItemID).concat('&ShopID=').concat(CartItem.ShopID);
        //Creating Shops if not available
        if ($('#Shop'.concat(CartItem.ShopID)).length === 0) {
            let Shop = document.createElement('div');
            let ShopName = document.createElement('div');
            let cartItems = document.createElement('div');
            Shop.classList.add('shop-items');
            Shop.id = 'Shop'.concat(CartItem.ShopID);
            ShopName.classList.add('shop-name');
            $.getJSON(URLShop, function (shop) {
                ShopName.innerHTML = `<i class="fas fa-store"></i>${shop.ShopName}`
            });
            cartItems.classList.add('cart-items');
            cartItems.id = 'CartItemsOfShop'.concat(CartItem.ShopID);
            Shop.appendChild(ShopName);
            Shop.appendChild(cartItems);
            containerItem.appendChild(Shop);
        }
        //Creating items based on Shopping Cart
        let Item = document.createElement('div');
        Item.classList.add('item');
            $.getJSON(URLItem, function (item) {
                $.getJSON(URLShopItem, function (shopitem) {
                    Item.innerHTML = `
                        <div class="item-img"><img src="${item.ItemImage}" alt="${item.Name}">${item.Name}</div>
                        <div class="UWeight">${item.UWeight}</div>
                        <div class="price">${shopitem.UnitPrice.toFixed(2)}</div>
                        <div class="quantity">
                            <button class="quantity-step" onclick="update(${shopitem.ShopID},${shopitem.ItemID},-${item.UWeight},${shopitem.UnitPrice},${item.MaxCount})"><i class="fas fa-minus-square" ></i></button>
                            <input type="number" id="quantity${shopitem.ShopID}${shopitem.ItemID}"  name="quantity" min="${item.UWeight}" max="${item.UWeight * item.MaxCount}" step="${item.UWeight}" value="${item.UWeight * CartItem.Quantity}" readonly>
                            <button class="quantity-step" onclick="update(${shopitem.ShopID},${shopitem.ItemID},${item.UWeight},${shopitem.UnitPrice},${item.MaxCount})"><i class="fas fa-plus-square" ></i></button>
                        </div>
                        <div class="total" id="total${shopitem.ShopID}${shopitem.ItemID}">${(shopitem.UnitPrice * CartItem.Quantity).toFixed(2)}</div>
                        <div class="update-button">
                            <button  class="update btn btn-primary" id="update${shopitem.ShopID}${shopitem.ItemID}" data-id="${shopitem.ShopID}${shopitem.ItemID}" type="button" onclick="updatebutton(${shopitem.ShopID},${shopitem.ItemID})">Update</button>
                        </div>
                        <div class="remove-button">
                            <button class="remove btn btn-red" type="button" id="remove${shopitem.ShopID}${shopitem.ItemID}" data-id="${shopitem.ShopID}${shopitem.ItemID}" data-itemid="${item.ItemID}" data-shopid="${shopitem.ShopID}">Remove</button>
                        </div>
            `
                });
            });
        //Add items to the relevant targeted shop
        const shopItemDiv = document.getElementById('CartItemsOfShop'.concat(CartItem.ShopID));
        shopItemDiv.appendChild(Item);
        });

});


function updatebutton(ShopID,ItemID) {
    let quantity = $('#quantity'.concat(ShopID).concat(ItemID)).val();
    let uweight = $('#quantity'.concat(ShopID).concat(ItemID)).attr('step')

    let passingvalue = Math.trunc(quantity / uweight);
    let obj = {"ItemID": ItemID, "ShopID": ShopID, "Quantity": passingvalue, "CustomerID": 2}; //keys and values should be enclosed in double quotes

    $.post(URLAddtoCartAPI, JSON.stringify(obj));

}

function update(ShopID,ItemID,UWeight,UnitPrice,MaxCount) {
    let quantity = $('#quantity'.concat(ShopID).concat(ItemID)).val()/Math.abs(UWeight);
    if(quantity < MaxCount + 1  && 1 < quantity ){
        let quantitysec = $('#quantity'.concat(ShopID).concat(ItemID)).val();
        $('#quantity'.concat(ShopID).concat(ItemID)).val(parseInt(quantitysec) + parseInt(UWeight));
        $('#total'.concat(ShopID).concat(ItemID)).text((quantity * UnitPrice).toFixed(2));
    }
}














