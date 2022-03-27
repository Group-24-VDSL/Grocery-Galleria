<?php

?>

<div class="core">
    <h1 class="heading">System <span>Analytics</span></h1>
    <div class="header-field">
        <label for="SalesMonth1">Select month:</label>
        <input type="month" id="SalesMonth1" name="SalesMonth1" min="2020-01" value="">
    </div>
    <div class="components">
        <div class="report">
            <h1 class="heading chart-heading">Income <span>Analysis</span></h1>
            <div class="details">
                <div class="details-div">
                    <label>Cost(LKR):</label>
                    <input type="text" id="Cost1" readonly>
                </div>
                <div class="details-div">
                    <label>3% Sales Revenue(LKR):</label>
                    <input type="text" id="revenue1" readonly>
                </div>
                <div class="details-div">
                    <label>Profit(LKR):</label>
                    <input type="text" id="profit1" readonly>
                </div>
                <div class="details-div">
                    <label>Profit percentage(%):</label>
                    <input type="text" id="profitP1" readonly>
                </div>
                <div class="details-div">
                    <label>Profit margin(%):</label>
                    <input type="text" id="profitM1" readonly>
                </div>
            </div>
        </div>
        <div class="report">
            <h1 class="heading chart-heading">Progress <span>So far</span></h1>
            <canvas id="myChart6"></canvas>

        </div>
        <div class="report">
            <h1 class="heading chart-heading">New <span>Users</span></h1>
            <div class="details">
                <div class="details-div">
                    <label>Total new users:</label>
                    <input type="text" id="TNew" readonly>
                </div>
                <div class="details-div">
                    <label>#New Customers:</label>
                    <input type="text" id="NCust" readonly>
                </div>
                <div class="details-div">
                    <label>#New Shops:</label>
                    <input type="text" id="NShop" readonly>
                </div>
                <div class="details-div">
                    <label>#New System Staff:</label>
                    <input type="text" id="NSStaff" readonly>
                </div>
                <div class="details-div">
                    <label>#New Delivery Staff:</label>
                    <input type="text" id="NDStaff" readonly>
                </div>
                <div class="details-div">
                    <label>#New Riders:</label>
                    <input type="text" id="NDRider" readonly>
                </div>
            </div>
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
<div class="core">
    <h1 class="heading">Year <span>Analytics</span></h1>
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

<script src="/js/report.js"></script>
<!--<script src="/js/system-report.js"></script>-->
