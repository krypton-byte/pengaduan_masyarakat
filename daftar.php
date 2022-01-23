<html lang="en"><!-- Mirrored from enftx-html.vercel.app/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:04:14 GMT --><!-- Added by HTTrack --><head><meta http-equiv="content-type" content="text/html;charset=utf-8"><!-- /Added by HTTrack -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!---- Website Information ---->
    <title>ENFTX - NFT Dashboard HTML Template</title>
    <meta name="description" content="ENFTX is the complete UX &amp; UI dashboard for NFT. Here included bids, collection, wallet, and all user setting pages including profile, application, activity, payment method, api, sign in &amp; sign up etc.">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="@@dashboard">

<div id="preloader" style="display: none;"><i>.</i><i>.</i><i>.</i></div>
<?php
if(isset($_POST['nik']) && isset($_POST['username']) && $_POST['password'] && $_POST['telp'] && $_POST['nama']){
    require 'modules/models.php';
        try
        {
            $user = new Masyarakat($_POST['username'], $_POST['password']);
            $user->daftar($_POST['nama'], $_POST['nik'], $_POST['telp']);
            header('Location: login.php');
            echo '<div class="alert alert-info" role="alert">
            Akun berhasil didaftarkan!
          </div>';
        } catch (penggunaTelahTerdaftar | IsNotNumeric | Exception $e){
            echo '<div class="alert alert-danger" role="alert">';
            echo  $e->getMessage();
            echo '</div>';
        }
}

?>
<div class="authincation section-padding">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="mini-logo text-center my-4"><a href="index-2.html"><img src="images/logo.png" alt=""></a>
                    <h4 class="card-title mt-5">Sign up to ENFTX</h4>
                </div>
                <div class="auth-form card">
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-12 mb-3"><label class="form-label">Nik</label><input name="nik" type="text" class="form-control" value="<?php echo isset($_POST['nik'])?$_POST['nik']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Nama</label><input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama'])?$_POST['nama']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Username</label><input name="username" type="text" class="form-control" value="<?php echo isset($_POST['username'])?$_POST['username']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Telp</label><input name="telp" type="text" class="form-control" value="<?php echo isset($_POST['telp'])?$_POST['telp']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control" value="<?php echo isset($_POST['password'])?$_POST['password']:'';?>"></div>
                            </div>
                            <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary mr-2">Sign
                                    Up</button></div>
                        </form>
                        <div class="text-center">
                            <p class="mt-3 mb-0"><a class="text-primary" href="login.php">Sign in</a>to your account</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    fetch()
</script>


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>














<script src="js/scripts.js"></script>





<!-- Mirrored from enftx-html.vercel.app/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:04:16 GMT -->
</body></html>