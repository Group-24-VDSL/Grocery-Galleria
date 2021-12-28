<link rel="stylesheet" href="/css/shopAnalytics.css">
<script src="/js/shop-chart.js" defer></script>
<script src="/js/chart.min.js" defer></script>
<script src="/js/jquery.min.js" defer></script>
<div class = "core" style="height: 880px;">
    <div class = "core-orders" >
        <h1 class="heading">Order <span>Analytics</span></h1>
        <div class="charts">
            <div class="barChart" ">
                <canvas class="analytics" height="120rem" id="orderBarchart"  style= " position: absolute; max-width:600px"></canvas>
                <div class= "average" >
                    Average Orders Per Month in Previous Year : <span id="order-barchart-average"></span>
                    <br>
                    Total Orders in Previous Year : <span id="order-barchart-sum"></span>
                </div>
            </div>

            <div class="lineChart" ">
                <canvas id="orderLinechart" height="120rem"  style="position: absolute; max-width:600px"></canvas>
                <div class= "average" >
                    Average Orders Per Day in Previous Month : <span id="order-linechart-average"></span>
                    <br>
                    Total Orders in Previous Month  : <span id="order-linechart-sum"></span>
                </div>
            </div>
        </div>

    </div>

    <div class="core-revenue">
        <h1 class="heading">Income <span>Analytics</span></h1>
        <div class="charts">
            <div class="barChart">
                <canvas class="analytics" height="120rem" id="revenueBarchart"  style= " position: absolute; max-width:600px"></canvas>
                <div class= "average" >
                    Average Revenue Per Month in Previous Year : <span id="revenue-barchart-average"></span>
                    <br>
                    Total Revenue in Previous Year : <span id="revenue-barchart-sum"></span>
                </div>
            </div>
            <div class="lineChart">
                <canvas id="revenueLinechart" height="120rem"  style="position: absolute; max-width:600px"></canvas>
                <div class= "average" >
                    Average Orders Per Day in Previous Month : <span id="order-linechart-average"></span>
                    <br>
                    Total Orders in Previous Month  : <span id="order-linechart-sum"></span>
                </div>
            </div>
        </div>
    </div>


</div>
