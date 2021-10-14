$(function () {
    const select = document.getElementById("ItemID");
    const MRP = document.getElementById("MRP");
    const Unit = document.getElementById("Unit");
    const UWeight = document.getElementById("UWeight");

    const UnitTag = ["Kg", "g", "L", "ml", "Unit"];
    const URLItems = "http://localhost/api/items?Category=0";
    const URLShopItems = "http://localhost/api/shopItems?ShopID=0";


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
            MRP.setAttribute("value", items[0].MRP);
            Unit.setAttribute("value", UnitTag[items[0].Unit]);
            UWeight.setAttribute("value", items[0].UWeight);

            select.addEventListener('change', function () {
                MRP.setAttribute("value", items[this.value - 1].MRP);
                Unit.setAttribute("value", UnitTag[items[this.value - 1].Unit]);
                UWeight.setAttribute("value", items[this.value - 1].UWeight);
            });
        }
    );
    $.getJSON(URLShopItems, function (shopItems) {
    });
});