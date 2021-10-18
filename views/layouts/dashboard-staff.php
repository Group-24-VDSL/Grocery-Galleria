<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/all.css" />
    <link rel="stylesheet" href="/css/fonts.css" />
    <link rel="stylesheet" href="/css/dashboardStyleStaff.css">
    <link rel="stylesheet" href="/css/staff-register-form.css">
    <link rel="stylesheet" href="/css/template.css">
    <!--    <link rel="stylesheet" href="/css/boxicons.min.css" />-->
    <link
            href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
            rel="stylesheet"
    />

    <script src="/js/jquery.min.js"></script>
    <script src="/js/template.js"></script>
    <title>Dashboard-Shop</title>
</head>
<?php include_once("utils/sessions.php"); ?>
<?php include_once("utils/pwa.php"); ?>
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
                <i class="bx bx-box"></i>
                <span class="link-name">Products</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-group"></i>
                <span class="link-name">Users</span>
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
                <i class="bx bx-message-error"></i>
                <span class="link-name">Complaints</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class='bx bx-cycling'></i>
                <span class="link-name">Riders</span>
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
            <span style="width:300px" class="dashboard">Staff Dashboard</span>
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
<!-- Home section ends -->
<script src="/js/dashboardScript.js"></script>
</body>
