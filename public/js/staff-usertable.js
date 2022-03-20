const host = window.location.origin; //http://domainname

//Api links
const URLShop = host + "/api/getshopstaff";
const URLRider = host + "/api/getriderstaff";
const URLDelivery = host + "/api/getdeliverystaff";
const URLSystem = host + "/api/getsystemstaff";

const ItemTable = document.getElementById('item-table');

$(document).ready(function () {
    $(".btn-tab").click(function () {
        $('#item-table').empty();
        $('#table-header').empty();
        let URLUser;
        switch ($(this).data("user")) {
            case "shop":
                URLUser=URLShop;
                const headerRow = document.createElement('ul');
                headerRow.innerHTML = `
                <ul>
                <li>UserID</li>
                <li>Name</li>
                <li>Email</li>
                <li>Contact</li>
                <li>NIC</li>
                <li>Status</li>
                </ul>
                `;
                break;
            case "rider":
                URLUser=URLRider;
                break;
            case "delivery":
                URLUser=URLDelivery;
                break;
            case "system":
                URLUser=URLSystem;
        }

        $.getJSON(URLUser, function (Items) {
            Items.forEach(Item => {
                    const itemRow = document.createElement('ul');
                    itemRow.classList.add('row');
                switch ($(this).data("user")) {
                    case "shop":

                        itemRow.innerHTML = `
                <li class="row-name">${Item.ShopID}</li>
                <li class="row-name">${Item.Name}</li>
                <li class="row-brand">${Item.Brand}</li>
                <li class="row-unit">${Item.Unit}</li>
                <li class="row-minWeight">${Item.UWeight}</li>
                <li class="row-mrp">${Item.MRP}</li>
                <li class="row-IncStep">${Item.MaxCount}</li>
                <li class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </li>
                `;

                        break;
                    case "rider":
                        itemRow.innerHTML = `
                <li class="row-name">${Item.ShopID}</li>
                <li class="row-name">${Item.Name}</li>
                <li class="row-brand">${Item.Brand}</li>
                <li class="row-unit">${Item.Unit}</li>
                <li class="row-minWeight">${Item.UWeight}</li>
                <li class="row-mrp">${Item.MRP}</li>
                <li class="row-IncStep">${Item.MaxCount}</li>
                <li class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </li>
                `;
                        break;
                    case "delivery":
                        itemRow.innerHTML = `
                <li class="row-name">${Item.ShopID}</li>
                <li class="row-name">${Item.Name}</li>
                <li class="row-brand">${Item.Brand}</li>
                <li class="row-unit">${Item.Unit}</li>
                <li class="row-minWeight">${Item.UWeight}</li>
                <li class="row-mrp">${Item.MRP}</li>
                <li class="row-IncStep">${Item.MaxCount}</li>
                <li class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </li>
                `;
                        break;
                    case "system":
                        itemRow.innerHTML = `
                <li class="row-name">${Item.ShopID}</li>
                <li class="row-name">${Item.Name}</li>
                <li class="row-brand">${Item.Brand}</li>
                <li class="row-unit">${Item.Unit}</li>
                <li class="row-minWeight">${Item.UWeight}</li>
                <li class="row-mrp">${Item.MRP}</li>
                <li class="row-IncStep">${Item.MaxCount}</li>
                <li class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </li>
                `;
                }
                ItemTable.appendChild(itemRow);
                }
            )
        }).then(function (){

            const searchbox = document.getElementById("product-search");
            searchbox.addEventListener("focus",function (){
                console.log("hello")
                const itemBtn = document.getElementsByClassName('btn-row')[0];
                $(itemBtn).trigger("click");
            })
            searchbox.addEventListener("keyup",function (){
                let input = document.getElementById("product-search").value.toUpperCase();
                let table = document.getElementById("item-table");
                items = table.getElementsByClassName("row");
                Array.prototype.forEach.call(items,function(ulelement) {
                    let brand = ulelement.getElementsByClassName("row-brand")[0].textContent || ulelement.getElementsByClassName("row-brand")[0].innerText;
                    let name = ulelement.getElementsByClassName("row-name")[0].textContent || ulelement.getElementsByClassName("row-name")[0].innerText;
                    if (name.toUpperCase().indexOf(input) > -1 || brand.toUpperCase().indexOf(input) >-1 ) {
                        ulelement.style.display = "";
                    } else {
                        ulelement.style.display = "none";
                    }

                });
            });
        })
    })
    $('#btn-vege').trigger('click');


})










