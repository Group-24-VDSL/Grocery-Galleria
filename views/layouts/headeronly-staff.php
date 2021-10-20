<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/all.css">
<!--  <link rel="stylesheet" href="../../views/Registration/css/registerStyle.css">-->
  <link rel="stylesheet" href="../shop/css/dashoboardStyle.css">
    <link rel="stylesheet" href="/css/complaint.css">
</head>
<?php include_once("utils/sessions.php"); ?>
<?php include_once("utils/pwa.php"); ?>
<body>
  <header>
    <div  style="height: 120px" class="header-1">
      <a href="#" class="logo"><img class="logo-img" src="../../img/logo2.png" alt="dd" srcset=""></a>
<!--      <a href="../shop/staff-comp.html" class="back"><i class="fas fa-step-backward"></i></a>-->
        <button onclick="goBack()" class="back"><i class="fas fa-step-backward"></i></button>
      </div>
  </header>

      {{content}}

  </body>
  </html>