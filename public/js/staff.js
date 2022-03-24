// get url parameters
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
const URLItemsAPI = host + "/api/items";
const URLItemAPI = host + "/api/item";
const ItemTable = document.getElementById('item-table');

$(document).ready(function () {
    $(".btn-tab").click(function () {
        $('#item-table').empty();
        let URLFindItems = URLItemsAPI.concat($(this).data("href"));
        $.getJSON(URLFindItems, function (Items) {
            Items.forEach(Item => {
                    const itemRow = document.createElement('ul');
                    itemRow.classList.add('row');
                    itemRow.innerHTML = `
                 <li class="row-img">
                    <img src="${Item.ItemImage}" alt="${Item.Name}" />
                </li>
                <li class="row-name">${Item.Name}</li>
                <li class="row-brand">${Item.Brand}</li>
                <li class="row-unit">${Item.Unit}</li>
                <li class="row-minWeight">${Item.UWeight}</li>
                <li class="row-mrp">${Item.MRP}</li>
                <li class="row-IncStep">${Item.MaxCount}</li>
                <li class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </li>
                `
                    ItemTable.appendChild(itemRow);
                }
            )
        }).then(function (){
            const itemBtns = document.getElementsByClassName('btn-row');
            $(itemBtns).click(function () {
                const URLFindItem = URLItemAPI.concat($(this).data("href"));
                console.log(URLFindItem);
                $.getJSON(URLFindItem, function (Item) {
                    $('#ItemID').val(Item.ItemID);
                    $('#Category').val(Item.Category);
                    // console.log(document.getElementById('Category').value);
                    $('#Unit').val(Item.Unit);
                    // console.log(document.getElementById('Unit').value);
                    $('#Name').val(Item.Name);
                    console.log(document.getElementById('Name').value);
                    $('#ImgDis').attr('src',Item.ItemImage);
                    // console.log(Item.ItemImage);
                    $('#Brand').val(Item.Brand);
                    // console.log(document.getElementById('Brand').value);
                    $('#UWeight').val(Item.UWeight);
                    // console.log(document.getElementById('UWeight').value);
                    $('#MaxCount').val(Item.MaxCount);
                    // console.log(document.getElementById('MaxCount').value);
                    $('#MRP').val(Item.MRP);
                    // console.log(document.getElementById('MRP').value);
                })



            });
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










