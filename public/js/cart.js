// const UnitTag = ["Kg", "g", "L", "ml", "Unit"];

const host = window.location.origin; //http://domainname

const URLShopAPI = host + "/api/shop";
const URLShopItemAPI = host + "/api/shopitem";
const URLFindItemAPI = host + "/api/item";

const URLAddtoCartAPI = host + "/api/addtocart";
const URLGetCartAPI = host + "/api/getcart";


const URLGetCart = URLGetCartAPI.concat('?CustomerID=').concat('2');


$.getJSON(URLGetCart, function (CartItems) {
    CartItems.sort((a, b) => parseFloat(a.ShopID) - parseFloat(b.ShopID));
    const containerItem = document.getElementById('container-item');
    // console.log(CartItems);

    CartItems.forEach(CartItem => {
        // console.log(CartItem);
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
        $.getJSON(URLShop, function (shop) {
            $.getJSON(URLItem, function (item) {
                $.getJSON(URLShopItem, function (shopitem) {

                    Item.innerHTML = `
                        <div class="item-img"><img src="${item.ItemImage}" alt="${item.Name}">${item.Name}</div>
                        <div class="UWeight">${item.UWeight}</div>
                        <div class="price">${shopitem.UnitPrice}</div>
                        <div class="quantity">
                            <input type="number" id="" name="quantity"  min="${item.UWeight}" max="${item.UWeight * item.MaxCount}" step="${item.UWeight}" value="${item.UWeight * CartItem.Quantity}">
                        </div>
                        <div class="total">${shopitem.UnitPrice * CartItem.Quantity}</div>
                        <div>
                            <a  class="" data-itemid="${item.ItemID}" data-shopid="${shopitem.ShopID}" >Update</a>
                            
                        </div>
                        <div>
                            <a class="remove" data-itemid="${item.ItemID}" data-shopid="${shopitem.ShopID}">Remove</a>   
                        </div>
            `
                });
            });
        });
        //Add items to the relevant targeted shop
        const shopItemDiv = document.getElementById('CartItemsOfShop'.concat(CartItem.ShopID));
        shopItemDiv.appendChild(Item);

    });


});









