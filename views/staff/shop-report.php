<?php
?>
<div class="core core-special">
    <h1 class="heading">Shop <span>Analytics</span></h1
    <div class="">
        <ul id="tab=btns" class="tabs">
            <li>
                <button data-name="Vegetable Shops" data-href="?Category=0" id="btn-vege" class="btn-tab">Vegetables
                </button>
            </li>
            <li>
                <button data-name="Fruit Shops" data-href="?Category=1" class="btn-tab">Fruits</button>
            </li>
            <li>
                <button data-name="Grocery Shops" data-href="?Category=2" class="btn-tab">Grocery</button>
            </li>
            <li>
                <button data-name="Fish Shops" data-href="?Category=3" class="btn-tab">Fish</button>
            </li>
            <li>
                <button data-name="Meat Shops" data-href="?Category=4" class="btn-tab">Meat</button>
            </li>
        </ul>
        <div>
            <p class="sub-heading" id="category"></p>
        </div>
        <div id="charDiv1" class="chart-div">
            <div class="chart">
                <canvas id="myChart1"></canvas>
            </div>
            <div class="chart">
                <canvas id="myChart2"></canvas>
            </div>
        </div>

        <div class="table-section">
            <div>
                <p class="table-title"><i class='bx bxs-calendar'></i> Month Report</p>
                <table id="month-table" class="table-info">
                    <thead>
                    <tr>
                        <th>ShopName</th>
                        <th>Address</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Shop Total</th>
                    </tr>
                    </thead>
                    <tbody id="month-table-body">

                    </tbody>

                </table>
            </div>
            <div>
                <p class="table-title"><i class='bx bxs-calendar'></i> Year Report</p>
                <table id="year-table" class="table-info">
                    <thead>
                    <tr>
                        <th>ShopName</th>
                        <th>Address</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Shop Total</th>
                    </tr>
                    </thead>
                    <tbody id="year-table-body">

                    </tbody>
                </table>
            </div>

        </div>

    </div>


    <script src="/js/shop-report.js"></script>
</div>
