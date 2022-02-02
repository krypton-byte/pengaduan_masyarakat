<?php
  $_SESSION['position'] = 'administrator';
  if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    header('location: ../logout.php');
    exit();
  }
  require '../modules/models.php';
  $petugas = new Petugas($_SESSION['username'], $_SESSION['password']);
  try{
    $info = $petugas->login();
  }catch(userDoesNotExist){
    header('location: ../logout.php');
    exit();
  }
?>

<html lang="en">
  <!-- Mirrored from enftx-html.vercel.app/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:03:48 GMT --><!-- Added by HTTrack --><head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <!-- /Added by HTTrack -->

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- disable caching -->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <!---- Website Information ---->
    <title><?php echo $title ?></title>
    <meta
      name="description"
      content="Pengaduan Masyarakat Berbasis WEB"
    />

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="stylesheet" href="../css/style.css" />
    <style type="text/css">
      /* Chart.js */
      @keyframes chartjs-render-animation {
        from {
          opacity: 0.99;
        }
        to {
          opacity: 1;
        }
      }
      .chartjs-render-monitor {
        animation: chartjs-render-animation 1ms;
      }
      .chartjs-size-monitor,
      .chartjs-size-monitor-expand,
      .chartjs-size-monitor-shrink {
        position: absolute;
        direction: ltr;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        pointer-events: none;
        visibility: hidden;
        z-index: -1;
      }
      .chartjs-size-monitor-expand > div {
        position: absolute;
        width: 1000000px;
        height: 1000000px;
        left: 0;
        top: 0;
      }
      .chartjs-size-monitor-shrink > div {
        position: absolute;
        width: 200%;
        height: 200%;
        left: 0;
        top: 0;
      }
    </style>
  </head>

  <body class="@@dashboard">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/chartjs/chart.bundle.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div id="preloader" style="display: none"><i>.</i><i>.</i><i>.</i></div>
    <div id="main-wrapper" class="show">
      <div class="header">
        <div class="container">
          <div class="row">
            <div class="col-xxl-12">
              <div class="header-content">
                <div class="header-left">
                  <div class="brand-logo">
                    <a class="mini-logo" href="index.html"
                      ><img src="../images/logoi.png" alt="" width="40"
                    /></a>
                  </div>
                </div>
                <div class="header-right">
                  <!-- <div class="theme-switch"><i class="ri-sun-line"></i></div> -->

                  <div
                    class="dark-light-toggle theme-switch"
                    onclick="themeToggle()"
                  >
                    <span class="dark"><i class="ri-moon-line"></i></span>
                    <span class="light"><i class="ri-sun-line"></i></span>
                  </div>

                  <div class="dropdown profile_log dropdown">
                    <div
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      class=""
                      aria-expanded="false"
                    >
                      <div class="user icon-menu active">
                        <span><img src="../images/avatar/officeman.png" alt="" /></span>
                      </div>
                    </div>
                    <div
                      tabindex="-1"
                      role="menu"
                      aria-hidden="true"
                      class="dropdown-menu dropdown-menu-right"
                    >
                      <div class="user-email">
                        <div class="user">
                          <span class="thumb">
                            <img src="../images/profile/3.png" alt="" />
                          </span>
                          <div class="user-info">
                            <h5><?php echo htmlspecialchars($info['nama'])?></h5>
                            <span><?php echo htmlspecialchars($info["level"])?></span>
                          </div>
                        </div>
                      </div>
                      <a class="dropdown-item logout" href="../logout.php">
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
        <div class="brand-logo">
          <a class="full-logo" href="index.html"
            ><img src="../images/logoi.png" alt="" width="30"
          /></a>
        </div>
        <div class="menu">
          <ul class="show">
            <li>
              <a href="index.php">
                <span><i class="ri-bar-chart-box-line"></i></span>
                <span class="nav-text">Statistik</span>
              </a>
            </li>
            <?php if($info['level'] === 'petugas'){ ?>
            <li class="">
              <a href="pengaduan.php">
                <span><i class="ri-chat-4-line"></i></span>
                <span class="nav-text">Pengaduan</span>
              </a>
            </li>
            <?php
            }
            ?>
            <?php
            if($info['level'] === 'admin'){
            ?>
              <li>
                <a href="laporan.php">
                  <span><i class="ri-printer-line"></i></span>
                  <span class="nav-text">Laporan</span>
                </a>
              </li>
              <li>
                <a href="petugas.php"><span><i class="ri-shield-user-line"></i></span>
              <span class="nav-text">Petugas</span></a>
              </li>
              <li>
                <a href="masyarakat.php"><span><i class="ri-user-line"></i></span>
              <span class="nav-text">Masyarakat</span></a>
              </li>
            <?php
            }
            ?>

          </ul>
        </div>
      </div>

      <style></style>
      <div class="content-body">