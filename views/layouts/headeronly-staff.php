<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/all.css">
  <link rel="stylesheet" href="../../views/Registration/css/registerStyle.css">
  <link rel="stylesheet" href="./css/complaint.css">
  <link rel="stylesheet" href="../shop/css/dashoboardStyle.css">
</head>
<?php include_once("utils/sessions.php"); ?>
<?php include_once("utils/pwa.php"); ?>
<body>
  <header>
    <div class="header-1">
      <a href="#" class="logo"><img class="logo-img" src="../../img/logo2.png" alt="dd" srcset=""></a>
      <a href="../shop/staff-comp.html" class="back"><i class="fas fa-step-backward"></i></a>
      </div>
  </header>

  <div class = "main-content" id="#complaint-section">
      <div class = "form-content">
            <ul class = "form-section page-section">
                <li id="cid_1" class="form-input-wide" data-type="control_head">
                    <div class="form-header-group  header-large">
                      <div class="header-text httal htvam">
                        <h1 id="header_1" class="form-header" data-component="header">
                          Complaints
                        </h1>
                        <div id="subHeader_1" class="form-subHeader">
                          Submit the Form To Add User Complaints 
                        </div>
                      </div>
                    </div>
                </li> 
            </ul>
      </div>

      {{content}}

  </body>
  </html>