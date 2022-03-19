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
    <!--Javascript-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/rider-mobile.js"></script>
    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        let endpoint = window.location.origin + "/rider/getlocation";

        const beamsClient = new PusherPushNotifications.Client({
            instanceId: 'd248ec3c-fd1b-484f-902b-82c20393efcb',
        });

        beamsClient.start()
            .then(() => beamsClient.addDeviceInterest('hello'))
            .then(() => console.log('Successfully registered and subscribed!'))
            .catch(console.error);

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('f08578b185d66fb3cf59', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('get-location',  async function (data) {
            console.log(data);
            let position = await  getPosition();
            let pos = {"lat":position["coords"]["latitude"],"lng":position["coords"]["longitude"]};
            console.log(pos);
            console.log(position);
            $.post(endpoint,JSON.stringify(pos));
        })

        function getPosition() {
            // Simple wrapper
            return new Promise((res, rej) => {
                navigator.geolocation.getCurrentPosition(res, rej);
            });
        }

    </script>
    <?php include_once("utils/pwa-rider.php"); ?>
</head>
<body>
<?php include_once("utils/sessions.php"); ?>

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

