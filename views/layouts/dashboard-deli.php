<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/template.css" />
    <link rel="stylesheet" href="/css/dashboard.css" />
    <link rel="stylesheet" href="/css/all.css" />
    <link rel="stylesheet" href="/css/fonts.css" />
    <link rel="stylesheet" href="/css/staff-dashboard.css">
    <!--Javascript-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/template.js"></script>
    <script src="/js/dashboard.js"></script>

    <title>Dashboard-Delivery</title>
</head>
<?php include_once("utils/sessions.php"); ?>
<body>
<div class="sidebar collapsed">
    <a id="menu" class="menu-item menu-item-menu">
        <span id="menu-icon" class="menu-icon"><i class="fas fa-bars"></i></span>
        <span id="" class="menu-text menu-expand display-none">Menu</span>
    </a>
    <a id="" class="menu-item" href="#">
        <span id="" class="menu-icon"><i class="fas fa-shopping-basket"></i></span>
        <span id="" class="menu-text menu-expand display-none">Trips</span>
        <span id="" class="menu-expand-icon display-none"><i class="fas fa-caret-right fa-menu-expand-icon"></i></span>
    </a>
    <div class="menu-dropdown-container display-none">
        <a id="" class="menu-item menu-item-child" href="#">
            <span id="" class="menu-icon"><i class="fas fa-shopping-basket"></i></span>
            <span id="" class="menu-text menu-expand display-none">Pending</span>
        </a>
        <a id="" class="menu-item menu-item-child" href="#">
            <span id="" class="menu-icon"><i class="fas fa-shopping-basket"></i></span>
            <span id="" class="menu-text menu-expand display-none">Delivered</span>
        </a>
    </div>
    <a id="" class="menu-item" href="#">
        <span id="" class="menu-icon"><i class="fas fa-cash-register"></i></span>
        <span id="" class="menu-text menu-expand display-none">Riders</span>
        <span id="" class="menu-expand-icon display-none"><i class="fas fa-caret-right fa-menu-expand-icon"></i></span>
    </a>
    <div class="menu-dropdown-container display-none">
        <a id="" class="menu-item menu-item-child" href="#">
            <span id="" class="menu-icon"><i class="fas fa-shopping-basket"></i></span>
            <span id="" class="menu-text menu-expand display-none">Add Rider</span>
        </a>
        <a id="" class="menu-item menu-item-child" href="#">
            <span id="" class="menu-icon"><i class="fas fa-shopping-basket"></i></span>
            <span id="" class="menu-text menu-expand display-none">View Riders</span>
        </a>
    </div>
    <a id="menu" class="menu-item menu-item-logout">
        <span id="" class="menu-icon"><i class="fas fa-power-off"></i></span>
        <span id="" class="menu-text menu-expand display-none">Logout</span>
    </a>
</div>

{{content}}

</body>
</html>