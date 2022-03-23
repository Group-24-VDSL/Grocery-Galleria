<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/all.css" />
    <link rel="stylesheet" href="/css/fonts.css" />
    <link rel="stylesheet" href="/css/dashboardStyle.css">
    <link rel="stylesheet" href="/css/dashboardStyleStaff.css">
    <link rel="stylesheet" href="/css/template.css">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="/js/jquery.min.js"></script>
    <script src="/js/template.js"></script>

    <title>Dashboard-Shop</title>
    <?php include_once("utils/pwa.php"); ?>
</head>
<body>
<?php include_once("utils/sessions.php"); ?>
<div class="sidebar active">
    <div class="sidebar-logo">
        <img src="../../img/logo_only_color.png" alt="" />
        <img class="text" src="../../img/text_white-min.png" alt="" />
    </div>
    <ul class="nav-links">
        <li>
            <a href="/dashboard/shop/viewitems">
                <i class="bx bx-grid-alt"></i>
                <span class="link-name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/shop/additem">
                <i class="bx bx-add-to-queue"></i>
                <span class="link-name">Products</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/shop/products">
                <i class="bx bx-edit"></i>
                <span class="link-name">Products</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/shop/vieworders">
                <i class="bx bx-list-ol"></i>
                <span class="link-name">Order list</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/shop/analytics">
                <i class="bx bxs-pie-chart-alt"></i>
                <span class="link-name">Analytics</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/shop/profilesettings">
                <i class="bx bx-user"></i>
                <span class="link-name">Profile</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/shop/changepassword">
                <i class="bx bx-cog"></i>
                <span class="link-name">Settings</span>
            </a>
        </li>
        <li class="logout">
            <a href="/logout">
                <i class="bx bx-log-out"></i>
                <span class="link-name">Log out</span>
            </a>
        </li>
    </ul>
</div>
    <!-- Home section start -->

<section class="home-section">
    <nav>
        <div class="sidebar-toggle">
            <i class="bx bx-menu sidebarBtn"></i>
            <span class="dashboard">Shop Dashboard</span>
        </div>

    </nav>

    <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="content">
                    <div class="box-topic">Total Orders</div>
                    <div class="number" id="total-orders"></div>
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
                    <div class="box-topic">Total Revenue (LKR)</div>
                    <div class="number" id="total-revenue"></div>
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
                    <div class="box-topic">Total Income (LKR)</div>
                    <div class="number" id="today-revenue"></div>
                    <div class="indicator">
                        <i class="down bx bxs-down-arrow-square"></i>
                        <span class="text">Down from today</span>
                    </div>
                </div>
                <img
                        src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-financial-mobile-payment-itim2101-lineal-color-itim2101.png"
                />
            </div>
            <div class="box">
                <div class="content">
                    <div class="box-topic">Total Orders</div>
                    <div class="number" id="today-orders"></div>
                    <div class="indicator">
                        <i class="down bx bxs-down-arrow-square"></i>
                        <span class="text">Down From Today</span>
                    </div>
                </div>
                <img
                        src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-order-online-shopping-itim2101-lineal-color-itim2101.png"
                />
            </div>
        </div>
      {{content}}
    </div>
  </section>
<script src="/js/dashboardScript.js"></script>
<script src="/js/shop-cards.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>
