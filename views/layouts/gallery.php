<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/main.css">
    <!-- JavaScript -->
    <script src="/js/jquery.min.js"></script>
    <title>Shop Gallery</title>
</head>
    <?php include_once("utils/pwa.php"); ?>
<body>
<?php include_once("utils/sessions.php"); ?>
<!-- Header start -->
<header>
    <div class="header-1">
        <a href="#" class="logo"><img class="logo-img" src="/img/logo2.png" alt="" srcset=""></a>
        <a href="javascript:history.back()" class="backward"><i class="fas fa-step-backward"></i></a>
    </div>
    <!-- Vege banner start -->
    <section class="shop-banner" id="banner">
        <div class="content">
            <h3 class="title"><i class="fas fa-store"></i> <span id="CategoryType"></span> Stores</h3>
            <h3 id="city-name" class="subtitle">City</h3>
            <h3 id="suburb-name" class="subtitle">Suburb</h3>
        </div>
    </section>
    <!-- Vege banner end -->
    <div class="header-2">
        <nav class="navbar">
            <a href="#contact">home</a>
            <a href="#contact">category</a>
            <a href="#contact">shops</a>
            <a href="#contact">FAQ</a>
            <a href="#contact">contact us</a>
        </nav>
        <div class="part">
            <div id="menu-bar" class="fas fa-bars"></div>

        </div>
        <div class="part">
            <div class="icons">
                <a href="/customer/cart"class="fas fa-shopping-cart"></a>
                <a href="/customer/profile" class="fas fa-user"></a>
            </div>
        </div>
    </div>
</header>
<!-- Header end -->
<!-- Shop section Start -->
{{content}}
<!--Shop section Ends-->
<!-- Footer start -->

<section class="footer" id="contact">

    <div class="box-container">

        <div class="box">
            <a href="#" class="logo"><img class="logo-img" src="/img/logo2.png" alt="" srcset=""></a>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam culpa sit enim nesciunt rerum laborum illum quam error ut alias!</p>
            <div class="communication">
                <a href="#" class="btn fas fa-phone-alt"></a>
                <a href="#" class="btn far fa-envelope"></a>
                <a href="#" class="btn fab fa-whatsapp"></a>
                <a href="#" class="btn fab fa-telegram-plane"></a>
            </div>
        </div>

        <div class="box">
            <h3>Address</h3>
            <ul>
                <li class="element">No:56/B,</li>
                <li class="element">Union Avenue,</li>
                <li class="element">Colombo,</li>
                <li class="element">Sri Lanka.</li>
                <li class="element">grocerygalleria33@gmail.com</li>
            </ul>
        </div>
        <div class="box">
            <h3>quick links</h3>
            <div class="links">
                <a href="#home">home</a>
                <a href="#category">category</a>
                <a href="#shops">shops</a>
                <a href="#faq">FAQ</a>
                <a href="#contact">contact us</a>
            </div>
        </div>
        <div class="box">
            <h3>Services</h3>
            <div class="links">
              <span>
                <img class="features-logo" src="/img/gurantee.png" alt="">
              </span>
                <span>
                <img class="features-logo" src="/img/delivery.png" alt="">
              </span>
            </div>
        </div>
        <div class="box">
            <h3>Payment</h3>
            <div class="links">
                <img class="features-logo" src="/img/visa.png" alt="">
                </span>
                <span>
            <img class="features-logo" src="/img/mastercard.png" alt="">
          </span>
            </div>
        </div>
    </div>

    <p class="footer-copyright">&#169; 2021 Grocery Galleria. All right reserved.</p>

</section>
<!-- Footer ends -->

<script src="/js/gallery.js"></script>

</body>
</html>