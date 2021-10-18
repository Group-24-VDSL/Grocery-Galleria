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
    <title>CustomerHome</title>
</head>
<body>
<?php include_once("utils/sessions.php"); ?>
<?php include_once("utils/pwa.php"); ?>
<!-- Header start -->
<header>
    <div class="header-1">
        <a href="#" class="logo"><img class="logo-img" src="/img/logo2.png" alt="" srcset=""></a>
        <a href="" class="logout"><i class="fas fa-sign-out-alt"></i></a>
    </div>
    <div class="header-2">
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#category">Category</a>
            <a href="#shops">Shops</a>
            <a href="#about">About us</a>
            <a href="#contact">Contact</a>
        </nav>
        <div class="part">
            <div id="menu-bar" class="fas fa-bars"></div>
            <div id="search-bar">
                <form action="" class="search-box-container">
                    <input type="search" id="search-box" placeholder="Search shop..">
                    <button class="fas fa-search search "></button>
                </form>
            </div>
        </div>
        <div class="part">
            <div class="icons">
                <a href="#"class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-clipboard-list"></a>
                <a href="#" class="fas fa-user"></a>
            </div>
        </div>
    </div>
</header>
<!-- Header end -->

{{content}}

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
                <a href="#">FAQ</a>
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

<!-- footer section ends -->
<script src="/js/main.js"></script>
<script src="/js/rivets-cart.min.js"></script>
</body>
</html>