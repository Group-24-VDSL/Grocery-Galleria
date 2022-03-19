<?php

?>
<div class="overview-boxes">
    <div class="box">
        <div class="content">
            <div class="box-topic">Total Orders</div>
            <div id="totOrders" class="number"></div>
            <div class="indicator">
                <i class="bx bxs-up-arrow-square"></i>
                <span class="text">Up so far</span>
            </div>
        </div>
        <!-- <i class='bx bx-cart-alt cart'></i> -->
        <img
                src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-delivery-box-shopping-and-ecommerce-itim2101-lineal-color-itim2101.png"
        />
    </div>
    <div class="box">
        <div class="content">
            <div class="box-topic">Total Revenue</div>
            <div id="totRevenue" class="number"></div>
            <div class="indicator">
                <i class="bx bxs-up-arrow-square"></i>
                <span class="text">Up so far</span>
            </div>
        </div>
        <img
                src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-revenue-money-and-economy-itim2101-lineal-color-itim2101.png"
        />
    </div>
    <!-- <i class='bx bx-cart-alt cart'></i> -->

    <div class="box">
        <div class="content">
            <div class="box-topic">Total Shops</div>
            <div id="totShops" class="number"></div>
            <div class="indicator">
                <i class="bx bxs-up-arrow-square"></i>
                <span class="text">Up so far</span>
            </div>
        </div>
        <img
                src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-financial-mobile-payment-itim2101-lineal-color-itim2101.png"
        />
    </div>
    <div class="box">
        <div class="content">
            <div class="box-topic">Total Riders</div>
            <div id="totRiders" class="number"></div>
            <div class="indicator">
                <i class="bx bxs-up-arrow-square"></i>
                <span class="text">Up so far</span>
            </div>
        </div>
        <img
                src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-order-online-shopping-itim2101-lineal-color-itim2101.png"
        />
    </div>
</div>
<div class="core">
    <h1 class="heading">System <span>Analytics</span></h1>
    <div class="chart-div">
        <div class="chart">

            <canvas id="myChart2"></canvas>
        </div>
        <div class="chart">

            <canvas id="myChart1"></canvas>
        </div>
        <div class="report-brief">
            <ul>
                <li>Total Sales Revenue Last Year(LKR)&ensp;: <span class="details" id="IdTL"></span></li>
                <li>Total Delivery Revenue Last Year(LKR)&ensp;: <span class="details" id="IdDL"></span></li>
            </ul>
        </div>
        <div class="report-brief">
            <ul>
                <li>Total Sales Revenue Current Year(LKR)&ensp;: <span class="details" id="IdTC"></span></li>
                <li>Total Delivery Revenue Current Year(LKR)&ensp;: <span class="details" id="IdDC"></span></li>
            </ul>
        </div>
    </div>

</div>
<div class="core">
    <h1 class="heading">Daily <span>Analysis</span></h1>

    <label id="SalesDateLabel" for="SalesDate">Select date:</label>
    <input type="date" id="SalesDate2" name="SalesDate2" min="2020-01-01" value="">
    <div class="headings">
        <h1 class="heading chart-heading">Revenue <span>Analysis</span></h1>
        <h1 class="heading chart-heading">Order <span>Analysis</span></h1>
    </div>
    <div id="dailyChart" class="chart-div-new">
        <div class="chart-new">
            <canvas id="myChart3"></canvas>
        </div>
        <div class="chart-new">
            <canvas id="myChart4"></canvas>
        </div>
    </div>

</div>

<script src="/js/report.js"></script>
<!--<script src="/js/daily-report.js"></script>-->
