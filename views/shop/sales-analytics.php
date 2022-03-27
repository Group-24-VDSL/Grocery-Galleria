<link rel="stylesheet" href="/css/shopAnalytics.css">
<script src="/js/shop-sales-chart.js" defer></script>

<script type="text/javascript" src="https://rawgit.com/nnnick/Chart.js/v1.0.2/Chart.min.js"></script>
<script src="/js/jquery.min.js" defer></script>
<div class = "core" style="height: 100rem;">

    <div class="core-itemAverage">
    <h1 class="heading">Item <span>Sale Average</span></h1>
        <div class="core-content">
            <div class="dropdown">
                <button onclick="itemDropDownBtn()" class="dropbtn-item" id = "dropbtn-item">Select Item</button>
                <div id="itemDropdown" class="dropdown-content">
<!--                    <a href="#home">Home</a>-->
<!--                    <a href="#about">About</a>-->
<!--                    <a href="#contact">Contact</a>-->
                    <table id="itemList" class="itemList">

                    </table>
                </div>
            </div>

            <div class="charts-shopItem">
                <div class="chartWrapper">
                    <div class="chartAreaWrapper">
                        <div>
                            <h2 class="chart-name"> Sales of Item in previous year</h2>
                            <table id="item" class="item">
                                <tr>
                                    <td><img class="chart-image" id="chart-image" src="" alt="Item image" /></td>
                                    <td><span class="chart-item-name" id="chart-item-name"></span></td>
                                </tr>
                                <tr>
<!--                                    <td><div class='box-red'></div> &ensp;- Total Income in Month (LKR)</td>-->
                                    <td><div class='box-green'></div> &ensp;- Total Sales Amount in Month <span id="unit-tag"></span></td>
                                    <td><div class='box-lightgreen'></div> &ensp;- Average Sales Amount in Month <span id="unit-tag"></span></td>
                                </tr>

                            </table>


                        </div>

                        <canvas id="salesChart" height="350" width="950" style="margin-bottom: 1rem "></canvas>
                    </div>
                    <canvas id="salesChartAxis" height="600" width="0"></canvas>
                </div>

                <div class= "average" >
                    Average Sales Per Month in Previous Year : <span id="order-linechart-average"><span id="unit-tag"></span> </span>
                    <br>
                    Total Sales in Previous Year  : <span id="order-linechart-sum"></span>
                </div>
            </div>

        </div>

    </div>


</div>
<br>





