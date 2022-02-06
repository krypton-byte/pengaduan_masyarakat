<?php
session_start();
$_SESSION['position'] = 'masyarakat';
require 'modules/models.php';
try{
    if(!(isset($_SESSION['username_']) && isset($_SESSION['password_']))){
        header('location: ../logout.php');
        exit();
    }
    $masyarakat = new Masyarakat($_SESSION['username_'], $_SESSION['password_']);
    $info = $masyarakat->login();
}catch(userDoesNotExist){
    header('location: logout.php');
}
    ?>
<html lang="en"><!-- Mirrored from enftx-html.vercel.app/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:03:48 GMT --><!-- Added by HTTrack --><head><meta http-equiv="content-type" content="text/html;charset=utf-8"><!-- /Added by HTTrack -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- disable caching -->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <!---- Website Information ---->
    <title>Masyarakat</title>
    <meta name="description" content="Pengaduan Masyarakat Berbasis WEB">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link rel="stylesheet" href="css/style.css">
<style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>

<body class="@@dashboard">
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<div id="preloader" style="display: none;"><i>.</i><i>.</i><i>.</i></div>

<div id="main-wrapper" class="show">

    <div class="header">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="header-content">
                    <div class="header-left">
                        <div class="brand-logo"><a class="mini-logo" href=""><img src="images/logoi.png" alt="" width="40"></a></div>
                    </div>
                    <div class="header-right">
                        <!-- <div class="theme-switch"><i class="ri-sun-line"></i></div> -->

                        <div class="dark-light-toggle theme-switch" onclick="themeToggle()">
                            <span class="dark"><i class="ri-moon-line"></i></span>
                            <span class="light"><i class="ri-sun-line"></i></span>
                        </div>
                        
                        <div class="dropdown profile_log dropdown">
                            <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                <div class="user icon-menu active"><span><img src="images/avatar/<?php echo $info['avatar']?>" alt=""></span>
                                </div>
                            </div>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <div class="user-email">
                                    <div class="user">
                                        <span class="thumb">
                                        <img src="images/avatar/<?php echo $info['avatar']?>" alt="">
                                        </span>
                                        <div class="user-info">
                                            <h5><?php echo htmlspecialchars($_SESSION['nama_']);?></h5>
                                            <span>Masyarakat</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="dropdown-item logout" href="logout.php">
                                    <i class="ri-logout-circle-line"></i>Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="sidebar">
    <div class="brand-logo"><a class="full-logo" href="#"><img src="images/logoi.png" alt="" width="30"></a></div>
    <div class="menu active">
        <ul class="show">
            <li class="active">
                <a href="dashboard.php" class="active">
                <span><i class="ri-layout-grid-fill"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
</div>

    <style>
    </style>
    <div class="content-body">
        <div class="container">