<?php
session_start();
    if(!isset($_SESSION['nama'])){
        header('Location: login.php');
        exit();
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
    <title>Pengaduan Masyarakat</title>
    <meta name="description" content="ENFTX is the complete UX &amp; UI dashboard for NFT. Here included bids, collection, wallet, and all user setting pages including profile, application, activity, payment method, api, sign in &amp; sign up etc.">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
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
                        <div class="brand-logo"><a class="mini-logo" href="index.html"><img src="images/logoi.png" alt="" width="40"></a></div>
                    </div>
                    <div class="header-right">
                        <!-- <div class="theme-switch"><i class="ri-sun-line"></i></div> -->

                        <div class="dark-light-toggle theme-switch" onclick="themeToggle()">
                            <span class="dark"><i class="ri-moon-line"></i></span>
                            <span class="light"><i class="ri-sun-line"></i></span>
                        </div>


                        <div class="nav-item dropdown notification dropdown">
                            <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                <div class="notify-bell icon-menu"><span><i class="ri-notification-2-line"></i></span>
                                </div>
                            </div>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu notification-list dropdown-menu dropdown-menu-right">
                                <h4>Recent Notification</h4>
                                <div class="lists">
                                    <a class="" href="index.html#">
                                        <div class="d-flex align-items-center"><span class="me-3 icon success"><i class="ri-check-line"></i></span>
                                            <div>
                                                <p>Account created successfully</p><span>2020-11-04 12:00:23</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="" href="index.html#">
                                        <div class="d-flex align-items-center"><span class="me-3 icon fail"><i class="ri-close-line"></i></span>
                                            <div>
                                                <p>2FA verification failed</p><span>2020-11-04 12:00:23</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="" href="index.html#">
                                        <div class="d-flex align-items-center"><span class="me-3 icon success"><i class="ri-check-line"></i></span>
                                            <div>
                                                <p>Device confirmation completed</p><span>2020-11-04 12:00:23</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="" href="index.html#">
                                        <div class="d-flex align-items-center"><span class="me-3 icon pending"><i class="ri-question-mark"></i></span>
                                            <div>
                                                <p>xs verification pending</p><span>2020-11-04 12:00:23</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#">More<i class="ri-arrow-right-s-line"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown profile_log dropdown">
                            <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                <div class="user icon-menu active"><span><img src="images/avatar/9.jpg" alt=""></span>
                                </div>
                            </div>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <div class="user-email">
                                    <div class="user">
                                        <span class="thumb">
                                            <img src="images/profile/3.png" alt="">
                                        </span>
                                        <div class="user-info">
                                            <h5><?php echo $_SESSION['nama'];?></h5>
                                            <span>Masyarakat</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="profile.html">
                                    <span><i class="ri-user-line"></i></span>Profile
                                </a>
                                <a class="dropdown-item" href="wallet.html">
                                    <span><i class="ri-wallet-line"></i></span>Wallet
                                </a>
                                <a class="dropdown-item" href="settings-profile.html">
                                    <span><i class="ri-settings-3-line"></i></span>Settings
                                </a>
                                <a class="dropdown-item" href="settings-activity.html">
                                    <span><i class="ri-time-line"></i></span>Activity
                                </a>
                                <a class="dropdown-item" href="lock.html">
                                    <span><i class="ri-lock-line"></i></span>Lock
                                </a>
                                <a class="dropdown-item logout" href="logout.php">
                                    <i class="ri-logout-circle-line"></i>Logout
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
    <div class="brand-logo"><a class="full-logo" href="index.html"><img src="images/logoi.png" alt="" width="30"></a></div>
    <div class="menu active">
        <ul class="show">
            <li class="active">
                <a href="index-2.html" class="active">
                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11H7v2h4v4h2v-4h4v-2h-4V7h-2v4z" fill="rgba(111,78,242,1)"/></svg></span>
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