<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/all.css"/>
    <link rel="stylesheet" href="/css/fonts.css"/>
    <link rel="stylesheet" href="/css/dashboardStyleStaff.css">
    <link rel="stylesheet" href="/css/template.css">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/template.js"></script>
    <title>Dashboard Delivery</title>
    <?php include_once("utils/pwa.php"); ?>
</head>
<body>
<?php include_once("utils/sessions.php"); ?>
<div class="sidebar active">
    <div class="sidebar-logo">
        <img src="../../img/logo_only_color.png" alt=""/>
        <img class="text" src="../../img/text_white-min.png" alt=""/>
    </div>
    <ul class="nav-links">
        <li>
            <a href="/dashboard/delivery/viewdelivery">
                <i class="bx bx-grid-alt"></i>
                <span class="link-name">Delivery Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/delivery/viewriders">
                <i class='bx bx-cycling'></i>
                <span class="link-name">Riders</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/delivery/profile">
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
            <span style="width: 350px" class="dashboard">Delivery Dashboard</span>
        </div>
        <div>

            <a href="javascript:history.back()" class="back-arrow"><i class="fas fa-step-backward"></i></a>

        </div>
    </nav>

    <div class="home-content">
        {{content}}
    </div>
</section>
<script src="/js/dashboardScript.js"></script>
<script src="/js/delivery-order.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>

