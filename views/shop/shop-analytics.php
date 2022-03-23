<link rel="stylesheet" href="/css/shopAnalytics.css">
<script src="/js/shop-chart.js" defer></script>
<script src="/js/chart.min.js" defer></script>
<script src="/js/jquery.min.js" defer></script>
<div class = "core" style="height: 60rem;">
    <div class = "core-orders" >
        <h1 class="heading">Shop <span>Orders</span></h1>
        <div class="charts">
            <div class="barChart" ">
                <canvas class="analytics" height="120rem" id="orderBarchart"  style= " position: absolute; max-width:7700px"></canvas>
                <div class= "average" >
                    Average Orders Per Month in Previous Year : <span id="order-barchart-average"></span>
                    <br>
                    Total Orders in Previous Year : <span id="order-barchart-sum"></span>
                </div>
            </div>

            <div class="lineChart" ">
                <canvas id="orderLinechart" height="120rem"  style="position: absolute; max-width:700px"></canvas>
                <div class= "average" >
                    Average Orders Per Day in Previous Month : <span id="order-linechart-average"></span>
                    <br>
                    Total Orders in Previous Month  : <span id="order-linechart-sum"></span>
                </div>
            </div>
        </div>

    </div>

    <div class="core-revenue">
        <h1 style="margin-top: 3rem;" class="heading">Shop <span>Income</span></h1>
        <div class="charts">
            <div class="barChart">
                <canvas class="analytics" height="120rem" id="revenueBarchart"  style= " position: absolute; max-width:700px"></canvas>
                <div class= "average" >
                    Average Revenue Per Month in Previous Year : Rs. <span id="revenue-barchart-average"></span>
                    <br>
                    Total Revenue in Previous Year : Rs. <span id="revenue-barchart-sum"></span>
                </div>
            </div>
            <div class="lineChart">
                <canvas id="revenueLinechart" height="120rem"  style="position: absolute; max-width:700px"></canvas>
                <div class= "average" >
                    Average Orders Per Day in Previous Month : Rs. <span id="revenue-linechart-average"></span>
                    <br>
                    Total Orders in Previous Month  : Rs. <span id="revenue-linechart-sum"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<script type="text/javascript">-->
<!--    window.onload=function(){-->
<!--        var ctx = document.getElementById("myChart").getContext("2d");-->
<!---->
<!--        var data = {-->
<!--            labels: ["January", "February", "March", "April", "May", "June", "July","January", "February", "March", "April", "May", "June", "July","January", "February", "March", "April", "May", "June", "July","January", "February", "March", "April", "May", "June", "July","January", "February", "March", "April", "May", "June", "July","January", "February", "March", "April", "May", "June", "July"],-->
<!--            datasets: [-->
<!--                {-->
<!--                    // label: "My First dataset",-->
<!--                    fillColor: 'yellow',-->
<!--                    strokeColor: "green",-->
<!--                    pointColor: "green",-->
<!--                    pointStrokeColor: "green",-->
<!--                    lineTension : 0,-->
<!--                    // pointHighlightFill: "#fff",-->
<!--                    // pointHighlightStroke: "rgba(220,220,220,1)",-->
<!--                    data: [30,50,20,10,40,40]-->
<!--                }-->
<!---->
<!--            ]-->
<!--        };-->
<!--        new Chart(ctx).Line(data, {-->
<!--            onAnimationComplete: function () {-->
<!--                // var sourceCanvas = this.chart.ctx.canvas;-->
<!--                // var copyWidth = this.scale.xScalePaddingLeft - 4;-->
<!--                // var copyHeight = this.scale.endPoint + 15;-->
<!--                var targetCtx = document.getElementById("myChartAxis").getContext("2d");-->
<!--                // targetCtx.canvas.width = copyWidth;-->
<!--                x = targetCtx.drawImage();-->
<!--                x.height = 100 ;-->
<!---->
<!--            }-->
<!--        });-->
<!--    }-->
<!---->
<!--</script>-->



