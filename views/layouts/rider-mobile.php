<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Template</title>
    <!--Stylesheets-->
    <link rel="stylesheet" href="/css/rider-mobile.css" />
    <link rel="stylesheet" href="/css/template.css" />
    <link rel="stylesheet" href="/css/all.css" />
    <link rel="stylesheet" href="/css/fonts.css" />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!--Javascript-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/rider-mobile.js"></script>
</head>
<?php include_once("utils/sessions.php"); ?>
<?php include_once("utils/pwa.php"); ?>
<body>


{{content}}
<!--mobile navigation-->
<div class="navigation-container">
    <!--mobile navigation icons-->
    <div class="navigation-icons">
        <a class="navigation-item navigation-toggle" href="#menu-mobile"><i class="fas fa-bars"></i><span>Menu</span></a>
        <a class="navigation-item" href="./rider/orders"><i class="fas fa-truck "></i><span>Orders</span></a>
        <a class="navigation-item" href="./rider/profile"><i class="fas fa-user-circle"></i><span>Profile</span></a>
    </div>
    <!--mobile navigation sidebars-->
    <div class="navigation-sidebar" id="menu-mobile">
        <div class="navigation-header">
            <h3>Menu</h3>
        </div>
        <div class="navigation-content">
            <ul class="menu-mobile">
                <li class="menu-item">
                    <a href="index-2.html">Home</a><span class=""></span>
                </li>
                <li class="menu-item">
                    <a href="index-2.html">Past Orders</a><span class=""></span>
                </li>
                <li class="menu-item">
                    <a href="./logout">Logout</a><span class=""></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="navigation-back-overlay"></div>
</div>
</body>
</html>

