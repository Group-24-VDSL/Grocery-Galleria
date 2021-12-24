<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/all.css" />
    <link rel="stylesheet" href="/css/fonts.css" />
    <link rel="stylesheet" href="/css/dashboardStyle.css">
    <link rel="stylesheet" href="/css/template.css">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>
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
            <a href="">
                <i class="bx bxs-pie-chart-alt"></i>
                <span class="link-name">Analytics</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bx-data"></i>
                <span class="link-name">Stock</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bx-cog"></i>
                <span class="link-name">Settings</span>
            </a>
        </li>
        <li class="logout">
            <a href="/login">
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
        <div class="search-box">
            <input type="search" id="" placeholder="Search.... " />
            <button class="bx bx-search search"></button>
        </div>
        <div class="profile-details">
            <i class="bx bx-user"></i>
            <span class="user-name">Dilshan98</span>
        </div>
    </nav>

    <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="content">
                    <div class="box-topic">Total Orders</div>
                    <div class="number">1276</div>
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
                    <div class="number">1276</div>
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
                    <div class="box-topic">Total Income</div>
                    <div class="number">12,876</div>
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
                    <div class="number">11,086</div>
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
</body>
</html>
