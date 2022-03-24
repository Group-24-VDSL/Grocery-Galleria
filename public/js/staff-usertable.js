const host = window.location.origin; //http://domainname

//Api links
const URLShop = host + "/api/getshopstaff";
const URLRider = host + "/api/getriderstaff";
const URLDelivery = host + "/api/getdeliverystaff";
const URLSystem = host + "/api/getsystemstaff";

const ItemHeader = document.getElementById('user-table-head');
const ItemBody = document.getElementById('user-table-body');

$(document).ready(function () {
    $(".btn-tab").click(function () {
        $(ItemHeader).empty();
        $(ItemBody).empty();
        let URLUser;
        let User = $(this).data("user");
        const headerRow = document.createElement('tr');
        switch ($(this).data("user")) {
            case "shop":
                URLUser = URLShop;
                headerRow.innerHTML = `
                <th>Shop ID</th>
                <th>Shop Name</th>
                <th>Address</th>
                <th>Contact Person</th>
                <th>Contact Number</th>
                <th>City</th>
                <th>Suburb</th>
                <th>Category</th>
                <th>Actions</th>
                `;
                break;
            case "rider":
                URLUser = URLRider;
                headerRow.innerHTML = `
                <th>Rider ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>NIC</th>
                <th>Contact Number</th>
                <th>City</th>
                <th>Suburb</th>
                <th>Rider Type</th>
                <th>Actions</th>
                `;
                break;
            case "delivery":
                URLUser = URLDelivery;
                headerRow.innerHTML = `
                <th>Delivery Staff ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>City</th>
                <th>Suburb</th>
                <th>Actions</th>
                `;
                break;
            case "system":
                URLUser = URLSystem;
                headerRow.innerHTML = `
                <th>Staff ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Actions</th>
                `;
                break;
        }
        ItemHeader.appendChild(headerRow);
        $.getJSON(URLUser, function (Items) {
            Items.forEach(Item => {
                const itemRow = document.createElement('tr');
                switch (User) {
                    case "shop":
                        itemRow.innerHTML = `
                <td>${Item.ShopID}</td>
                <td>${Item.ShopName}</td>
                <td>${Item.Address}</td>
                <td>${Item.Name}</td>
                <td>${Item.ContactNo}</td>
                <td>${Item.City}</td>
                <td>${Item.Suburb}</td>
                <td>${Item.Category}</td>
                <td class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </td>
                `;
                        break;
                    case "rider":
                        itemRow.innerHTML = `
                <td class="row-name">${Item.RiderID}</td>
                <td class="row-name">${Item.Name}</td>
                <td class="row-unit">${Item.Address}</td>
                <td class="row-unit">${Item.Email}</td>
                <td class="row-unit">${Item.NIC}</td>
                <td class="row-mrp">${Item.ContactNo}</td>
                <td class="row-IncStep">${Item.City}</td>
                <td class="row-IncStep">${Item.City}</td>
                <td class="row-IncStep">${Item.RiderType}</td>
                <td class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </td>
                `;
                        break;
                    case "delivery":
                        itemRow.innerHTML = `
                <td class="row-name">${Item.DelStaffID}</td>
                <td class="row-name">${Item.Name}</td>
                <td class="row-mrp">${Item.ContactNo}</td>
                <td class="row-unit">${Item.Email}</td>
                <td class="row-unit">${Item.City}</td>
                <td class="row-unit">${Item.Suburb}</td>
                <td class="row-ubutton">
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                </td>
                
                `;
                        break;
                    case "system":
                        itemRow.innerHTML = `
                <td class="row-name">${Item.StaffID}</td>
                <td class="row-name">${Item.Name}</td>
                <td class="row-unit">${Item.Email}</td>
                <td class="row-mrp">${Item.ContactNo}</td>
                    <button data-href="?ItemID=${Item.ItemID}" class="btn-row">Update</button>
                <td class="row-ubutton">
                </td>
                `;
                        ItemBody.appendChild(itemRow);
                        break;
                    default:
                        itemRow.innerHTML = `<td>Error</td>
                        `

                }

                ItemBody.appendChild(itemRow);
            }
        )
        }).then(function () {


            $('#user-table').DataTable();
        })
    })
    $('#shop-tab').trigger('click');


})










