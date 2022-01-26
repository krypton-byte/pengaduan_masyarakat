<?php
session_start();
require '../modules/imgbb.php';
require '../modules/models.php';
header('content-type: application/json');
if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    exit();
}
if(isset($_POST['isi']) && isset($_FILES['image']))
{
    $user = new Masyarakat($_SESSION['username'], $_SESSION['password']);
    if( getimagesize($_FILES['image']['tmp_name'])/* $img */ ){
        #$img = uploadImageFromPath($_FILES['image']['tmp_name']);
        $file = uploadImageFromPath($_FILES['image']['tmp_name']);
        // $nname = str_replace('.','',strval(microtime(true))).'.'.explode('/', mime_content_type($_FILES['image']['tmp_name']))[1];
        // echo $nname;
        // move_uploaded_file($_FILES['image']['tmp_name'], realpath(dirname(__FILE__).'/..').'/gambar-aduan/'.$nname);
        // echo '{}';
        echo json_encode($user->buatPengaduan($_POST['isi'], $file), JSON_PRETTY_PRINT);
        exit();
    }
    echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    exit();
}
echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
exit();
?>