<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
    <!--    Jquery-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/template.js"></script>

    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/all.css"/>
    <link rel="stylesheet" href="/css/fonts.css"/>
    <link rel="stylesheet" href="/css/dashboardStyleStaff.css">
    <link rel="stylesheet" href="/css/template.css">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">


    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"  rel="stylesheet"  />
    <title>Dashboard-Staff</title>
    <?php include_once("utils/pwa.php"); ?>
</head>
<?php include_once("utils/sessions.php"); ?>
<body>
<div class="sidebar active">
    <div class="sidebar-logo">
        <img src="../../img/logo_only_color.png" alt=""/>
        <img class="text" src="../../img/text_white-min.png" alt=""/>
    </div>
    <ul class="nav-links">
        <li>
            <a href="/dashboard/staff/vieworders">
                <i class="bx bx-grid-alt"></i>
                <span class="link-name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/staff/products">
                <i class="bx bx-box"></i>
                <span class="link-name">Products</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/staff/additem">
                <i class='bx bx-list-plus'></i>
                <span class="link-name">New</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/staff/adduser">
                <i class='bx bx-user-plus'></i>
                <span class="link-name">Register</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/staff/viewusers">
                <i class="bx bxs-group"></i>
                <span class="link-name">Users</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/staff/systemreports">
                <i class="bx bxs-pie-chart-alt"></i>
                <span class="link-name">System Analytics</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/staff/shopreports">
                <i class="bx bxs-pie-chart-alt"></i>
                <span class="link-name">Shop Analytics</span>
            </a>
        </li>

        <li>
            <a href="/dashboard/staff/viewcomplaints">
                <i class="bx bx-message-error"></i>
                <span class="link-name">Complaints</span>
            </a>
        </li>
        <li>
            <a href="/dashboard/staff/profilesettings">
                <i class='bx bxs-user'></i>
                <span class="link-name">Profile</span>
            </a>
        </li>
        <li>
            <a href="/settings">
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
            <span style="width:300px" class="dashboard">Staff Dashboard</span>
        </div>
        <div class="search-box">
            <input type="search" id="" placeholder="Search.... "/>
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
<!--<script src="/js/complaint.js"></script>-->
<script src="/js/register.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>

