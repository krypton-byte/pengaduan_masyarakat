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
    <title>ENFTX - NFT Dashboard HTML Template</title>
    <meta name="description"
        content="ENFTX is the complete UX & UI dashboard for NFT. Here included bids, collection, wallet, and all user setting pages including profile, application, activity, payment method, api, sign in & sign up etc.">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="@@dashboard">
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<div id="preloader"><i>.</i><i>.</i><i>.</i></div>

<div class="authincation section-padding">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="mini-logo text-center my-4"><a href="index-2.html"><img src="../images/logoi.png" width="150px" alt=""></a>
                    <h4 class="card-title mt-5">Administrator Register</h4>
                </div>
                <div class="auth-form card">
                    <div class="card-body">
                    <?php
                        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama']) && isset($_POST['telp'])) {
                            require '../modules/models.php';
                            try
                            {
                                $user = (new Petugas($_POST['username'], $_POST['password']))->daftar($_POST['nama'], $_POST['telp'], 'admin');
                                header('Location: login.php');
                                echo '<div class="alert alert-success" role="alert">
                                Berhasil. anda akan di arahakan kehalaman login
                              </div>';
                            } catch (Exception $e){
                                echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
                            }
                        }else if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                            header('Location: index.php');
                        }
                    ?>
                    
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-12 mb-3"><label class="form-label">Nama</label><input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama'])?$_POST['nama']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Username</label><input name="username" type="text" class="form-control" value="<?php echo isset($_POST['username'])?$_POST['username']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control" value="<?php echo isset($_POST['password'])?$_POST['password']:''?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Telp</label><input name="telp" type="text" class="form-control" value="<?php echo isset($_POST['telp'])?$_POST['telp']:'';?>"></div>
                            </div>
                            <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary mr-2">Sign
                                    In</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>














<script src="../js/scripts.js"></script>


</body>


<!-- Mirrored from enftx-html.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:03:48 GMT -->
</html>
