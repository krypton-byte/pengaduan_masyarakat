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
    $img = uploadImageFromPath($_FILES['image']['tmp_name']);
    if($img){
        echo json_encode($user->buatPengaduan($_POST['isi'], $img), JSON_PRETTY_PRINT);
    }else{
        echo json_encode([ "status" => false ], JSON_PRETTY_PRINT);
    }
}
?>