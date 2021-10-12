<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/all.css" />
    <link rel="stylesheet" href="/css/fonts.css" />
    <link rel="stylesheet" href="/css/dashboardStyle.css">
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<?php include_once("utils/sessions.php"); ?>
<body>
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="../../img/logo_only_color.png" alt="" />
        <img class="text" src="../../img/text_white-min.png" alt="" />
    </div>
    <ul class="nav-links">
        <li>
            <a href="">
                <i class="bx bx-grid-alt"></i>
                <span class="link-name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class='bx bx-user' ></i>
                <span class="link-name">Users</span>
            </a>
        </li>
        <li>
            <a href="">
            <i class="bx bx-box"></i>
                <span class="link-name">Products</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bx-list-ul"></i>
                <span class="link-name">Orders</span>
            </a>
        </li>
        <li>
            <a href="">
            <i class='bx bxs-truck'></i>
                <span class="link-name">Delivery</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bx-message-error"></i>
                <span class="link-name">Complaints</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class='bx bxs-report'></i>
                <span class="link-name">Reports</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bx-cog"></i>
                <span class="link-name">Settings</span>
            </a>
        </li>
        <li class="logout">
            <a href="">
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
            <span class="dashboard">Dashboard</span>
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
        
      {{content}}

    </div>
  </section>
<script src="/js/dashboardScript.js"></script>
</body>
</html>


