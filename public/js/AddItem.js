$(function () {
    const select = document.getElementById("ItemID");
    const MRP = document.getElementById("MRP");
    const Unit = document.getElementById("Unit");
    const UWeight = document.getElementById("UWeight");

    const UnitTag = ["Kg", "g", "L", "ml", "Unit"];
    const URLItems = "http://localhost/api/items?Category=0";
    const URLShopItems = "http://localhost/api/shopitems?ShopID=5";


    $.getJSON(URLItems, function (items) {
            $.getJSON(URLShopItems, function (shopItems) {
                items.forEach(item => {
                    if (!shopItems.some(shopItem => shopItem.ItemID === item.ItemID)) {
                        let option = document.createElement("option");
                        option.text = item.Name;
                        option.value = item.ItemID;
                        select.add(option);
                    }
                })
            });
            MRP.setAttribute("value", "Rs. "+items[0].MRP);
            Unit.setAttribute("value", UnitTag[items[0].Unit]);
            UWeight.setAttribute("value", items[0].UWeight+" g");

            select.addEventListener('change', function () {
                items.forEach(item=>{
                    if(item.ItemID == this.value){
                        MRP.setAttribute("value", item.MRP);
                        Unit.setAttribute("value", UnitTag[item.Unit]);
                        UWeight.setAttribute("value", item.UWeight);

                    }
                })

            });
        }
    );

});