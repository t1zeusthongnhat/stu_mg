<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $titlePage ?? null; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="public/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="public/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="public/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="public/assets/images/favicon.ico" />
   

    <style>
      .disable-interaction{
        color: #000;
        font-size: 18px;
      }
      .total{
        color: #f2edf3;
        position: relative;
        font-size: 34px;
        top: 5px;
        margin-left: 5px;
      }
      .more{
        font-size: 18px;
        text-decoration: none;
        color: #000;
        width: 10px;
        height: 20px;
        border-radius: 10px;
        padding: 10px 60px;
        border-radius: 20px;
        border: #000 solid 0px;
        outline: none;
       
      }
      .more:hover{
        color: #000;
        background-color: #f2edf3;
        transform: scale(10,10);
      }
   
    .disable-interaction{
      line-height: 45px;
    }
    .custom-panel {
      top: 25px;
      text-align: center;
      background: linear-gradient(to right, #da8cff, #9a55ff) !important;
      border-radius: 15px;
      padding: 20px;
      margin-right: 10px;
      transition: background-color 0.3s, box-shadow 0.3s;
      position: relative;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    }
    .custom-panel:hover {
      background: linear-gradient(to right, #da8cff, #9a55ff) !important;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
      cursor: pointer;
    }

    .form-margin {
        margin-top: 35px;
    }

    .btnA {
        margin-top: 18px;
    }

    .btec {
        width: none;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .page-info {
        margin-top: 100px;
    }

    .pagination a {
        margin: 0 2px;

    }

    .pagination .show {
        margin-right: auto;
    }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php require "view/partials/navbar_view.php"; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php require "view/partials/sidebar_view.php"; ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">