<html lang="en"><!-- Mirrored from enftx-html.vercel.app/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:04:14 GMT --><!-- Added by HTTrack --><head><meta http-equiv="content-type" content="text/html;charset=utf-8"><!-- /Added by HTTrack -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!---- Website Information ---->
    <title>Daftar Masyarakat</title>
    <meta name="description" content="ENFTX is the complete UX &amp; UI dashboard for NFT. Here included bids, collection, wallet, and all user setting pages including profile, application, activity, payment method, api, sign in &amp; sign up etc.">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="stylesheet" href="css/style.css">
</head>


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<body class="@@dashboard">

<div id="preloader" style="display: none;"><i>.</i><i>.</i><i>.</i></div>

<?php
if(isset($_POST['nik']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['telp']) && isset($_POST['nama']) && isset($_POST['avatar']) && is_numeric($_POST['avatar'])){
    require 'modules/models.php';
    require 'modules/avatar.php';
        try
        {
            $user = new Masyarakat($_POST['username'], $_POST['password']);
            $user->daftar($_POST['nama'], $_POST['nik'], $_POST['telp'], getAvatarFileByIndex(intval($_POST['avatar'])));
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
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AVATAR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row d-flex justify-content-center">
            <div class="col-5 my-0 col-sm-4">
                <img src="images/avatar/avt-1.jpg" class="avatar" id="avt0" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1 mr-1">
                <img src="images/avatar/avt-2.jpg" class="avatar" id="avt1" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1">
                <img src="images/avatar/avt-3.jpg" class="avatar" id="avt2" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1 mr-1">
                <img src="images/avatar/avt-4.jpg" class="avatar" id="avt3" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1">
                <img src="images/avatar/avt-5.jpg" class="avatar" id="avt4" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1 mr-1">
                <img src="images/avatar/avt-6.jpg" class="avatar" id="avt5" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1">
                <img src="images/avatar/avt-7.jpg" class="avatar" id="avt6" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1 mr-1">
                <img src="images/avatar/avt-8.jpg" class="avatar" id="avt7" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1">
                <img src="images/avatar/avt-9.jpeg" class="avatar" id="avt8" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1 mr-1">
                <img src="images/avatar/avt-10.jpg" class="avatar" id="avt9" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1">
                <img src="images/avatar/avt-11.jpg" class="avatar" id="avt10" srcset="">
            </div>
            <div class="col-5 col-sm-4 my-1 mr-1">
                <img src="images/avatar/avt-12.jpg" class="avatar" id="avt11" srcset="">
            </div>
     </div>
      <div class="container-fluid">
      </div>
      </div>
    </div>
  </div>
</div>
<style>
    .avatar {
        border-radius: 20%;
    }
</style>
<script type="text/javascript">
    $('.avatar').on('click', (x)=>{
        document.getElementById('avt').value = x.target.getAttribute('id').replace('avt','');
        Array.from(document.getElementsByClassName('avatar')).forEach((y)=>{
            y.style.border = '';
        })
        x.target.style.border = '2px solid blue';
        $('#exampleModal').modal('hide');
        document.getElementById('preview').src = x.target.getAttribute('src');
    })
</script>
<div class="authincation section-padding">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="mini-logo text-center my-4"><img src="images/logoi.png" width="100px" alt="">
                    <h4 class="card-title mt-5">Masyarakat</h4>
                </div>
                <div class="auth-form card">
                    <div class="card-body  bg-transparent">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-12 mb-3"><label class="form-label">Nik</label><input name="nik" type="text" class="form-control" value="<?php echo isset($_POST['nik'])?$_POST['nik']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Nama</label><input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama'])?$_POST['nama']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Username</label><input name="username" type="text" class="form-control" value="<?php echo isset($_POST['username'])?$_POST['username']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Telp</label><input name="telp" type="text" class="form-control" value="<?php echo isset($_POST['telp'])?$_POST['telp']:'';?>"></div>
                                <div class="col-12 mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control" value="<?php echo isset($_POST['password'])?$_POST['password']:'';?>"></div>
                                <input type="hidden" value="1" name="avatar" id="avt">
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label align-middle">Avatar</label>
                                        </div>
                                        <div class="col-3 offset-6" style="float: right;" onclick="$('#exampleModal').modal('show')">
                                            <img src="images/avatar/avt-1.jpg" alt="" srcset="" id="preview" style="float: right;border-radius:20%;border: 2px solid blue;">
                                        </div>
                                    </div>
                                    <!-- <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal"">Ubah</button> -->
                                </div>
                            </div>
                            <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary mr-2">Daftar</button></div>
                        </form>
                        <div class="text-center">
                            <p class="mt-3 mb-0"><a class="text-primary" href="login.php">Login</a>?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>














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
        
</style>
<script src="js/scripts.js"></script>





<!-- Mirrored from enftx-html.vercel.app/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 08:04:16 GMT -->
</body></html>