// const UnitTag = ["Kg", "g", "L", "ml", "Unit"];

const host = window.location.origin; //http://domainname

const URLShopAPI = host + "/api/shop";
const URLShopItemAPI = host + "/api/shopitem";
const URLFindItemAPI = host + "/api/item";

const URLAddtoCartAPI = host + "/api/addtocart";
const URLDeletefromCartAPI = host + "/api/deletefromcart";
const URLGetCartAPI = host + "/api/getcart";

const URLGetCart = URLGetCartAPI;

const totallabel = $('#GTotal');
const subtotallabel = $('#subTotal');
const numberofshops  = $('#ShopCount');
const itemcount = $('#itemCount');
const delivery = $('#DeliveryFee');

$.getJSON(URLGetCart, function (CartItems) {
    CartItems.items.sort((a, b) => parseFloat(a.ShopID) - parseFloat(b.ShopID));
    const containerItem = document.getElementById('container-item');


    $('#itemCount').text(CartItems.items.length);
    $('#subTotal').text(CartItems.total.toFixed(2));

    let shopcount = [...new Set(CartItems.items.map(item => item.ShopID))].length;
    $('#ShopCount').text(shopcount);

    let baseDeli = calculateDelivery(shopcount);

    $('#DeliveryFee').text(baseDeli.toFixed(2));
    $('#GTotal').text((baseDeli + CartItems.total).toFixed(2));

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
                    Item.id = "item".concat(shopitem.ShopID).concat(shopitem.ItemID);
                    Item.innerHTML = `
                        <div class="item-img"><img src="${item.ItemImage}" alt="${item.Name}">${item.Name}</div>
                        <div class="UWeight">${item.UWeight}</div>
                        <div class="price">${shopitem.UnitPrice.toFixed(2)}</div>
                        <div class="quantity">
                            <button class="quantity-step" onclick="update(${shopitem.ShopID},${shopitem.ItemID},${item.UWeight},${shopitem.UnitPrice},${item.MaxCount},'dec')"><i class="fas fa-minus-square" ></i></button>
                            <input type="number" id="quantity${shopitem.ShopID}${shopitem.ItemID}" data-uprice="${shopitem.UnitPrice}" name="quantity" min="${item.UWeight}" max="${item.UWeight * item.MaxCount}" step="${item.UWeight}" value="${item.UWeight * CartItem.Quantity}" readonly>
                            <button class="quantity-step" onclick="update(${shopitem.ShopID},${shopitem.ItemID},${item.UWeight},${shopitem.UnitPrice},${item.MaxCount},'inc')"><i class="fas fa-plus-square" ></i></button>
                        </div>
                        <div class="total" id="total${shopitem.ShopID}${shopitem.ItemID}">${(shopitem.UnitPrice * CartItem.Quantity).toFixed(2)}</div>
                        <div class="update-button">
                            <button  class="update btn btn-primary" id="update${shopitem.ShopID}${shopitem.ItemID}" data-id="${shopitem.ShopID}${shopitem.ItemID}" type="button" onclick="updatebutton(${shopitem.ShopID},${shopitem.ItemID})">Update</button>
                        </div>
                        <div class="remove-button">
                            <button class="remove btn btn-red" type="button" id="remove${shopitem.ShopID}${shopitem.ItemID}"  onclick="remove(${shopitem.ShopID},${shopitem.ItemID},${shopitem.UnitPrice})" >Remove</button>
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
    let uweight = $('#quantity'.concat(ShopID).concat(ItemID)).attr('step');

    let passingvalue = Math.trunc(quantity / uweight);
    let obj = {"ItemID": ItemID, "ShopID": ShopID, "Quantity": passingvalue}; //keys and values should be enclosed in double quotes
    $.ajax({
        url : URLAddtoCartAPI,
        data : JSON.stringify(obj),
        type : 'PATCH',
        dataType:'json',
        processData: false,
        contentType : 'application/json'
    }).done(function (data){
        if(JSON.parse(data)['success'] === 'ok'){
            templateAlert('green', 'Item updated.');
        }else{
            templateAlert('red', 'Item update failed.');
        }
    });
}

function update(ShopID,ItemID,UWeight,UnitPrice,MaxCount,method) {
    let item = $('#quantity'.concat(ShopID).concat(ItemID));
    let quantitysec = item.val();
    let quantity = quantitysec/UWeight;
    if(method === 'inc'){
        if(quantity + 1 < MaxCount){

            let uprice = item.data('uprice');
            //update subtotal
            let subtotal = parseInt(subtotallabel.text());
            subtotal += uprice;
            subtotallabel.text(subtotal.toFixed(2));
            totallabel.text((parseInt(totallabel.text())+uprice).toFixed(2));

            item.val(parseInt(quantitysec) + parseInt(UWeight));
            $('#total'.concat(ShopID).concat(ItemID)).text(((quantity+1) * UnitPrice).toFixed(2));
        }
    }else{
        if( 0 < quantity-1 ){

            let uprice = item.data('uprice');
            //update subtotal
            let subtotal = parseInt(subtotallabel.text());
            subtotal -= uprice;
            subtotallabel.text(subtotal.toFixed(2));
            totallabel.text((parseInt(totallabel.text())-uprice).toFixed(2));

            item.val(parseInt(quantitysec) - parseInt(UWeight));
            $('#total'.concat(ShopID).concat(ItemID)).text(((quantity-1) * UnitPrice).toFixed(2));
        }
    }
}

function remove(ShopID,ItemID,UnitPrice){

    let obj = {"ItemID":ItemID,"ShopID":ShopID};
    $.post(URLDeletefromCartAPI,JSON.stringify(obj)).done(function (data){
        if(JSON.parse(data)['success'] === 'ok'){
            let numofshops = parseInt(numberofshops.text());

            let item = $('#quantity'.concat(ShopID).concat(ItemID));
            let quantity = item.val()
            let uweight = item.attr('step');

            quantity = quantity/uweight;

            //update number of items
            itemcount.text(parseInt(itemcount.text())-1);

            //update subtotal
            let subtotal = parseInt(subtotallabel.text());
            subtotal -= (quantity*UnitPrice);

            subtotallabel.text(subtotal.toFixed(2));


            //remove the item
            $('#item'.concat(ShopID).concat(ItemID)).remove();
            //check if its the last item on the shop.
            if($('#CartItemsOfShop'.concat(ShopID).concat(' div')).length===0){ //last item
                //update no of shops
                $('#Shop'.concat(ShopID)).remove();
                numofshops = parseInt(numberofshops.text())-1;
                numberofshops.text(numofshops);
            }


            //update total
            let deliveryfee = calculateDelivery(numofshops);
            delivery.text(deliveryfee.toFixed(2));
            totallabel.text((subtotal+deliveryfee).toFixed(2));

            templateAlert('green', 'Item successfully removed.');
        }else{
            templateAlert('red', 'Item removal from cart failed.');
        }
    });
}

function calculateDelivery(numberofshops){
    let baseDeli = 120;

    for (let i = 1; i < 5 && i < numberofshops; i++) {
        baseDeli += 30;
    }
    return baseDeli;
}














