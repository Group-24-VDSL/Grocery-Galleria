<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function goBack() {
            history.back();
        }
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="/css/dashoboardStyle.css">
    <link rel="stylesheet" href="/css/complaint.css">
    <script src="/js/jquery.min.js"></script>
<?php include_once("utils/pwa.php"); ?>
</head>
<body>
<?php include_once("utils/sessions.php"); ?>
  <header>
    <div  style="height: 120px" class="header-1">
      <a href="#" class="logo"><img class="logo-img" src="../../img/logo2.png"  srcset=""></a>
        <button onclick="goBack()" class="back"><i class="fas fa-step-backward"></i></button>
      </div>
  </header>

      {{content}}

  </body>
  </html>