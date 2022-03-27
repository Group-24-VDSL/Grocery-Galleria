const host = window.location.origin; //http://domainname
const ShopCategory =  host + "/api/getshopcategory";
const ShopID =  host + "/api/getshopid";
const URLGetItem = host + "/api/item" ;

$(function () {
    const select = document.getElementById("ItemID");
    const MRP = document.getElementById("MRP");
    const Unit = document.getElementById("Unit");
    const UWeight = document.getElementById("UWeight");
    const UPrice = document.getElementById("UnitPrice");
    let UnitSymbol = ' ';
    let MaxPrice = '' ;
    let systemItems = [];
    const UnitTag = ["Kg", "L", "Unit"];


        $.getJSON(ShopID, function (shopID) {
            $.getJSON(ShopCategory, function (category) {

                const URLItems = "http://localhost/api/items?Category=".concat(category);
                const URLShopItems = "http://localhost/api/shopitems?ShopID=".concat(shopID);



                $.getJSON(URLItems, function (items) {
                        $.getJSON(URLShopItems, function (shopItems) {

                            items.forEach(item => {
                                if (!shopItems.some(shopItem => shopItem.ItemID === item.ItemID)) {
                                    let option = document.createElement("option");
                                    option.text = item.Name;
                                    option.value = item.ItemID;
                                    select.add(option);

                                    systemItems.push(item);
                                }


// console.log(items)

                            })
                            console.log(systemItems[0].MRP)

                            switch (systemItems[0].Unit) {
                                case 0 :
                                    UnitSymbol = 'Kg';
                                    break;
                                case 1 :
                                    UnitSymbol = 'L';
                                    break;
                                case 2 :
                                    UnitSymbol = 'Unit';
                                    break;
                            }

                            switch (systemItems[0].Category) {
                                case 0 :
                                    MaxPrice = items[0].MRP;
                                    break;
                            }

                            // UPrice.setAttribute("max", MaxPrice);


                            MRP.setAttribute("value", parseFloat(systemItems[0].MRP, 2));
                            Unit.setAttribute("value", UnitTag[systemItems[0].Unit]);
                            UWeight.setAttribute("value", systemItems[0].UWeight + " " + UnitSymbol);

                            document.getElementById('unit-tag').innerText = "(in " + UnitTag[items[0].Unit] + ")";
                        });




                        select.addEventListener('change', function () {
                            items.forEach(item => {
                                if (item.ItemID == this.value) {
                                    console.log(item)
                                    switch (item.Unit) {
                                        case 0 :
                                            UnitSymbol = 'Kg';
                                            break;
                                        case 1 :
                                            UnitSymbol = 'L';
                                            break;
                                        case 2 :
                                            UnitSymbol = 'Unit';
                                            break;
                                    }

                                    switch (item.Category) {
                                        case 0 :
                                            MaxPrice = item.MRP;
                                            break;
                                        default :
                                            MaxPrice = '';
                                            break ;
                                    }
                                    // UPrice.setAttribute("max", MaxPrice);
                                    MRP.setAttribute("value", parseFloat(item.MRP, 2));
                                    Unit.setAttribute("value", UnitTag[item.Unit]);
                                    UWeight.setAttribute("value", item.UWeight + " " + UnitSymbol);

                                    document.getElementById('unit-tag').innerText = "(in " + UnitSymbol + ")";

                                }
                            })

                        });
                    }
                );
            })
        })
});

