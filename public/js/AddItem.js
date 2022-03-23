$(function () {
    const select = document.getElementById("ItemID");
    const MRP = document.getElementById("MRP");
    const Unit = document.getElementById("Unit");
    const UWeight = document.getElementById("UWeight");
    let UnitSymbol = ' ';

    const UnitTag = ["Kg", "g", "L", "ml", "Unit"];

    const URLItems = "http://localhost/api/items?Category=0";
    const URLShopItems = "http://localhost/api/shopitems?ShopID=5";


    $.getJSON(URLItems, function (items) {
        console.log(items)
            $.getJSON(URLShopItems, function (shopItems) {
                items.forEach(item => {
                    if (!shopItems.some(shopItem => shopItem.ItemID === item.ItemID)) {
                        let option = document.createElement("option");
                        option.text = item.Name;
                        option.value = item.ItemID;
                        select.add(option);
                    }
// console.log(items)

                })
            });

        switch (items[0].Unit){
            case 0 : UnitSymbol = 'Kg' ;
                break ;
            case 1 : UnitSymbol = 'g' ;
                break ;
            case 2 : UnitSymbol = 'l' ;
                break ;
            case 3 : UnitSymbol = 'Unit' ;
                break ;
        }
            MRP.setAttribute("value", "Rs. "+items[0].MRP);
            Unit.setAttribute("value", UnitTag[items[0].Unit]);
            UWeight.setAttribute("value", items[0].UWeight+" "+UnitSymbol);

            select.addEventListener('change', function () {
                items.forEach(item=>{
                    if(item.ItemID == this.value){
                        switch (item.Unit){
                            case 0 : UnitSymbol = 'Kg' ;
                                break ;
                            case 1 : UnitSymbol = 'g' ;
                                break ;
                            case 2 : UnitSymbol = 'l' ;
                                break ;
                            case 3 : UnitSymbol = 'Unit' ;
                                break ;
                        }
                        MRP.setAttribute("value", item.MRP);
                        Unit.setAttribute("value", UnitTag[item.Unit]);
                        UWeight.setAttribute("value", item.UWeight+" "+UnitSymbol);

                    }
                })

            });
        }
    );

});