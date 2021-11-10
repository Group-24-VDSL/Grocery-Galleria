const getUrlParameter = function getUrlParameter(sParam) {
    let sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
}
const host = window.location.origin; //http://domainname

//Api links

const URLOrderAPI = host + "/api/orders";
const URLFindCartAPI = host + "/api/getordercart";

const URLGetOrder = URLOrderAPI.concat('?OrderID=').concat('1');

$(document).ready(function () {
    $.getJSON(URLGetOrder, function (Orders) {


            Orders.forEach(Order => {
                // itemRow.classList.add('row');

                if (Order.Status == 0){
                    const URlFindCart = URLFindCartAPI.concat("?CartID=").concat(Order.CartID);
                    console.log(URlFindCart);

                    $.getJSON(URlFindCart , function (Carts) {
                            Carts.forEach(Cart => {

                                    const ItemRow = document.createElement('tr');
                                    // itemRow.classList.add('tr');
                                    ItemRow.innerHTML = `
                 <td></td>
                 <td id="Name" class="row-name">${Order.OrderID}</td>
                 <td id="ItemImage" class="row-img">
                    <img src="${Item.ItemImage}" alt="${Item.Name}" />
                </td>
                <td id="Name" class="row-name">${Item.Name}</td>
                <td id="Brand" class="row-brand">${Item.Brand}</td>
                <td id="Unit" class="row-unit">${Item.Unit}</td>
                <td id="UWeight" class="row-minWeight">${Item.UWeight}</td>
                <td id="MRP" class="row-mrp">${Item.MRP}</td>
                <td id="UPrice" class="row-uprice">${Shop.UnitPrice}</td>
                <td id="Stock" class="row-stock">${Shop.Stock}</td>
                <td id="Enable" class="row-enable">${Shop.Enable}</td>
                <td class="row-ubutton">
                    <a  class="btn-row" type="submit">Update</a>
                </td>
                `
                                    ItemTable.appendChild(ItemRow);
                                }
                            )
                        }
                    )
                }



            });
        }
    )
    ;});