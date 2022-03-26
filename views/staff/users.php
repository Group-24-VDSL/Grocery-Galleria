<script src="/js/jquery.min.js"></script>
<script src="/js/datatables.min.js"></script>
<link rel="stylesheet" href="/css/datatables.min.css" />
<div class="core">
    <h1 class="heading">System <span>Users</span></h1>
    <div class="container-core">
        <ul class="tabs">
            <li><button id="shop-tab" data-user="shop" class="btn-tab">Shops</button></li>
            <li><button id="rider-tab" data-user="rider" class="btn-tab">Delivery Riders</button></li>
            <li><button id="del-tab" data-user="delivery" class="btn-tab">Delivery Staff</button></li>
            <li><button id="staff-tab" data-user="system" class="btn-tab">System Staff</button></li>
        </ul>
        <table id="user-table">
            <thead id="user-table-head">

            </thead>
            <tbody id="user-table-body">

            </tbody>
        </table>
    </div>
</div>


<script src="/js/staff-usertable.js"></script>