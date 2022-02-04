<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from enftx-html.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:03:46 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!---- Website Information ---->
    <title>Login Masyarakat</title>
    <meta name="description"
        content="EPengaduan Masyarakat Berbasis WEB">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="@@dashboard">
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<div id="preloader"><i>.</i><i>.</i><i>.</i></div>
<div class="authincation section-padding">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="mini-logo text-center my-4"><img src="images/logoi.png" width="100px" alt="">
                    <h4 class="card-title mt-5">Masyarakat</h4>
                </div>
                <div class="auth-form card">
                    <div class="card-body bg-transparent">
                    <?php
                        if(isset($_POST['username']) && isset($_POST['password'])) {
                            require 'modules/models.php';
                            try
                            {
                                $uname = $_POST['username'];
                                $passwd = $_POST['password'];
                                $user = (new Masyarakat($uname, $passwd))->login();
                                $_SESSION['username_'] = $_POST['username'];
                                $_SESSION['password_'] = $_POST['password'];
                                $_SESSION['nama_'] = $user['nama'];
                                $_SESSION['level_'] = 'user';

                                echo '<div class="alert alert-info" role="alert">Login Berhasil</div>';
                                header('Location: dashboard.php');
                            } catch (userDoesNotExist){
                                echo '<div class="alert alert-danger" role="alert">Akun Tidak Terdaftar</div>';
                            }
                        }else if(isset($_SESSION['username_']) && isset($_SESSION['password_'])){
                            header('Location: dashboard.php');
                        }
                    ?>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-12 mb-3"><label class="form-label">Username</label><input name="username"
                                        type="text" class="form-control" value="<?php echo isset($_POST['username'])?$_POST['username']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Password</label><input
                                        name="password" type="password" class="form-control" value="<?php echo isset($_POST['password'])?$_POST['password']:''?>">
                                </div>
                            </div>
                            <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary mr-2">Sign
                                    In</button></div>
                        </form>
                        <p class="mt-3 mb-0">Belum punya akun? <a class="text-primary" href="daftar.php">Daftar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
        body {
        background-image: url('images/bg/eagle-flat-landscape-720p.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
    .card-body {
            box-shadow: 0  0 5px 0;
            background: inherit;
            backdrop-filter: blur(10px);
        }
    .alert {
        backdrop-filter: blur(10px);
        opacity: 76%;
    }
</style>


</body>
</html>














<script src="js/scripts.js"></script>


</body>


<!-- Mirrored from enftx-html.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:03:48 GMT -->
</html>
