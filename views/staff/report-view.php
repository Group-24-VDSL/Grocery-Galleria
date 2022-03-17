<?php

?>
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
                <li>Total Sales Revenue Current Year    :   <span id="IdTL"></span></li>
                <li>Total Delivery Revenue Current Year :   <span id="IdDL"></span></li>
            </ul>
        </div>
        <div class="report-brief">
            <ul>
                <li>Total Sales Revenue Current Year    :   <span id="IdTC"></span></li>
                <li>Total Delivery Revenue Current Year :   <span id="IdDC"></span></li>
            </ul>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
            integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/report.js"></script>
</div>